<?php
include("movies_utils.php");
$err = "";
$con = connectToDB($err);
if ($err === "")
    $movies = selectMovies($con);
else
    echo $err;

if (isset($_POST["insertFromJSFileName"]))
    insertMoviesFromJsonFile($_POST["insertFromJSFileName"], $con);

if (isset($_POST["insertFromXMLFileName"]))
    insertFromXML($_POST["insertFromXMLFileName"], $con);

if (isset($_POST["insertFromCSVFileName"]))
    saveFromFile($_POST["insertFromCSVFileName"], $con);

if (isset($_POST["xmlFilePath"]))
    saveMoviesToXML($_POST["xmlFilePath"], $movies);

if ($err === "")
    $movies = selectMovies($con);
else
    echo $err;

if (isset($_POST["jsonFilePath"]))
    saveMovieJSON($_POST["jsonFilePath"], $movies);

$movies = selectMovies($con);

if (isset($_POST["csvFilePath"]))
    saveMoviesToCSVFile($_POST["csvFilePath"], $con);


$movies = selectMovies($con);

?>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <div class="container">
        <form method="POST">
            <input type="file" name="insertFromJSFileName">
            <button class="btn">Insert from JSON file</button>
        </form>
        <form method="POST">
            <input type="file" name="insertFromXMLFileName">
            <button class="btn">Insert from XML file</button>
        </form>
        <form method="POST">
            <input type="file" name="insertFromCSVFileName">
            <button class="btn">Insert from CSV file</button>
        </form>
        <b>
            <div class="row">
                <div class="col">
                    Title
                </div>
                <div class="col">
                    Primary director
                </div>
                <div class="col">
                    Year released
                </div>
                <div class="col">
                    Genre
                </div>
            </div>
        </b>
        <?php while ($entry = $movies->fetch_assoc()) : ?>
            <div class="row">
                <div class="col">
                    <?= $entry["title"] ?>
                </div>
                <div class="col">
                    <?= $entry["primary_director"] ?>
                </div>
                <div class="col">
                    <?= $entry["year_released"] ?>
                </div>
                <div class="col">
                    <?= $entry["genre"] ?>
                </div>
            </div>
        <?php endwhile; ?>
        <form method="POST">
            <input value=".xml" name="xmlFilePath">
            <button class="btn">Save to XML</button>
        </form>
        <form method="POST">
            <input value=".json" name="jsonFilePath">
            <button class="btn">Save to JSON</button>
        </form>
        <form method="POST">
            <input value=".csv" name="csvFilePath">
            <button class="btn">Save to CSV</button>
        </form>
    </div>
</body>