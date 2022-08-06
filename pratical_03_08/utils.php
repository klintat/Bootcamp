<?php

function getCustomersFromXML(string $filename): string
{
    $content = "";
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($filename);

    $customers = $xmlDoc->documentElement->getElementsByTagName("customer"); //root element
    foreach ($customers as $customer) :
        $content .= "<div class='row'>";
        $firstname =  $customer->getElementsByTagName("firstname")->item(0)->nodeValue;
        $lastname = $customer->getElementsByTagName("lastname")->item(0)->nodeValue;
        $phone = $customer->getElementsByTagName("phone")->item(0)->nodeValue;
        $email = $customer->getElementsByTagName("email")->item(0)->nodeValue;
        $content .= "<div class='col'>" . $firstname .  "</div>";
        $content .= "<div class='col'>" . $lastname .  "</div>";
        $content .= "<div class='col'>" . $phone .  "</div>";
        $content .= "<div class='col'>" . $email .  "</div>";
        $content .= "</div>";
    endforeach;
    return $content;
}

function insertFromXML(string $filename)
{
    $err = "";
    $con = connectToDB($err);
    if ($err !== "")
        exit();
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($filename);

    $customers = $xmlDoc->documentElement->getElementsByTagName("customer"); //root element
    foreach ($customers as $customer) :
        $firstname =  $customer->getElementsByTagName("firstname")->item(0)->nodeValue;
        $lastname = $customer->getElementsByTagName("lastname")->item(0)->nodeValue;
        $phone = $customer->getElementsByTagName("phone")->item(0)->nodeValue;
        $email = $customer->getElementsByTagName("email")->item(0)->nodeValue;
        createCustomer($con, $firstname, $lastname, $email, $phone);
    endforeach;
}

function connectToDB(string &$err)
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02";

    $con = new mysqli($hostname, $username, $password, $databasename);
    if ($con->connect_error) {
        $err = $con->connect_error;
    }
    // $err = "We have the error";

    return $con;
}

function selectCustomers(mysqli $con, int $id = null): mysqli_result
{
    if ($id === null || $id === 0)
        $query = "SELECT * FROM customer";
    else
        $query = "SELECT * FROM customer WHERE id = $id";
    return $con->query($query);
}


function updateCustomer(
    mysqli $con,
    int $id,
    string $firstname,
    string $lastname,
    string $email,
    string $phone
) {

    $query = "UPDATE customer SET firstname='$firstname',lastname='$lastname',email='$email', 
    phone='$phone' WHERE id=$id";
    $con->query($query);
}

function createCustomer(
    mysqli $con,
    string $firstname,
    string $lastname,
    string $email,
    string $phone
) {
    $prepStament = $con->prepare("INSERT INTO customer (firstname,lastname,email,phone) VALUES
    (?,?,?,?)");
    $prepStament->bind_param("ssss", $firstname, $lastname, $email, $phone);
    $prepStament->execute();
}

function saveFromFile(string $filename)
{
    $file = fopen($filename, "r");
    if ($file == false) {
        exit();
    }

    $err = "";
    $con = connectToDB($err);
    if ($err !== "")
        exit();

    //We skip the heder line
    $csvContentLineArr = fgetcsv($file, filesize($filename), ";");

    while ($csvContentLineArr = fgetcsv($file, filesize($filename), ";")) :
        ///implement here
        /*
    $csvContentLineArr[0] == Kate;
    $csvContentLineArr[1] == Smith;
    etc.
    */
        $firstname = $csvContentLineArr[0];
        $lastname = $csvContentLineArr[1];
        $email = $csvContentLineArr[2];
        $phone = $csvContentLineArr[3];
        createCustomer($con, $firstname, $lastname, $email, $phone);
    endwhile;
}

function saveCustomerJSON(string $filename, mysqli_result $customers)
{
    $customersArr = array();
    while ($entry = $customers->fetch_assoc()) :
        $customerArr = array(
            "firstname" => $entry["firstname"],
            "lastname" => $entry["lastname"],
            "phone" => $entry["phone"],
            "email" => $entry["email"]
        );
        array_push($customersArr, $customerArr); //push $customerArr to $customersArr
    endwhile;
    $json = json_encode(array("customers" => $customersArr), JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}

function saveCustomersToXML(string $filename, mysqli_result $customers)
{
    $xmlDoc = new DOMDocument();
    $xmlDoc->encoding = "UTF-8";
    $xmlDoc->formatOutput = true;
    $customersElement = $xmlDoc->createElement("customers");
    while ($entry = $customers->fetch_assoc()) :
        $customerElement = $xmlDoc->createElement("customer");

        $firstnameElement = $xmlDoc->createElement("firstname", $entry["firstname"]);
        $customerElement->appendChild($firstnameElement);

        $lastnameElement = $xmlDoc->createElement("lastname", $entry["lastname"]);
        $customerElement->appendChild($lastnameElement);

        $phoneElement = $xmlDoc->createElement("phone", $entry["phone"]);
        $customerElement->appendChild($phoneElement);

        $emailElement = $xmlDoc->createElement("email", $entry["email"]);
        $customerElement->appendChild($emailElement);

        $customersElement->appendChild($customerElement);
    endwhile;
    $xmlDoc->appendChild($customersElement);
    $xmlDoc->save($filename);
}

function saveCustomersToCSVFile(string $filename, mysqli $con)
{
    $filecontent = "";
    $headerline = "Firstname;Lastname;Email;Phone";
    $filecontent = $headerline;
    $result = selectCustomers($con);
    while ($entry = $result->fetch_assoc()) :
        $filecontent .= "\n"; ///Line break 
        $firstname = $entry["firstname"];
        $lastname = $entry["lastname"];
        $email = $entry["email"];
        $phone = $entry["phone"];
        $line = $firstname . ";" . $lastname . ";" . $email . ";" . $phone;
        $filecontent .= $line;
    endwhile;

    $file = fopen($filename, "w");
    fwrite($file, $filecontent);
    fclose($file);
}

function insertCustomersFromFile(string $filename, mysqli $con)
{
    $filecontent = file_get_contents($filename);
    $customersArr = json_decode($filecontent);
    foreach ($customersArr->customers as $customer) :
        createCustomer($con, $customer->firstname, $customer->lastname, $customer->email, $customer->phone);
    endforeach;
}