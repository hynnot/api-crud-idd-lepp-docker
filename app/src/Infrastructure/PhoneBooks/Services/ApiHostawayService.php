<?php

namespace App\Infrastructure\PhoneBooks\Services;

use App\Domain\PhoneBooks\Services\ApiService;

class ApiHostawayService implements ApiService
{
    private $httpClient;

    public function __construct($httpClient)
    {
        $this->httpCLient = $httpClient;
    }

    public function getCountryCodes() : array
    {
        return $this->get('countries');
    }

    public function getTimeZones() : array
    {
        return $this->get('timezones');
    }

    private function get(string $url)
    {
        $response = $this->httpCLient->get($url);

        return get_object_vars(json_decode($response->getBody())->result);
    }

}
