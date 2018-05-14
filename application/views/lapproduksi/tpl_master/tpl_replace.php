<?php
function replaceKat($kat){
    $result = str_replace(" ", "_", $kat);
    $output = str_replace("-", "_", $result);
    return $output;
}