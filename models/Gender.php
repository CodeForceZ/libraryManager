<?php

class Gender{





    private $db;





    public function __construct(){

        $this->db = new Database();

    }





    public function add($post){
        $sql = 'insert into tbl_genders (gender_title) values (:genderTitle)';
        $this->db->query($sql);
        $this->db->bind(':genderTitle', $post['genderTitle']);
        return $this->db->execute();
    }





    public function deleteRecord($id){
        $sql = 'delete from tbl_genders where gender_id = :genderId';
        $this->db->query($sql);
        $this->db->bind(':genderId', $id);
        return $this->db->execute();
    }





    public function checkUniqueValues($tableName, $fieldName, $value){
        $sql = "select * from $tableName where $fieldName = :value";
        $this->db->query($sql);
        $this->db->bind(':value', $value);
        return $this->db->single();
    }





    public function getGenderById($genderId){
        $sql = 'select * from tbl_genders where gender_id = :genderId';
        $this->db->query($sql);
        $this->db->bind(':genderId', $genderId);
        return $this->db->single();
    }




    
    public function getGenders(){
        $sql = 'select * from tbl_genders';
        $this->db->query($sql);
        return $this->db->resultSet();
    }

}

?>