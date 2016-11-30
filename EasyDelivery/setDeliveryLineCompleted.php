<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

//DeliveryLine is being completed with current date
if (isset($_REQUEST['companyid']) && isset($_REQUEST['deliveryid']) && isset($_REQUEST['lineid']) && isset($_REQUEST['datecompleted']))
{
	$model->deliveryid = filter_var($_REQUEST['deliveryid'], FILTER_SANITIZE_NUMBER_INT);	
	$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
	$model->lineid = filter_var($_REQUEST['lineid'], FILTER_SANITIZE_NUMBER_INT);	
	$model->datecompleted = filter_var($_REQUEST['datecompleted'], FILTER_SANITIZE_STRING);	
	
	//print $ID."#".$CompanyID."#".$Description."#".$DriverID."#".$VehicleID."#".$DateCreated."#".$DateCompleted;
	//print $_REQUEST['DateCompleted'];
	$model->setDeliveryLineCompleted();
}
else
{
	$model->error["success"] = 1;
	$model->error["message"] = "Input data are not correctly formatted.";	
}

print json_encode($model->error);
?>
