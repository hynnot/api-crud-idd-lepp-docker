<?php

namespace App\Domain\PhoneBooks\Services;

use App\Domain\PhoneBooks\Exceptions\InvalidCountryCodeException;
use App\Domain\PhoneBooks\Services\ApiService;

class ApiValidatorService
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    function execute(string $element, string $function, string $exception)
    {
        $list = call_user_func( [ $this->apiService, $function ] );
        if (false === array_key_exists($element, $list)) {
            $className = 'App\Domain\PhoneBooks\Exceptions\\' . $exception;
            throw new $className;
        }
    }

}
