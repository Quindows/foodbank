<?php

class AllergyModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllergies()
    {
        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 
                            alle.Name as Name
                        from Allergy alle');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
