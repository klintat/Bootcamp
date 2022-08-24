<?php
include("customer.php");

$filename = json_decode(file_get_contents('php://input'));
$fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

switch ($fileExtension) {
    case "json":
        echo Customer::getCustomersFromJSON($filename);
        break;
}