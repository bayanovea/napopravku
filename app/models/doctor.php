<?php

class Doctor implements iDoctor
{
	private $_pdo;
    
    /**
    * Constructor
    */
    public function __construct($_pdo) {
        $this->_pdo = $_pdo;
    }

    /**
   	* Get all doctors by speciality_id
   	*/
	public function getDoctorsBySpeciality($speciality_id) {
		$stm = $this->_pdo->prepare('SELECT `d`.`id`,`d`.`name`,`d`.`last_name` 
			FROM `doctors` AS `d` 
			WHERE `speciality_id`=:speciality_id 
			GROUP BY `d`.`id`');
		$stm->bindParam(":speciality_id", mysql_real_escape_string($speciality_id));
        $stm->execute();
        $res = $stm->fetchAll();

        $doctorsArr = Array();
        foreach ($res as $doctor) {
        	$doctorsArr[$doctor['id']] = $doctor;
        	$doctorsArr[$doctor['id']]['hours'] = array(10,11,12,13,14,15,16,17);
        }

        return $doctorsArr;
	}
}