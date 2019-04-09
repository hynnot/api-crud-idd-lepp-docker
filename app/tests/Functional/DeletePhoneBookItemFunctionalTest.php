<?php

namespace Tests\Functional;

class DeletePhoneBookItemTest extends BaseTestCase
{
    private $route = '/phonebooks/';

    public function tearDown()
    {
        \App\Factories\PhoneBookFactory::truncate();
    }

    public function testShowErrorMessageWhenPhoneBookIDNotExist()
    {
        $response = $this->runApp('DELETE', $this->route . '1');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains(
            'Phone book item not found!',
            (string)$response->getBody()
        );
    }

    public function testDeleteOnePhoneBookItemById()
    {
        $phoneBook = \App\Factories\PhoneBookFactory::create();

        $response = $this->runApp('DELETE', $this->route . $phoneBook->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains(
            'Phone book item delete successfully!',
            (string)$response->getBody()
        );
    }

}