<?php

namespace Tests\Functional;

class StorePhoneBookTest extends BaseTestCase
{
    private $route = '/phonebooks';

    public function tearDown()
    {
        \App\Factories\PhoneBookFactory::truncate();
    }

    public function testShowErrorMessageWhenPostPhoneBookWithoutRequiredParameters()
    {
        $response = $this->runApp('POST', $this->route, ['lastName' => 'Morella']);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains(
            'A phone book item requires: first name, phone number, country code and time zone!',
            (string)$response->getBody()
        );
    }

    public function testShowErrorMessageWhenPostPhoneBookWithInvalidPhoneNumber()
    {
        $response = $this->runApp('POST', $this->route, [
            'firstName' => 'Tony',
            'phoneNumber' => '635123456',
            'countryCode' => 'ESP',
            'timeZoneName' => 'Europe/Valencia'
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains(
            'A phone book item requires a phone number valid!',
            (string)$response->getBody()
        );
    }

    public function testShowErrorMessageWhenPostPhoneBookWithCountryCodeIncorrect()
    {
        $response = $this->runApp('POST', $this->route, [
            'firstName' => 'Tony',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ESP',
            'timeZoneName' => 'Europe/Valencia'
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains(
            'A phone book item requires a country code valid!',
            (string)$response->getBody()
        );
    }

    public function testShowErrorMessageWhenPostPhoneBookWithTimeZoneNameIncorrect()
    {
        $response = $this->runApp('POST', $this->route, [
            'firstName' => 'Tony',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ES',
            'timeZoneName' => 'Europe/Valencia'
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains(
            'A phone book item requires a time zone valid!',
            (string)$response->getBody()
        );
    }

    public function testShowOkMessageWhenPostPhoneBook()
    {
        $response = $this->runApp('POST', $this->route, [
            'firstName' => 'Tony',
            'lastName' => 'Morella',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ES',
            'timeZoneName' => 'Europe/Madrid'
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertContains(
            'Phone book item created successfully!',
            (string)$response->getBody()
        );
    }

 }