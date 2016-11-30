<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once 'db/db_connect.php';
require_once 'db/db_config.php';
 
// check for post data
if (isset($_GET["email"]) && isset($_GET["password"])) {
    $email = $_GET['email'];
    $password = $_GET['password'];
 
    // get a valid login for this user
	try {
		// connecting to db
		$db = new DB_CONNECT();
		
		//Already SHA1ed...
		$hashPassword = $password;
		
		//connect as appropriate as above
		$query=$db->con->prepare("SELECT us.*, co.description as companyname, dr.description as drivername FROM ed_user us left join ed_companies co on co.ID = us.companyid left join ed_drivers dr on dr.ID = us.driverid WHERE us.email=:param and us.pass=:param2");
		$query->bindParam(':param', $email);
		$query->bindParam(':param2', $hashPassword );
		$query->execute();

		$result = $query -> fetch();
	} 
	catch(PDOException $ex) {
		print "An Error occurred: ".$ex->getMessage(); //user friendly message
	}

    if (!empty($result)) {
        // check for empty result
        if (count($result) > 0) {
 
            $login = array();
            $login["companyid"] = $result["companyid"];
            $login["driverid"] = ($result["driverid"]=='')?'0':$result["driverid"];
            $login["uid"] = $result["uid"];
            $login["email"] = $result["email"];
            $login["creationdate"] = $result["creationdate"];
            $login["drivername"] = ($result["drivername"]=='')?'N/A':$result["drivername"];
            $login["companyname"] = ($result["companyname"]=='')?'N/A':$result["companyname"];
            // success
            $response["success"] = 0;
 
            // user node
            $response["login"] = array();
 
            array_push($response["login"], $login);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 1;
            $response["message"] = "User and Password are invalid";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // login is invalid
        $response["success"] = 1;
        $response["message"] = "User and Password are invalid";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 1;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
 
