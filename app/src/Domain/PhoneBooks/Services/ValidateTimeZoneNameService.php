<?php

namespace App\Domain\PhoneBooks\Services;

use App\Domain\PhoneBooks\Services\ApiValidatorService;

class ValidateTimeZoneNameService
{
    private $apiValidatorService;

    public function __construct(ApiValidatorService $apiValidatorService)
    {
        $this->apiValidatorService = $apiValidatorService;
    }

    function execute(string $timeZoneName)
    {
        $this->apiValidatorService->execute($timeZoneName, 'getTimeZones', 'InvalidTimeZoneNameException');
    }

}
