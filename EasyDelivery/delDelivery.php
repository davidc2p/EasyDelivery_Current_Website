<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// array for JSON response
$response = array();
$ret = 0;	

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

//Delivery
if (isset($_REQUEST['deliveryid']) && isset($_REQUEST['companyid']))
{
	$model->deliveryid = filter_var($_REQUEST['deliveryid'], FILTER_SANITIZE_NUMBER_INT);	
	$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
	
	$model->delDelivery();
}
else
{
	$model->error["success"] = 1;
	$model->error["message"] = "Variables are not correctly formatted.";
}


print json_encode($model->error);
?>
