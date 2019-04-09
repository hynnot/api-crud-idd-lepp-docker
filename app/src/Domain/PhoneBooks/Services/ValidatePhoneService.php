<?php

namespace App\Domain\PhoneBooks\Services;

use App\Domain\PhoneBooks\Exceptions\InvalidPhoneException;

class ValidatePhoneService
{
    function execute(string $phone)
    {
        $regex = '/^\+(?:[0-9] ?){6,14}[0-9]$/';
        $validPhone = (bool)preg_match($regex, $phone);
        if (false === $validPhone) {
            throw new InvalidPhoneException();
        }
    }
}
