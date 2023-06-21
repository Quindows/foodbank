<?php

class LeverancierModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeveranciers(){
        // error handler
        try
        {
            $this->db->query('SELECT 	lev.Naam 			as Naam,
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

    public function getLeveranciersByType($result){
        // error handler
        try
        {
            $this->db->query('SELECT 	lev.Naam 			as Naam,
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
}
