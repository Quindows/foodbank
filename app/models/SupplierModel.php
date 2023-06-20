<?php

class SupplierModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSuppliersByIdDate($id, $datum)
    {
        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 
                            per.Voornaam as voornaam,
                            per.Tussenvoegsel as tussenvoegsel,
                            per.Achternaam as achternaam,
                            res.Datum as datum,
                            res.AantalUren as aantalUren,
                            res.BeginTijd as beginTijd,
                            res.EindTijd as eindTijd,
                            res.AantalVolwassen as volwassenen,
                            res.AantalKinderen as kinderen
                        from reservering res
                        inner join persoon per
                        on per.Id = res.PersoonId
                        where res.PersoonId = :Id
                        and res.Datum >= :Datum;');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);
            $this->db->bind(':Datum', $datum, PDO::PARAM_STR);
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSuppliers()
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                sup.Id as id,
                                sup.CompanyName as companyname,
                                sup.Address as address,
                                sup.Name as contactperson,
                                sup.Email as email,
                                sup.Phonenumber as phonenumber,  
                                del.TimeOfDeparture as nextdelivery
                            from supplier sup
                            left join deliverysupplier dsu
                            on sup.Id = dsu.SupplierId
                            left join delivery del
                            on del.Id = dsu.DeliveryId');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSupplierById($id)
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                res.Id as id,
                                per.Voornaam as voornaam,
                                per.Tussenvoegsel as tussenvoegsel,
                                per.Achternaam as achternaam,
                                res.Datum as datum,
                                res.AantalVolwassen as volwassenen,
                                res.AantalKinderen as kinderen,
                                pak.Naam as pakket
                            from supplier sup
                            inner join deliverysupplier dsu
                            on sup.Id = dsu.SupplierId
                            inner join delivery del
                            on del.Id = dsu.DeliveryId
                            where res.PersoonId = :Id;');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);
            return $this->db->resultSet();
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

    public function updateSupplier($data, $id)
    {
        $this->db->query('UPDATE reservering
                        set PakketOptieId = :optie
                        where Id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind(':optie', $data['optiepakket'], PDO::PARAM_INT);
        return $this->db->execute();
    }
}
