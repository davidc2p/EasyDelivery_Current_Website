<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// array for JSON response
$response = array();
$ret = array();	

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

//Delivery
if (isset($_REQUEST['CompanyID']))
{
	$model->companyid = filter_var($_REQUEST['CompanyID'], FILTER_SANITIZE_NUMBER_INT);	
	
	$ret = $model->getAllDeliveryLines();

	if ($model->error == 0) {
		$response["success"] = 0;
		$response["message"] = "DeliveryLines have been fetched.";
	} else {
		$response["success"] = $model->error;
		$response["message"] = $model->errordesc;
	}
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while fetching deliverylines.";
}

$result = array();
if (!empty($ret))
	$result = $ret;
else
	$result = $response;

print json_encode($result);
?>
