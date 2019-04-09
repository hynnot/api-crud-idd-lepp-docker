<?php

namespace Tests\Unit;

use \App\Domain\PhoneBooks\Actions\GetOnePhoneBookItemAction;

use \Tests\Unit\Mocks\PhoneBookRepositoryMock;
use App\Domain\PhoneBooks\Entities\PhoneBookEntity;

class GetOnePhoneBookItemActionUnitTest extends \PHPUnit_Framework_TestCase
{
    protected $getOnePhoneBookItemAction;

    public function testReturnNullWhenPhoneBookIDNotExist()
    {
        $this->getOnePhoneBookItemAction = new GetOnePhoneBookItemAction( new PhoneBookRepositoryMock() );

        $phoneBook = $this->getOnePhoneBookItemAction->execute(1);

        $this->assertNull($phoneBook);
    }

    public function testReturnPhoneBookWhenPhoneBookIDNotExist()
    {
        $phoneBookRepositoryMock = new PhoneBookRepositoryMock();
        $phoneBookEntity = new PhoneBookEntity(['id' => 1]);
        $phoneBookRepositoryMock->storePhoneBook($phoneBookEntity);
        $this->getOnePhoneBookItemAction = new GetOnePhoneBookItemAction($phoneBookRepositoryMock);

        $this->assertEquals($phoneBookEntity, $this->getOnePhoneBookItemAction->execute(1));
    }

}
