<?php

/**
 * Form Validator
 */

 class FormValidator{


    private $db;
    
    
    public function __construct(){
        $this->db = new Database();
    }



    public function generateRuleSet($ruleString){
        
        if(strstr($ruleString, '|') == true){
            $ruleSet = explode('|', $ruleString);
        }else{
            $ruleSet[] = $ruleString;
        }

        return $ruleSet;
    }




    public function validate($fieldValue, $rules){

        $valdationResults = [];

        $ruleSet = $this->generateRuleSet($rules);
        
        foreach($ruleSet as $ruleIndex => $rule){
            
            # dual-layer Rule
            ####################
            if(strstr($rule, ':')){
                $ruleArray = explode(':', $rule);
                $rule = $ruleArray[0];
                $ruleParam = $ruleArray[1];
                switch($rule){
                    case 'unique':
                        $ruleParamArray = explode('->', $ruleParam);
                        $table = $ruleParamArray[0];
                        $field = $ruleParamArray[1];
                        $feedbackEntity = $ruleParamArray[2];
                        if(isset($ruleParamArray[3])){
                            $id = $ruleParamArray[3];
                            $tableId = $ruleParamArray[4];
                            $searchType = $ruleParamArray[5];
                        }
                        if($this->checkForValueInDb($table, $field, $fieldValue, $id, $tableId, $searchType) == 'fail'){$valdationResults[$rule] = 'This ' . $feedbackEntity . ' is already in use';};
                    break;

                    case 'max':
                        if($this->max($fieldValue, $ruleParam) == 'fail'){$valdationResults[$rule] = 'This cannot exceed ' . $ruleParam . ' characters.';}
                    break;

                    case 'match':
                        if($this->match($fieldValue, $ruleParam) == 'fail'){$valdationResults[$rule] = 'This field does not match your previous input.';}
                    break;
                }

            }else{
                
                switch($rule){

                    case 'required':
                        if($this->required($fieldValue) == 'fail'){$valdationResults[$rule] = 'Required*';}
                    break;

                    case 'numeric':
                        if($this->numeric($fieldValue) == 'fail'){$valdationResults[$rule] = 'This field must be numeric';}
                    break;

                    case 'emailFormat':
                        if($this->emailFormat($fieldValue) == 'fail'){$valdationResults[$rule] = 'Please enter a valid email.';}
                    break;

                    case 'passwordFormat':
                        if($this->passwordFormat($fieldValue) == 'fail'){$valdationResults[$rule] = 'This does not meet the password requirements.';}
                    break;

                    case 'invalidChars':
                        if($this->invalidChars($fieldValue) == 'fail'){$valdationResults[$rule] = 'You have disallowed characters in this field.';}
                    break;
    
                }
            }
            
        }
        
        return $valdationResults;
    }



    # Required
    ######################################
    public function required($fieldValue){
        if(empty($fieldValue)){
            return 'fail';
        }
    }


    # Numeric
    ######################################
    public function numeric($fieldValue){
        if(!is_numeric($fieldValue)){
            return 'fail';
        }
    }


    # Max
    #####################################
    public function max($fieldValue, $maxLength){
        if(strlen($fieldValue) > $maxLength){
            return 'fail';
        }
    }


    # Email Format
    #####################################
    public function emailFormat($fieldValue){
        if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)){
            return 'fail';
        }
    }


    # Match
    #####################################
    public function match($fieldValue, $matchValue){
        if($matchValue !== $fieldValue){
            return 'fail';
        }
    }


    # PasswordFormat
    #####################################
    public function passwordFormat($fieldValue){
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,24}$/', $fieldValue)) {
            return 'fail';
        }
    }

    
    # InvalidChars
    #####################################
    public function invalidChars($fieldValue){
        $disallowedChars = [
            '\\',
            '*',
            '\'',
            '"',
            '{',
            '}',
            '%',
            '&',
            '(',
            ')',
            '+',
            ';',
            '\t',
            '\n',
            '\r',
            ':',
        ];
        foreach($disallowedChars as $charIndex => $charValue){
            if(strstr($fieldValue, $charValue)){
                return 'fail';
            }
        }
    }


    # Check for value in DB
    #####################################
    public function checkForValueInDb($table, $field, $fieldValue, $id, $tableId, $searchType){
        if(isset($id)){
            switch($searchType){
                case 'new':
                    $idClause = ' and ' . $tableId . ' = ' . $id;
                break;

                case 'existing':
                    $idClause = ' and ' . $tableId . ' != ' . $id;
                break;
            }
            
        }else{
            $idClause = '';
        }
        $sql = 'select * from ' . $table . ' where ' . $field . ' = :fieldValue' . $idClause;
        // echo $sql; die();
        $this->db->query($sql);
        $this->db->bind(':fieldValue', $fieldValue);
        if($this->db->resultSet()){
            return 'fail';
        }
    }





    # Test DB
    ####################################
    public function testDB(){
        $sql = 'select * from tbl_libraries';
        $this->db->query($sql);
        return $this->db->resultSet();
    }










    # Show - For Debugging
    #################################################
    function show($value){
        if(is_array($value)){
            foreach($value as $item => $itemValue){
                echo $item . ' : ' . $itemValue . '<br/>';
            }
        }else{
            echo $value . '<br/>';
        }
        die();
    }

 }

?>