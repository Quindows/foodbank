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
                        <td><a href='../score/updateCustomer/$info->Id' class='btn-outlined-primary'>Edit</a></td>
                        <td><a href='../score/deleteCustomer/$info->Id' class='btn-outlined-red'>Delete</a></td>
                    </tr>";
        }
        $data = [
            'title' => 'Overview Customers',
            'rows' => $rows
        ];

        $this->view('customer/index', $data);
    }
}


?>