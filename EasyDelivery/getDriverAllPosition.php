<?php
require_once('class/GeoAlgorithm.class.php');
$Geo = new GeoAlgorithm();

// include db config class
require_once 'db/db_config.php';

//for the JSON response
$position = array();

// generic functions
require dirname(__FILE__).'/class/generic.class.php';
// model functions
require dirname(__FILE__).'/class/model.class.php';
$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

if (isset($_GET['companyid']) && isset($_GET['deliveryid'])) {

	$model->companyid = $_GET['companyid'];
	$model->deliveryid = $_GET['deliveryid'];

	//getting last know position of a user identified by companyid
	$position = $model->getDriverAllPosition();

} else {
    // required field is missing
    $position["success"] = 0;
    $position["message"] = "Required field(s) is missing";
}

// echoing JSON response
echo json_encode($position);

?>