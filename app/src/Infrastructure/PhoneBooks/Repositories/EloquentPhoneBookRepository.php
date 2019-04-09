<?php

namespace App\Infrastructure\PhoneBooks\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use App\Domain\PhoneBooks\Repositories\PhoneBookRepository;
use App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class EloquentPhoneBookRepository implements PhoneBookRepository
{
    private $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function storePhoneBook(PhoneBookEntity $phoneBook)
    {
        $this->table->insert($phoneBook->toArray());
    }

    public function existPhoneBook(int $id) : bool
    {
        return $this->table->where('id', $id)->exists();
    }

    public function getPhoneBookById(int $id) : ?PhoneBookEntity
    {
        $phoneBookModel = $this->table->find($id);

        $phoneBookEntity = null;
        if ($phoneBookModel) {
            $phoneBookEntity = new PhoneBookEntity(get_object_vars($phoneBookModel));
        }

        return $phoneBookEntity;
    }

    public function deletePhoneBookById(int $id)
    {
        $this->table->where('id', $id)->delete();
    }

}
