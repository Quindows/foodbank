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

     //This method will get the information per id from the database
     public function getKlantById($id)
     {
         $this->db->query("SELECT    per.id,
                                     per.firstname,
                                     per.infix, 
                                     per.lastname, 
                                     gam.personId,
                                     gam.id,
                                     sco.totalPoints,
                                     gam.reservationId
                                     from Person as per 
                                     INNER join game as gam on gam.personId = per.id
                                     LEFT join score as sco on gam.id = sco.gameId
                                     WHERE gam.reservationId = :id;");
 
 
         $this->db->bind(':id', $id, PDO::PARAM_INT);
         $result = $this->db->resultSet();
 
         return $result;
     }
}
