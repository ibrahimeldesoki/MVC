<?php

namespace App\Services;

class ContactService
{

    public function __construct(TestService $testService)
    {

    }

    public function getContactName()
    {
        return "Alaa";
    }
}