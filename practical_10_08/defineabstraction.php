<?php

// final abstract class Shape - abstract class can't be defined as final
// because they should always be extended from the subclasses
abstract class Shape
{
    protected $base;
    protected $height;

    public function __construct($edge1, $edge2)
    {
        $this->base = $edge1;
        $this->height = $edge2;
    }

    abstract public function surface(): float;
    // abstract private function surface(); - not possible, becauce
    // private function can't be overriden

    public function showSurface()
    {
        echo $this->surface();
    }

    public abstract function getPerimeter(): float;

    public static function getInstance(): Shape
    {
        $args = func_get_args();
        if (isset($args[0]) && isset($args[1]) && !isset($args[2]))
            return new Rectangle($args[0], $args[1]);
        else if (
            isset($args[0]) && isset($args[1])
            && isset($args[2]) && !isset($args[3])
        )
            return new Triangle($args[0], $args[1], $args[2]);
        else
            return null;
    }
}

class Triangle extends Shape ///when the abstract class is extended, it should always
//implement (override) the abstract functions (except if the class is defined as abstract)
{
    protected float $edge3;

    public function surface(): float
    {
        $sP = $this->getPerimeter() / 2;
        $sRootUnd = $sP * ($sP - $this->base) * ($sP - $this->height) * ($sP - $this->edge3);
        return round(sqrt($sRootUnd), 2);
    }

    public function __construct($edge1, $edge2, $edge3)
    {
        parent::__construct($edge1, $edge2);
        $this->edge3 = $edge3;
    }

    public function getPerimeter(): float
    {
        return $this->edge3 + $this->base + $this->height;
    }
}
class Rectangle extends Shape
{
    public function surface(): float
    {
        return round((($this->base) * ($this->height)), 2);
    }

    public function getPerimeter(): float
    {
        return 2 * ($this->base + $this->height);
    }
}