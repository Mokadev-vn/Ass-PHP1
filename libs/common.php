<?php

define('BASE_URL', 'http://localhost/hoc-php/ass/');

// format date
function formatDate($date, $format = "d/m/Y")
{
    $time = new DateTime($date);
    return $time->format($format);
}

// permission
function role($type = 'user', $next = '')
{
    $role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

    if ($role == '') {
        if ($next == '') {
            header('Location: ' . BASE_URL .'login.php');
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

// check login auth
function checkLog($next = false)
{
    $role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';
    
    if ($role != '') {
        header('Location: ' . BASE_URL);
        return false;
    }

    return true;
}


function error($key, $message){
    $_SESSION['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : [];
    $_SESSION['error'][$key] = $message;
}