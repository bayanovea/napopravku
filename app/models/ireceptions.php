<?php

interface iReceptions 
{
	public function newReception($user_id, $doctor_id, $date);
	public function deleteReceptionById($id);
	public function getReceptionListByUserId($user_id);
	public function getAvailableReceptions($speciality_id, $dateInUtc);
}