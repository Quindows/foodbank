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
            $this->db->query('SELECT 
                        cus.FamilyName as FamilyName,
                        cus.ExtraWish as ExtraWish,
                        cus.Id,
                        ale.Id,
                        ale.Name as AllergyName,
                        caf.CustomerId,
                        caf.AllergyId
                        from customerallergyfoodpackage as caf
                        Inner join customer as cus on caf.CustomerId = cus.id
                        Inner join Allergy as ale on caf.AllergyId = ale.id');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
