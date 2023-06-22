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
    public function getKlantenById($klantId)
    {

        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query("SELECT 	
                                Gez.Id as GezId, 
                                Per.Id as PerId,
                                Per.Voornaam, 
                                Per.Tussenvoegsel,
                                Per.Achternaam,
                                Per.Geboortedatum,
                                Per.TypePersoon,
                                Per.GezinId,
                                Per.IsVertegenwoordiger,
                                Con.Straat,
                                Con.Huisnummer,
                                Con.Toevoeging,
                                Con.Postcode,
                                Con.Woonplaats,
                                Con.Email,
                                Con.Mobiel,
                                Con.Id as ConId,
                                Cpg.Id as CpgId,
                                Cpg.GezinId as CpgGezId,
                                Cpg.ContactId as CpgConId
                                FROM ContactPerGezin as Cpg
                                INNER JOIN Gezin as Gez on cpg.GezinId = Gez.Id
                                INNER JOIN Contact as Con on cpg.ContactId = Con.Id
                                INNER JOIN Persoon as Per on Per.GezinId = Gez.Id
                                WHERE Cpg.Id = :klantId
                                AND Per.IsVertegenwoordiger = 1;");

            $this->db->bind(':klantId', $klantId, PDO::PARAM_INT);

            return $this->db->single();
        } catch (PDOException $e) {
            // echo "<h3 class='text-red'>Het wijzigen is niet gelukt, probeer het opnieuw.</h3>";
            // header("Refresh:2; url=" . URLROOT . "/klant/index");
        }
    }

    //This method will update the information per id from the database
    public function updateKlant($post)
    {
        try {
            //Contact query
            $this->db->query("UPDATE Contact Con
            INNER JOIN ContactPerGezin Cpg on Cpg.ContactId = Con.Id
            SET Con.Straat = :straat,
                Con.Huisnummer = :huisnummer,
                Con.Toevoeging = :toevoeging,
                Con.Postcode = :postcode,
                Con.Woonplaats = :woonplaats,
                Con.Email = :email,
                Con.Mobiel = :mobiel,
                Con.dateUpdated = :dateUpdated
            WHERE Con.Id = :conId");

            $this->db->bind(':conId', $post['conId'], PDO::PARAM_INT);
            $this->db->bind(':straat', $post['straat'], PDO::PARAM_STR);
            $this->db->bind(':huisnummer', $post['huisnummer'], PDO::PARAM_INT);
            $this->db->bind(':toevoeging', $post['toevoeging'], PDO::PARAM_STR);
            $this->db->bind(':postcode', $post['postcode'], PDO::PARAM_STR);
            $this->db->bind(':woonplaats', $post['woonplaats'], PDO::PARAM_STR);
            $this->db->bind(':email', $post['email'], PDO::PARAM_STR);
            $this->db->bind(':mobiel', $post['mobiel'], PDO::PARAM_STR);
            $this->db->bind(':dateUpdated', date('Y-m-d H:i:s'), PDO::PARAM_STR);

            $this->db->execute();

            //Persoon query
            $this->db->query("UPDATE Persoon Per
            INNER JOIN Gezin Gez on Gez.Id = Per.Id
            INNER JOIN ContactPerGezin Cpg on Cpg.GezinId = Gez.Id 
            SET Per.Voornaam = :voornaam,
                Per.Tussenvoegsel = :tussenvoegsel,
                Per.Achternaam = :achternaam,
                Per.Geboortedatum = :geboortedatum,
                Per.TypePersoon = :typepersoon,
                Per.IsVertegenwoordiger = :isvertegenwoordiger,
                Per.dateUpdated = :dateUpdated
            WHERE Per.Id = :perId");

            $this->db->bind(':perId', $post['perId'], PDO::PARAM_INT);
            $this->db->bind(':voornaam', $post['voornaam'], PDO::PARAM_STR);
            $this->db->bind(':tussenvoegsel', $post['tussenvoegsel'], PDO::PARAM_STR);
            $this->db->bind(':achternaam', $post['achternaam'], PDO::PARAM_STR);
            $this->db->bind(':geboortedatum', $post['geboortedatum'], PDO::PARAM_STR);
            $this->db->bind(':typepersoon', $post['typepersoon'], PDO::PARAM_STR);
            $this->db->bind(':isvertegenwoordiger', $post['isvertegenwoordiger'], PDO::PARAM_INT);
            $this->db->bind(':dateUpdated', date('Y-m-d H:i:s'), PDO::PARAM_STR);


            return $this->db->execute();
        } catch (PDOException $e) {
            echo "<h3 class='text-red'>Het wijzigen is niet gelukt, probeer het opnieuw.</h3>";
            header("Refresh:2; url=" . URLROOT . "/klant/index");
        }
    }
}
