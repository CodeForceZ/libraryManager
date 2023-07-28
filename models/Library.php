<?php

class Library{





    public $db;





    public function __construct()
    {
        $this->db = new Database();
    }





    public function delete($id){
        $sql = 'delete from tbl_libraries where library_id = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $id);
        return $this->db->execute();
    }





    public function checkUniqueValues($tableName, $fieldName, $value){
        $sql = "select * from $tableName where $fieldName = :value";
        $this->db->query($sql);
        $this->db->bind(':value', $value);
        return $this->db->single();
    }





    public function add($post, $codeBaseId){
        $sql = 'insert into tbl_libraries (
            library_name, 
            code_base_id, 
            version, 
            delivery_type, 
            script_name, 
            local_path, 
            recommended, 
            maintained, 
            security_risk, 
            license, 
            latest_version, 
            date_created, 
            created_by, 
            status,
            purpose

            ) values (

                :libraryName, 
                :codeBaseId, 
                :version, 
                :deliveryType, 
                :scriptName, 
                :localPath, 
                :recommended, 
                :maintained, 
                :securityRisks, 
                :license, 
                :latestVersion, 
                now(), 
                :createdBy, 
                :status,
                :purpose

            )';
        $this->db->query($sql);
        $this->db->bind(':libraryName', $post['libraryName']);
        $this->db->bind(':codeBaseId', $codeBaseId);
        $this->db->bind(':version', $post['libraryVersion']);
        $this->db->bind(':deliveryType', $post['deliveryType']);
        $this->db->bind(':scriptName', $post['scriptName']);
        $this->db->bind(':localPath', $post['localPath']);
        $this->db->bind(':createdBy', $_SESSION['user_id']);
        $this->db->bind(':status', 1);
        $this->db->bind(':recommended', $post['recommended']);
        $this->db->bind(':maintained', $post['maintained']);
        $this->db->bind(':securityRisks', $post['securityRisks']);
        $this->db->bind(':license', $post['license']);
        $this->db->bind(':latestVersion', $post['latestVersion']);
        $this->db->bind(':purpose', $post['purpose']);
        return $this->db->execute();
    }





    public function update($post, $libraryId){
        // show($post);
        $sql = 'update tbl_libraries set 

                library_name = :libraryName,  
                version = :libraryVersion, 
                delivery_type = :deliveryType, 
                script_name = :scriptName, 
                local_path = :localPath, 
                recommended = :recommended, 
                maintained = :maintained, 
                security_risk = :securityRisks, 
                license = :license, 
                latest_version = :latestVersion,
                purpose = :purpose
                
                where library_id = :libraryId';

        $this->db->query($sql);
        $this->db->bind(':libraryName', $post['libraryName']);
        $this->db->bind(':libraryVersion', $post['libraryVersion']);
        $this->db->bind(':deliveryType', $post['deliveryType']);
        $this->db->bind(':scriptName', $post['scriptName']);
        $this->db->bind(':localPath', $post['localPath']);
        $this->db->bind(':recommended', $post['recommended']);
        $this->db->bind(':maintained', $post['maintained']);
        $this->db->bind(':securityRisks', $post['securityRisks']);
        $this->db->bind(':license', $post['license']);
        $this->db->bind(':latestVersion', $post['latestVersion']);
        $this->db->bind(':purpose', $post['purpose']);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->execute();
    }





    public function getLibraries(){
        $sql = 'select * from tbl_libraries order by library_name';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getLibraryByName($libraryName){
        $sql = 'select * from tbl_libraries where library_name = :libraryName';
        $this->db->query($sql);
        $this->db->bind(':libraryName', $libraryName);
        return $this->db->single();
    }





    public function getLibraryByNameOtherIds($libraryName, $libraryId){
        $sql = 'select * from tbl_libraries where library_name = :libraryName and library_id != :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryName', $libraryName);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->single();
    }





    public function getLibraryById($libraryId){
        $sql = 'select * from tbl_libraries where library_id = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->single();
    }




    
    public function checkLanguageRelationship($libraryId, $languageId){
        $sql = 'select * from tbl_library_language_rel where library_id = :libraryId and language_id = :languageId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        $this->db->bind(':languageId', $languageId);
        return $this->db->single();
    }





    public function updateLibraryLanguageRel($libraryId, $languageId, $action){
        switch($action){
            case 'add':
                $sql = 'insert into tbl_library_language_rel (library_id, language_id) values (:libraryId, :languageId)';
            break;

            case 'remove':
                $sql = 'delete from tbl_library_language_rel where library_id = :libraryId and language_id = :languageId';
            break;
        }

        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        $this->db->bind(':languageId', $languageId);
        return $this->db->execute();
    }





    public function getLibrariesByCodeBase($codeBaseId){
        $sql = 'select * from tbl_libraries where code_base_id = :codeBaseId';
        $this->db->query($sql);
        $this->db->bind(':codeBaseId', $codeBaseId);
        return $this->db->resultSet();
    }





    public function getLibraryDeliveryTypes(){
        $sql = 'select * from tbl_library_delivery_types order by title';
        $this->db->query($sql);
        return $this->db->resultSet();
    }





    public function getDeliveryTypeById($id){
        $sql = 'select * from tbl_library_delivery_types where type_id = :typeId';
        $this->db->query($sql);
        $this->db->bind(':typeId', $id);
        return $this->db->single();
    }





    public function enable($id){
        $sql = 'update tbl_libraries set status = :status where library_id = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':status', 1);
        $this->db->bind(':libraryId', $id);
        return $this->db->execute();
    }





    public function disable($id){
        $sql = 'update tbl_libraries set status = :status where library_id = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':status', 2);
        $this->db->bind(':libraryId', $id);
        return $this->db->execute();
    }





    public function getSiblingLibraries($libraryId, $codeBaseId){
        $sql = 'select * from tbl_libraries where code_base_id = :codeBaseId and library_id != :libraryId';
        $this->db->query($sql);
        $this->db->bind(':codeBaseId', $codeBaseId);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->resultSet();
    }





    public function checkForDependency($libraryId, $isDependentOn){
        $sql = 'select * from tbl_library_dependencies where library_id = :libraryId and is_dependent_on = :isDependentOn';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        $this->db->bind(':isDependentOn', $isDependentOn);
        return $this->db->single();
    }





    public function checkForParency($isDependentOn, $libraryId){
        $sql = 'select * from tbl_library_dependencies where library_id = :libraryId and is_dependent_on = :isDependentOn';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $isDependentOn);
        $this->db->bind(':isDependentOn', $libraryId);
        return $this->db->single();
    }





    public function addDependency($id, $parentId){
        $sql = 'insert into tbl_library_dependencies (library_id, is_dependent_on) values (:id, :parentId)';
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':parentId', $parentId);
        return $this->db->execute();
    }





    public function removeDependency($id, $parentId){
        $sql = 'delete from tbl_library_dependencies where library_id = :id and is_dependent_on = :parentId';
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':parentId', $parentId);
        return $this->db->execute();
    }





    public function deleteDependencies($libraryId){
        $sql = 'delete from tbl_library_dependencies where library_id = :libraryId || is_dependent_on = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->execute();
    }





    public function getCountOfDependencies($libraryId){
        $sql = 'select count(*) as \'total\' from tbl_library_dependencies where library_id = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->single();
    }





    public function getCountOfParencies($libraryId){
        $sql = 'select count(*) as \'total\' from tbl_library_dependencies where is_dependent_on = :libraryId';
        $this->db->query($sql);
        $this->db->bind(':libraryId', $libraryId);
        return $this->db->single();
    }


    
}

?>