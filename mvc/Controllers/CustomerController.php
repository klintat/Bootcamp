<?php

namespace App\Controllers;

require_once __DIR__  . "/../Models/Customer.php";

use App\Models\Customer;

class CustomerController
{
    public function display(int $id, bool $isView)
    {
        $customers = Customer::selectCustomers(null, $id);
        if (count($customers) > 0)
            $customer = $customers[0];
        else
            echo "Customer";
        if ($isView)
            require_once __DIR__ . '/../Views/customerView.php';
        else 
            require_once __DIR__ . '/../Views/customerEdit.php';
    }

    public function get(int $id, bool $isView)
    {
        $customers = Customer::selectCustomers(null, $id);
        return $customer = $customers[0];
    }

    public function insert(array $customer)
    {
        Customer::createCustomer(new Customer(
            $customer["firstname"],
            $customer["lastname"],
            $customer["phone"],
            $customer["email"]
        ));
    }

    public function edit(array $customer)
    {
        // Customer::updateCustomers($customer);
        Customer::editCustomer(new Customer(
            $customer["firstname"],
            $customer["lastname"],
            $customer["phone"],
            $customer["email"]
        ));
    }
}