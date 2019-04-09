<?php

namespace App\Domain\PhoneBooks\Repositories;

use App\Domain\PhoneBooks\Entities\PhoneBookEntity;

interface PhoneBookRepository
{
    public function storePhoneBook(PhoneBookEntity $phoneBook);
    public function existPhoneBook(int $id) : bool;
    public function getPhoneBookById(int $id) : ?PhoneBookEntity;
    public function deletePhoneBookById(int $id);
}
