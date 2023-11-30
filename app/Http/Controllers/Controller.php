<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\SqlLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Helpers\FileUtility;
use App\Models\EmailLog;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function _delete(Model $model)
    {
        if ( !isset($model->child_model_class))
        {
            $class_name = get_class($model);
            throw_exception("child_model_class Array is not set in model $class_name");
        }

        foreach($model->child_model_class as $className => $arr)
        {
            if ($arr['preventDelete'])
            {
                $count = $className::where($arr['foreignKey'], $model->id)->count();

                if ($count > 0)
                {
                    throw_exception("Record has associated data in $className. can't delete");
                }
            }
            else
            {
                $child_records = $className::where($arr['foreignKey'], $model->id)->get();

                if ($child_records->count() > 0)
                {
                    foreach($child_records as $child_record)
                    {
                        $this->_delete($child_record);
                    }
                }
            }
        }

        if ( !$model->delete() )
        {
            $class_name = get_class($model);
            throw_exception("Fail to delete record of $class_name");
        }
    }
    
    public function delete(Model $model)
    {
        DB::beginTransaction();

        try
        {
            $this->_delete($model);

            DB::commit();

            return true;
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
            $this->saveSqlLog();
            throw $ex;
        }
    }

    protected function saveSqlLog()
    {
        if (App::environment('production')) 
        {
            return false;
        }

        $db_logs = DB::getQueryLog();

        if (count($db_logs) == 0)
        {
            return false;
        }

        $sqlLogModel = new SqlLog();

        $sqlLogModel->route_name_or_url = Route::getCurrentRoute()->getName();

        if (!$sqlLogModel->route_name_or_url)
        {
            $sqlLogModel->route_name_or_url = request()->getRequestUri();
        }

        $sqlLogModel->have_dml_query = false;
        $sqlLogModel->have_heavy_query = false;
       
        if ( !$sqlLogModel->saveQuietly() )
        {
            throw_exception("Fail to Save Sql Log");
        }

        $sql_list = $dml_sql_list = [
            implode(",", ["Query", "Time-In-MilliSeconds"])
        ];

        foreach ($db_logs as $row)
        {
            $is_dml = false;

            $query = $row['query'];

            $query = vsprintf(str_replace('?', '%s', $query), $row['bindings']);

            $query = trim(preg_replace('/\s+/', ' ', $query));
            
            $sql_row = implode(", ", [$query, $row["time"]]);

            $sql_list[] = $sql_row;

            $query_first_10_chars = substr($query, 0, 10);
            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "INSERT") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "insert") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "UPDATE") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "update") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "DELETE") !== false;
            }

            if (!$is_dml)
            {
                $is_dml = strpos($query_first_10_chars, "delete") !== false;
            }

            if ($is_dml)
            {
                $sqlLogModel->have_dml_query = true;

                $dml_sql_list[] = $sql_row;
            }

            if ($row["time"] > 1000)
            {
                $sqlLogModel->have_heavy_query = true;
            }
        }

        $path = SqlLog::getFileSavePath() . $sqlLogModel->id . "/";
        FileUtility::createFolder($path);

        $sqlLogModel->sql_log_file = $path . "sql.txt";

        $content = implode(PHP_EOL, $sql_list);
        file_put_contents($sqlLogModel->sql_log_file, $content);

        if ($sqlLogModel->have_dml_query)
        {
            $sqlLogModel->sql_dml_log_file = $path . "sql_dml.txt";
            $content = implode(PHP_EOL, $dml_sql_list);
            file_put_contents($sqlLogModel->sql_dml_log_file, $content);
        }

        if ( !$sqlLogModel->saveQuietly() )
        {
            throw_exception("Fail to Save Sql Log");
        }

        return true;
    }

    public function responseJson(Array $response)
    {
        $this->saveSqlLog();
        
        return $response;
    }

    public function email_log_save(array $from, array $to, String $subject, String $html)
    {
        if (!isset($from['name']))
        {
            throw new Exception("name is not set in from");
        }

        if (!isset($from['email']))
        {
            throw new Exception("email is not set in from");
        }

        if (strlen($subject) > 80)
        {
            throw new Exception("Subject length should be less than 80 chars");
        }

        foreach($to as $k => $t)
        {
            if (!isset($t['name']))
            {
                throw new Exception("name is not set in to->$k");
            }

            if (!isset($t['email']))
            {
                throw new Exception("email is not set in to->$k");
            }
            
            $emailLog = new EmailLog();

            $path = EmailLog::getFileSavePath();

            FileUtility::createFolder($path);

            $file = $emailLog->getNextId() . ".html";

            file_put_contents($path . $file, $html);

            $emailLog->fill([
                "from_name" => $from['name'],
                "from_email" => $from['email'],
                "to_name" => $t['name'],
                "to_email" => $t['email'],
                "subject" => $subject,
                "content_file" => $path . $file
            ]);

            if (!$emailLog->save())
            {
                throw new Exception("Email Log Save Failed");
            }
        }
    }

    public function email_send(array $from, array $to, String $subject, String $html)
    {
        $this->email_log_save($from, $to, $subject, $html);
        
        $endpoint = 'https://api.brevo.com/v3/smtp/email';

        $api_key = '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';

        //Request payload

        $data = array(
            'sender' => $from,
            'to' => $to,
            'subject' => $subject,
            'htmlContent' => $html
        );

        //Set cURL options

        $options = array(
            CURLOPT_URL => $endpoint,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'api-key: ' . $api_key,
                'content-type: application/json'
            )
        );

        
        $curl = curl_init();
        
        curl_setopt_array($curl, $options);
        
        $response = curl_exec($curl);

        if ($response === false) {

            throw new Exception(curl_error($curl));

        } else {

            curl_close($curl);

            $response_data = json_decode($response, true);

            if (isset($response_data['messageId'])) 
            {
                return true;
            }
        }

        return false;
    }
}
