<?php

class Supplier extends controller
{
    public function __construct()
    {
        $this->model = $this->model('SupplierModel');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $records = $this->model->getSuppliers();
        } else {
            $records = $this->model->getSuppliers();
        }

        $rows = '';
        $naam = '';
        // Checkt of er Supplier zijn
        if ($records == null) {
            $rows .= '<h2>Er staan nog geen leveranciers in de database.</h2> ';
        } else {
            foreach ($records as $value) {
                // Bouwt de tabel inhoud
                $rows .= "
                <tr>
                    <td>$value->companyname</td>
                    <td>$value->address</td>
                    <td>$value->contactperson</td>
                    <td>$value->email</td>
                    <td>$value->phonenumber</td>
                    <td>$value->nextdelivery</td>
                    <td><a href='../supplier/updateSupplier/$value->id' class='btn-outlined-green'>Edit</a></td>
                    <td><a href='../supplier/deleteSupplier/$value->id' class='btn-outlined-red'>Delete</a></td>
                </tr>";
            }
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'naam' => $naam,
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('supplier/index', $data);
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
