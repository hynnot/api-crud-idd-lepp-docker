<?php

namespace App\Domain\PhoneBooks\Services;

use App\Domain\PhoneBooks\Services\ApiValidatorService;

class ValidateCountryCodeService
{
    private $apiValidatorService;

    public function __construct(ApiValidatorService $apiValidatorService)
    {
        $this->apiValidatorService = $apiValidatorService;
    }

    function execute(string $countryCode)
    {
        $this->apiValidatorService->execute($countryCode, 'getCountryCodes', 'InvalidCountryCodeException');
    }

}
