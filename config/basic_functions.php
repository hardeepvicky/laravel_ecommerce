<?php

use App\Helpers\Util;

function d($arg, $will_exit = false)
{
    $callBy = debug_backtrace()[0];
    echo "<pre>";
    echo "<b>" . $callBy['file'] . "</b> At Line : " . $callBy['line'];
    echo "<br/>";
    
    if (is_string($arg))
    {
        echo htmlspecialchars($arg);
    }
    else
    {
        print_r($arg);
    }
    
    echo "</pre>";

    if ($will_exit)
    {
        exit;
    }
}

function throw_exception($msg)
{
    $callBy = debug_backtrace()[1];

    $prefix = "";

    if (isset($callBy['class']))
    {
        $call_class_name = $callBy['class'];

        $prefix .= $call_class_name . "->";
    }

    if (isset($callBy['function']))
    {
        $call_fn_name = $callBy['function'];

        $prefix .= $call_fn_name . "() : ";
    }

    throw new Exception($prefix . $msg);
}

function get_url_params_in_array()
{
    $url_arr = explode("?", $_SERVER["REQUEST_URI"]);

    $query_params = [];
    if (isset($url_arr[1])) {
        $query_list = explode("&", $url_arr[1]);

        foreach ($query_list as $str) {
            list($k, $v) = explode("=", $str);
            $query_params[$k] = $v;
        }
    }

    return $query_params;
}

function get_url($extra_params = [])
{
    $url_arr = explode("?", $_SERVER["REQUEST_URI"]);

    $page_url = $url_arr[0];

    $query_params = [];

    if (isset($url_arr[1])) {
        $query_list = explode("&", $url_arr[1]);

        foreach ($query_list as $str) {
            list($k, $v) = explode("=", $str);
            $query_params[$k] = $v;
        }
    }

    $extra_params = Util::applyAllforKey(Util::applyAll($extra_params, ["trim"]), ["trim"]);

    $query_params = array_merge($query_params, $extra_params);

    $query_list = [];

    foreach ($query_params as $k => $v) {
        $query_list[] = "$k=$v";
    }

    return $page_url . "?" . implode("&", $query_list);
}

function sortable_url($sort_by)
{
    $url_params = get_url_params_in_array();
    $params = [];
    $params['sort_by'] = $sort_by;
    $params['sort_dir'] = 'ASC';

    if ( isset($url_params['sort_dir']) )
    {
        if ($url_params['sort_dir'] == 'ASC')
        {
            $params['sort_dir'] = 'DESC';
        }
    }

    return get_url($params);
}

function sortable_anchor(String $sort_by, String $title, array $attrs = [])
{
    $url = sortable_url($sort_by);

    $html = '<a href="' . $url . '"';

    $atrr_list = [];
    foreach ($attrs as $k => $v) {
        if (is_numeric($k)) {
            $k = $v;
        }

        $atrr_list[] = $v . '="' . $v . '"';
    }

    $html .= " " . implode(" ", $atrr_list);
    $html = trim($html);
    $html .= '>';

    $content_html = $title;

    if (isset($_GET['sort_dir']) && isset($_GET['sort_by']) && $_GET['sort_by'] == $sort_by) {
        if (strtoupper(trim($_GET['sort_dir'])) == 'DESC') {
            $content_html .= ' ' . '<i class="fas fa-arrow-up"></i>';
        } else {
            $content_html .= ' ' . '<i class="fas fa-arrow-down"></i>';
        }
    }

    $html .= $content_html;

    $html .= '</a>';

    return $html;
}