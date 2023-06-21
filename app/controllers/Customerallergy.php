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
                                <td><a href='". URLROOT ."customerallergy/familyIndex/$info->Id' class='btn-outlined-primary'>Bekijken</a></td>
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

    public function FamilyIndex($Id)
    {
        $rows = '';

        $result = $this->CustomerAllergyModel->getFamilyAllergies($Id);
                // var_dump($result);

        foreach ($result as $info) {
            $rows .= "<tr>
                        <td>$info->PersonName</td>
                        <td>$info->typeOfPerson</td>
                        <td>$info->IsRepresentative</td>
                        <td>$info->Allergy</td>
                        <td><a href='". URLROOT ."customerallergy/updateFamilyAllergy/$info->Id' class='btn-outlined-primary'>Wijzig Allergie</a></td>
                        </tr>";
        }

        $data = [
            'Id'=> $info->Id,
            'rows' => $rows,
            'Gezinsnaam' => $info->Name,
            'Omschrijving' => $info->FamilyDescription,
            'TotaalAantalPersonen' => $info->TotalAmountOfPeople,

        ];
    
        // redirect naar de view
        $this->view('customerallergy/familyIndex', $data);
    }

    public function updateFamilyAllergy($Id = null)
    {
        $row = $this->CustomerAllergyModel->getFamilyAllergyById($Id);


        $result = $this->CustomerAllergyModel->getFamilyAllergies($Id);


        $data = [
            'row' => $row];

        // redirect naar de view
        $this->view('customerallergy/updateFamilyAllergy', $data);
    }
}
