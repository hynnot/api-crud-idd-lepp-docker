<?php

namespace Tests\Unit;

use \App\Domain\PhoneBooks\Actions\StorePhoneBookItemAction;

use \Tests\Unit\Mocks\PhoneBookRepositoryMock;
use \Tests\Unit\Mocks\ApiServiceMock;
use \App\Domain\PhoneBooks\Services\ValidateRequiredParametersFilledService;
use \App\Domain\PhoneBooks\Services\ValidatePhoneService;
use \App\Domain\PhoneBooks\Services\ValidateCountryCodeService;
use \App\Domain\PhoneBooks\Services\ValidateTimeZoneNameService;
use \App\Domain\PhoneBooks\Services\ApiValidatorService;
use App\Domain\PhoneBooks\Exceptions\RequiredParametersException;
use App\Domain\PhoneBooks\Exceptions\InvalidPhoneException;
use App\Domain\PhoneBooks\Exceptions\InvalidCountryCodeException;
use App\Domain\PhoneBooks\Exceptions\InvalidTimeZoneNameException;

class StorePhoneBookItemActionUnitTest extends \PHPUnit_Framework_TestCase
{
    protected $storePhoneBookItemAction;

    protected function setUp(): void
    {
        $this->storePhoneBookItemAction = new StorePhoneBookItemAction(
            new PhoneBookRepositoryMock(),
            new ValidatePhoneService(),
            new ValidateCountryCodeService(new ApiValidatorService(new ApiServiceMock())),
            new ValidateTimeZoneNameService(new ApiValidatorService(new ApiServiceMock())),
            new ValidateRequiredParametersFilledService()
        );
    }

    public function testThrowRequiredParametersExceptionWhenRequiredParameterIsEmpty()
    {
        $this->expectException(RequiredParametersException::class);

        $this->storePhoneBookItemAction->execute([]);
    }

    public function testThrowInvalidPhoneExceptionWhenPhoneIsInvalid()
    {
        $this->expectException(InvalidPhoneException::class);

        $this->storePhoneBookItemAction->execute([
            'firstName' => 'Tony',
            'phoneNumber' => '635123456',
            'countryCode' => 'ESP',
            'timeZoneName' => 'Europe/Valencia'
        ]);
    }

    public function testThrowInvalidCountryCodeExceptionWhenCountryCodeIsInvalid()
    {
        $this->expectException(InvalidCountryCodeException::class);

        $this->storePhoneBookItemAction->execute([
            'firstName' => 'Tony',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ESP',
            'timeZoneName' => 'Europe/Valencia'
        ]);
    }

    public function testThrowInvalidTimeZoneNameExceptionWhenTimeZoneNameIsInvalid()
    {
        $this->expectException(InvalidTimeZoneNameException::class);

        $this->storePhoneBookItemAction->execute([
            'firstName' => 'Tony',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ES',
            'timeZoneName' => 'Europe/Valencia'
        ]);
    }

    public function testStorePhoneBook()
    {
        $this->storePhoneBookItemAction->execute([
            'firstName' => 'Tony',
            'phoneNumber' => '+34635123456',
            'countryCode' => 'ES',
            'timeZoneName' => 'Europe/Madrid'
        ]);
    }

}
