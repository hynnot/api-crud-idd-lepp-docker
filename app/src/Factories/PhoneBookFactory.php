<?php

namespace App\Factories;

class PhoneBookFactory
{
    public static function create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'phoneNumber' => $faker->phoneNumber(),
            'countryCode' => $faker->countryCode(),
            'timeZoneName' => $faker->timezone(),
            'insertedOn' => $faker->dateTime()->format('Y-m-d H:i:s'),
            'updatedOn' => $faker->dateTime()->format('Y-m-d H:i:s')
        ];

        return \App\Models\PhoneBookModel::create($data);
    }

    public static function truncate()
    {
        \App\Models\PhoneBookModel::truncate();
    }
}
