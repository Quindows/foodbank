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
}

