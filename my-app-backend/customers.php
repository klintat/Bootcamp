<?php
include("customer.php");
$customers = Customer::convertCustomersToTextArray(
    Customer::selectCustomers()
);
echo json_encode($customers);