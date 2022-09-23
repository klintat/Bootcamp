<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "js_06_02"; // correct data base

$connection = new mysqli($hostname, $username, $password, $databasename);

$errorMessage = "";

if ($connection->connect_error) {
$errorMessage = $connection->connect_error;
}
else {
    $querry = 'UPDATE customer SET firstname = $_POST["firstname"], lastname = $_POST["lastname"], 
    email = $_POST["email"], phone = $_POST["phone"]'; // need to pute the correct fields
    if ($connection->query($querry)) {
        $success = "Product succesfully updated."; 
    } else {
        $errorMessage = $connection->error;
    }
}

?>