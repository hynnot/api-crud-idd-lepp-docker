<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use App\Domain\PhoneBooks\Actions\StorePhoneBookItemAction;
use App\Domain\PhoneBooks\Actions\GetOnePhoneBookItemAction;
use App\Domain\PhoneBooks\Actions\DeleteOnePhoneBookItemAction;
use App\Domain\PhoneBooks\Exceptions\RequiredParametersException;
use App\Domain\PhoneBooks\Exceptions\InvalidPhoneException;
use App\Domain\PhoneBooks\Exceptions\InvalidCountryCodeException;
use App\Domain\PhoneBooks\Exceptions\InvalidTimeZoneNameException;
use App\Domain\PhoneBooks\Exceptions\PhoneBookNotExistException;

class PhoneBookController
{
    private $storePhoneBookItemAction;
    private $getOnePhoneBookItemAction;

    public function __construct(
        StorePhoneBookItemAction $storePhoneBookItemAction,
        GetOnePhoneBookItemAction $getOnePhoneBookItemAction,
        DeleteOnePhoneBookItemAction $deleteOnePhoneBookItemAction
    ) {
        $this->storePhoneBookItemAction = $storePhoneBookItemAction;
        $this->getOnePhoneBookItemAction = $getOnePhoneBookItemAction;
        $this->deleteOnePhoneBookItemAction = $deleteOnePhoneBookItemAction;
    }

    public function storePhoneBookItem($request, $response, $args) {
        $data = $request->getParsedBody();
        [$status, $message] = $this->getStatusAndMessageWhenStorePhoneBookItem($data);

        return $response->withStatus($status)->withJson(['message'=> $message]);
    }

    public function getOnePhoneBookItem($request, $response, $args)
    {
        $phoneBook = $this->getOnePhoneBookItemAction->execute($args['id']);

        [$status, $result] = $this->getStatusAndMessageWhenPhoneBookNotExist();
        if ($phoneBook) {
            $status = 200;
            $result = $phoneBook;
        }

        return $response->withStatus($status)->withJson($result);
    }

    public function deleteOnePhoneBookItem($request, $response, $args)
    {
        try {
            $this->deleteOnePhoneBookItemAction->execute($args['id']);
            $status = 200;
            $result = ['message' => 'Phone book item delete successfully!'];
        } catch (PhoneBookNotExistException $e) {
            [$status, $result] = $this->getStatusAndMessageWhenPhoneBookNotExist();
        }

        return $response->withStatus($status)->withJson($result);
    }

    private function getStatusAndMessageWhenPhoneBookNotExist() : array
    {
        $status = 404;
        $message = ['message' => 'Phone book item not found!'];

        return [$status, $message];
    }

    private function getStatusAndMessageWhenStorePhoneBookItem(array $data) : array
    {
        $status = 400;
        try {
            $this->storePhoneBookItemAction->execute($data);
            $status = 201;
            $message = 'Phone book item created successfully!';
        } catch (RequiredParametersException $e) {
            $message = 'A phone book item requires: first name, phone number, country code and time zone!';
        } catch (InvalidPhoneException $e) {
            $message = 'A phone book item requires a phone number valid!';
        } catch (InvalidCountryCodeException $e) {
            $message = 'A phone book item requires a country code valid!';
        } catch (InvalidTimeZoneNameException $e) {
            $message = 'A phone book item requires a time zone valid!';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return [$status, $message];
    }

}
