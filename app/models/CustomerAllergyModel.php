<?php

class CustomerAllergyModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCustomerAllergies()
    {
        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 	fam.Id,
                                        fam.Name, 
                                        fam.FamilyDescription,
                                        fam.AmountOfAdults,
                                        fam.AmountOfKids,
                                        fam.AmountOfBabies,
                                        CONCAT( per.CallName, " ", per.Infix, " ", per.Lastname) AS RepresentativeName
                                FROM family AS fam
                                INNER JOIN person AS per ON fam.Id = per.FamilyId
                                WHERE per.IsRepresentative = 1;');
                                
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
