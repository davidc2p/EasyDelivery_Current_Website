<?php
/**
 * Write a simple location
 *
 */

if (!isset($_GET['email']) || !isset($_GET['latitude']) || !isset($_GET['longitude']) || !isset($_GET['lineid']) || !isset($_GET['deliveryid']) || !isset($_GET['creationdate']))
	return;

// array for JSON response
$response = array();
$ret = 0;

$email = $_GET['email'];
$latitude  = $_GET['latitude'];
$longitude = $_GET['longitude'];
$deliveryid = $_GET['deliveryid'];
$lineid = $_GET['lineid'];
$creationdate = $_GET['creationdate'];

require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// include db connect class
require_once 'db/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');


// Creating driver current position
$model->email = $email;
$model->deliveryid = $deliveryid;
$model->lineid = $lineid;
$model->latitude = $latitude;
$model->longitude = $longitude;
$model->creationdate = $creationdate;
$ret = $model->setDriverLocation();

if ($ret == 0) {
	$response["success"] = 0;
	$response["message"] = "Driver location has sucessfuly been registered.";
} else {
	$response["success"] = 1;
	$response["message"] = "An error has occurred while creating driver location.";
}
// echo no users JSON
echo json_encode($response);

?>
