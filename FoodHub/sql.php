<?php

function connectToDB() {
    $host = "localhost";
    $username = "dbuser";
    $password = "goodbyeWorld";
    $dbname = "foodhub";

    $db = mysqli_connect($host, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
        echo "Connect failed.\n".mysqli_connect_error();
        exit();
    }
    return $db;
}

function getData($table, $condition) {
    $returnResults;
    $conn = connectToDB();
    
    $query = "select * from " . $table . " where " . $condition;

    /* Executing query */
    $result = $conn->query($query);
    if (!$result) {
        die("Retrieval failed: ". $conn->error);
    } else {
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        $returnResults = $row;
    }

    $result->close();
    return $returnResults;
}

function getAllData($table, $condition) {
    $returnResults;
    $conn = connectToDB();
    
    $query = "select * from " . $table . " where " . $condition;

    /* Executing query */
    $result = $conn->query($query);
    if (!$result) {
        die("Retrieval failed: ". $conn->error);
    } else {
        $returnResults = $result;
    }

    return $returnResults;
}
