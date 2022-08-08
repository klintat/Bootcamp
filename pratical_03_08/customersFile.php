<?php
include("utils.php");
$err = "";
$con = connectToDB($err);
if ($err === "")
    $customers = selectCustomers($con);
else
    echo $err;

if (isset($_POST["insertFromJSFileName"]))
    insertFromJSONFile($_POST["insertFromJSFileName"], $con);

if (isset($_POST["insertFromXMLFileName"]))
    insertFromXML($_POST["insertFromXMLFileName"], $con);

if (isset($_POST["insertFromCSVFileName"]))
    insertFromCSVFile($_POST["insertFromCSVFileName"], $con);

if (isset($_POST["xmlFilePath"]))
    saveCustomersToXML($_POST["xmlFilePath"], $customers);

if ($err === "")
    $customers = selectCustomers($con);
else
    echo $err;

if (isset($_POST["jsonFilePath"]))
    saveCustomerJSON($_POST["jsonFilePath"], $customers);

$customers = selectCustomers($con);

if (isset($_POST["csvFilePath"]))
    saveCustomersToCSVFile($_POST["csvFilePath"]);


$customers = selectCustomers($con);

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
        <form method="POST">
            <input type="file" name="insertFromXMLFileName">
            <button class="btn">Insert from XML file</button>
        </form>
        <form method="POST">
            <input type="file" name="insertFromCSVFileName">
            <button class="btn">Insert from CSV file</button>
        </form>
        <b>
            <div class="row">
                <div class="col">
                    First name
                </div>
                <div class="col">
                    Last name
                </div>
                <div class="col">
                    E-Mail
                </div>
                <div class="col">
                    Phone
                </div>
            </div>
        </b>
        <?php while ($entry = $customers->fetch_assoc()) : ?>
            <div class="row">
                <div class="col">
                    <?= $entry["firstname"] ?>
                </div>
                <div class="col">
                    <?= $entry["lastname"] ?>
                </div>
                <div class="col">
                    <?= $entry["email"] ?>
                </div>
                <div class="col">
                    <?= $entry["phone"] ?>
                </div>
            </div>
        <?php endwhile; ?>
        <form method="POST">
            <input value=".xml" name="xmlFilePath">
            <button class="btn">Save to XML</button>
        </form>
        <form method="POST">
            <input value=".json" name="jsonFilePath">
            <button class="btn">Save to JSON</button>
        </form>
        <form method="POST">
            <input value=".csv" name="csvFilePath">
            <button class="btn">Save to CSV</button>
        </form>
    </div>
</body>