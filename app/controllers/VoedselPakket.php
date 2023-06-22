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
                    <td><a href='../voedselpakket/overzichtPakketten/$value->id' class='btn-outlined-green'>Details</a></td>
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

    public function overzichtPakketten($id)
    {
        // Else it shows the page 

        $records = $this->model->getVoedselPakkettenById($id);
        $rows = '';

        foreach ($records as $value) {
            // Bouwt de tabel inhoud
            $rows .= "
            <tr>
                <td>$value->pakketnummer</td>
                <td>$value->datumsamengesteld</td>
                <td>$value->datumuitgifte</td>
                <td>$value->status</td>
                <td>4</td>
                <td><a href='/voedselpakket/wijzigStatus/$value->pakketid' class='btn-outlined-green'>Wijzig Status</a></td>
            </tr>";
        }
        // Gets all the information for the page ready
        $data = [
            'rows' => $rows,
            'gezinNaam' => $records[0]->naam,
            'omschrijving' => $records[0]->omschrijving,
            'aantalpersonen' => $records[0]->totaalaantalpersonen
        ];
        // This gets us to the right page with the required data
        $this->view("voedselpakket/overzichtPakketten", $data);
    }


    public function wijzigStatus($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "test";
            $records = $this->model->updateStatus($id);


            $this->view("voedselpakket/wijzigStatus", $data);
        } else {
            $records = $this->model->getVoedselPakketById($id);

            // Gets all the information for the page ready
            $data = [
                'status' => $records->status,
            ];

            // This gets us to the right page with the required data
            $this->view("voedselpakket/wijzigStatus", $data);
        }
    }
}
