<?php

function getConnection() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "shopgear";
    $error = "";
    $connection = mysqli_connect($host, $user, $pass);
    
    if(!$connection) {
        echo 'Khong the ket noi den co so du lieu!<br>';
    } 
    else {
        mysqli_select_db($connection, $dbName);
        mysqli_query($connection, "SET NAMES 'utf8'");
        return $connection;
    }
}

function select($connection, $sql) {
    return mysqli_query($connection, $sql);
}

function closeConnection($connection) {
    mysqli_close($connection);
}
?>