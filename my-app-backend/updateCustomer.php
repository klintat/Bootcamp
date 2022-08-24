<?php
include("customer.php");

$customersInput = json_decode(file_get_contents('php://input'));
$customers = [];
foreach ($customersInput as $customerInput) :
    $customerObj = Customer::convertFromJSONToCustomer($customerInput);
    array_push($customers, $customerObj);
endforeach;
Customer::updateCustomers($customers);
echo json_encode("The customers sucessfully updated!");