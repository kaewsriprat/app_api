<?php

class MainController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Home',
        );

        $this->view('main/index', $data);
    }
}
