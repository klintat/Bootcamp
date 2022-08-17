<?php
include("defineinterfaces.php");

$shape =  ShapeGenerator::getInstance(10, 13, 4); //returns triangle
echo $shape->show();

echo "<br>";
$shape1 =  ShapeGenerator::getInstance(4, 23); //returns rectangle
echo $shape1->show();
echo "<br>";
echo $shape;

$obj = RectangleII::getInstance();

echo "<br>";
$obj->callSomething(3432,423432);
$obj->getPerimeter();
$obj->pro = "232";
echo "<br>";
echo $obj->pro;