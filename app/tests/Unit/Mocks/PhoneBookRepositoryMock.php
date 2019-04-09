<?php

namespace Tests\Unit\Mocks;

use \App\Domain\PhoneBooks\Repositories\PhoneBookRepository;
use \App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class PhoneBookRepositoryMock implements PhoneBookRepository
{
    private $phoneBooks = [];

    public function storePhoneBook(PhoneBookEntity $phoneBook)
    {
        $this->phoneBooks[$phoneBook->id] = $phoneBook;
    }

    public function getPhoneBookById(int $id) : ?PhoneBookEntity
    {
        $result = null;
        if(array_key_exists($id, $this->phoneBooks)) {
            $result = $this->phoneBooks[$id];
        }

        return $result;
    }

    public function existPhoneBook(int $id) : bool
    {
        return array_key_exists($id, $this->phoneBooks);
    }

    public function deletePhoneBookById(int $id)
    {
        unset($this->phoneBooks[$id]);
    }

}
