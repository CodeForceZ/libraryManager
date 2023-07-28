<?php


class Database {

    public $dbDriver;
    public $dbType;
    public $dbServer;
    public $dbUsername;
    public $dbName;
    public $dbHandler;

    private $dbPassword;
    private $stmt;
    private $error;


    # Constructor
    /******************************************** */
    public function __construct(){
        
        $this->dbType = $_ENV["BASE_DB_TYPE"];
        $this->dbServer = $_ENV["BASE_DB_HOST"];
        $this->dbUsername = $_ENV["BASE_DB_USERNAME"];
        $this->dbPassword = $_ENV["BASE_DB_PASSWORD"];
        $this->dbName = $_ENV["BASE_DB_NAME"];

        
        switch($this->dbType){
            
            case 'mysql':
                $dsn = 'mysql:host=' .  $this->dbServer . ';dbname=' . $this->dbName;
                $this->dbDriver = 'PDO';
                break;

            case 'mssql':
                $dsn = 'dblib:dbname=' . $this->dbName . ';host=' .$this->dbServer;
                $this->dbDriver = 'PDO';
                break;

            case 'oracle':
                $this->dbDriver = 'OCI';
                break;

        }

        if($this->dbDriver == 'PDO'){

            $dbOptions = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
    
            try{
    
                $this->dbHandler = new PDO($dsn, $this->dbUsername, $this->dbPassword, $dbOptions);
                
    
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }

        }
        

        if($this->dbDriver == 'OCI'){

            $this->dbHandler = oci_connect($this->dbUsername, $this->dbPassword, $this->dbServer);

        }
        

    }





    # Query
    /******************************************** */
    public function query($sql){

        if($this->dbDriver == 'PDO'){

            $this->stmt = $this->dbHandler->prepare($sql);

        }

        if($this->dbDriver == 'OCI'){

            $this->stmt = oci_parse($this->dbHandler, $sql);

        }
    }





    # Bind Values
    /******************************************** */
    public function bind($param, $value, $type = null){

        if($this->dbDriver == 'PDO'){

            if(is_null($type)){

                switch(true){

                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;

                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;

                    default:
                        $type = PDO::PARAM_STR;

                }
                
            }
            
            $this->stmt->bindValue($param, $value, $type);

        }


        if($this->dbDriver == 'OCI'){

            // if(is_null($type)){

            //     switch(true){

            //         case is_int($value):
            //             $type = PDO::PARAM_INT;
            //             break;

            //         case is_bool($value):
            //             $type = PDO::PARAM_BOOL;
            //             break;

            //         case is_null($value):
            //             $type = PDO::PARAM_NULL;
            //             break;

            //         default:
            //             $type = PDO::PARAM_STR;

            //     }
                
            // }

            oci_bind_by_name($this->stmt, $param, $value);
        }

    }





    # Execute
    /******************************************** */
    public function execute(){
        
        if($this->dbDriver == 'PDO'){

            return $this->stmt->execute();

        }

        if($this->dbDriver == 'OCI'){

            return oci_execute($this->stmt);

        }
        

    }





    # Reurn Result Set
    /******************************************** */
    public function resultSet(){

        $this->execute();

        if($this->dbDriver == 'PDO'){

            return $this->stmt->fetchAll(PDO::FETCH_OBJ);

        }

        if($this->dbDriver == 'OCI'){

            oci_fetch_all($this->stmt, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            return $result;

        }

        

    }





    # Return Single Record
    /******************************************** */
    public function single(){

        $this->execute();

        if($this->dbDriver == 'PDO'){
        
            return $this->stmt->fetch(PDO::FETCH_OBJ);

        }

        if($this->dbDriver == 'OCI'){
        
            return oci_fetch_row($this->stmt);

        }

    }





    # Get Row Count
    /******************************************** */
    public function rowCount(){

        if($this->dbDriver == 'PDO'){

            return $this->stmt->rowCount();

        }

        if($this->dbDriver == 'OCI'){

            return oci_num_rows($this->stmt);

        }

    }



}

?>