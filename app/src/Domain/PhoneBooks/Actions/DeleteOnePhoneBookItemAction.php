<?php

namespace App\Domain\PhoneBooks\Actions;

use App\Domain\PhoneBooks\Repositories\PhoneBookRepository;
use App\Domain\PhoneBooks\Exceptions\PhoneBookNotExistException;

class DeleteOnePhoneBookItemAction
{
    private $phoneBookRepository;

    public function __construct(PhoneBookRepository $phoneBookRepository)
    {
        $this->phoneBookRepository = $phoneBookRepository;
    }

    public function execute(int $id)
    {
        if (false === $this->phoneBookRepository->existPhoneBook($id)) {
            throw new PhoneBookNotExistException();
        }

        $this->phoneBookRepository->deletePhoneBookById($id);
    }
}