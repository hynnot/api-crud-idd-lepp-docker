<?php

namespace App\Domain\PhoneBooks\Actions;

use App\Domain\PhoneBooks\Repositories\PhoneBookRepository;
use App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class GetOnePhoneBookItemAction
{
    private $phoneBookRepository;

    public function __construct(PhoneBookRepository $phoneBookRepository)
    {
        $this->phoneBookRepository = $phoneBookRepository;
    }

    public function execute(int $id) : ?PhoneBookEntity
    {
        return $this->phoneBookRepository->getPhoneBookById($id);
    }
}