<?php
require(__DIR__ . "\..\utils.php");
require("Controllers/CustomerController.php");

use App\Controllers\CustomerController;

// $customerController = new CustomerController();
// $customerController->display($_GET["id"], false);

// $customerController = new CustomerController();
// // if (count($_POST) === 0) :
// // if (isset($_POST['editButton'])) :
// if (!isset($_POST)) :
//     $customerController->edit($_POST);
//     require("Views/sucessInsertion.php");
// else :
//     $customerController->display($_GET["id"], false);
// endif;

$customerController = new CustomerController();
// if (count($_POST) === 0) :
// if (isset($_POST['editButton'])) :
// if (isset($customer)) :
//     $customerController->edit($_POST);
//     require("Views/sucessInsertion.php");
// else :
    $customer = $customerController->get($_GET["id"], false);
    require_once 'Views/customerEdit.php';
// endif;