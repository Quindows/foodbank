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


    public function updateFamilyAllergy($id = null)
    {
        $data = [
            'notification' => '',
            'id' => $id
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                // filtert voor sql injecties
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

                //VALIDATIE VAN DE INPUT
                $data = $this->validateAllergy($data, $_POST);

                if (strlen($data["notification"]) < 1) {    
                    // VOERT DE UPDATE UIT
                    $result = $this->CustomerAllergyModel->updateFamilyAllergy($_POST, $id);
                    
                    // CHECKT OF HET IS GELUKT
                    if ($result) {
                        $data['notification'] = "<h4 class='col-12-lg text-green bg-green-light-8 p-2'>Allergie gewijzigd!</h4>";
                        header("Refresh: 3; url=" . URLROOT . "customerallergy/index");
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
            $data['notification'] = ' ';
        }
        $this->view('customerAllergy/updateFamilyAllergy', $data);
    }

    public function validateAllergy($data, $post)
    {
        if ($post['allergy'] == 'Pindas')
        {
            $data['notification'] = "<h4 class='col-12-lg text-red bg-red-light-8 p-2'>Voor het wijzigen van deze allergie wordt geadviseerd eerst een arts te raadplegen vanwege een hoog risico op een anafylactisch shock</h4>";
         }
         return($data);
    }
}
