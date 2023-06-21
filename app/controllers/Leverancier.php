<?php

class Leverancier extends controller{
    public function __construct()
    {
        $this->model = $this->model('LeverancierModel');
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $records = $this->model->getLeveranciersByType($_POST['type']);  
        } else {
            $records = $this->model->getLeveranciers();
        }
        // variable met de data van de database

        $rows = '';
       
        // checkt of er leveranciers zijn
        if($records == null)
        {
            $rows .= '<h2>Er zijn geen leveranciers bekent van het geselecteerde leverancierstype</h2>';
        } else {
            // insert de data in elke row van de tabel
            foreach($records as $value)
            {
                $rows .="
                <tr>
                    <td>$value->Naam</td>
                    <td>$value->ContactPersoon</td>
                    <td>$value->Email</td>
                    <td>$value->Mobiel</td>
                    <td>$value->LeveranciersNummer</td>
                    <td>$value->LeveranciersType</td>
                </tr>";
            }
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'rows' => $rows
        ];

        // redirect naar de view
        $this->view('leverancier/index', $data);
        
    }
}