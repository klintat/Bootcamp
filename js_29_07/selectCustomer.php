<?php
include("db_utils.php");
include("ui_utils.php");
$err = "";
$con = connectToDB($err);

if (isset($_POST["id"]) && $err === "") :
    updateCustomer(
        $con,
        $_POST["id"],
        $_POST["firstname"],
        $_POST["lastname"],
        $_POST["email"],
        $_POST["phone"]
    );
endif;
$entry = null;
if (isset($_GET["id"]) && $err === "") :
    $result = selectCustomers($con, intval($_GET["id"]));
endif;

if (isset($_POST["fileName"]))
    saveCustomersToCSVFile($_POST["fileName"]);
?>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <div class="container">
        <form method="get">
            <div class="row">
                <div class="col col-sm-1">
                    ID
                </div>
                <div class="col col-sm-3">
                    <input type="number" name="id">
                </div>
                <div class="col col-sm-2">
                    <button class="btn">Search</button>
                </div>
            </div>
        </form>
        <b>
            <div class="row font-weight-bold">
                <div class="col">ID</div>
                <div class="col">First Name</div>
                <div class="col">Last Name</div>
                <div class="col">E-Mail</div>
                <div class="col">Phone</div>
            </div>
        </b>
        <form method="post">
            <?php while ($entry = $result->fetch_assoc()) :
                echo "<div class='row'>";

                echo "<input hidden name='id' value=" . $entry['id'] . ">";

                echo "<div class='col'>";
                echo ($entry["id"]);
                echo "</div>";

                echo "<div class='col'>";
                echo "<input readonly name='firstname' value='" . $entry['firstname'] . "'>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input readonly name='lastname' value='" . $entry['lastname'] . "'>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input readonly name='email' value='" . $entry['email'] . "'>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input readonly name='phone' value='" . $entry['phone'] . "'>";
                echo "</div>";

                echo "</div>";
            endwhile;
            ?>
        </form>
        <button class='btn' type='button' onclick="setEditable()">Edit</button>
        <button class='btn'>Save</button>
        <form method="post">
            <input name="fileName" value=".csv">
            <button class="btn">Save to file</button>
        </form>
    </div>

</body>