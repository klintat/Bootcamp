<?php
include("../utils.php");
include("customer.php");
include("tab.php");
$err = "";
$con = Utilities::connectToDB($err);
$customers;
if ($err === "")
    $customers = Customer::selectCustomers($con);
else
    echo $err;

if (isset($_POST["insertFromJSFileName"]))
    Customer::insertFromJSONFile($_POST["insertFromJSFileName"], $con);

if (isset($_POST["jsonFilePath"]))
    Customer::saveCustomersJSON(
        $_POST["jsonFilePath"],
        Customer::convertCustomerArrToJSON($customers)
    );

$customersTable = new Tab();
$customersTable->addHeader(["First Name", "Last Name", "Phone", "E-Mail"]);
$customersTable->generateElements(
    Customer::convertCustomersToTextArray($customers)
);
$cutomersTableHTML = $customersTable->finishTable();

Customer::getPersonDummy();//this is fine
Customer::getCustomerDummy();
?>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <div class="container">
        <form method="POST">
            <input type="file" name="insertFromJSFileName">
            <button class="btn">Insert from JSON file</button>
        </form>
        <?= $cutomersTableHTML ?>
        <form method="POST">
            <input value=".json" name="jsonFilePath">
            <button class="btn">Save to JSON</button>
        </form>
    </div>
</body>