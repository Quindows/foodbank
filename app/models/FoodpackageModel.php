<?php

class FoodpackageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getFoodpackages()
    {
        // error catcher
        try{
            $this->db->query('SELECT 
                    caf.Id              as id,
                    cus.FamilyName 		as familyName,
                    foo.Id				as packageId,
                    pro.ProductName		as product,
                    alr.Name			as allergy,
                    cus.ExtraWish		as extra
                    
                    
            from customerAllergyFoodpackage caf
            
            -- customer and allergy
            inner join customer cus
                on cus.Id = caf.CustomerId
            inner join allergy alr
                on alr.Id = caf.AllergyId
            -- Product info 
            inner join foodPackageProduct fpp
                on fpp.Id = caf.FoodPackageProductId 
            inner join product pro
                on pro.Id = fpp.ProductId
            inner join foodPackage foo
                on foo.Id = fpp.FoodPackageId
            ;');
            return $this->db->resultSet();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        
        }
    }

    public function deleteFoodpackage($id)
    {
        // error handler
        try
        {
            // Database query
            $this->db->query('DELETE FROM customerAllergyFoodpackage
                            WHERE Id = :id');
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            return $this->db->execute();
        } 
        catch(PDOException $e) 
        {
            echo "Error: " . $e->getMessage();
        }
    }
}