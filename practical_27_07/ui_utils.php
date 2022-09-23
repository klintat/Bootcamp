<?php
// function printHelloName(string $firstName = "Arturs", string $lastName = "Olekss")
// {
//     echo "<h1>Hello " . $firstName . " " . $lastName . " " . func_get_args()[2] . "</h1>";
// }

function printHelloName()
{
    $fullName = "";
    foreach (func_get_args() as $index => $name) :
        if ($index !== 0)
            $fullName .= " " . $name;
    endforeach;

    echo "<h1>Hello " . $fullName . "</h1>";
}