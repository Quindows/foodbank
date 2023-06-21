<?php

class VoedselPakket extends controller
{
    public function __construct()
    {
        $this->model = $this->model('VoedselPakketModel');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $records = $this->model->getVoedselPakkettenByEetwens($_POST["Eetwens"]);
        } else {
            $records = $this->model->getVoedselPakketten();
        }

        $rows = '';
        $naam = '';
        // Checkt of er Supplier zijn
        if ($records == null) {
            $rows .= '<tr><td>Er zijn geen gezinnen bekent die de geselecteerde eetwens hebben<td></tr> ';
        } else {
            foreach ($records as $value) {
                // Bouwt de tabel inhoud
                $fullname = '';
                if ($value->tussenvoegsel == null) {
                    $fullname = "$value->voornaam $value->achternaam";
                } else {
                    $fullname = "$value->voornaam $value->tussenvoegsel $value->achternaam";
                }
                $rows .= "
                <tr>
                    <td>$value->naam</td>
                    <td>$value->omschrijving</td>
                    <td>$value->volwassenen</td>
                    <td>$value->kinderen</td>
                    <td>$value->babys</td>
                    <td>$fullname</td>
                    <td><a href='../supplier/updateSupplier/$value->id' class='btn-outlined-green'>Details</a></td>
                </tr>";
            }
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'naam' => $records,
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('voedselpakket/index', $data);
    }

    public function createSupplier()
    {
        // Checks if there is a POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // It sanitizes the input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->CreateSupplier($_POST);
            // Sends the user back to the order index page 
            header("Location:" . URLROOT . "/supplier/index");
        }
        // Else it shows the page 
        else {

            $this->view('supplier/createSupplier');
        }
    }

    public function updateSupplier($id = null)
    {
        // Checks if there is a POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // It sanitizes the input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->model->UpdateSupplier($_POST);
            // Sends the user back to the order index page 
            header("Location:" . URLROOT . "/supplier/index");
        }
        // Else it shows the page 
        else {
            $row = $this->model->getSupplierById($id);
            $data = [
                'row' => $row
            ];
            $this->view("supplier/updateSupplier", $data);
        }
    }
    public function deleteSupplier($id)
    {
        $this->model->deleteSupplier($id);
        header("Location: " . URLROOT . "/supplier/index");
    }
}
