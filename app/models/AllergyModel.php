<?php

class ReserveringModel{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllergy($id){
        // error catcher
        try{
            // Database query voor reservation overzicht
            $this->db->query('SELECT 
                            all.Name as Name
                        from Allergy All');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);
            return $this->db->resultSet();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
