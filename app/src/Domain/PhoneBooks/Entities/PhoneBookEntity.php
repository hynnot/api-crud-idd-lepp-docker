<?php

namespace App\Domain\PhoneBooks\Entities;

class PhoneBookEntity
{
    public $id;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $countryCode;
    public $timeZoneName;
    public $insertedOn;
    public $updatedOn;

    public function __construct(array $attributes=[])
    {
        foreach ($this as $property => $value) {
            if (array_key_exists($property, $attributes) ) {
                $this->$property = $attributes[$property];
            }
        }
        $this->addDateIsEmpty();
    }

    public function toArray()
    {
        return array_filter(get_object_vars($this), function($value) { return $value !== NULL; });
    }

    private function addDateIsEmpty()
    {
        if (is_null($this->insertedOn)) {
            $this->insertedOn = date("Y-m-d H:i:s");
            $this->updatedOn = date("Y-m-d H:i:s");
        }
    }

}
