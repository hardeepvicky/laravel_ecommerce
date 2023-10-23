<?php

use App\Helpers\Util;

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
    $query_params = [];
    $query_params['sort_by'] = $sort_by;
    $query_params['sort_dir'] = 'ASC';

    return get_url($query_params);
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

    return '<a href="' . $url . '">' . $html . '</a>';
}

function get_next_tab($tabs, $tab, &$is_last_tab)
{
    $keys = array_keys($tabs);

    if (!$tab) {
        return 0;
    }

    $next_index = $current_index = 0;
    for ($i = 0; $i < count($keys); $i++) {
        if ($keys[$i] == $tab) {
            $current_index = $i;
            if ($i < count($keys) - 1) {
                $next_index = $i + 1;
            } else {
                $next_index = $i;
            }
        }
    }

    $is_last_tab = $current_index == (count($keys) - 1);

    return $keys[$next_index];
}