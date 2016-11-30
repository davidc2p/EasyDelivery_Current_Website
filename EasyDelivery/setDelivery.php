<?php
require_once('class/GeoAlgorithm.class.php');
require_once('class/generic.class.php');
require_once('class/model.class.php');

// include db config class
require_once 'db/db_config.php';

$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

if (!empty($_REQUEST) && isset($_REQUEST['action']))
{
	//Delivery
	if ($_REQUEST['action'] == '1')
	{
		if (isset($_REQUEST['id']) && isset($_REQUEST['companyid']) && isset($_REQUEST['description']) && isset($_REQUEST['driverid']) && isset($_REQUEST['isdriverbeginning']) 
			&& isset($_REQUEST['vehicleid']) && isset($_REQUEST['datecreated']) && isset($_REQUEST['dateinitiated']) && isset($_REQUEST['datecompleted']))
		{
			$model->id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);	
			$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->description = filter_var($_REQUEST['description'], FILTER_SANITIZE_STRING);	
			$model->driverid = filter_var($_REQUEST['driverid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->isdriverbeginning = filter_var($_REQUEST['isdriverbeginning'], FILTER_SANITIZE_NUMBER_INT);
			$model->vehicleid = filter_var($_REQUEST['vehicleid'], FILTER_SANITIZE_NUMBER_INT);
			if ($_REQUEST['datecreated'] == '0001-01-01 12:00:00') {
				$model->datecreated = '0001-01-01 00:00:00';
			} else {	
				$date = strtotime(filter_var($_REQUEST['datecreated'], FILTER_SANITIZE_STRING));
				$model->datecreated = date('Y-m-d H:i:s', $date);
			}
			if ($_REQUEST['dateinitiated'] == '0001-01-01 12:00:00') {
				$model->dateinitiated = '0001-01-01 00:00:00';
			} else {	
				$date = strtotime(filter_var($_REQUEST['dateinitiated'], FILTER_SANITIZE_STRING));
				$model->dateinitiated = date('Y-m-d H:i:s', $date);
			}
			if ($_REQUEST['datecompleted'] == '0001-01-01 12:00:00') {
				$model->datecompleted = '0001-01-01 00:00:00';
			} else {	
				$date = strtotime(filter_var($_REQUEST['datecompleted'], FILTER_SANITIZE_STRING));			
				$model->datecompleted = date('Y-m-d H:i:s', $date);	
			}
			
			//print $ID."#".$CompanyID."#".$Description."#".$DriverID."#".$VehicleID."#".$DateCreated."#".$DateCompleted;
			//print $_REQUEST['DateCompleted'];
			$model->setDelivery();
		} else {
			$model->error["success"] = 1;
			$model->error["message"] = "Input data are not correctly formatted.";	
		}

	}
	
	//DeliveryLine
	if ($_REQUEST['action'] == '2')
	{
		if (isset($_REQUEST['deliveryid']) && isset($_REQUEST['companyid']) && isset($_REQUEST['lineid']) && isset($_REQUEST['customerid']) && 
			isset($_REQUEST['distance']) && isset($_REQUEST['cumulativedistance']) && isset($_REQUEST['timeinsec']) && isset($_REQUEST['cumulativetimeinsec']))
		{
			$model->deliveryid = filter_var($_REQUEST['deliveryid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->companyid = filter_var($_REQUEST['companyid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->lineid = filter_var($_REQUEST['lineid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->customerid = filter_var($_REQUEST['customerid'], FILTER_SANITIZE_NUMBER_INT);	
			$model->distance = (float)filter_var(str_replace(",", ".", $_REQUEST['distance']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$model->cumulativedistance = (float)filter_var(str_replace(",", ".", $_REQUEST['cumulativedistance']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	
			$model->timeinsec = filter_var($_REQUEST['timeinsec'], FILTER_SANITIZE_NUMBER_INT);	
			$model->cumulativetimeinsec = filter_var($_REQUEST['cumulativetimeinsec'], FILTER_SANITIZE_NUMBER_INT);
			if ($_REQUEST['datecompleted'] == '0001-01-01 12:00:00') {
				$model->datecompleted = '0001-01-01 00:00:00';
			} else {	
				$date = strtotime(filter_var($_REQUEST['datecompleted'], FILTER_SANITIZE_STRING));			
				$model->datecompleted = date('Y-m-d H:i:s', $date);	
			}
			// print 'deliveryid'.$model->deliveryid;
			// print 'companyid'.$model->companyid;
			// print 'lineid'.$model->lineid;
			// print 'customerid'.$model->customerid;
			// print 'distance'.$model->distance;
			// print 'cumulativedistance'.$model->cumulativedistance;
			// print 'timeinsec'.$model->timeinsec;
			// print 'cumulativetimeinsec'.$model->cumulativetimeinsec;
 		    // print 'datecompleted'.$model->datecompleted;
			
			
			
			
			//print $_REQUEST['DeliveryID']."#".$_REQUEST['CompanyID']."#".$_REQUEST['LineID']."#".$_REQUEST['CustomerID']."#".$_REQUEST['Latitude']."#".$_REQUEST['Longitude']."#".$_REQUEST['Distance']."#".$_REQUEST['CumulativeDistance']."#".$_REQUEST['TimeinSec']."#".$_REQUEST['CumulativeTimeinSec']."#".$_REQUEST['DateCompleted'];
			//print $DeliveryID."#".$CompanyID."#".$LineID."#".$CustomerID."#".$Distance."#".$CumulativeDistance."#".$TimeinSec."#".$CumulativeTimeinSec;
			
			$model->setDeliveryLine();
		} else {
			$model->error["success"] = 1;
			$model->error["message"] = "Input data are not correctly formatted.";	
		}
	}
}
else
{
	$model->error["success"] = 1;
	$model->error["message"] = "Input data are not correctly formatted.";	
}

print json_encode($model->error);
?>
