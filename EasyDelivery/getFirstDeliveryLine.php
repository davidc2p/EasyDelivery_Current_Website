<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// array for JSON response
$response = array();

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

//Delivery
//http://easydeliveryed.eu.pn/EasyDelivery/getFirstDeliveryLine.php?companyid=2&deliveryid=24
if (isset($_REQUEST['deliveryid']) && isset($_REQUEST['companyid']))
{
	$model->deliveryid = filter_var($_REQUEST['deliveryid'], FILTER_SANITIZE_NUMBER_INT);	
	$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
	
	$response = $model->getFirstDeliveryLine();
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while fetching first deliveryline available.";
}

print json_encode($response);
?>
