<?php

class Generals{





    public $baseModel;





    public function __construct()
    {
        $this->baseModel = new General();
    }





    public function getYesNoOptions(){
        return $this->baseModel->getYesNoOptions();
    }





    public function getLicenseOptions(){
        return $this->baseModel->getLicenseOptions();
    }





    public function getYesNoById($id){
        return $this->baseModel->getYesNoById($id);
    }



    

    public function getLicenseById($id){
        return $this->baseModel->getLicenseById($id);
    }

}

?>