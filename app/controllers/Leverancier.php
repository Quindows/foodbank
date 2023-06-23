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

        $rows = '';
       
        // checkt of er leveranciers zijn
        if($records == null)
        {
            $rows = '<tr class="error">
                        <p>Er zijn geen leveranciers bekent van het geselecteerde leverancierstype</p>
                    </tr>';
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
                    <td>
                        <a href='../leverancier/productOverzicht/$value->Id'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                            </svg>   
                        </a>
                    </td>
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

    public function productOverzicht($id = null)
    {
        $records = $this->model->getProductByLeverancier($id);
        $leverancierData = $this->model->getLeverancierById($id);

        $rows = '';

        if($records == null)
        {
            $rows .= '<tr class="error">
                        <p>Er zijn geen producten bekent van het geselecteerde leverancierstype</p>
                    </tr>';
        } else {
            foreach($records as $value)
            {
                $rows .= "
                <tr>
                    <td>$value->Naam</td>
                    <td>$value->SoortAllergie</td>
                    <td>$value->Barcode</td>
                    <td>$value->HoudbaarheidsDatum</td>
                    <td>
                        <a href='/leverancier/productWijzigen/$value->Id'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                            </svg>   
                        </a>
                    </td>
                </tr>";
            }
        }

        // array voor alle data om mee te sturen naar de view
        $data = [
            'rows' => $rows,
            'leverancierData' => $leverancierData
        ];
        
        // redirect naar de view
        $this->view('leverancier/productOverzicht', $data);
    }

    public function productWijzigen($id = null)
    {
        $data = [
            'notification' => '',
            'id' => $id
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                // filtert voor sql injecties
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

                // VALIDATIE VAN DE INPUT
                $data = $this->validatieProductWijzigen($data, $_POST, $id);

                if (strlen($data["notification"]) < 1) {
                    // VOERT DE UPDATE UIT
                    $result = $this->model->updateProduct($_POST, $id);

                    // CHECKT OF HET IS GELUKT
                    if ($result) {
						$data['notification'] = "<p class='text-green bg-green-light-8 p-2 col-12-lg'>Product aangepast!</p>";
						header("Refresh: 3; url=" . URLROOT . "leverancier/index");
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
        $this->view('leverancier/productWijzigen', $data);
    }

           // VALIDATIE METHOD VOOR UPDATE
           public function validatieProductWijzigen($data, $post, $id){
            // checkt in het database of er kinderen aanwezig zijn
            $result = $this->model->getHoudbaarheidsDatum($id);
            $date=date_create($result->Houdbaarheidsdatum);
            date_add($date,date_interval_create_from_date_string("7 days"));
            $date2 = date_format($date,"Y-m-d");

            if ($post['datum'] > $date2)
                $data['notification'] = "<p class='text-red col-12-lg'>De houdbaarheidsdatum mag met maximaal 7 dagen worden verlengd</p>";
            return($data);
        }
}