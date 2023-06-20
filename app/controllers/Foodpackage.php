<?php

class Foodpackage extends controller
{
    public function __contruct()
    {
        $this->model = $this->model('FoodpackageModel');
    }

    public function index()
    {
        $records = $this->model('FoodpackageModel')->getFoodpackages();

        $rows = '';
        $notification = '';

        if($records == null)
        {
            $notification = "no packages";
        } else 
        {
            foreach($records as $value)
            {
                $rows .="
                <tr>
                    <td>$value->familyName</td>
                    <td>$value->packageId</td>
                    <td>$value->product</td>
                    <td>$value->allergy</td>
                    <td>$value->extra</td>
                    <td><a href='#' class='btn-outlined-primary'>Edit</a></td>
                        <td><a href='../foodpackage/delete/$value->id' class='btn-outlined-red'>Delete</a></td>

                </tr>";
            }
        }

        $data = [
            'rows' => $rows,
            'notification' => $notification
        ];

        $this->view('foodpackage/index', $data);
    }

        // DELETE METHOD
        public function delete($id){
            if($this->model('FoodpackageModel')->deleteFoodpackage($id)){
                echo "het verwijderen is gelukt";
                header('location: ' . URLROOT . 'foodpackage/index');
        }
    }
}