<?php
$uri = $_SERVER['REQUEST_URI'];
    	$uri = explode('/', $uri);
    	echo $uri[count($uri)-1];