<?php

namespace Demo;

class Person
{
    ///values - attributes
    private string $name = "";
    private string $lastName = "";
    private static int $totalPopulation = 7999999999;

    private Object $myObject;
    ///functions - behaviour
    private function __construct(string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public static function getPersonsFromDB()
    {
        return [];
    }

    public static function getInstance(string $name, string $lastName): Person
    {
        return new Person($name, $lastName);
    }

    public static function getInstanceWithLastName($lastName): Person
    {
        return new Person("", $lastName);
    }

    public static function getInstanceWithFirstName($firstName): Person
    {
        return new Person($firstName, "");
    }

    public function setData(string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getFullName(): string
    {
        return $this->name . " " . $this->lastName;
    }

    public static function getWorldPersonsCount(): int
    {
        return Person::$totalPopulation;
    }

    public static function increasePopulation()
    {
        Person::$totalPopulation++;
    }

    public function __toString() ///represnt the Object as the String
    {
        return $this->getFullName();
    }
}

class IPhone
{
    private static Person $keyDesingPerson;
    private string $serialNumber;

    public function setSerial(string $serial)
    {
        $this->serialNumber;
    }

    public static function setDesigner(Person $designer)
    {
        IPhone::$keyDesingPerson = $designer;
    }
}