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

    public function getCustomerAllergiesById($Id)
    {
        try {
            // Database query voor reservation overzicht
            $this->db->query('SELECT 	CONCAT( per.CallName, " ", per.Infix, " ", per.Lastname) AS PersonName,
                                        per.typeOfPerson,
                                        alg.Allergy,
                                        per.IsRepresentative,
                                        IF (per.IsRepresentative=0, "Gezinslid", "Vertegenwoordiger")
                                FROM person AS per
                                INNER JOIN allergyPerPerson AS app ON per.Id = app.PersonId
                                INNER JOIN allergy AS alg ON alg.Id  = app.AllergyId
                                INNER JOIN family AS fam ON per.FamilyId = fam.Id
                                WHERE fam.Id = :Id;');

            
        $this->db->bind(':id', $Id, PDO::PARAM_STR);
                                
            return $this->db->resultSet();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getCustomerByAllergy($allergy)
    {
        try{
            $this->db->query('SELECT 	alg.Allergy,
                                        fam.Name, 
                                        fam.FamilyDescription,
                                        fam.AmountOfAdults,
                                        fam.AmountOfKids,
                                        fam.AmountOfBabies,
                                        per.Id,
                                        CONCAT( per.CallName, " ", per.Infix, " ", per.Lastname) AS RepresentativeName
                                FROM person AS per
                                INNER JOIN allergyPerPerson AS app ON per.Id = app.PersonId
                                INNER JOIN allergy AS alg ON alg.Id  = app.AllergyId
                                INNER JOIN family AS fam ON per.FamilyId = fam.Id
                                WHERE alg.Allergy = :allergy;');
    
            $this->db->bind(':allergy', $allergy, PDO::PARAM_STR);
    
            return $this->db->resultSet();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

     
    }

    public function getFamilyAllergies($Id)
    {
        try{
            $this->db->query('SELECT 	CONCAT( per.CallName, " ", per.Infix, " ", per.Lastname) AS PersonName,
                                        per.Id,
                                        fam.Name,
                                        fam.FamilyDescription,
                                        fam.TotalAmountOfPeople,
                                        per.typeOfPerson,
                                        alg.Allergy,
                                        IF (per.IsRepresentative = 0, "Gezinslid", "Vertegenwoordiger") AS IsRepresentative
                                FROM person AS per
                                INNER JOIN allergyPerPerson AS app ON per.Id = app.PersonId
                                INNER JOIN allergy AS alg ON alg.Id  = app.AllergyId
                                INNER JOIN family AS fam ON per.FamilyId = fam.Id
                                WHERE fam.Id = :Id;');
    
            $this->db->bind(':Id', $Id, PDO::PARAM_STR);
    
            return $this->db->resultSet();

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
     
    }

    public function getFamilyAllergyById($Id)
    {
        try{
            $this->db->query("  SELECT    alg.Allergy
                                from allergy as alg 
                                INNER JOIN allergyPerPerson AS app ON alg.Id = app.AllergyId
                                INNER JOIN person AS per ON app.PersonId = per.Id
                                INNER JOIN family AS fam ON per.FamilyId = fam.Id
                                WHERE per.Id = :Id;");

                            $this->db->bind(':Id', $Id, PDO::PARAM_INT);

                            $result = $this->db->single();

                            return $result;


        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateFamilyAllergy($post, $id)
    {
        try{
            
            $this->db->query('UPDATE allergy as alg
                                INNER JOIN allergyPerPerson AS app ON alg.Id  = app.AllergyId
                                INNER JOIN person AS per ON  app.PersonId = per.Id
                                SET allergy = :allergy
                                WHERE per.Id = :id;');
                                
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            $this->db->bind(':allergy', $post['allergy'], PDO::PARAM_STR);
            return $this->db->execute();

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
