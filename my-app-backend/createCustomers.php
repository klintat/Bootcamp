<?php
include("customer.php");

$customersInput = json_decode(file_get_contents('php://input'));
$customers = [];
foreach ($customersInput as $customerInput) :
    $customerInput->id = 0;
    $customerObj = Customer::convertFromJSONToCustomer($customerInput);
    array_push($customers, $customerObj);
endforeach;
Customer::createCustomers($customers);
echo json_encode("The customers sucessfully created!");