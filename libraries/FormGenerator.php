<?php


class FormGenerator{


    public function __construct()
    {
        
    }


    public function generateForm($method, $fields){
        //'text, form-control, firstName, firstName, Enter First Name, [required|invalidChars|unique]'
        $form = "<form method=\"$method\">";

        foreach($fields as $fieldIndex => $fieldParams){
            $field = '';
            $paramArray = explode(',', $fieldParams);
            
            foreach($paramArray as $paramIndex => $value){
                $type = $paramArray[0];
                $class = $paramArray[1];
                $name = $paramArray[2];
                $id = $paramArray[3];
                $placeholder = $paramArray[4];
                $validations = $paramArray[5];
                $field .= "<input type=\"".$type."\" class=\"".$class."\" name=\"".$name."\" id=\"".$id."\" placeholder=\"".$placeholder."\"/>";
                $validationsArray = explode('|', $validations);
                foreach($validationsArray as $validationIndex => $validationRule){
                    
                }
            }    
            
        }

        $form = "</form>";

        return $form;

    }

}

?>