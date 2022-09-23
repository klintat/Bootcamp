<?php
    include("db_utils.php"); // The connection to the data base
    include("ui_utils.php"); // 
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
                    <!-- <div class="col">ID</div>
                    <div class="col">First Name</div>
                    <div class="col">Last Name</div>
                    <div class="col">E-Mail</div>
                    <div class="col">Phone</div> --> <!-- Need to change fields
                </div>
            </b>
            <?php 
            while ($entry = $result->fetch_assoc()) :
                echo "<form action='save.php'>";
                echo "<div class='row'>";

                echo "<div class='col'>";
                echo "<input name='id' readonly value=' " . $entry['id'] . " '>"; // need to edit
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='name' value=' " . $entry['firstname'] . " '>"; // need to edit
                echo "</div>";

                echo "<div class='col'>";
                echo"<input name='lastname' value=' " . $entry['lastname'] . " '>"; // need to edit
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='email' value=' " . $entry['email'] . " '>"; // need to edit
                echo "</div>";

                echo "<div class='col'>";
                echo "<input name='phone' value=' " . $entry['phone'] . " '>"; // need to edit
                echo "</div>";
                
                echo "<div class='col'>";
                echo "<button type='submit'>Save</button>"; // need to edit
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