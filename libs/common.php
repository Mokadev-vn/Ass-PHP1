<?php

define('BASE_URL', 'http://localhost/hoc-php/ass/');

function formatDate($date, $format = "d/m/Y")
{
    $time = new DateTime($date);
    return $time->format($format);
}

function role($type = 'user', $next = '')
{
    $role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

    if ($role == '') {
        if ($next == '') {
            header('Location: ' . BASE_URL);
        }
        return false;
    }

    if ($type == 'admin' && $role != 1) {
        if ($next == '') {
            header('Location: ' . BASE_URL);
        }
        return false;
    }

    return true;
}


function checkLog($next = false)
{
    $role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

        if ($role == 1 && $next) {
            header('Location: ' . BASE_URL);
            return false;
        }

        if($role != 1 && $role != '') {
            header('Location: ' . BASE_URL);
            return false;
        }

    return true;
}
