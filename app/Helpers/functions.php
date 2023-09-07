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