<?php
    
    require_once('../bootstrap.php');

    $entity = $_POST['entity'];
    $id = $_POST['id'];
    if(isset($_POST['parentId'])){
        $parentId = $_POST['parentId'];
    }
    $action = $_POST['action'];

    
    
    switch($entity){

        case 'codeBase':
            $controller = new CodeBases();
            $subController = new Libraries();
            switch($action){
                case 'delete':
                    if($subController->deleteAllCodeBaseLibraries($id)){
                        ($controller->delete($id)) ? $result = 'success' : $result = 'failure';
                    }else{
                        $result = 'failure';
                    }
                    
                break;

                case 'enable':
                    ($controller->enable($id)) ? $result = 'success' : $result = 'failure';
                break;

                case 'disable':
                    ($controller->disable($id)) ? $result = 'success' : $result = 'failure';
                break;
            }
        break;

        case 'library':
            $controller = new Libraries();
            switch($action){
                case 'delete':
                    ($controller->delete($id)) ? $result = 'success' : $result = 'failure';
                break;

                case 'enable':
                    ($controller->enable($id)) ? $result = 'success' : $result = 'failure';
                break;

                case 'disable':
                    ($controller->disable($id)) ? $result = 'success' : $result = 'failure';
                break;
            }
        break;

        case 'dependency':
            $controller = new Libraries();
            switch($action){
                case 'add':
                    ($controller->addDependency($id, $parentId)) ? $result = 'success' : $result = 'failure';
                break;

                case 'remove':
                    ($controller->removeDependency($id, $parentId)) ? $result = 'success' : $result = 'failure';
                break;
            }
        break;



    }
    


    
    
    echo $result;
      
?>