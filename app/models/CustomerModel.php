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
                            Inner join contact as con on cus.Id = con.CustomerId;");

        $result = $this->db->resultSet();

        // var_dump($result);
        return $result;
    }
}
?>