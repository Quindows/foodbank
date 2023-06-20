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

    // public function getAllergiesById($id)
    // {
    //     // error catcher
    //     try {
    //         // Database query voor reservation overzicht
    //         $this->db->query('SELECT 
    //                         alle.Id as Id
    //                         alle.Name as Name
    //                     from Allergy alle');

    //         $this->db->bind(':Id', $id, PDO::PARAM_INT);
    //         return $this->db->resultSet();
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    public function addAllergy($post)
    {
        // error catcher
        try {
            // addScore for Allergies
            $this->db->query("INSERT INTO Allergy (name
                                                ,isActive
                                                ,dateCreated)
                                        VALUES (:name
                                                ,:isActive
                                                ,:dateCreated);");

            $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
            $this->db->bind(':isActive', 1, PDO::PARAM_INT);
            $this->db->bind(':dateCreated', date('Y-m-d H:i:s'), PDO::PARAM_STR);

            return $this->db->execute();
        } catch (PDOExeption $e) {
            echo "<h3 class='text-red'>Het toevoegen is niet gelukt, probeer het opnieuw.</h3>";
            header("Refresh:2; url=" . URLROOT . "/allergy/index");
        }
    }
}
