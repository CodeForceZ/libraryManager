<?php

class Users{
    




    public $baseModel;
    public $formValidator;
    
    
    


    public function __construct()
    {
        $this->baseModel = new User();    
        $this->formValidator = new FormValidator();
    }





    public function deleteRecord($id){
        return $this->baseModel->deleteRecord($id);
    }





    public function add(){
        
        $returnFieldData = [];
        $errors = false;
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $returnFieldData['userType'] = $this->formValidator->validate($post['userType'], 'required');
        $returnFieldData['firstName'] = $this->formValidator->validate($post['firstName'], 'required|invalidChars');
        $returnFieldData['lastName'] = $this->formValidator->validate($post['lastName'], 'required|invalidChars');
        $returnFieldData['gender'] = $this->formValidator->validate($post['gender'], 'required');
        $returnFieldData['email'] = $this->formValidator->validate($post['email'], 'required|emailFormat|unique:tbl_users->email->email address|invalidChars');
        $returnFieldData['password'] = $this->formValidator->validate($post['password'], 'required|passwordFormat|invalidChars');
        $returnFieldData['confirmPassword'] = $this->formValidator->validate($post['confirmPassword'], 'required|match:'.$post['password']);
        
        
        foreach($returnFieldData as $field => $value){
            if(count($value) > 0){
                $errors = true;
            }
        }
        
        if($errors == true){
            return $returnFieldData;    
        }else{
            if($this->baseModel->add($post)){
                redirect('users.php');
            }
        }
        
    }





    public function signIn($post){
        
        $returnData = [];
        $returnData['emptyEmail'] = '';
        $returnData['emptyPassword'] = '';
        $returnData['invalidPassword'] = '';
        $returnData['userNotFound'] = '';
        $emptyFields = false;

        $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(empty($_POST['email'])){
            $returnData['emptyEmail'] = 'Please enter email';
            $emptyFields = true;
        }
        if(empty($_POST['password'])){
            $returnData['emptyPassword'] = 'Please enter password';
            $emptyFields = true;
        }

        if($emptyFields == false){
            
            $userRecord = $this->baseModel->getUserByEmail($post['email']);
        
            if($userRecord){
                if(password_verify($post['password'], $userRecord->password)){
                    session_start();
                    $_SESSION['user_id'] = $userRecord->user_id;
                    $_SESSION['user_type'] = $userRecord->user_type;
                    redirect('home.php');
                }else{
                    $returnData['invalidPassword'] = 'Password is invalid';    
                }
            }else{
                $returnData['userNotFound'] = 'Email not recognised';    
            }

        }        

        return $returnData; 

    }





    public function signOut(){
        session_destroy();
        redirect('index.php');
    }

    



    public function getUserById($userId){
        return $this->baseModel->getUserById($userId);
    }

    



    public function updateProfile($post){
        
        $returnData = [];
        $returnData['emptyFirstName'] = '';
        $returnData['emptyLastName'] = '';
        $returnData['emptyGender'] = '';
        $returnData['emptyEmail'] = '';
        $returnData['emailExists'] = '';
        $returnData['invalidChars'] = '';
        $returnData['sqlError'] = '';
        $emptyFields = false;

        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(empty($post['firstName'])){
            $returnData['emptyFirstName'] = 'Please enter first name';
            $emptyFields = true;
        }
        if(empty($post['lastName'])){
            $returnData['emptyLastName'] = 'Please enter last name';
            $emptyFields = true;
        }
        if(empty($post['gender'])){
            $returnData['emptyGender'] = 'Please select gender';
            $emptyFields = true;
        }
        if(empty($post['email'])){
            $returnData['emptyEmail'] = 'Please enter email';
            $emptyFields = true;
        }

        if($emptyFields == false){
            if($this->baseModel->checkEmailExistsOtherUsers($post['email'], $_SESSION['user_id'])){
                $returnData['emailExists'] = 'This email is in use for another user';
            }else{
                if(validateName($post['firstName']) == false || validateName($post['lastName']) == false || validateName($post['gender']) == false || validateName($post['email']) == false){
                    
                    $returnData['invalidChars'] = 'You have invalid characters in one of your inputs';
                }else{
                    
                    if($this->baseModel->updateProfile($post)){
                        redirect('profile.php');
                    }else{
                        $returnData['sqlError'] = 'An error occured while updating your profile';
                    }
                }
            }
        }

        return $returnData;

    }

    



    public function getUserTypes(){
        return $this->baseModel->getUserTypes();
    }

    



    public function getUserType($userTypeId){
        return $this->baseModel->getUserType($userTypeId);
    }

    



    public function getUsers(){
        return $this->baseModel->getUsers();
    }

    



    


    

}

?>