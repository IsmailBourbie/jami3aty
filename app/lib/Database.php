<?php

/*
 * PDO Database Class
 * Connection to database
 * Create Prepared Statements
 * Bind Values
 * Return rows and results
*/

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $db;
    private $stmt;
    private $error;

    public function __construct() {
        // Set Dns
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        // Create PDO Instance
        try {
            $this->db = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare Statement with Query
    public function query($sql) {
        $this->stmt = $this->db->prepare($sql);
    }

    // Bind Values
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
         $this->stmt->bindValue($param, $value, $type);
    }
    // execute the prepared Statement
    public function execute() {
        return $this->stmt->execute();
    }
    // return the last id inserted
   public function lastInsertId() {
       return $this->db->lastInsertId();
   }
    // get Result as Array of objects
    public function getAll() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // get single row as Object
    public function get() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    // get row count
    public function rowCount() {

        return $this->stmt->rowCount();
    }
}














































