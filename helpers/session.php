<?php
    session_start();
    
    function checkSessionUserId(){
        if(!$_SESSION['user_id']){
            session_destroy();
            header('Location: index.php');
        }    
    }


    function applyUserTypePermission($userType){
        if($userType != 1){
            session_destroy();
            header('Location: index.php');
        }
    }

?>