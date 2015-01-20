<?php

class Connect 
{
    private static $_instance;
    private $_pdo;
    private $_pdoUrl = 'mysql:host=localhost;dbname=napopravku;charset=utf8';
    private $_pdoUser = 'root';
    private $_pdoPassword = '';
    private $_pdoPrm = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

    /**
    * Constructor
    */
    private function __construct() {
        $this->_pdo = new PDO($this->_pdoUrl, $this->_pdoUser, $this->_pdoPassword, $this->_pdoPrm);
    }

     /**
    * Singleton
    */
    private function __clone() {}
    private function __wakeup() {}
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    } 

     /**
    * Get connection
    */
     public function getConnection() {
        return $this->_pdo;
     }
}