<?php

class CustomerAllergy extends controller
{
    public function __construct()
    {
        $this->model = $this->model('CustomerAllergyModel');
    }

    public function index()
    {


        $records = $this->model->getCustomerAllergies();
        $rows = '';

        if ($records == null) {
            $rows .= '<h2>Geen allergieën</h2>';
        } else {
            foreach ($records as $value) {
                // bouwt de tabel inhoud
                $rows .= "
                <tr>
                    <td>$value->FamilyName</td>
                    <td>$value->ExtraWish</td>
                    <td>$value->AllergyName</td>
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
}
