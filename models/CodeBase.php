<?php

class CodeBase{




    
    private $db;





    public function __construct()
    {
        $this->db = new Database();
    }





    public function delete($id){
        $sql = 'delete from tbl_code_bases where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':codeBaseId', $id);
        return $this->db->execute();
    }





    public function checkUniqueValues($tableName, $fieldName, $value){
        $sql = "select * from $tableName where $fieldName = :value";
        $this->db->query($sql);
        $this->db->bind(':value', $value);
        return $this->db->single();
    }





    public function getCodeBaseByName($codeBaseName){
        $sql = 'select * from tbl_code_bases where code_base_name = :codeBaseName';
        $this->db->query($sql);
        $this->db->bind(':codeBaseName', $codeBaseName);
        return $this->db->single();
    }





    public function add($post){
        $sql = 'insert into tbl_code_bases (code_base_name, server_address, root_dir, date_created, created_by, status) values (:codeBaseName, :serverAddress, :rootDir, now(), :createdBy, :status)';
        $this->db->query($sql);
        $this->db->bind(':codeBaseName', $post['codeBaseName']);
        $this->db->bind(':serverAddress', $post['serverAddress']);
        $this->db->bind(':rootDir', $post['rootDir']);
        $this->db->bind(':createdBy', $_SESSION['user_id']);
        $this->db->bind(':status', 1);
        return $this->db->execute();
    }





    public function update($post, $codeBaseId){
        $sql = 'update tbl_code_bases set code_base_name = :codeBaseName, server_address = :serverAddress, root_dir = :rootDir where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':codeBaseName', $post['codeBaseName']);
        $this->db->bind(':serverAddress', $post['serverAddress']);
        $this->db->bind(':rootDir', $post['rootDir']);
        $this->db->bind(':codeBaseId', $codeBaseId);
        return $this->db->execute();
    }





    public function getCodeBases(){
        $sql = 'select * from tbl_code_bases order by code_base_name';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getCodeBaseById($codeBaseId){
        $sql = 'select * from tbl_code_bases where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':codeBaseId', $codeBaseId);
        return $this->db->single();
    }





    public function enable($id){
        $sql = 'update tbl_code_bases set status = :status where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':status', 1);
        $this->db->bind(':codeBaseId', $id);
        return $this->db->execute();
    }





    public function disable($id){
        $sql = 'update tbl_code_bases set status = :status where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':status', 2);
        $this->db->bind(':codeBaseId', $id);
        return $this->db->execute();
    }


    

}

?>