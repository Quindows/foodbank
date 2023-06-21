<?php

class VoedselPakketModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getVoedselPakkettenByEetwens($eetwens)
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gez.Id as id,
                                gez.Naam as naam,
                                gez.Omschrijving as omschrijving,
                                gez.AantalVolwassenen as volwassenen,
                                gez.AantalKinderen as kinderen,
                                gez.AantalBabys as babys,
                                per.Voornaam as voornaam,
                                per.Tussenvoegsel as tussenvoegsel,
                                per.Achternaam as achternaam,
                                etw.naam as eetwens
                                
                            from gezin gez
                            inner join persoon per
                            on gez.Id = per.GezinId
                            inner join eetwenspergezin epg
                            on gez.Id = epg.GezinId
                            inner join eetwens etw
                            on etw.Id = epg.EetwensId
                            where (per.IsVertegenwoordiger = 1) and (etw.Naam = :Eetwens)
                            ');
            $this->db->bind(':Eetwens', $eetwens, PDO::PARAM_STR);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getVoedselPakkettenById($id)
    {

        // error catcher
        try {
            $this->db->query('SELECT DISTINCT
                                gez.Id as id,
                                gez.Naam as naam,
                                gez.Omschrijving as omschrijving,
                                gez.TotaalAantalPersonen as totaalaantalpersonen,
                                vdp.PakketNummer as pakketnummer,
                                vdp.DatumSamenstelling as datumsamengesteld,
                                vdp.DatumUitgifte as datumuitgifte,
                                vdp.Status as status    

                            from gezin gez
                            inner join voedselpakket vdp
                            on gez.Id = vdp.GezinId
                            inner join productpervoedselpakket pvp
                            on vdp.Id = pvp.VoedselpakketId
                            where (gez.Id = :Id)
                            ');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getVoedselPakketten()
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gez.Id as id,
                                gez.Naam as naam,
                                gez.Omschrijving as omschrijving,
                                gez.AantalVolwassenen as volwassenen,
                                gez.AantalKinderen as kinderen,
                                gez.AantalBabys as babys,
                                per.Voornaam as voornaam,
                                per.Tussenvoegsel as tussenvoegsel,
                                per.Achternaam as achternaam
                                
                            from gezin gez
                            inner join persoon per
                            on gez.Id = per.GezinId
                            where per.IsVertegenwoordiger = 1
                            ');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateStatus($data)
    {
        // $this->db->query("UPDATE Supplier
        //                 set     companyname = :companyname,
        //                         address = :address,
        //                         name = :name,
        //                         email = :email,
        //                         phonenumber = :phonenumber,
        //                         dateUpdated = :dateUpdated

        //                 where Id = :id;");
        // $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        // $this->db->bind(':companyname', $data['companyName'], PDO::PARAM_STR);
        // $this->db->bind(':address', $data['address'], PDO::PARAM_STR);
        // $this->db->bind(':name', $data['contactName'], PDO::PARAM_STR);
        // $this->db->bind(':email', $data['email'], PDO::PARAM_STR);
        // $this->db->bind(':phonenumber', $data['phoneNumber'], PDO::PARAM_STR);
        // $this->db->bind(':dateUpdated', date('Y-m-d H:i:s'), PDO::PARAM_STR);


        // return $this->db->execute();
    }
}
