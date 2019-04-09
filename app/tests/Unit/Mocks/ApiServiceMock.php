<?php

namespace Tests\Unit\Mocks;

use App\Domain\PhoneBooks\Services\ApiService;

class ApiServiceMock implements ApiService
{
    public function getCountryCodes():array
    {
        return ['ES' => ''];
    }

    public function getTimeZones():array
    {
        return ['Europe/Madrid' => ''];
    }

}
