<?php

class Receptions implements IReceptions{
	private $_pdo;

	/**
	* Constructor
	*/
	public function __construct($_pdo) {
	    $this->_pdo = $_pdo;
	}
    
    /**
    * New reception 
    */
    public function newReception($user_id, $doctor_id, $date) {
        $stm = $this->_pdo->prepare('INSERT INTO `receptions`
            (user_id, doctor_id, date)
            VALUES (:user_id, :doctor_id, :date)');
        $stm->bindParam(":user_id", mysql_real_escape_string($user_id));
        $stm->bindParam(":doctor_id", mysql_real_escape_string($doctor_id));
        $stm->bindParam(":date", mysql_real_escape_string($date));
        $stm->execute();
    }

	/**
    * Delete reception by id
    */
    public function deleteReceptionById($id) {
        $stm = $this->_pdo->prepare('DELETE FROM `receptions`
			WHERE `receptions`.`id` = :id');
        $stm->bindParam(":id", mysql_real_escape_string($id));
        return $stm->execute();
    }

    /**
    * Get reception list by user id
    */
    public function getReceptionListByUserId($user_id) {
        $stm = $this->_pdo->prepare('SELECT `r`.`id`,`r`.`date`, `r`.`active`,`d`.`name`,`d`.`last_name`,`s`.`name` AS `speciality_name`
            FROM `receptions` AS `r`
            LEFT JOIN `doctors` AS `d`
            ON `r`.`doctor_id` = `d`.`id`
            LEFT JOIN `speciality` AS `s` 
            ON `d`.`speciality_id` = `s`.`id`
            WHERE `r`.`user_id` = :user_id
            ORDER BY `r`.`date`');
        $stm->bindParam(":user_id", mysql_real_escape_string($user_id));
        $stm->execute();
        $res = $stm->fetchAll();
        foreach ($res as $key => $value) {
            $res[$key]['format_date'] = date("d.m.Y", $value['date']);
            $res[$key]['format_time'] = date("H", $value['date']);
        }
        return $res;
    }    

    /**
    * Get available receptions by speciality and date
    * 
    * Each doctor work on schedule 10:00 - 18:00, need remove booking time and return not occupied values
    */
    public function getAvailableReceptions($allDoctorsByCurSpeciality, $dateInUtc) {
        
        // Get all booking time for all doctors with current speciality in current date
        $dateInUtcFrom = $dateInUtc+36000;
        $dateInUtcTo = $dateInUtc+64800;

        $curDoctorsIdString = implode(',', array_keys($allDoctorsByCurSpeciality));

        $stm = $this->_pdo->prepare('SELECT `r`.`id`,`r`.`doctor_id`,`r`.`date`
            FROM `receptions` AS `r`
            WHERE `r`.`date` >= :dateInUtcFrom AND `r`.`date` < :dateInUtcTo AND `r`.`active` = 1 
                AND `r`.`doctor_id` IN ('.$curDoctorsIdString.')
            ORDER BY `r`.`doctor_id`');
        $stm->bindParam(":dateInUtcFrom", mysql_real_escape_string($dateInUtcFrom));
        $stm->bindParam(":dateInUtcTo", mysql_real_escape_string($dateInUtcTo));
        $stm->execute();
        $res = $stm->fetchAll();
       
        if($res) {
            foreach ($res as $reception) {
                $curHours = $allDoctorsByCurSpeciality[$reception['doctor_id']]['hours'];
                $curHourKey = array_search(date("H", $reception['date']), $curHours);

                if ( $curHours[$curHourKey] ) {
                    unset($allDoctorsByCurSpeciality[$reception['doctor_id']]['hours'][$curHourKey]);
                }
            }
        }

        return $allDoctorsByCurSpeciality;
    }
}