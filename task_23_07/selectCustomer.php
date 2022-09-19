<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02";
    
    $connection = new mysqli($hostname, $username, $password, $databasename);
    
    $errorMessage = "";
    $entry = [];
    
    if ($connection->connect_error) {
    $errorMessage = $connection->connect_error;
    }
    else {
        $querry = "SELECT * FROM customers WHERE id = ". $_POST["CustomerId"] ." "; // concatination ?
        $result = $connection->query($querry);
        if ($result->num_rows == 0) {
            $errorMessage = "No entries found."; 
        }
        else {
            $entry = $result->fetch_assoc();
        }
    }
?>

<html>

<?php
    include("header.php");
?>

<body>
        <!-- navbar -->
        <?php include("navbar.php"); ?>
    <div class="container p-3">
        <?php if ($errorMessage != "") { ?>
        <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
        <?php } else { ?>
        <div class="container">
            <div class="row d-flex justify-content-center mt-5 rounded-2 bg-dark shadow text-bg-dark">
                <div class="col-4 p-5">
                    <?php 
                        if ($entry["photo"] == null) { ?>
                            <img src="photos/default.jpg" alt="img" class="w-100 rounded"> <?php
                        } else { ?>
                            <img src="photos/<?= $entry["photo"] ?>" alt="img" class="w-100 rounded"> <?php
                        } 
                    ?>
                </div>
                <div class="col-8 p-5">
                    <h3>Customer Info</h3>
                    <div>
                        ID: 
                        <?= $entry["id"] ?>
                    </div>
                    <div>
                        First Name:
                        <?= $entry["firstname"] ?>
                    </div>
                    <div>
                        Last Name:
                        <?= $entry["lastname"] ?>
                    </div>
                    <div>
                        Email: 
                        <?= $entry["email"] ?>
                    </div>
                    <div>
                        Phone number:
                        <?= $entry["phone"] ?>
                    </div>
                    <div my-5>
                        Comments:
                        <?= $entry["comments"] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>

</html>