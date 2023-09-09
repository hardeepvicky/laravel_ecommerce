<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function delete($model, $id)
    {
        $record = $model::query()->withAllCount()->findOrFail($id);

        dd($record->toArray());

        foreach($record->getRelations() as $relation => $items)
        {
            if (!empty($items->toArray()))
            {
                throw new \Exception("Record has associated data. can't delete");
            }
        }

        $record->delete();
    }
}
