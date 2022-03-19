<?php

namespace App\Controllers;

use App\Services\ContactService;
use Core\Controller;

class Contact extends Controller
{
    public function index($ali, ContactService $contactService)
    {
        echo $ali;
        echo $contactService->getContactName();
    }

    public function phone()
    {
        echo "contact by phone zero zero zero kaman zerooo";
    }
}