<?php

class Users implements iUsers
{
    /**
    * Get current user id
    */
    public function getCurUserId() {
    	$uri = $_SERVER['REQUEST_URI'];
    	$uri = explode('/', $uri);
    	return $uri[count($uri)-1];
    }
}