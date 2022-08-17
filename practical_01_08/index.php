<?php
include("db_utils.php");
include("ui_utils.php");
$err = "";
$con = connectToDB($err);

if ($err === "")
    $result = selectCustomers($con);
?>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <div class="container">
        <?php if ($err === "") : ?>
            <b>
                <div class="row font-weight-bold">
                    <div class="col">ID</div>
                    <div class="col">First Name</div>
                    <div class="col">Last Name</div>
                    <div class="col">E-Mail</div>
                    <div class="col">Phone</div>
                </div>
            </b>
            <?php
            while ($entry = $result->fetch_assoc()) :
                echo "<div class='row'>";

                echo "<div class='col'>";
                echo ($entry["id"]);
                echo "</div>";

                echo "<div class='col'>";
                echo ($entry['firstname']);
                echo "</div>";

                echo "<div class='col'>";
                echo ($entry["lastname"]);
                echo "</div>";

                echo "<div class='col'>";
                echo ($entry["email"]);
                echo "</div>";

                echo "<div class='col'>";
                echo ($entry["phone"]);
                echo "</div>";

                echo "</div>";
            endwhile;
            ?>
        <?php else :
            echo "<div class='alert alert-primary' role='alert'><h1>$err</h1></div>";
        endif;
        ?>
    </div>
</body>