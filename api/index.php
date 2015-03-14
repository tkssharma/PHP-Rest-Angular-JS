<?php
include 'db.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/users/:key','getUsers');
$app->get('/getoneuser/:key/:user_name','getOneUser');
$app->get('/trainings/:key','getTrainings');
$app->get('/schedule/:key', 'getSchedule');
$app->get('/searchtraining/:course_id/:key','searchTraining');
$app->get('/searchuser/:query/:key','searchUser');

$app->run();

function getUsers($key) {	
	$sql = "SELECT user_id,username,name,profile_pic FROM users ORDER BY user_id";
	try {
		
		$db = getDB();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

			if(count($users) > 0)
		{
		echo '{"users": ' . json_encode($users) . '}';
	    }
	    else
	    {
	    	echo '{"users": "No data found for the given input"}';
	    }


	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getOneUser($key , $user_name) {
	$sql = "SELECT user_id,username,name,profile_pic FROM users WHERE username=:user_name";
	try {
		
		$db = getDB();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("user_name", $user_name);		
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		if(count($users) > 0)
		{
		echo '{"users": ' . json_encode($users) . '}';
	    }
	    else
	    {
	    	echo '{"users": "No data found for the given input"}';
	    }
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}



function getTrainings($key) {	
	$sql = "SELECT id ,corse_id, module1,module2,module3,tagline1,tagline2,tagline3 FROM course";
	try {
		
		$db = getDB();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		if(count($users) > 0)
		{
	      echo '{"getTrainings": ' . json_encode($users) . '}';
	    }
	    else
	    {
	    	echo '{"getTrainings": "No data found for the given input"}';
	    }


	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getSchedule($key) {
	$sql = "SELECT training_id ,training_name,start_time,end_time,training_cost FROM training_schedule ";
	try {
		
		$db = getDB();

		$stmt = $db->query($sql);  
		$cources = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"getSchedule": ' . json_encode($cources) . '}';
		
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"getSchedule":{"text":'. $e->getMessage() .'}}'; 
	}
}

function searchTraining( $course_id , $key) {
	$sql = "SELECT id ,corse_id, module1,module2,module3,tagline1,tagline2,tagline3 from course where corse_id LIKE :course_id";
	try {
		
		$db = getDB();
		$stmt = $db->prepare($sql);
		$course_id = $course_id."%";  
        $stmt->bindParam("course_id", $course_id);		
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		if(count($users) > 0)
		{
		echo '{"searchTraining": ' . json_encode($users) . '}';
	    }
	    else
	    {
	    	echo '{"searchTraining": "No data found for the given input"}';
	    }
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}



function searchUser($query , $key) {
	$sql = "SELECT user_id,username,name,profile_pic FROM users WHERE UPPER(name) LIKE :query ORDER BY user_id";
	try {
		
		$db = getDB();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";  
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"getUserSearch": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
?>