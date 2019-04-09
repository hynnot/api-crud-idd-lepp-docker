<?php

namespace App\Domain\PhoneBooks\Services;

interface ApiService
{
    public function getCountryCodes() : array;
    public function getTimeZones() : array;
}
