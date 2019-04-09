<?php

namespace App\Domain\PhoneBooks\Actions;

use \App\Domain\PhoneBooks\Repositories\PhoneBookRepository;
use \App\Domain\PhoneBooks\Services\ValidateRequiredParametersFilledService;
use \App\Domain\PhoneBooks\Services\ValidatePhoneService;
use \App\Domain\PhoneBooks\Services\ValidateCountryCodeService;
use \App\Domain\PhoneBooks\Services\ValidateTimeZoneNameService;
use \App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class StorePhoneBookItemAction
{
    private $phoneBookRepository;
    private $validatePhoneService;
    private $validateCountryCodeService;
    private $validateTimeZoneNameService;
    private $validateRequiredParametersFilledService;

    public function __construct(
        PhoneBookRepository $phoneBookRepository,
        ValidatePhoneService $validatePhoneService,
        ValidateCountryCodeService $validateCountryCodeService,
        ValidateTimeZoneNameService $validateTimeZoneNameService,
        ValidateRequiredParametersFilledService $validateRequiredParametersFilledService
    )
    {
        $this->phoneBookRepository = $phoneBookRepository;
        $this->validatePhoneService = $validatePhoneService;
        $this->validateCountryCodeService = $validateCountryCodeService;
        $this->validateTimeZoneNameService = $validateTimeZoneNameService;
        $this->validateRequiredParametersFilledService = $validateRequiredParametersFilledService;
    }

    public function execute(array $data)
    {
        $this->validateRequiredParametersFilledService->execute($data);
        $this->validatePhoneService->execute($data['phoneNumber']);
        $this->validateCountryCodeService->execute($data['countryCode']);
        $this->validateTimeZoneNameService->execute($data['timeZoneName']);
        $phoneBookEntity = new PhoneBookEntity($data);

        $this->phoneBookRepository->storePhoneBook($phoneBookEntity);
    }
}