<?php

class Landingpages extends Controller
{
    public function index()
    {
        $sum = $this->add(2, 2);
        
        $data = [
            'title' => "testing unittests",
            'test' => $sum
        ];

        $this->view('landingpages/index', $data);
    }

    // TESTING
    public function add($numb1, $numb2)
    {
        $sum = $numb1 + $numb2;

        return $sum;
    }

}