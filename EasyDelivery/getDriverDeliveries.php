<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

$response = array();

//Delivery
if (isset($_REQUEST['companyid']))
{
	$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
	
	$response = $model->getDriverDeliveries();

	// if (isset($model->error) && $model->error["success"] != 0) {
		// $response["success"] = $model->error["success"];
		// $response["message"] = $model->error["message"];
	//} else {
		// foreach ($deliveries as $r)
		// {
			// $delivery = array(
				// "DeliveryID"=>$r["ID"],
				// "DriverID"=>$r["DriverID"],
				// "Description"=>$r["Description"],
				// "isDriverBeginning"=>$r["isDriverBeginning"],
				// "VehicleID"=>$r["VehicleID"],
				// "DateCreated"=>$r["DateCreated"],
				// "DateInitiated"=>$r["DateInitiated"],
				// "DateCompleted"=>$r["DateCompleted"]
			// );
			// array_push($response["delivery"], $delivery);
		// }
	//}
}
else
{
	// Error registered
	$response["success"] = 1;
	$response["message"] = "An error has occurred while fetching deliveries.";
}

print json_encode(array("result"=>$response));
?>
