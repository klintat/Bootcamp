<?php

include("defineabstraction.php");
// final abstract class Shape - abstract class can't be defined as final
// because they should always be extended from the subclasses
interface IShape
{

    public function surface(): float;
    // abstract private function surface(); - not possible, becauce
    // private function can't be overriden

    public function getPerimeter(): float;
}

interface IDisplayable
{
    public function show();
}

class ShapeGenerator
{
    public static function getInstance(): IDisplayable
    {
        $args = func_get_args();
        if (isset($args[0]) && isset($args[1]) && !isset($args[2]))
            return new RectangleII($args[0], $args[1]);
        else if (
            isset($args[0]) && isset($args[1])
            && isset($args[2]) && !isset($args[3])
        )
            return new TriangleII($args[0], $args[1], $args[2]);
        else
            return null;
    }
}

abstract class ShapeAbstr implements IShape //not needed to implemnt the 
//functions from the interface
{
    //we can consider all the functions from the interface as the abstract functions
    //in the abstract class
}

class TriangleII extends Shape implements IShape, IDisplayable
{
    protected float $edge1, $edg2, $edge3;

    public function surface(): float
    {
        $sP = $this->getPerimeter() / 2;
        $sRootUnd = $sP * ($sP - $this->base) * ($sP - $this->height) * ($sP - $this->edge3);
        return round(sqrt($sRootUnd), 2);
    }

    public function __construct($edge1, $edge2, $edge3)
    {
        $this->edge1 = $edge1;
        $this->edge2 = $edge2;
        $this->edge3 = $edge3;
    }

    public function getPerimeter(): float
    {
        return $this->edge3 + $this->base + $this->height;
    }

    public function show()
    {
        echo "This is the traingle with the edges : " .
            $this->edge1 . " " . $this->edge2 . " " . $this->edge3;
    }

    public function __toString()
    {
        return "Triangle : " . $this->edge1 .
            " " . $this->edge2 . " " . $this->edge3;
    }
}
class RectangleII implements IShape, IDisplayable
{
    protected float $height, $base;
    public string $pro;
    
    public function show()
    {
        echo "This is the Rectangle with the height : " .
            $this->height . " and base : " . $this->base;
    }

    public function __construct($height, $base)
    {
        $this->height = $height;
        $this->base = $base;
    }

    public function surface(): float
    {
        return round((($this->base) * ($this->height)), 2);
    }

    public function getPerimeter(): float
    {
        return 2 * ($this->base + $this->height);
    }

    public function __call($methodname, $args)
    {

        if (!isset($this->functions[$methodname])) {
            echo "METHOD DOES NOT EXIST";
            return;
        }

        return call_user_func_array($this->functions[$methodname], $args);
    }

    public function __set($attribute, $value)
    {
        $props = get_object_vars($this);
        if (!isset($props[$attribute])) {
            echo "Property does not exist";
            return;
        }
        $this[$attribute] = $value;
    }

    public static function getInstance()
    {
        return new RectangleII(323, 5254);
    }
}