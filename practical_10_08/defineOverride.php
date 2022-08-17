<?php

// final class MyParentClass - if the class is declared as final, you can't be extended
class MyParentClass
{
    private string $str1, $str2;
    protected string $str4;

    public function __construct($str1, $str2)
    {
        $this->str1 = $str1;
        $this->str2 = $str2;
    }

    public function showProperties()
    {
        echo $this->str1 . " " . $this->str2;
    }

    final public function accessPrivateElements($str1, $str2)
    {
        $this->str1 = $str1;
        $this->str2 = $str2;
    }
}

class MySubClass extends MyParentClass
{
    private string $str3;

    public function __construct($str1, $str2, $str3)
    {
        parent::__construct($str1, $str2);
        $this->str3 = $str3;
    }

    //Overriding
    public function showProperties()
    {
        parent::showProperties();
        echo " " . $this->str3;
    }

    //Can't override, since the function from the parent class
    //is defined as final
    // public function accessPrivateElements($str1, $str2)
    // {
    // }
}