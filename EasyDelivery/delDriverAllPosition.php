<?php
/**
 * Delete all driver's positions
 *
 */

if (!isset($_GET['companyid']) || !isset($_GET['deliveryid']))
	return;

// array for JSON response
$response = array();
$ret = 0;

$companyid = $_GET['companyid'];
$deliveryid = $_GET['deliveryid'];

require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

// Creating driver current position
$model->companyid = $companyid;
$model->deliveryid = $deliveryid;
$model->delDriverAllPosition();

// echo no users JSON
echo json_encode($model->error);

?>
