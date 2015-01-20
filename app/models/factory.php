<?php

require '/db/connect.php';
require '/app/models/ispeciality.php';
require '/app/models/speciality.php';
require '/app/models/ireceptions.php';
require '/app/models/receptions.php';
require '/app/models/idoctor.php';
require '/app/models/doctor.php';
require '/app/models/iusers.php';
require '/app/models/users.php';
date_default_timezone_set('UTC');

class Factory
{
	public static function create($type, $arg=false) {
		$connection = Connect::getInstance()->getConnection();
		
		if (class_exists($type)) {
			return new $type($connection);
		} else {
			throw new \Exception("Class with the same name does not exist");
		}
	}
}

?>