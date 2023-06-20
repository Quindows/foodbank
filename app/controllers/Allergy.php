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
                    <td><a href='../allergy/deleteAllergy/$value->Id' class='btn-outlined-red'>Verwijderen</a></td>
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
            'title' => 'Add Allergy'
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->addAllergy($_POST);
            header("Location: " . URLROOT . "/allergy/index");
        } else {
            $this->view('allergy/addAllergy', $data);
        }
    }

    public function updateAllergy($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->updateAllergy($_POST);
            header("Location:" . URLROOT . "/allergy/index");
        } else {
            $row = $this->model->getAllergiesById($id);

            // Check if the $row variable is null or not
            if ($row === null) {
                // Handle the case where the data is not found
                echo "<h3 class='text-red'>Data not found.</h3>";
                return;
            }

            $data = [
                'title' => 'Change allergy',
                'row' => $row
            ];
            $this->view("allergy/updateAllergy", $data);
        }
    }

    public function deleteAllergy($id)
    {
        $this->model->deleteAllergy($id);

        $data = [
            'title' => 'Allergy removed!'
        ];

        $this->view('allergy/deleteAllergy', $data);
        header("Refresh:2; url=" . URLROOT . "/allergy/index");
    }
}
