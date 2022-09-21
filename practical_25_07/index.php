<?php 
    const CONSTANT_TEST = "test";

$var = "There is the variable";
echo "<h1>Hear are the text</h1>","<h2>Here is another text</h2>";

    include("header.php");

 if($var === "232" )   {

        $var2 = "another text";
    }

if(!isset($_COOKIE["color"])){
   setcookie("color", "red");
} else {
    echo "<h1>The color is" . $_COOKIE["color"]. " </h2>";
}

$vari = "1121a";

$intval = intval($vari);
$res = $intval + 5;

$res++;
echo "<h1>" . $res++ . "</h1>";
echo "<h1>" . ++$res . "</h1>";
echo "<h1>" . $res . "</h1>";

$boolval = true;
$boolval = false;

$arr[0] = "value 1";
$arr["key"] = "value 2";

echo $arr[0];
echo$arr["key"];

$text_part1 = 'Klinta';
$text_full = "$text_part1 Teberga";
echo $text_full;

$arr2 = [];

$arr2[] = "Element1";// goes to key = 0 
$arr2[] = "Element2";// goes to key = 1 
$arr2[] = "Element3";// goes to key = 2

$res = $arr2[0] <> $arr2[1];// same as $arr2[0] != $arr[1]
$res = $arr2[0] !== $arr2[1];// same as $arr2[0] != $arr[1]


echo "<br>", $arr2[0], $arr2[1], $arr2[2], "<br>";

echo boolval(1=="1");//prints 1 (true)
echo "<br>";
echo boolval(1=="1");// prints space (false);

$result = (true) ? "true" : "false";
echo ($result) ;//prints 1 (true)
echo "<br>";
echo 1 === "1" ? "true" : "false";// prints space (false);

?>

<body>

    <?php
        include("navbar.php");
    ?>

    <p><?= "Here is the text \n and here is continues" ?> </p>
    <?= "<h1>Hear are the text</h1>" ?>
    <?= $var . $nd //display the first part but trigger the warning after that ?>

    <?= $var2 ?>

</body>