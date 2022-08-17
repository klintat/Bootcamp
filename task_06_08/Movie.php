<?php

class Movie{

    private string $title = "";
    private string $primary_director = "";
    private static int $totalMovies = 8;

    public function setData(string $title, string $primary_director)
    {
        $this->title = $title;
        $this->primary_director = $primary_director;
    }

    public function getFullInfo() : string
    {
        return $this->title . " " . $this->primary_director;
    }

    public static function getMovieFromDB(): int
    {
        return Movie::$totalMovies;
    }

}

class IPhone
{

    private static Movie $keyTitle;
    private string $serialNumber;

    public function setSerial(string $serial)
    {
        $this->serialNumber;
    }

    public static function setTile(Movie $title)
    {
        IPhone::$keyTitle = $title;
    }
}

?>