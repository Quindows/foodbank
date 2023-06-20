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
                            alle.Id as Id,
                            alle.Name as Name
                        from Allergy alle');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllergiesById($id)
    {
        // error catcher
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 
                            alle.Id as Id
                            alle.Name as Name
                        from Allergy alle');

            $this->db->bind(':Id', $id, PDO::PARAM_INT);
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
