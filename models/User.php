<?php

class User{
 




    private $db;





    public function __construct()
    {   
        $this->db = new Database();
    }





    public function deleteRecord($id){
        $sql = 'delete from tbl_users where user_id = :userId';
        $this->db->query($sql);
        $this->db->bind(':userId', $id);
        return $this->db->execute();
    }





    public function checkUniqueValues($tableName, $fieldName, $value){
        $sql = "select * from $tableName where $fieldName = :value";
        $this->db->query($sql);
        $this->db->bind(':value', $value);
        return $this->db->single();
    }





    public function getUserByEmail($email){
        $sql = 'select * from tbl_users where email = :email';
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        return $this->db->single();
    }





    public function getUserById($userId){
        $sql = 'select * from tbl_users where user_id = :userId';
        $this->db->query($sql);
        $this->db->bind(':userId', $userId);
        return $this->db->single();
    }





    public function updateProfile($post){
        $sql = 'update tbl_users set 
                first_name = :firstName,
                last_name = :lastName,
                gender = :gender,
                email = :email
                where user_id = :userId
                ';
        $this->db->query($sql);
        $this->db->bind(':firstName', $post['firstName']);
        $this->db->bind(':lastName', $post['lastName']);
        $this->db->bind(':gender', $post['gender']);
        $this->db->bind(':email', $post['email']);
        $this->db->bind(':userId', $_SESSION['user_id']);
        return $this->db->execute();
    }





    public function checkEmailExists($email){
        $sql = 'select count(*) as total from tbl_users where email = :email and status = :status';
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        $this->db->bind(':status', 1);
        $result = $this->db->single();
        if($result->total > 0){
            return true;
        }else{
            return false;
        }
    }





    public function checkEmailExistsOtherUsers($email, $userId){
        $sql = 'select count(*) as total from tbl_users where email = :email and user_id != :userId and status = :status';
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        $this->db->bind(':userId', $userId);
        $this->db->bind(':status', 1);
        $result = $this->db->single();
        if($result->total > 0){
            return true;
        }else{
            return false;
        }
    }





    public function getUserType($userTypeId){
        $sql = 'select * from tbl_user_types where user_type_id = :userTypeId';
        $this->db->query($sql);
        $this->db->bind(':userTypeId', $userTypeId);
        return $this->db->single();
    }





    public function getUsers(){
        $sql = 'select * from tbl_users';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getUserTypes(){
        $sql = 'select * from tbl_user_types';
        $this->db->query($sql);
        return $this->db->resultSet();
    }




    
    public function add($post){
        // show($post);
        $sql = 'insert into tbl_users (first_name, last_name, gender, email, password, status, date_created, user_type) values (:firstName, :lastName, :gender, :email, :password, :status, now(), :userType)';
        $this->db->query($sql);
        $this->db->bind(':firstName', $post['firstName']);
        $this->db->bind(':lastName', $post['lastName']);
        $this->db->bind(':gender', $post['gender']);
        $this->db->bind(':email', $post['email']);
        $this->db->bind(':password', $post['password']);
        $this->db->bind(':status', 1);
        $this->db->bind(':userType', $post['userType']);
        return $this->db->execute();
    }



}

?>