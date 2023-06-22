<?php

class Klant extends Controller
{
    public function __construct()
    {
        $this->model = $this->model('klantModel');
    }

    public function index()
    {
        $rows = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // It sanitizes the input
            if ($_POST == null) {
                $result = $this->model->getKlanten();
            }
            $rows = '';
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $result = $this->model->getKlantenByPostcode($_POST['type']);
            // This if statement looks at the content of $result
            // If $result is empty, It will display red text saying there is no data yet
            // Else it will display the data from $result
            if ($result == null) {
                $rows .= "<tr>
                            <td class='text-red'>Er zijn geen klanten die de geslecteerde postcode hebben</td>
                        </tr>";
            } else {
                foreach ($result as $info) {
                    $rows .= "<tr>
                            <td>$info->GezinNaam</td>
                            <td>$info->Naam</td>
                            <td>$info->Email</td>
                            <td>$info->Mobiel</td>
                            <td>$info->Adres</td>
                            <td>$info->Woonplaats</td>
                            <td><a href='../klant/updateKlant/$info->CpgId' class='btn-outlined-primary'>Klant details</a></td>
                        </tr>";
                }
            }
        } else {
            //References the method in the model
            $result = $this->model->getKlanten();
            foreach ($result as $info) {
                $rows .= "<tr>
                            <td>$info->GezinNaam</td>
                            <td>$info->Naam</td>
                            <td>$info->Email</td>
                            <td>$info->Mobiel</td>
                            <td>$info->Adres</td>
                            <td>$info->Woonplaats</td>
                            <td><a href='../klant/updateKlant/$info->CpgId' class='btn-outlined-primary'>Klant details</a></td>
                        </tr>";
            }
        }
        // This is the data I will pass to the index page
        $data = [
            'title' => 'Overzicht Klanten',
            'rows' => $rows
        ];

        $this->view('klant/index', $data);
    }

    public function updateKlant($klantId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->updateKlant($_POST);
            header("Location:" . URLROOT . "klant/index");
        } else {
            $row = $this->model->getKlantenById($klantId);

            // Check if the $row variable is null or not
            if ($row === null) {
                // Handle the case where the data is not found
                echo "<h3 class='text-red'>Data not found.</h3>";
                header("Refresh:3; url=" . URLROOT . "klant/index");
                return;
            }

            $data = [
                'title' => 'Klant details wijzigen',
                'row' => $row
            ];
            $this->view("klant/updateKlant", $data);
        }
    }
}
