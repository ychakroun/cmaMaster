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
        $mangoUsers = $this->mangoPayApi->Users->GetAll();

        return  $mangoUsers;
    }
    /**
     * Create Mangopay User
     * @return MangopPayUser $mangoUser
     */
    public function getMangoUser($mangoId)
    {

        //Send the request
        $mangoUsers = $this->mangoPayApi->Users->Get($mangoId);

        return  $mangoUsers;
    }
    /**
     * Create Mangopay User
     * @return MangopPayUser $mangoUser
     */
    public function createMangoUser($firstname,$lastname,$birthday,$email)
    {
        $mangoUser = new \MangoPay\UserNatural();
        $mangoUser->PersonType = "NATURAL";
        $mangoUser->FirstName = $firstname;
        $mangoUser->LastName = $lastname;
        $mangoUser->Birthday = $birthday;
        $mangoUser->Nationality = "FR";
        $mangoUser->CountryOfResidence = "FR";
        $mangoUser->Email = $email;

        //Send the request
        $mangoUser = $this->mangoPayApi->Users->Create($mangoUser);

        return $mangoUser;
    }
}