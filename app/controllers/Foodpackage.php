<?php

class Foodpackage extends controller
{
    public function __contruct()
    {
        $this->model = $this->model('FoodpackageModel');
    }
        // READ METHOD
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
                    <td>$value->product</td>
                    <td>$value->allergy</td>
                    <td>$value->extra</td>
                    <td><a href='../foodpackage/update/$value' class='btn-outlined-primary'>Edit</a></td>
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
    public function delete($id)
    {
        if($this->model('FoodpackageModel')->deleteFoodpackage($id)){
            echo "het verwijderen is gelukt";
            header('location: ' . URLROOT . 'foodpackage/index');
        }
    }

        // CREATE METHOD
        public function create(){
            $data = ["notification" => ""]; 
    
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                try{
                    // FILTERT VOOR SQL INJECTIONS
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

                    // VALIDATIE VAN DE INPUT
                    $data = $this->validateFoodpackage($data, $_POST); 
                    
                    if (strlen($data["notification"]) < 1) {

    
                        // VOERT DE CREATE UIT
                        $result = $this->model('FoodpackageModel')->createFoodpackage($_POST, 1);
                        // CHECKT OF HET IS GELUKT
                        if ($result) {
                            
                            $data['notification'] = "Reservatie gemaakt!";
                            header("Refresh: 3; url=" . URLROOT . "foodpackage/index");
                        } else {
                             
                            $data['notification'] = "er is iets mis gegaan, probeer opnieuw.";
                        }
                    }
                } catch (PDOException $e) {
                     
                    echo $e;
                    $data['notification'] = "er is iets mis gegaan, probeer opnieuw.";
                }
            }
            else {
                $data['notification'] = 'Maak een reservering!';
            }
            $this->view('foodpackage/create', $data);
        }

        // UPDATE METHOD
        public function update(){
            $data = ["notification" => ""]; 
    
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                try{
                    // FILTERT VOOR SQL INJECTIONS
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

                    // VALIDATIE VAN DE INPUT
                    $data = $this->validateFoodpackage($data, $_POST); 
                    
                    if (strlen($data["notification"]) < 1) {

    
                        // VOERT DE CREATE UIT
                        $result = $this->model('FoodpackageModel')->updateFoodpackage($_POST, 1);
                        // CHECKT OF HET IS GELUKT
                        if ($result) {
                            
                            $data['notification'] = "Reservatie gemaakt!";
                            header("Refresh: 3; url=" . URLROOT . "foodpackage/index");
                        } else {
                             
                            $data['notification'] = "er is iets mis gegaan, probeer opnieuw.";
                        }
                    }
                } catch (PDOException $e) {
                     
                    echo $e;
                    $data['notification'] = "er is iets mis gegaan, probeer opnieuw.";
                }
            }
            else {
                $data['notification'] = 'Maak een reservering!';
            }
            $this->view('foodpackage/create', $data);
        }

        // VALIDATIE METHOD VOOR CREATE EN UPDATE
        public function validateFoodpackage($data, $post){
            foreach($post as $key => $value){
            if (empty($value)) {
                $data['notification'] = "Niet alle velden zijn ingevuld.";
                return ($data);
            }
        }
        if ($post['Family'] > 5)
            $data['notification'] = "invalid ";
        return($data);
        }
}