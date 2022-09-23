<?php

function connectToDB(string &$err)
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02"; // Correct database

    $con = new mysqli($hostname, $username, $password, $databasename);
    if ($con->connect_error) {
        $err = $con->connect_error;
    }
    // $err = "We have the error";

    return $con;
}

function selectCustomers(mysqli $con): mysqli_result // will be select product
{
    $query = "SELECT * FROM customer"; // select form product table
    return $con->query($query);
}
