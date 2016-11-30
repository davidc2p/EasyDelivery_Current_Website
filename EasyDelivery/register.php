<?php

// array for JSON response
$response = array();
 
// include db connect class
require_once 'db/db_connect.php';
 
// generic functions
require dirname(__FILE__).'/class/generic.class.php';
$generic = new Generic(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');
 
// check for get data
if (isset($_GET["email"]) && isset($_GET["password"]) && isset($_GET["companyid"])) {
	
	try {
		// connecting to db
		$db = new DB_CONNECT();
	
		$email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);	
		$password = filter_var($_GET['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW);	
		$companyid = filter_var($_GET['companyid'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW);	
	 
		// get a valid login for this user
		$query=$db->con->prepare("SELECT * FROM ed_user WHERE email=:param");
		$query->bindParam(':param', $email);
		$query->execute();
		
		$result = $query -> fetch();
	 
		if (!empty($result)) {
			// check for empty result
			if (count($result) > 0) {
	 
				// user found - already registered
				$response["success"] = 1;
				$response["message"] = "This user has already been registered.";

				// echoing JSON response
				echo json_encode($response);
			} else {
				// inserting new user
				$query_string = $db->con->prepare("INSERT INTO ed_user(email, uid, companyid, pass, creationdate) VALUES(:email, :uid, :companyid, :pass, CURRENT_DATE)");
				$result = $query_string->execute(array(
					"email" 	=> $email,
					"uid" 		=> $generic->generatecode(20),
					"companyid" => $companyid,
					"pass" 		=> SHA1($password)
				));

				if (!$result) {
					$response["success"] = 1;
					$response["message"] = "User and Password are invalid";
				} else {
					$response["success"] = 0;
					$response["message"] = "Your account has been created. Please check your email.";
				}
				// echo no users JSON
				echo json_encode($response);
			}
		} else {
			// inserting new user
			$query_string = $db->con->prepare("INSERT INTO ed_user(email, uid, companyid, pass, creationdate) VALUES(:email, :uid, :companyid, :pass, CURRENT_DATE)");
			$result = $query_string->execute(array(
				"email" 	=> $email,
				"uid" 		=> $generic->generatecode(20),
				"companyid" => $companyid,
				"pass" 		=> SHA1($password)
			));

			if (!$result) {
				$response["success"] = 1;
				$response["message"] = "User and Password are invalid";
			} else {
				$response["success"] = 0;
				$response["message"] = "Your account has been created. Please check your email.";
			}
			// echo no users JSON
			echo json_encode($response);
		}
    }
	catch(PDOException $ex) {
		$response["success"] = 1;
		$response["message"] = "An error has occurred: ".$ex->getMessage();
	}
} else {
    // required field is missing
    $response["success"] = 1;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
 
