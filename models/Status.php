<?php

class Status{





    private $db;





    public function __construct()
    {   
        $this->db = new Database();
    }





    public function deleteRecord($id){
        $sql = 'delete from tbl_status_flags where flag_id = :flagId';
        $this->db->query($sql);
        $this->db->bind(':flagId', $id);
        return $this->db->execute();
    }





    public function add($post){
        $sql = 'insert into tbl_status_flags (title) values (:title)';
        $this->db->query($sql);
        $this->db->bind(':title', $post['statusTitle']);
        return $this->db->execute();
    }





    public function checkUniqueValues($tableName, $fieldName, $value){
        $sql = "select * from $tableName where $fieldName = :value";
        $this->db->query($sql);
        $this->db->bind(':value', $value);
        return $this->db->single();
    }



    

    public function getStatusById($statusId){
        $sql = 'select * from tbl_status_flags where flag_id = :flagId';
        $this->db->query($sql);
        $this->db->bind(':flagId', $statusId);
        return $this->db->single();
    }

}

?>