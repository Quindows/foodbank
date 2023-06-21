<?php

class CustomerAllergy extends controller
{
    public function __construct()
    {
        $this->CustomerAllergyModel = $this->model('CustomerAllergyModel');
    }

    public function index()
    {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $result = $this->CustomerAllergyModel->getCustomerByAllergy($_POST['allergy']);
            } else {
                $result = $this->CustomerAllergyModel->getCustomerAllergies();
            }
            // variable met de data van de database
    
            $rows = '';
           
            // checkt of er leveranciers zijn
            if($result == null)
            {
                $rows = '<td class="text-red">Er zijn geen gezinnen bekend die de geselecteerde allergie hebben</td>';
            } else {
                // insert de data in elke row van de tabel
                foreach ($result as $info) {
                    $rows .= "<tr>
                                <td>$info->Name</td>
                                <td>$info->FamilyDescription</td>
                                <td>$info->AmountOfAdults</td>
                                <td>$info->AmountOfKids</td>
                                <td>$info->AmountOfBabies</td>
                                <td>$info->RepresentativeName</td>
                                <td><a href='". URLROOT ."customerallergy/familyallergies/$info->Id' class='btn-outlined-primary'>Bekijken</a></td>
                                </tr>";
                }
            }
    
            // array voor alle data om mee te sturen naar de view
        $data = [
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('customerallergy/index', $data);
    }

    public function FamilyIndex()
    {

        $data = [
            'rows' => $rows
        ];
    
        // redirect naar de view
        $this->view('customerallergy/familyIndex', $data);
    }


}
