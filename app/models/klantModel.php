<?php

class KlantModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //This method gets all the information for the Customers who are representatives
    public function getKlanten()
    {
        try {
            $this->db->query("SELECT 	Gez.Naam as GezinNaam,
		                                Gez.Id, 
                                CONCAT (Per.Voornaam, ' ', Per.Tussenvoegsel, ' ', Per.Achternaam) as Naam,
                                        Per.IsVertegenwoordiger, 
                                        Per.GezinId, 
                                        Con.Email as Email,
                                        Con.Mobiel as Mobiel,
                                CONCAT (Con.Straat, ' ', Con.Huisnummer, ' ', Con.Toevoeging, ' ', Con.Postcode) as Adres,
                                        Con.Woonplaats as Woonplaats,
                                        Con.Id,
                                        Cpg.Id as CpgId,
                                        Cpg.GezinId,
                                        Cpg.ContactId
                                        FROM ContactPerGezin as Cpg
                                        INNER JOIN Gezin as Gez on cpg.GezinId = Gez.Id
                                        INNER JOIN Contact as Con on cpg.ContactId = Con.Id
                                        INNER JOIN Persoon as Per on Per.GezinId = Gez.Id
                                        WHERE Per.IsVertegenwoordiger = 1;");

            $result = $this->db->resultSet();

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getKlantenByPostcode($result)
    {
        try {
            $this->db->query("SELECT 	Gez.Naam as GezinNaam,
		                                Gez.Id, 
                                CONCAT (Per.Voornaam, ' ', Per.Tussenvoegsel, ' ', Per.Achternaam) as Naam,
                                        Per.IsVertegenwoordiger, 
                                        Per.GezinId, 
                                        Con.Email as Email,
                                        Con.Mobiel as Mobiel,
                                CONCAT (Con.Straat, ' ', Con.Huisnummer, ' ', Con.Toevoeging, ' ', Con.Postcode) as Adres,
                                        Con.Woonplaats as Woonplaats,
                                        Con.Id,
                                        Cpg.Id as CpgId,
                                        Cpg.GezinId,
                                        Cpg.ContactId
                                        FROM ContactPerGezin as Cpg
                                        INNER JOIN Gezin as Gez on cpg.GezinId = Gez.Id
                                        INNER JOIN Contact as Con on cpg.ContactId = Con.Id
                                        INNER JOIN Persoon as Per on Per.GezinId = Gez.Id
                                        WHERE Per.IsVertegenwoordiger = 1
                                        AND Con.Postcode = :result;");

            $this->db->bind(':result', $result, PDO::PARAM_STR);
            $result = $this->db->resultSet();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
