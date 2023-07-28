<?php

class General{





    private $db;





    public function __construct()
    {
        $this->db = new Database();
    }





    public function getYesNoOptions(){
        $sql = 'select * from tbl_yes_no';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getLicenseOptions(){
        $sql = 'select * from tbl_license_types';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getYesNoById($id){
        $sql = 'select * from tbl_yes_no where option_id = :id';
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        return $this->db->single();
    }



    

    public function getLicenseById($id){
        $sql = 'select * from tbl_license_types where license_type_id = :id';
        $this->db->query($sql);
        $this->db->bind(':id',$id);
        return $this->db->single();
    }

}

?>