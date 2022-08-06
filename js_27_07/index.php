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

<body onload="onInit()">
    <?php printHelloName("Janis", "Liepins", "II") ?>
    <div class="container">
        <?php if ($err === "" ) : ?>
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
                echo "<form action='save.php'>";
                echo "<div class='row'>";

                echo "<div class='col'>";
                echo "<input name='id' readonly value=' " . $entry['id'] . " '>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='name' value=' " . $entry['firstname'] . " '>"; 
                echo "</div>";

                echo "<div class='col'>";
                echo"<input name='lastname' value=' " . $entry['lastname'] . " '>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='email' value=' " . $entry['email'] . " '>";
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='phone' value=' " . $entry['phone'] . " '>";
                echo "</div>";
                
                echo "<div class='col'>";
                echo "<button type='submit'>Save</button>";
                echo "</div>";

                echo "</div>";
                echo "</form>";
            endwhile;
        ?>
        <?php else :
            echo "<div class='alert alert-primary' role='alert'><h1>$err</h1></div>";
            endif;
        ?>
    </div>
</body>