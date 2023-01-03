<?php
    class Database{
        private $host = DB_HOST;
        private $user = DB_USERNAME;
        private $pass = DB_PASSWORD;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            //set destination
            $dsn = 'pgsql:host=' . $this->host . ';port=5432;dbname=' . $this->dbname;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //create PDO instance
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
        //Prepare statment with query
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        //Bind Values
        public function bind($param, $value, $type = null){
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

        //execute the prepared statment
        public function execute(){
            return $this->stmt->execute();
        }

        //Get result set as array of objects
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

