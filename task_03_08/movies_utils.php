<?php

function getMoviesFromXML(string $filename): string
{
    $content = "";
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($filename);

    $movies = $xmlDoc->documentElement->getElementsByTagName("movie"); //root element
    foreach ($movies as $movie) :
        $content .= "<div class='row'>";
        $title =  $movie->getElementsByTagName("title")->item(0)->nodeValue;
        $primary_director = $movie->getElementsByTagName("primary_director")->item(0)->nodeValue;
        $year_released = $movie->getElementsByTagName("year_released")->item(0)->nodeValue;
        $genre = $movie->getElementsByTagName("genre")->item(0)->nodeValue;
        $content .= "<div class='col'>" . $title .  "</div>";
        $content .= "<div class='col'>" . $primary_director .  "</div>";
        $content .= "<div class='col'>" . $year_released .  "</div>";
        $content .= "<div class='col'>" . $genre .  "</div>";
        $content .= "</div>";
    endforeach;
    return $content;
}

function insertFromXML(string $filename)
{
    $err = "";
    $con = connectToDB($err);
    if ($err !== "")
        exit();
    $xmlDoc = new DOMDocument();
    $xmlDoc->load($filename);

    $movies = $xmlDoc->documentElement->getElementsByTagName("movie"); //root element
    foreach ($movies as $movie) :
        $title =  $movie->getElementsByTagName("title")->item(0)->nodeValue;
        $primary_director = $movie->getElementsByTagName("primary_director")->item(0)->nodeValue;
        $year_released = $movie->getElementsByTagName("year_released")->item(0)->nodeValue;
        $genre = $movie->getElementsByTagName("genre")->item(0)->nodeValue;
        createMovie($con, $title, $primary_director, $year_released, $genre);
    endforeach;
}

function connectToDB(string &$err)
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "movie_list_03_08";

    $con = new mysqli($hostname, $username, $password, $databasename);
    if ($con->connect_error) {
        $err = $con->connect_error;
    }
   
    return $con;
}

function selectMovies(mysqli $con, int $id = null): mysqli_result
{
    if ($id === null || $id === 0)
        $query = "SELECT * FROM movie";
    else
        $query = "SELECT * FROM movie WHERE id = $id";
    return $con->query($query);
}

function updateMovie(
    mysqli $con,
    int $id,
    string $title,
    string $primary_director,
    string $year_released,
    string $genre
) {

    $query = "UPDATE movie SET title='$title', primary_director='$primary_director', year_released='$year_released', 
    genre='$genre' WHERE id=$id";
    $con->query($query);
}

function createMovie(
    mysqli $con,
    string $title,
    string $primary_director,
    string $year_released,
    string $genre
) {
    $prepStament = $con->prepare("INSERT INTO movie (title,primary_director,year_released,genre) VALUES
    (?,?,?,?)");
    $prepStament->bind_param("ssss", $title, $primary_director, $year_released, $genre);
    $prepStament->execute();
}

function saveFromFile(string $filename)
{
    $file = fopen($filename, "r");
    if ($file == false) {
        exit();
    }

    $err = "";
    $con = connectToDB($err);
    if ($err !== "")
        exit();

    $csvContentLineArr = fgetcsv($file, filesize($filename), ";");

    while ($csvContentLineArr = fgetcsv($file, filesize($filename), ";")) :
 
        $title = $csvContentLineArr[0];
        $primary_director = $csvContentLineArr[1];
        $year_released = $csvContentLineArr[2];
        $genre = $csvContentLineArr[3];
        createMovie($con, $title, $primary_director, $year_released, $genre);
    endwhile;
}

function saveMovieJSON(string $filename, mysqli_result $movies)
{
    $moviesArr = array();
    while ($entry = $movies->fetch_assoc()) :
        $movieArr = array(
            "title" => $entry["title"],
            "primary_director" => $entry["primary_director"],
            "year_released" => $entry["year_released"],
            "genre" => $entry["genre"]
        );
        array_push($moviesArr, $movieArr);
    endwhile;
    $json = json_encode(array("movies" => $moviesArr), JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}

function saveMoviesToXML(string $filename, mysqli_result $movies)
{
    $xmlDoc = new DOMDocument();
    $xmlDoc->encoding = "UTF-8";
    $xmlDoc->formatOutput = true;
    $moviesElement = $xmlDoc->createElement("movies");
    while ($entry = $movies->fetch_assoc()) :
        $movieElement = $xmlDoc->createElement("movie");

        $titleElement = $xmlDoc->createElement("title", $entry["title"]);
        $movieElement->appendChild($titleElement);

        $primary_directorElement = $xmlDoc->createElement("primary_director", $entry["primary_director"]);
        $movieElement->appendChild($primary_directorElement);

        $year_releasedElement = $xmlDoc->createElement("year_released", $entry["year_released"]);
        $movieElement->appendChild($year_releasedElement);

        $genreElement = $xmlDoc->createElement("genre", $entry["genre"]);
        $movieElement->appendChild($genreElement);

        $moviesElement->appendChild($movieElement);
    endwhile;
    $xmlDoc->appendChild($moviesElement);
    $xmlDoc->save($filename);
}

function saveMoviesToCSVFile(string $filename, mysqli $con)
{
    $filecontent = "";
    $headerline = "Title;Primary_director;Year_released;Genre";
    $filecontent = $headerline;
    $result = selectMovies($con);
    while ($entry = $result->fetch_assoc()) :
        $filecontent .= "\n";
        $title = $entry["title"];
        $primary_director = $entry["primary_director"];
        $year_released = $entry["year_released"];
        $genre = $entry["genre"];
        $line = $title . ";" . $primary_director . ";" . $year_released . ";" . $genre;
        $filecontent .= $line;
    endwhile;

    $file = fopen($filename, "w");
    fwrite($file, $filecontent);
    fclose($file);
}

function insertMoviesFromJsonFile(string $filename, mysqli $con)
{
    $filecontent = file_get_contents($filename);
    $moviesArr = json_decode($filecontent);
    foreach ($moviesArr->movies as $movie) :
        createMovie($con, $movie->title, $movie->primary_director, $movie->year_released, $movie->genre);
    endforeach;
}