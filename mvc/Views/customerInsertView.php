<?php
require_once __DIR__ . "/../header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Customer</title>
</head>

<body>

    <form method="POST">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input id="firstname" name="firstname"></input>
            <label for="lastname">Last Name</label>
            <input id="lastname" name="lastname"></input>

            <label for="email">E-Mail</label>
            <input id="email" name="email"></input>

            <label for="phone">Phone</label>
            <input id="phone" name="phone"></input>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>

</body>

</html>