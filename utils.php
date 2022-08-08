<?php

class Utilities
{

    public static function connectToDB(string &$err): mysqli
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $databasename = "js_06_02";

        $con = new mysqli($hostname, $username, $password, $databasename);
        if ($con->connect_error) {
            $err = $con->connect_error;
        }

        return $con;
    }
}