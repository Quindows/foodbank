<?php

class CustomerAllergy extends controller
{
    public function __construct()
    {
        $this->CustomerAllergyModel = $this->model('CustomerAllergyModel');
    }

    public function index()
    {


        $result = $this->CustomerAllergyModel->getCustomerAllergies();
        $rows = '';

        foreach ($result as $info) {
            $rows .= "<tr>
                        <td>$info->Name</td>
                        <td>$info->FamilyDescription</td>
                        <td>$info->AmountOfAdults</td>
                        <td>$info->AmountOfKids</td>
                        <td>$info->AmountOfBabies</td>
                        <td>$info->RepresentativeName</td>
                        <td><a href='../customer/updateCustomer/$info->Id' class='btn-outlined-primary'>Bekijken</a></td>
                        </tr>";
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('customerallergy/index', $data);
    }
}
