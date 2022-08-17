<?php
include("defineOverride.php");
$ovrObj = new MyParentClass("STR1", "STR2");
$ovrObj->showProperties();
echo "<br>";
$ovrObj = new MySubClass("STR1", "STR2", "STR3");
$ovrObj->showProperties();