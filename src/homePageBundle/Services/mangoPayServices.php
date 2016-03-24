<?php

namespace homePageBundle\Services;

use MangoPay;


class mangoPayServices
{

    private $mangoPayApi;

    public function __construct()
    {
        $this->mangoPayApi = new MangoPay\MangoPayApi();
        $this->mangoPayApi->Config->ClientId = 'custommyart';
        $this->mangoPayApi->Config->ClientPassword = 'w1XjOt3b7rsNuOuqWYmi2EiyO8bE738VLjSEamkrOXht88MnnM';
        $this->mangoPayApi->Config->TemporaryFolder = __DIR__.'/../../../var/tmpMangoPay';    
        $this->mangoPayApi->Config->BaseUrl = 'https://api.sandbox.mangopay.com';
    }

    /**
     * Create Mangopay User
     * @return MangopPayUser $mangoUser
     */
    public function getMangoUsers()
    {

        //Send the request
        $users = $this->mangoPayApi->Users;
        $mangoUsers = $this->mangoPayApi->Users->GetAll();

        return  $mangoUsers;
    }
    /**
     * Create Mangopay User
     * @return MangopPayUser $mangoUser
     */
    public function createMangoUser()
    {

        $mangoUser = new \MangoPay\UserNatural();
        $mangoUser->PersonType = "NATURAL";
        $mangoUser->FirstName = 'John';
        $mangoUser->LastName = 'Doe';
        $mangoUser->Birthday = 1409735187;
        $mangoUser->Nationality = "FR";
        $mangoUser->CountryOfResidence = "FR";
        $mangoUser->Email = 'john.doe@mail.com';

        //Send the request
        $mangoUser = $this->mangoPayApi->Users->Create($mangoUser);

        return $mangoUser;
    }
}