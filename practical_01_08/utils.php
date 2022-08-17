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

function saveCustomersToCSVFile(string $filename)
{
    $err = "";
    $con = connectToDB($err);
    if ($err !== "")
        exit();

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