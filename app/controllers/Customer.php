<?php

class Customer extends Controller
{
    
    public function __construct()
    {
        $this->CustomerModel = $this->model('CustomerModel');
    }



    public function index()
    {
        $result = $this->CustomerModel->getCustomer();
        // var_dump($result);
        $rows = '';

        foreach ($result as $info) {
            $rows .= "<tr>
                        <td>$info->FamilyName</td>
                        <td>$info->Address</td>
                        <td>$info->Email</td>
                        <td>$info->Phonenumber</td>
                        <td>$info->AmountOfAdults</td>
                        <td>$info->AmountOfKids</td>
                        <td>$info->AmountOfBabies</td>
                        <td>$info->ExtraWish</td>
                        <td><a href='../customer/updateCustomer/$info->Id' class='btn-outlined-primary'>Edit</a></td>
                        <td><a href='../customer/deleteCustomer/$info->Id' class='btn-outlined-red'>Delete</a></td>
                    </tr>";
        }
        $data = [
            'title' => 'Overview Customers',
            'rows' => $rows
        ];

        $this->view('customer/index', $data);
    }

    public function addCustomer()
    {
        $data = [   "notification" => "",
                    'title' => 'Overview Customers',]; 
 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             try{
                 // filtert voor sql injecties
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
 
                 // VALIDATIE VAN DE INPUT
                 $data = $this->validateCreate($data,$_POST);
 
                 if (strlen($data["notification"]) < 1) {
                     // VOERT DE UPDATE UIT
                     $result = $this->CustomerModel->addCustomer($_POST);
 
                     // CHECKT OF HET IS GELUKT
                     if ($result) {
                         $data['notification'] = "Customer Added!";
                         header("Refresh: 3; url=" . URLROOT . "/customer/index");
                     } else {
 
                         $data['notification'] = "Something went wrong, Try again";
                     }
                 }
             } catch (PDOException $e) {
 
                 echo $e;
                 $data['notification'] = "Something went wrong, Try again";
             }
         }
         else {
             $data['notification'] = ' ';
         }
         $this->view('customer/create', $data);
    }
 
        // VALIDATIE METHOD VOOR CREATE EN UPDATE
    
    public function validateCreate($data, $post)
    {
        if ($post['FamilyName'] == 50)
        {
            $data['notification'] = "Thats too long, please try again with a shorter familyname";
         }
        if ($post['Address'] == null)
        {
            $data['notification'] = "You must enter your address";
        }
        if ($post['AmountOfAdults'] == null)
        {
            $data['notification'] = "There needs to be atleast one adult";
        }
        return($data);
    }  

    public function updateCustomer($Id = null)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->CustomerModel->updateCustomer($_POST);

            header("Location:" . URLROOT . "/customer/index");
          } else {

            $row = $this->CustomerModel->getCustomerById($Id);

            $data = [
              'title' => 'Edit Customer',
              'row' => $row
            ];

            $this->view("customer/update", $data);
          }

    }

        public function deleteCustomer($Id){
            $this->CustomerModel->deleteCustomer($Id);
            
            echo "het verwijderen is gelukt";
            header('location: ' . URLROOT . '/customer/index');
            
        }
}
?>