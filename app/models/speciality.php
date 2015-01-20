<?php

class Speciality implements ISpeciality 
{

    private $_pdo;
    
    /**
    * Constructor
    */
    public function __construct($_pdo) {
        $this->_pdo = $_pdo;
    }
    
    /**
    * Get content by alias
    */
    public function getAllSpeciality() {
        $stm = $this->_pdo->prepare('SELECT * FROM `speciality`');
        $stm->execute();
        return $stm->fetchAll();
    }
}