<?php

class VoedselPakketModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getVoedselPakkettenByEetwens($eetwens)
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gez.Id as id,
                                gez.Naam as naam,
                                gez.Omschrijving as omschrijving,
                                gez.AantalVolwassenen as volwassenen,
                                gez.AantalKinderen as kinderen,
                                gez.AantalBabys as babys,
                                per.Voornaam as voornaam,
                                per.Tussenvoegsel as tussenvoegsel,
                                per.Achternaam as achternaam,
                                etw.naam as eetwens
                                
                            from gezin gez
                            inner join persoon per
                            on gez.Id = per.GezinId
                            inner join eetwenspergezin epg
                            on gez.Id = epg.GezinId
                            inner join eetwens etw
                            on etw.Id = epg.EetwensId
                            where (per.IsVertegenwoordiger = 1) and (etw.Naam = :Eetwens)
                            ');
            $this->db->bind(':Eetwens', $eetwens, PDO::PARAM_STR);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getVoedselPakketten()
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gez.Id as id,
                                gez.Naam as naam,
                                gez.Omschrijving as omschrijving,
                                gez.AantalVolwassenen as volwassenen,
                                gez.AantalKinderen as kinderen,
                                gez.AantalBabys as babys,
                                per.Voornaam as voornaam,
                                per.Tussenvoegsel as tussenvoegsel,
                                per.Achternaam as achternaam
                                
                            from gezin gez
                            inner join persoon per
                            on gez.Id = per.GezinId
                            where per.IsVertegenwoordiger = 1
                            ');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSupplierById($id)
    {
        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 
                            Id,
                            CompanyName,
                            Address,
                            Name,
                            Email,
                            Phonenumber 
                        from Supplier
                        WHERE Id = :Id');

            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->single();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    // Creates a new Supplier
    public function createSupplier($post)
    {
        $this->db->query("INSERT INTO `Supplier` (companyname 
                                             ,address
                                             ,name
                                             ,email
                                             ,phonenumber
                                             ,isActive 
                                             ,dateCreated)
                         VALUES              (:companyname 
                                             ,:address
                                             ,:name
                                             ,:email
                                             ,:phonenumber
                                             ,1
                                             ,:dateCreated)
                           ;");

        // Binds the filled in information with the database fields
        $this->db->bind(':companyname', $post["companyName"], PDO::PARAM_STR);
        $this->db->bind(':address', $post["address"], PDO::PARAM_STR);
        $this->db->bind(':name', $post["contactName"], PDO::PARAM_STR);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':phonenumber', $post["phoneNumber"], PDO::PARAM_STR);
        $this->db->bind(':dateCreated', date('Y-m-d H:i:s'), PDO::PARAM_STR);


        // Executes the query
        return $this->db->execute();
    }

    public function updateSupplier($data)
    {
        $this->db->query("UPDATE Supplier
                        set     companyname = :companyname,
                                address = :address,
                                name = :name,
                                email = :email,
                                phonenumber = :phonenumber,
                                dateUpdated = :dateUpdated

                        where Id = :id;");
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind(':companyname', $data['companyName'], PDO::PARAM_STR);
        $this->db->bind(':address', $data['address'], PDO::PARAM_STR);
        $this->db->bind(':name', $data['contactName'], PDO::PARAM_STR);
        $this->db->bind(':email', $data['email'], PDO::PARAM_STR);
        $this->db->bind(':phonenumber', $data['phoneNumber'], PDO::PARAM_STR);
        $this->db->bind(':dateUpdated', date('Y-m-d H:i:s'), PDO::PARAM_STR);


        return $this->db->execute();
    }

    public function deleteSupplier($id)
    {
        try {
            $this->db->query('DELETE FROM `supplier` WHERE `id` = :id');
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            echo "<h3 class='text-red'>Het verwijderen is niet gelukt, probeer het opnieuw.</h3>";
            header("Refresh:2; url=" . URLROOT . "/supplier/index");
        }
    }
}
