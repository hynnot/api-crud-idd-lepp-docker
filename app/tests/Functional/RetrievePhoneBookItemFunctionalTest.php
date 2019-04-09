<?php

namespace Tests\Functional;

class RetrievePhoneBookItemTest extends BaseTestCase
{
    private $route = '/phonebooks/';

    public function tearDown()
    {
        \App\Factories\PhoneBookFactory::truncate();
    }

    public function testShowErrorMessageWhenPhoneBookIDNotExist()
    {
        $response = $this->runApp('GET', $this->route . '1');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains(
            'Phone book item not found!',
            (string)$response->getBody()
        );
    }

    public function testGetOnePhoneBookItemById()
    {
        $phoneBook = \App\Factories\PhoneBookFactory::create();

        $response = $this->runApp('GET', $this->route . $phoneBook->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(
            [
                'firstName' => $phoneBook->firstName,
                'lastName' => $phoneBook->lastName,
                'phoneNumber' => $phoneBook->phoneNumber,
                'countryCode' => $phoneBook->countryCode,
                'timeZoneName' => $phoneBook->timeZoneName,
                'insertedOn' => $phoneBook->insertedOn,
                'updatedOn' => $phoneBook->updatedOn,
            ],
            (array)json_decode($response->getBody())
        );
    }

}