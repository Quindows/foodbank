<?php

class Landingpages extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Homepage voedselbank maaskantje",
            'test' => "",
        ];

        $this->view('landingpages/index', $data);
    }
}
