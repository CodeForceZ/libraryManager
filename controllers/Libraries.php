<?php

class Libraries{





    public $baseModel;
    public $illegalCharsErrorText;
    public $formValidator;
    public $insertErrorMessage;





    public function __construct()
    {
        global $illegalCharsErrorText;
        global $insertErrorMessage;

        $this->baseModel = new Library();
        $this->illegalCharsErrorText = $illegalCharsErrorText;
        $this->insertErrorMessage = $insertErrorMessage;
        $this->formValidator = new FormValidator();

    }





    public function delete($id){
        return $this->baseModel->delete($id);
    }





    public function add($codeBaseId){
        
        $returnFieldData = [];
        $errors = false;
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $returnFieldData['libraryName'] = $this->formValidator->validate($post['libraryName'], 'required|invalidChars|unique:tbl_libraries->library_name ->library name->'.$codeBaseId.'->code_base_id->new');
        $returnFieldData['libraryVersion'] = $this->formValidator->validate($post['libraryVersion'], 'required|invalidChars');
        $returnFieldData['deliveryType'] = $this->formValidator->validate($post['deliveryType'], 'required');
        $returnFieldData['scriptName'] = $this->formValidator->validate($post['scriptName'], 'invalidChars');
        $returnFieldData['localPath'] = $this->formValidator->validate($post['localPath'], 'invalidChars');
        $returnFieldData['recommended'] = $this->formValidator->validate($post['recommended'], 'required');
        $returnFieldData['maintained'] = $this->formValidator->validate($post['maintained'], 'required');
        $returnFieldData['securityRisks'] = $this->formValidator->validate($post['securityRisks'], 'required');
        $returnFieldData['license'] = $this->formValidator->validate($post['license'], 'required');
        $returnFieldData['latestVersion'] = $this->formValidator->validate($post['latestVersion'], 'required');
        $returnFieldData['purpose'] = $this->formValidator->validate($post['purpose'], 'required|invalidChars');
        
        foreach($returnFieldData as $field => $value){
            if(count($value) > 0){
                $errors = true;
            }
        }
        
        if($errors == true){
            return $returnFieldData;    
        }else{
            if($this->baseModel->add($post, $codeBaseId)){
                redirect('codeBase.php?id='.$codeBaseId);
            }
        }
        
    }





    public function update($libraryId, $origin){
        
        $returnFieldData = [];
        $errors = false;
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        
        $returnFieldData['libraryName'] = $this->formValidator->validate($post['libraryName'], 'required|invalidChars');
        $returnFieldData['deliveryType'] = $this->formValidator->validate($post['deliveryType'], 'required');
        $returnFieldData['scriptName'] = $this->formValidator->validate($post['scriptName'], 'invalidChars');
        $returnFieldData['localPath'] = $this->formValidator->validate($post['localPath'], 'invalidChars');
        $returnFieldData['recommended'] = $this->formValidator->validate($post['recommended'], 'required');
        $returnFieldData['maintained'] = $this->formValidator->validate($post['maintained'], 'required');
        $returnFieldData['securityRisks'] = $this->formValidator->validate($post['securityRisks'], 'required');
        $returnFieldData['license'] = $this->formValidator->validate($post['license'], 'required');
        $returnFieldData['latestVersion'] = $this->formValidator->validate($post['latestVersion'], 'required');
        $returnFieldData['purpose'] = $this->formValidator->validate($post['purpose'], 'required|invalidChars');
        
        foreach($returnFieldData as $field => $value){
            if(count($value) > 0){
                $errors = true;
            }
        }
        
        if($errors == true){
            return $returnFieldData;    
        }else{
            if($this->baseModel->update($post, $libraryId)){
                redirect('library.php?id=' . $libraryId . '&origin=' . $origin);
            }
        }
        
    }





    public function enable($id){
        return $this->baseModel->enable($id);
    }





    public function disable($id){
        return $this->baseModel->disable($id);
    }





    public function getLibraries(){
        return $this->baseModel->getLibraries();
    }





    public function getLibraryById($libraryId){
        return $this->baseModel->getLibraryById($libraryId);
    }





    public function checkLanguageRelationship($libraryId, $languageId){
        return $this->baseModel->checkLanguageRelationship($libraryId, $languageId);
    }





    public function updateLibraryLanguageRel($libraryId, $languageId, $action){
        return $this->baseModel->updateLibraryLanguageRel($libraryId, $languageId, $action);
    }





    public function getLibrariesByCodeBase($codeBaseId){
        return $this->baseModel->getLibrariesByCodeBase($codeBaseId);
    }





    public function getLibraryDeliveryTypes(){
        return $this->baseModel->getLibraryDeliveryTypes();
    }





    public function getDeliveryTypeById($id){
        return $this->baseModel->getDeliveryTypeById($id);
    }





    public function getSiblingLibraries($libraryId, $codeBaseId){
        return $this->baseModel->getSiblingLibraries($libraryId, $codeBaseId);
    }





    public function checkForDependency($libraryId, $isDependentOn){
        if($this->baseModel->checkForDependency($libraryId, $isDependentOn)){
            return true;
        }else{
            return false;
        }
    }





    public function checkForParency($isDependentOn, $libraryId){
        if($this->baseModel->checkForParency($isDependentOn, $libraryId)){
            return true;
        }else{
            return false;
        }
    }





    public function addDependency($id, $parentId){
        if($this->baseModel->addDependency($id, $parentId)){
            return true;
        }else{
            return false;
        }
    }





    public function removeDependency($id, $parentId){
        if($this->baseModel->removeDependency($id, $parentId)){
            return true;
        }else{
            return false;
        }
    }





    public function deleteAllCodeBaseLibraries($codeBaseId){
        $libraries = $this->getLibrariesByCodeBase($codeBaseId);
        if(count($libraries) > 0){
            foreach($libraries as $library){
                $this->baseModel->delete($library->library_id);
                $this->baseModel->deleteDependencies($library->library_id);
            }
        }else{
            return true;
        }
        
        
    }





    public function getCountOfDependencies($libraryId){
        return $this->baseModel->getCountOfDependencies($libraryId);
    }


    public function getCountOfParencies($libraryId){
        return $this->baseModel->getCountOfParencies($libraryId);
    }


}

?>
