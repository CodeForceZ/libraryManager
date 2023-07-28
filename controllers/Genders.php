<?php

class Genders{





    public $baseModel;
    public $illegalCharsErrorText;
    public $formValidator;
    public $insertErrorMessage;





    public function __construct()
    {
        global $illegalCharsErrorText;
        global $insertErrorMessage;

        $this->baseModel = new Gender();
        $this->illegalCharsErrorText = $illegalCharsErrorText;
        $this->insertErrorMessage = $insertErrorMessage;
        $this->formValidator = new FormValidator();
    }





    public function deleteRecord($id){
        return $this->baseModel->deleteRecord($id);
    }





    public function add($post){
        
        $returnData = [];
        $returnData['emptyFields'] = [];
        $returnData['illegalChars'] = [];
        $returnData['insertError'] = '';
        $returnData['uniqueValueInfringements'] = '';
        $error = false;

        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $blanks = $this->formValidator->checkBlanks($post);
        if($blanks){
            $error = true;
            $returnData['emptyFields'] = $this->formValidator->getBlankFieldMessages($blanks);
        }

        $illegalFields = $this->formValidator->checkForIllegalChars($post);
        if($illegalFields){
            $error = true;
            $returnData['illegalChars'] = $this->formValidator->getIllegalCharsErrorText($illegalFields);
        }
        
        $uniqueValueInfringements = $this->formValidator->checkUniqueValues($post);
        if($uniqueValueInfringements){
            $error = true;
            $returnData['uniqueValueInfringements'] = $this->formValidator->getUniqueValueExistsMessage($uniqueValueInfringements);
        }
        
        if($error == false){
            
            if($this->baseModel->add($post)){
                redirect('genders.php');
            }else{
                $returnData['insertError'] = $this->insertErrorMessage;
                return $returnData;
            }
        }else{
            return $returnData;
        }


    }





    public function getGenderById($genderId){
        return $this->baseModel->getGenderById($genderId);
    }





    public function getGenders(){
        return $this->baseModel->getGenders();
    }

}

?>