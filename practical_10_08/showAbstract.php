<?php
include("defineabstraction.php");
// $shape = new Shape(); can't be possible
// we cannot instatiate the abstract classes

$shape = Shape::getInstance(10, 13, 4);//returns triangle
echo $shape->surface();

echo "<br>";
$shape1 = Shape::getInstance(4, 23);//returns rectangle
echo $shape1->surface();