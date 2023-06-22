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
                                vdp.Status as status,
                                vdp.Id as pakketid  

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

    public function getVoedselPakketById($id)
    {

        // error catcher
        try {
            $this->db->query('SELECT 
                            Status as status,
                            Id as id,
                            GezinId as gezinid,
                            isActief as isactief
                            from voedselpakket
                            where (Id = :Id)
                            ');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->single();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateStatus($data)
    {
        $datum = '';
        if ($data['status'] == "Uitgereikt") {
            $datum = date('Y-m-d');
        } else {
            $datum = null;
        }

        $this->db->query("UPDATE voedselpakket
                        set     Status = :status,
                                DatumUitgifte = :datumuitgifte,
                                DatumGewijzigd = :datumgewijzigd
                        where Id = :id;");
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind(':status', $data['status'], PDO::PARAM_STR);
        $this->db->bind(':datumuitgifte', $datum, PDO::PARAM_STR);
        $this->db->bind(':datumgewijzigd', date('Y-m-d H:i:s'), PDO::PARAM_STR);


        return $this->db->execute();
    }
}
