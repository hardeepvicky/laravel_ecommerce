<?php
function d($array)
{
    $callBy = debug_backtrace()[0];
    echo "<pre>";
    echo "<b>" . $callBy['file'] . " At Line : " . $callBy['line'] . "</b>";
    echo "<br/>";
    print_r($array);    
    echo "</pre>";
}

function throw_exception($msg)
{
    throw new Exception($msg); 
}

function curl_get_request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

function curl_post_request($url, $params, $headers = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);

    return $res;
}

function sortable_url($sort_by)
{
    $url_arr = explode("?", $_SERVER["REQUEST_URI"]);

    $page_url = $url_arr[0];

    $query_params = [];

    if (isset($url_arr[1]))
    {
        $query_list = explode("&", $url_arr[1]);
        
        foreach($query_list as $str)
        {
            list($k, $v) = explode("=", $str);
            $query_params[$k] = $v; 
        }
    }

    //dd($query_params); exit;

    $query_params['sort_by'] = $sort_by;
    $query_params['sort_dir'] = 'ASC';

    if (isset($_GET['sort_dir']))
    {
        if (strtoupper(trim($_GET['sort_dir'])) == 'DESC')
        {
            $query_params['sort_dir'] = 'ASC';
        }
        else
        {
            $query_params['sort_dir'] = 'DESC';
        }
    }

    $query_list = [];

    foreach ($query_params as $k => $v)
    {
        $query_list[] = "$k=$v";
    }

    return $page_url . "?" . implode("&", $query_list);
}

function sortable_anchor(String $sort_by, String $title, Array $attrs = [])
{
    $url = sortable_url($sort_by);

    $html = '<a href="' . $url . '"';

    $atrr_list = [];
    foreach($attrs as $k => $v)
    {
        if (is_numeric($k))
        {
            $k = $v;
        }

        $atrr_list[] = $v . '="' . $v . '"';
    }

    $html .= " " . implode(" ", $atrr_list);
    $html = trim($html);
    $html .= '>';

    $content_html = $title;

    if (isset($_GET['sort_dir']) && isset($_GET['sort_by']) && $_GET['sort_by'] == $sort_by)
    {
        if (strtoupper(trim($_GET['sort_dir'])) == 'DESC')
        {
            $content_html .= ' ' . '<i class="fas fa-arrow-up"></i>';
        }
        else
        {
            $content_html .= ' ' . '<i class="fas fa-arrow-down"></i>';
        }
    }

    $html .= $content_html;

    $html .= '</a>';

    return '<a href="' . $url . '">' . $html . '</a>';
}