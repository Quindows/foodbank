<?php

class LeverancierModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeveranciers()
    {
        // error handler
        try
        {
            $this->db->query('SELECT 	lev.Id              as Id,
                                        lev.Naam 			as Naam,
                                        lev.ContactPersoon 	as ContactPersoon,
                                        con.Email			as Email,
                                        con.Mobiel			as Mobiel,
                                        lev.LeveranciersNummer,
                                        lev.LeveranciersType
                                from `ContactPerLeverancier` cpl
                                inner join `leverancier` lev
                                    on lev.Id = cpl.LeverancierId
                                Inner join `contact` con
                                    on con.Id = cpl.ContactId;');
            return $this->db->resultSet();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLeveranciersByType($result)
    {
        // error handler
        try
        {
            $this->db->query('SELECT 	lev.Id              as Id,
                                        lev.Naam 			as Naam,
                                        lev.ContactPersoon 	as ContactPersoon,
                                        con.Email			as Email,
                                        con.Mobiel			as Mobiel,
                                        lev.LeveranciersNummer,
                                        lev.LeveranciersType
                                from `ContactPerLeverancier` cpl
                                inner join `leverancier` lev
                                    on lev.Id = cpl.LeverancierId
                                Inner join `contact` con
                                    on con.Id = cpl.ContactId
                                where lev.LeveranciersType = :result;');
            $this->db->bind(':result', $result, PDO::PARAM_STR);
            return $this->db->resultSet();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getProductByLeverancier($id)
    {
        // error handler
        try
        {
            $this->db->query('SELECT 	pro.Id,
                                        pro.Naam,
                                        pro.SoortAllergie,
                                        pro.Barcode,
                                        pro.HoudbaarheidsDatum
                                from `ProductperLeverancier` ppl
                                inner join `leverancier` lev
                                    on lev.Id = ppl.LeverancierId
                                Inner join `product` pro
                                    on pro.Id = ppl.ProductId
                                where lev.Id = :id;');
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            return $this->db->resultSet();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLeverancierById($id)
    {
        // error handler
        try
        {
            $this->db->query('SELECT	Naam,
                                        LeveranciersNummer,
                                        LeveranciersType
                                from leverancier
                                Where Id = :id;');
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            return $this->db->single();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getHoudbaarheidsDatum($id){
        $this->db->query('SELECT Id, Houdbaarheidsdatum
                        from product 
                        where Id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateProduct($post, $id)
    {    
        try
        {
            $this->db->query('UPDATE `product`		
                                SET Houdbaarheidsdatum = :datum 
                                WHERE Id = :id');
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            $this->db->bind(':datum', $post['datum'], PDO::PARAM_STR);
            return $this->db->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
