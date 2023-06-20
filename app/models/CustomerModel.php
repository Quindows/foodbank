<?php

class CustomerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //This method will get the firstname, infix, lastname and score from the database
    public function getCustomer()
    {
        $this->db->query("SELECT cus.Id,
                                 cus.FamilyName,
                                 cus.Address,
                                 cus.AmountOfAdults, 
                                 cus.AmountOfKids, 
                                 cus.AmountOfBabies,
                                 cus.ExtraWish,
                                 con.Email, 
                                 con.Phonenumber 
                            from customer as cus 
                            left join contact as con on cus.Id = con.CustomerId;");

        $result = $this->db->resultSet();

        // var_dump($result);
        return $result;
    }

    public function getCustomerById($Id)
    {
        $this->db->query("SELECT    cus.Id,
                                    cus.FamilyName,
                                    cus.Address,
                                    cus.AmountOfAdults, 
                                    cus.AmountOfKids, 
                                    cus.AmountOfBabies,
                                    cus.ExtraWish,
                                    con.Email, 
                                    con.Phonenumber 
                        from customer as cus 
                        Inner join contact as con 
                        on cus.Id = con.Id
                        WHERE cus.Id = :Id");

        $this->db->bind(':Id', $Id, PDO::PARAM_INT);

        $result = $this->db->single();

        return $result;
    }

    public function addCustomer($post)
    {
        try{
            // Customer query
            $this->db->query("INSERT INTO customer (FamilyName
                                                    ,Address
                                                    ,AmountOfAdults
                                                    ,AmountOfKids
                                                    ,AmountOfBabies
                                                    ,ExtraWish)
                                    VALUES          (:FamiliName
                                                    ,:Address
                                                    ,:AmountOfAdults
                                                    ,:AmountOfKids
                                                    ,:AmountOfBabies
                                                    ,:ExtraWish);");

            $this->db->bind(':FamiliName', $post['FamilyName'], PDO::PARAM_STR);
            $this->db->bind(':Address', $post['Address'], PDO::PARAM_STR);
            $this->db->bind(':AmountOfAdults', $post['AmountOfAdults'], PDO::PARAM_INT);
            $this->db->bind(':AmountOfKids', $post['AmountOfKids'], PDO::PARAM_INT);
            $this->db->bind(':AmountOfBabies', $post['AmountOfBabies'], PDO::PARAM_INT);
            $this->db->bind(':ExtraWish', $post['ExtraWish'], PDO::PARAM_STR);

            $this->db->execute();

            // Contact query
            $this->db->query("INSERT INTO contact   (
                                                    Email
                                                    ,Phonenumber)
                                    Values          (:Email
                                                    ,:Phonenumber);");

            $this->db->bind(':Email', $post['Email'], PDO::PARAM_STR);
            $this->db->bind(':Phonenumber', $post['Phonenumber'], PDO::PARAM_STR);

            return $this->db->execute();

        }catch(PDOExeption $e){
        }
    }

    public function updateCustomer($post)
    {
        try{
            //Person query
            $this->db->query("UPDATE Customer
                                SET FamilyName = :FamilyName,
                                    Address = :Address,
                                    AmountOfAdults = :AmountOfAdults,
                                    AmountOfKids = :AmountOfKids,
                                    AmountOfBabies = :AmountOfBabies,
                                    ExtraWish = :ExtraWish
                                WHERE Id = :Id");
    
            $this->db->bind(':Id', $post['Id'], PDO::PARAM_INT);
            $this->db->bind(':FamilyName', $post['FamilyName'], PDO::PARAM_STR);
            $this->db->bind(':Address', $post['Address'], PDO::PARAM_STR);
            $this->db->bind(':AmountOfAdults', $post['AmountOfAdults'], PDO::PARAM_INT);
            $this->db->bind(':AmountOfKids', $post['AmountOfKids'], PDO::PARAM_INT);
            $this->db->bind(':AmountOfBabies', $post['AmountOfBabies'], PDO::PARAM_INT);
            $this->db->bind(':ExtraWish', $post['ExtraWish'], PDO::PARAM_STR);

            $this->db->execute();
    
            //Score query
            $this->db->query("UPDATE contact as con
                            Inner join customer as cus on con.CustomerId = cus.Id 
                                SET con.Email = :Email,
                                    con.Phonenumber = :Phonenumber,
    
                                WHERE cus.Id = :Id");
    
            $this->db->bind(':Id', $post['Id'], PDO::PARAM_INT);
            $this->db->bind(':Email', $post['Email'], PDO::PARAM_STR);
            $this->db->bind(':Phonenumber', $post['Phonenumber'], PDO::PARAM_STR);
    
            $this->db->execute();

            return $this->db->execute();

        }catch(PDOExeption $e){
            // echo "<h3 class='text-red'>Het wijzigen is niet gelukt, probeer het opnieuw.</h3>";
            // header("Refresh:2; url=" . URLROOT . "/score/index");
        }
    }

    //This method will delete the information per id from the database
    public function deleteCustomer($Id)
    {
        try{
            $this->db->query("DELETE FROM contact where Id =:Id ");

            $this->db->bind(':Id', $Id, PDO::PARAM_INT);   

            $this->db->execute();

            $this->db->query("DELETE FROM customer where Id =:Id ");
            // $this->db->query("DELETE FROM contact WHERE CustomerId = :Id ");
    
            $this->db->bind(':Id', $Id, PDO::PARAM_INT);    
    
            return $this->db->execute();

        } catch(PDOException $e){
            // echo "<h3 class='text-red'>Het wijzigen is niet gelukt, probeer het opnieuw.</h3>";
            // header("Refresh:2; url=" . URLROOT . "/score/index");
        }
    }
}
?>