<?php
function load_classes($base_path, $sub_path){
    $class_files = scandir($base_path . '/' . $sub_path);
    foreach($class_files as $file_index => $file_name){
        if($file_name == '.' || $file_name == '..'){
            
        }else{
            if(strstr($file_name, '.php')){
                require_once $base_path . '/' . $sub_path . '/' . $file_name;
            }
        }
    }
}
?>