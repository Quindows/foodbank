<?php

class Allergy extends controller
{
    public function __construct()
    {
        $this->model = $this->model('AllergyModel');
    }

    public function index()
    {


        $records = $this->model->getAllergies();
        $rows = '';

        if ($records == null) {
            $rows .= '<h2>Geen allergieën</h2>';
        } else {
            foreach ($records as $value) {
                // bouwt de tabel inhoud
                $rows .= "
                <tr>
                    <td>$value->Name</td>
                    <td><a href='../allergy/updateAllergy/$value->Id' class='btn-outlined-primary'>Wijzigen</a></td>
                    <td><a href='../allergy/updateAllergy/$value->Id' class='btn-outlined-red'>Verwijderen</a></td>
                </tr>";
            }
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('allergy/index', $data);
    }

    public function addAllergy()
    {
        $data = [
            'title' => 'Score Toevoegen'
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->addAllergy($_POST);
            header("Location: " . URLROOT . "allergy/index");
        } else {
            $this->view('allergy/addAllergy', $data);
        }
    }
}
