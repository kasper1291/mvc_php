<?php

namespace Controllers;
use Core\Controller;
use Core\View;

class ControllerAuth extends Controller
{
    public function index()
    {
        (new \Core\View)->generate('auth.php');
    }


}