<?php
include("customer.php");

$filename = json_decode(file_get_contents('php://input'));
$filename = 'files\\' . $filename;
$fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

switch ($fileExtension) {
    case "json":
        echo Customer::getCustomersFromJSON($filename);
        break;
    case "xml":
        echo Customer::getCustomersFromXML($filename);
        break;
    case "csv":
        echo Customer::getCustomersFromCSV($filename);
        break;
}