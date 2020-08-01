<?php

define('BASE_URL', 'http://localhost/hoc-php/ass/');

function formatDate($date, $format = "d/m/Y"){
    $time = new DateTime($date);
    return $time->format($format);
}