<?php

namespace Controllers;
use Core\Controller;
use Core\View;
use ModelPost;

class ControllerPost extends Controller
{
    public function __construct()
    {
        $this->model = new ModelPost();
        $this->view = new View();
    }

    public function index ()
    {
        $posts = $this->model->getPosts();
        $this->view->generate('');
    }

}