<?php

namespace App\Domain\PhoneBooks\Services;

use App\Domain\PhoneBooks\Exceptions\RequiredParametersException;

class ValidateRequiredParametersFilledService
{
    function execute(array $data)
    {
        if (
            empty($data['firstName']) ||
            empty($data['phoneNumber']) ||
            empty($data['countryCode']) ||
            empty($data['timeZoneName'])
        ) {
            throw new RequiredParametersException();
        }
    }
}
