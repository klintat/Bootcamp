<?php

use Customer as GlobalCustomer;

include("Person.php");
include("utils.php");

class Customer extends Person
{
    protected string $phone, $email;
    protected int $id;
    protected mysqli $con;

    public function __construct($firstname, $lastname, $phone, $email, $id = 0)
    {
        parent::__construct($firstname, $lastname);
        $this->phone = $phone;
        $this->email = $email;
        $this->id = $id;
        $this->con = connectToDB();
    }

    public function getCustomer(): array
    {
        return [
            "id" => $this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "phone" => $this->phone,
            "email" => $this->email
        ];
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public static function selectCustomers(mysqli $con = null, int $id = null): array
    {
        if ($con === null) :
            $con = connectToDB();
        endif;

        if ($id === null || $id === 0)
            $query = "SELECT * FROM customer";
        else
            $query = "SELECT * FROM customer WHERE id = $id";

        $result = $con->query($query);
        $customers = [];

        while ($entry = $result->fetch_assoc()) :
            $customer = new Customer(
                $entry["firstname"],
                $entry["lastname"],
                $entry["phone"],
                $entry["email"],
                $entry["id"]
            );
            array_push($customers, $customer);
        endwhile;

        return $customers;
    }

    public static function convertCustomersToTextArray(array $customers): array
    {
        $customersArray = [];
        foreach ($customers as $customerObj)
            array_push($customersArray, $customerObj->getCustomer());
        return $customersArray;
    }

    // public function createCustomer(mysqli $con)
    // {
    //     $prepStament = $con->prepare("INSERT INTO customer (firstname,lastname,email,phone) VALUES
    //     (?,?,?,?)");
    //     $prepStament->bind_param(
    //         "ssss",
    //         $this->firstname,
    //         $this->lastname,
    //         $this->email,
    //         $this->phone
    //     );
    //     $prepStament->execute();
    // }

    public static function createCustomer(Customer $customer, mysqli $con = null)
    {
        if ($con === null) :
            $con = connectToDB();
        endif;

        $prepStament = $con->prepare("INSERT INTO customer (firstname,lastname,email,phone) VALUES
        (?,?,?,?)");
        $prepStament->bind_param(
            "ssss",
            $customer->firstname,
            $customer->lastname,
            $customer->email,
            $customer->phone
        );
        $prepStament->execute();
    }

    public static function insertFromJSONFile(string $filename, mysqli $con)
    {
        $filecontent = file_get_contents($filename);
        $customersObj = json_decode($filecontent);
        foreach ($customersObj->customers as $customer) :
            Customer::createCustomer(
                $con,
                Customer::convertFromJSONToCustomer($customer)
            );
        endforeach;
    }

    public static function convertFromJSONToCustomer($customer): Customer
    {
        return new Customer(
            $customer->firstname,
            $customer->lastname,
            $customer->phone,
            $customer->email
        );
    }

    public function convertToJSON()
    {
        $customer = new stdClass();
        $customer->firstname = $this->firstname;
        $customer->lastname = $this->lastname;
        $customer->phone = $this->phone;
        $customer->email = $this->email;
        return $customer;
    }

    public static function convertCustomerArrToJSON(array $customers): array
    {
        $customersJSON = [];
        foreach ($customers as $customer)
            array_push($customersJSON, $customer->convertToJSON());

        return $customersJSON;
    }

    public static function saveCustomersJSON(string $filename, array $customers)
    {
        $json = json_encode(array("customers" => $customers), JSON_PRETTY_PRINT);
        file_put_contents($filename, $json);
    }

    public static function generateCustomersTableHTML($customers): string
    {
        $customersTable =
            "<b>
        <div class='row'>
            <div class='col'>
                First name
            </div>
            <div class='col'>
                Last name
            </div>
            <div class='col'>
                E-Mail
            </div>
            <div class='col'>
                Phone
            </div>
        </div>
    </b>";

        foreach ($customers as $customer) :
            $customersTable .= $customer->getCustomerRow();
        endforeach;
        return $customersTable;
    }

    public function getCustomerRow()
    {
        return "<div class='row'>
                <div class='col'>" . $this->firstname .
            "</div>
                <div class='col'>" . $this->lastname .
            "</div>
                <div class='col'>" . $this->email .
            "</div>
                <div class='col'>" . $this->phone .
            "</div>
            </div>";
    }

    public static function getPersonDummy(): Person
    {
        // return new Person("Name","Lastname"); //Fine
        // return "sfdfd"; //Not-fine
        // return 434343; // Not-fine, integer is not the person
        return new Customer("Name", "LastName", "4343423", "test@gmail.com", 1); //Correct, because 
        //all the Customer objects are the Persons/
        //This is called up-casting (pass more specific object to more generic object)
        // return new Person2("Name", "LastName");//this will fail
    }

    public static function getCustomerDummy(): Customer
    {
        // return new Person("Name", "Lastname");//this will always fail
        return self::getPersonDummy(); //this will be correct, since getCustomerDummy return 
        //the object typed as Customer (in fact) - this is called down-casting
    }
}


////public function getFile(string $filepath): DataFile{  if(isJson($filepat))
// return new Json();else if(isXML($filepath)) return new XML()...  }