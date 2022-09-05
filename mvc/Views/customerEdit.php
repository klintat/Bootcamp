<?php
require_once __DIR__."/../header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer edit</title>
</head>
<body>
    <section>
        <h1>Customer edit</h1>
        <form method="POST">
            <label for="id">ID :</label>
            <input id="id" name="id" disabled value="<?= $customer->getId()?>"></input>
            </br>
            <label for="phone">First Name :</label>
            <input id="firstname" name="firstname" value="<?= $customer->getFirstname()?>"></input>
            </br>
            <label for="lastname">Last Name :</label>
            <input id="lastname" name="lastname" value="<?= $customer->getLastname()?>"></input>
            </br>
            <label for="email">Email :</label>
            <input id="email" name="email"value="<?= $customer->getEmail()?>"></input>
            </br>
            <label for="phone">Phone :</label>
            <input id="phone" name="phone" value="<?= $customer->getPhone()?>"></input>
            </br>
            <button id="editButton" class="btn btn-primary">Edit</button>
        </form>
    </section>
</body>
</html>