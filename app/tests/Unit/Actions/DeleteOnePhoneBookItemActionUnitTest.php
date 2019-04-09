<?php

namespace Tests\Unit;

use \App\Domain\PhoneBooks\Actions\DeleteOnePhoneBookItemAction;

use \Tests\Unit\Mocks\PhoneBookRepositoryMock;
use App\Domain\PhoneBooks\Exceptions\PhoneBookNotExistException;
use \App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class DeleteOnePhoneBookItemActionUnitTest extends \PHPUnit_Framework_TestCase
{
    protected $deleteOnePhoneBookItemAction;

    public function testThrowPhoneBookNotExistExceptionWhenPhoneBookNotExist()
    {
        $this->deleteOnePhoneBookItemAction = new DeleteOnePhoneBookItemAction( new PhoneBookRepositoryMock() );

        $this->expectException(PhoneBookNotExistException::class);

        $this->deleteOnePhoneBookItemAction->execute(1);
    }

    public function testDeletePhoneBookWhenPhoneBookExist()
    {
        $id = 1;
        $phoneBookRepositoryMock = new PhoneBookRepositoryMock();
        $phoneBookEntity = new PhoneBookEntity(['id' => $id]);
        $phoneBookRepositoryMock->storePhoneBook($phoneBookEntity);
        $this->deleteOnePhoneBookItemAction = new DeleteOnePhoneBookItemAction($phoneBookRepositoryMock);

        $this->deleteOnePhoneBookItemAction->execute($id);

        $this->assertNull($phoneBookRepositoryMock->getPhoneBookById($id));
    }

}
