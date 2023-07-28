<?php
$illegalCharsErrorText = 'You have entered illegal characters in this field';

function redirect($url){
    header('Location: '. $url);
}

function here(){
    echo 'Here'; die();
}

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

function validateName($name){
    global $illegalNameChars;
    $flag = true;
    $nameCharArray = str_split($name);
    foreach($nameCharArray as $charIndex => $char){
        if(in_array($char, $illegalNameChars)){
            $flag = false;
        }
    }

    return $flag;
}

function getOriginPath($origin, $id = null){
    switch($origin){
        case 'codeBase':
            $returnPath = 'codeBase.php?id='.$id;
        break;

        case 'libraries':
            $returnPath = 'libraries.php';
        break;

    }

    return $returnPath;
}

?>