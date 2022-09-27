<?php


class ControllerIndex extends Controller
{

    public function index()
    {
        $posts = (new ModelPost)->getPosts();
        $this->view->generate('main_page.php', 'basic_template.php', $posts);
    }
}