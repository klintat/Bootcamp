<?php
include("../common/header.php");
include("Person.php");
include("MySimplePerson.php");

$myPerson = \Demo\Person::getInstance("Arturs", "Olekss");
// $myPerson->setData("Arturs", "Olekss");
echo $myPerson;
echo "<br>" . $myPerson->getFullName() . "<br>";
Demo\Person::increasePopulation();
echo "Total population of the World : " . Demo\Person::getWorldPersonsCount();
$simplePerson = new Simple\Person();
$simplePerson->name = "Jack";
$simplePerson->lastname = "Sparrow";
echo "<br>Welcome " . $simplePerson->name . " " . $simplePerson->lastname;
echo $myPerson->getRowHtml();