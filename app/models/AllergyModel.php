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
                            Id,
                            Name
                        from Allergy
                        WHERE Id = :Id');

            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->single();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

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

    // This method will update the information that is selected by ID
    public function updateAllergy($post)
    {
        try {
            //Person query
            $this->db->query("UPDATE Allergy
            SET Name = :Name,
                dateUpdated = :dateUpdated
            WHERE Id = :Id");

            $this->db->bind(':Id', $post['id'], PDO::PARAM_INT);
            $this->db->bind(':Name', $post['name'], PDO::PARAM_STR);
            $this->db->bind(':dateUpdated', date('Y-m-d H:i:s'), PDO::PARAM_STR);


            return $this->db->execute();
        } catch (PDOExeption $e) {
            echo "<h3 class='text-red'>Het wijzigen is niet gelukt, probeer het opnieuw.</h3>";
            header("Refresh:2; url=" . URLROOT . "/allergy/index");
        }
    }

    //This method will delete the information from the database
    public function deleteAllergy($id)
    {
        try {
            $this->db->query("DELETE FROM Allergy WHERE id =:id ");
            $this->db->bind(':id', $id, PDO::PARAM_INT);

            return $this->db->execute();
        } catch (PDOException $e) {
            echo "<h3 class='text-red'>Het verwijderen is niet gelukt, probeer het opnieuw.</h3>";
            header("Refresh:2; url=" . URLROOT . "/allergy/index");
        }
    }
}
