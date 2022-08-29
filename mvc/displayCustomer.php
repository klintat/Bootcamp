<?php
require(__DIR__ . "\..\utils.php");
require("Controllers/CustomerController.php");

use App\Controllers\CustomerController;

$customerController = new CustomerController();
$customerController->display($_GET["id"]);