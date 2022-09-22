<?php 

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "js_06_02";

    $con = new mysqli($hostname, $username, $password, $databasename);

    $success = "";
    if ($con->connect_error) :
        $err = $con->connect_error;
else :
        $query = "SELECT * FROM comments";
        $result = $con->query($query);
    
        if ($result->num_rows == 0) {
            $err = "No entries found";
        } else {
            $entry = $result->fetch_assoc();
        }
endif;
        
    
include("header.php") ?>;

<body>
    <div class="container">
        
        <?php while ($result->fetch_assoc()):

            echo "<h3>ID : ". $entry["id"]. ", Comment:" . $entry["comment"]. "</h3>";

        endwhile;
        ?>
    </div>
</body>