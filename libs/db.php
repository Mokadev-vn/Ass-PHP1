<?php

function connDB(){
    $dns = "mysql:host=localhost;dbname=web;charset=utf8";
    $dbUserName = "root";
    $dbPass = "1306";
    return new PDO($dns, $dbUserName, $dbPass);
}