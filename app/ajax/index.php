<?php

require './../../db/connect.php';
require './../models/ispeciality.php';
require './../models/speciality.php';
require './../models/ireceptions.php';
require './../models/receptions.php';
require './../models/idoctor.php';
require './../models/doctor.php';
require './../models/iusers.php';
require './../models/users.php';
date_default_timezone_set('UTC');

class Factory
{
	public static function create($type) {
		$connection = Connect::getInstance()->getConnection();
		
		if (class_exists($type)) {
			return new $type($connection);
		} else {
			throw new \Exception("Class with the same name does not exist");
		}
	}
}

switch ($_POST['type']) {	
	/* Book appointment */
	case 'book-appointment':
		$receptions = Factory::create("receptions");
		
		$dateInUtc = mktime(0, 0, 0, $_POST['month']+1, $_POST['day'], $_POST['year']);
		$dateInUtc += $_POST['time'] * 3600;

		$receptions->newReception($_POST['user_id'], $_POST['doctor_id'], $dateInUtc);
		echo true;

		break;
	/* Cancel appointment */
	case 'cancel-appointment':
		$receptions = Factory::create("receptions");
		$receptions->deleteReceptionById($_POST['id']);

		echo true;
		break;
	/* Getting free time and doctors in this specialty and to this date */
	case 'available-doctors':
		$dateInUtc = mktime(0, 0, 0, $_POST['month']+1, $_POST['day'], $_POST['year']);

		$doctor = Factory::create("doctor");
		$receptions = Factory::create("receptions");

		$allDoctorsByCurSpeciality = $doctor->getDoctorsBySpeciality($_POST['speciality_id']);
		$res = $receptions->getAvailableReceptions($allDoctorsByCurSpeciality, $dateInUtc);
		
		echo json_encode($res);
		break;
	default:
		break;
}

?>