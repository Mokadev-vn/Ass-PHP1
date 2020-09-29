<?php

// function connect database
function connDB(){
    $dns = "mysql:host=localhost;dbname=web;charset=utf8";
    $dbUserName = "root";
    $dbPass = "1306";
    return new PDO($dns, $dbUserName, $dbPass);
}

// function insert database
function insert($table, $data, $getId = false){
    $conn  = connDB();
    $fields = '';
    $values = '';

    foreach($data as $key => $value){
        $fields .= ", $key";
        $values .= ", '$value'";
    }

    $sql = "INSERT INTO $table (". trim($fields, ',') . ") VALUES (". trim($values, ',') . ")";
    $stmt = $conn->prepare($sql);
    if(!$getId){
        return $stmt->execute();
    }
    $stmt->execute();
    return $conn->lastInsertId();
}

// function update database
function update($table, $data, $where){
    $conn = connDB();
    $set = '';
    foreach($data as $key => $value){
        $set .= " $key = '$value',";
    }

    $sql = "UPDATE $table SET ". trim($set, ',') ." WHERE $where";

    $stmt = $conn->prepare($sql);
    return $stmt->execute();
}

// function delete database
function remove($table, $where){
    $conn = connDB();
    $sql  = "DELETE FROM $table WHERE $where";
    $stmt = $conn->prepare($sql);
    return $stmt->execute();
}

// function get All rows database
function getList($sql){
    $conn = connDB();
    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

// function get one row database
function getRow($sql){
    $conn = connDB();
    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetch();
}
