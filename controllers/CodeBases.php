<?php

class CodeBases{





    public $baseModel;
    public $illegalCharsErrorText;
    public $formValidator;
    public $insertErrorMessage;





    public function __construct()
    {
        global $illegalCharsErrorText;
        global $insertErrorMessage;

        $this->baseModel = new CodeBase();
        $this->illegalCharsErrorText = $illegalCharsErrorText;
        $this->insertErrorMessage = $insertErrorMessage;
        $this->formValidator = new FormValidator();

    }





    public function delete($id){
        return $this->baseModel->delete($id);
    }





    public function add(){
        
        $returnFieldData = [];
        $errors = false;
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $returnFieldData['codeBaseName'] = $this->formValidator->validate($post['codeBaseName'], 'required|invalidChars|unique:tbl_code_bases->code_base_name->code base name');
        $returnFieldData['serverAddress'] = $this->formValidator->validate($post['serverAddress'], 'required|invalidChars');
        $returnFieldData['rootDir'] = $this->formValidator->validate($post['rootDir'], 'required|invalidChars');
        
        foreach($returnFieldData as $field => $value){
            if(count($value) > 0){
                $errors = true;
            }
        }
        
        if($errors == true){
            return $returnFieldData;    
        }else{
            if($this->baseModel->add($post)){
                redirect('codeBases.php');
            }
        }
        
    }





    public function update($codeBaseId){
        
        $returnFieldData = [];
        $errors = false;
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $returnFieldData['codeBaseName'] = $this->formValidator->validate($post['codeBaseName'], 'required|invalidChars|unique:tbl_code_bases->code_base_name->code base name->'.$codeBaseId.'->code_base_id->existing');
        $returnFieldData['serverAddress'] = $this->formValidator->validate($post['serverAddress'], 'required|invalidChars');
        $returnFieldData['rootDir'] = $this->formValidator->validate($post['rootDir'], 'required|invalidChars');
        
        foreach($returnFieldData as $field => $value){
            if(count($value) > 0){
                $errors = true;
            }
        }
        
        if($errors == true){
            return $returnFieldData;    
        }else{
            if($this->baseModel->update($post, $codeBaseId)){
                redirect('codeBase.php?id='.$codeBaseId);
            }
        }
        
    }





    public function enable($id){
        return $this->baseModel->enable($id);
    }





    public function disable($id){
        return $this->baseModel->disable($id);
    }





    public function getCodeBases(){
        return $this->baseModel->getCodeBases();
    }





    public function getCodeBaseById($codeBaseId){
        return $this->baseModel->getCodeBaseById($codeBaseId);
    }


    
}

?>