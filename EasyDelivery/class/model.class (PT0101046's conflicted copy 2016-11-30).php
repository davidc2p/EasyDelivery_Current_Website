<?php
// ************************************************
// This file has been written by David Domingues
// you are free to use it and change it as you need
// but i will ask you to keep this header on the file
// and never remove it.
// model.class.php downloaded at http://www.webrickco.com
// webrickco@gmail.com
// ************************************************
// PHP Document

class Model
{
    var $hostname;
    var $database;
	var $admin;
	var $password;
	var $prefix;
	var $con;
	
	//generic
	var $id;
	var $lineid;
	var $email;
	var $latitude;
	var $longitude;
	var $deliveryid;
	var $companyid;
	var $companyaddress;
	var $companyname;
	var $description;
	var $customerid;
	var $driverid;
	var $driveraddress;
	var $drivername;
	var $isdriverbeginning;
	var $vehicleid;
	var $distance;
	var $cumulatedistance;
	var $timeinsec;
	var $cumulativetimeinsec;
	var $creationdate;
	var $datecreated;
	var $dateinitiated;
	var $datecompleted;

	//error
	var $info;
	var $error;
	
	//subsets
	var $listpoints = array();
	
	//debug info
	var $debug = '';
	
	
	function __construct($hostname, $database, $admin, $password, $prefix) 
	{
		$this->hostname		= $hostname;
		$this->database		= $database;
		$this->admin		= $admin;
		$this->password		= $password;
		$this->prefix		= $prefix;
		
		try {        
			// Connecting to mysql database
			//$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
			$con = new PDO('mysql:host='.$this->hostname.';dbname='.$this->database, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch(PDOException $ex) {
			print "An Error occurred: ".$ex->getMessage(); //user friendly message
		}


        // Selecting database
        //$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
		
		$this->con = $con;
		
		$this->generic = new Generic($this->hostname, $this->database, $this->admin, $this->password, $this->prefix);
		
		$this->Geo = new GeoAlgorithm();
		
		return $this->con;
    }

	/* --------------------------------
	Dealing with Users Drivers or Companies
	-----------------------------------*/
	public function login()
	{
		// get a valid login for this user
		try {
			//Already SHA1ed...
			$hashPassword = SHA1($this->password);
			
			//connect as appropriate as above
			$query=$this->con->prepare("SELECT us.*, co.description as companyname, dr.description as drivername FROM ed_user us left join ed_companies co on co.ID = us.companyid left join ed_drivers dr on dr.ID = us.driverid WHERE us.email=:param and us.pass=:param2");
			$query->bindParam(':param', $this->email);
			$query->bindParam(':param2', $hashPassword );
			$query->execute();

			$result = $query -> fetch(PDO::FETCH_ASSOC);
		} 
		catch(PDOException $ex) {
			$this->error["success"] = 0;
			$this->error["message"] = "An Error occurred: ".$ex->getMessage(); //user friendly message
		}

		if (!empty($result)) {
			// check for empty result
			if (count($result) > 0) {
				$this->companyid = $result["companyid"];
				$this->driverid = ($result["driverid"]=='')?'0':$result["driverid"];
				$this->uid = $result["uid"];
				$this->email = $result["email"];
				$this->creationdate = $result["creationdate"];
				$this->drivername = ($result["drivername"]=='')?'N/A':$result["drivername"];
				$this->companyname = ($result["companyname"]=='')?'N/A':$result["companyname"];
				// success
				$this->error["success"] = 1;
			} else {
				// no login found
				$this->error["success"] = 0;
				$this->error["message"] = "User and Password are invalid";
			}
		} else {
			// no login found
			$this->error["success"] = 0;
			$this->error["message"] = "User and Password are invalid";
		}
	}
	
	public function register()
   	{
		try{
			// Check if exists
			$query=$this->con->prepare("SELECT * FROM ed_user WHERE email=:param");
			$query->bindParam(':param', $this->email);
			$query->execute();
			
			$result = $query -> fetch();
			
			if (!empty($result)) {
				// check for empty result
				if (count($result) > 0) {
		 
					// user found - already registered
					$this->error['success'] = 0;
					$this->error['message'] = "This user has already been registered.";

				} else {
					// Get the last CompanyID
					$query=$this->con->prepare("SELECT MAX(CompanyID) as companyid FROM ed_user");
					$query->execute();
					
					$lastcompany = $query->fetch(PDO::FETCH_ASSOC);
					if (is_null($lastcompany['companyid'])) {
						$companyid = 1;
					} else {
						$companyid = $lastcompany['companyid'] + 1;
					}
					
					$this->con->beginTransaction();
					
					$this->token = $this->generic->generatecodeupperAZ(20);
					
					// inserting new user
					$query = $this->con->prepare("INSERT INTO ed_user(email, uid, companyid, driverid, pass, creationdate) VALUES(:email, :uid, :companyid, :driverid, :pass, CURRENT_DATE)");
					$result = $query->execute(array(
						"email" 		=> $this->email,
						"uid" 			=> $this->token,
						"companyid" 	=> $companyid,
						"driverid" 		=> "N/A",
						"pass" 			=> SHA1($this->password)
					));

					if (!$result) {
						$this->error['success'] = 0;
						$this->error['message'] = "User and Password are invalid";
						$this->con->rollBack();
					} else {
						//inserting company Data
						$query = $this->con->prepare("INSERT INTO ed_companies (ID, Address, Description, Latitude, Longitude) VALUES (:id, :address, :companyname, :latitude, :longitude)");
						$result = $query->execute(array(
							"id" 			=> $companyid,
							"address" 		=> $this->companyaddress,
							"companyname" 	=> $this->companyname,
							"latitude" 		=> $this->latitude,
							"longitude" 	=> $this->longitude
						));

						if (!$result) {
							$this->error['success'] = 0;
							$this->error['message'] = "User and Password are invalid";
							$this->con->rollBack();
						} else {
							$this->error['success'] = 1;
							$this->error['message'] = "Your account has been created. Please check your email.";
						}
					}
				}
			} else {
				// Get the last CompanyID
				$query=$this->con->prepare("SELECT MAX(CompanyID) as companyid FROM ed_user");
				$query->execute();
				
				$lastcompany = $query->fetch(PDO::FETCH_ASSOC);
				if (is_null($lastcompany['companyid'])) {
					$companyid = 1;
				} else {
					$companyid = $lastcompany['companyid'] + 1;
				}

				$this->con->beginTransaction();
				
				$this->token = $this->generic->generatecodeupperAZ(20);
				
				// inserting new user
				$query = $this->con->prepare("INSERT INTO ed_user(email, uid, companyid, driverid, pass, creationdate) VALUES(:email, :uid, :companyid, :driverid, :pass, CURRENT_DATE)");
				$result = $query->execute(array(
					"email" 		=> $this->email,
					"uid" 			=> $this->token,
					"companyid" 	=> $companyid,
					"driverid" 		=> "N/A",
					"pass" 			=> SHA1($this->password)
				));

				if (!$result) {
					$this->error['success'] = 0;
					$this->error['message'] = "User and Password are invalid";
					$this->con->rollBack();
				} else {
					//inserting company Data
					$query = $this->con->prepare("INSERT INTO ed_companies (ID, Address, Description, Latitude, Longitude) VALUES (:id, :address, :companyname, :latitude, :longitude)");
					$result = $query->execute(array(
						"id" 			=> $companyid,
						"address" 		=> $this->companyaddress,
						"companyname" 	=> $this->companyname,
						"latitude" 		=> $this->latitude,
						"longitude" 	=> $this->longitude
					));

					if (!$result) {
						$this->error['success'] = 0;
						$this->error['message'] = "User and Password are invalid";
						$this->con->rollBack();
					} else {
						$this->error['success'] = 1;
						$this->error['message'] = "Your account has been created. Please check your email.";
					}
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }
	
	public function getDrivers()
	{
		$ret = array();
		
		try {
			//fetching all drivers of a company
			$query=$this->con->prepare("SELECT us.*, dr.description as drivername, dr.Address as driveraddress, dr.latitude as driverlatitude, dr.longitude as driverlongitude FROM ed_user us 
										inner join ed_drivers dr on dr.ID = us.driverid WHERE us.companyid=:companyid");
			$query->bindParam(':companyid', $this->companyid);
			$query->execute();

			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
				
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
			}
			else {
				$this->error["success"] = 1;
				$this->error["message"] = "No data to retrieve.";
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = "An error has occurred while retrieving data.";
			$ret = $this->error;
		}
		
		return $ret;		
	}

	public function setDriver()
   	{
		try{
			if (isset($this->driverid) && $this->driverid!=0) {
				//UPDATE
				if ((isset($this->password) &&  $this->password!="")) {
					$query = $this->con->prepare("UPDATE ed_user set pass=:pass WHERE email=:email");
					$result = $query->execute(array(
						"email" 		=> $this->email,
						"pass" 			=> SHA1($this->password)
					));

					if (!$result) {
						$this->error['success'] = 0;
						$this->error['message'] = "Error while creating the user.";
					} else {
						$this->error['success'] = 1;
						$this->error['message'] = "Password successfully updated.";
					}
				}

				//inserting driver Data
				print $this->driveraddress;
				print $this->drivername;
				print $this->latitude;
				print $this->longitude;
				$query = $this->con->prepare("UPDATE ed_drivers SET Description=:drivername, Address=:driveraddress, Latitude=:latitude, Longitude=:longitude WHERE ID=:id");
				$result = $query->execute(array(
					"id" 			=> $this->driverid,
					"driveraddress"	=> $this->driveraddress,
					"drivername" 	=> $this->drivername,
					"latitude" 		=> $this->latitude,
					"longitude" 	=> $this->longitude
				));

				if (!$result) {
					$this->error['success'] = 0;
					$this->error['message'] = "Error while updating the driver";
				} else {
					$this->error['success'] = 1;
					$this->error['message'] = "This driver has sucessfully been updated.";
				}

			} else {
				//INSERT
				// Check if exists by name
				$query=$this->con->prepare("SELECT '1' FROM ed_drivers dr INNER JOIN ed_user us ON us.driverid = dr.ID WHERE us.companyid=:param AND (dr.Description=:param2 OR us.email=:param3)");
				$query->bindParam(':param', $this->companyid);
				$query->bindParam(':param2', $this->drivername);
				$query->bindParam(':param3', $this->email);
				$query->execute();
				
				$result = $query -> fetch(PDO::FETCH_ASSOC);

				if (!empty($result) && count($result) > 0) {
					// check for empty result
					// user found - already registered
					$this->error['success'] = 0;
					$this->error['message'] = "This driver is already created.";
				} else {	
					// Get the last DriverID
					$query=$this->con->prepare("SELECT MAX(ID) as driverid FROM ed_drivers");
					$query->execute();
					
					$lastdriver = $query->fetch(PDO::FETCH_ASSOC);
					if (is_null($lastdriver['driverid'])) {
						$driverid = 1;
					} else {
						$driverid = $lastdriver['driverid'] + 1;
					}
					
					$this->con->beginTransaction();
					
					$this->token = $this->generic->generatecodeupperAZ(20);
					
					// inserting new user
					$query = $this->con->prepare("INSERT INTO ed_user(email, uid, companyid, driverid, pass, creationdate) VALUES(:email, :uid, :companyid, :driverid, :pass, CURRENT_DATE)");
					$result = $query->execute(array(
						"email" 		=> $this->email,
						"uid" 			=> $this->token,
						"companyid" 	=> $this->companyid,
						"driverid" 		=> $driverid,
						"pass" 			=> SHA1($this->password)
					));

					if (!$result) {
						$this->error['success'] = 1;
						$this->error['message'] = "Error while creating the user";
						$this->con->rollBack();
					} else {
						//inserting driver Data
						$query = $this->con->prepare("INSERT INTO ed_drivers(ID, Description, Address, Latitude, Longitude) VALUES (:id, :drivername, :driveraddress, :latitude, :longitude)");
						$result = $query->execute(array(
							"id" 			=> $driverid,
							"driveraddress"	=> $this->driveraddress,
							"drivername" 	=> $this->drivername,
							"latitude" 		=> $this->latitude,
							"longitude" 	=> $this->longitude
						));

						if (!$result) {
							$this->error['success'] = 1;
							$this->error['message'] = "Error while creating the driver";
							$this->con->rollBack();
						} else {
							$this->error['success'] = 0;
							$this->error['message'] = "This driver has sucessfully been registered.";
						}
					}
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }

	public function delDriver()
   	{
		try{
			$this->con->beginTransaction();

			$query = $this->con->prepare("DELETE FROM ed_user WHERE email=:email");
			$result = $query->execute(array(
				"email" 		=> $this->email
			));

			if (!$result) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while deleting the user.";
				$this->con->rollBack();
			} else {
				$query=$this->con->prepare("DELETE FROM ed_drivers WHERE ID=:param");
				$query->bindParam(':param', $this->driverid);
				$query->execute();

				if (!$result) {
					$this->error['success'] = 1;
					$this->error['message'] = "Error while creating the driver";
					$this->con->rollBack();
				} else {
					$this->error['success'] = 0;
					$this->error['message'] = "Driver successfully removed.";
				}
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
			$this->con->rollBack();
		}
    }

	/* --------------------------------
	Dealing with Driver Location
	-----------------------------------*/
	public function setDriverPosition()
   	{
		try{			
			//getting last sequence
			$query=$this->con->prepare("select max(id) as id from ed_driverposition where CompanyID = :companyid");
			$query->bindParam(':companyid', $this->companyid);
			$query->execute();
						
			$ar = $query->fetch(PDO::FETCH_ASSOC);

			if (is_null($ar['id'])) {
				$id = 1;
			} else {
				$id = $ar['id'] + 1;
			}
	
			$query_string = $this->con->prepare("INSERT INTO ed_driverposition (id, CompanyID, DeliveryID, LineID, Latitude, Longitude, CreationDate) 
												  VALUES (:id, :companyid, :deliveryid, :lineid, :latitude, :longitude, CURRENT_DATE)");
			$result = $query_string->execute(array(
				":id" 			=> $id,
				":companyid" 	=> $this->companyid,
				":deliveryid" 	=> $this->deliveryid,
				":lineid" 		=> $this->lineid,
				":latitude" 	=> $this->latitude,
				":longitude" 	=> $this->longitude
			));
			
			if (!$result) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to insert driver's position.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Driver's position successfully registered.";
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }

    public function delDriverAllPosition()
   	{
		try {
			//delete from ed_driverposition
			$query_string = $this->con->prepare("DELETE FROM ed_driverposition 
								   WHERE companyid = :companyid
								   AND deliveryid = :deliveryid");
			
			$response = $query_string->execute(array(
				":companyid" 		=> $this->companyid,
				":deliveryid" 		=> $this->deliveryid
			));
		
			// $this->debug .= '<br/>'.$query_string;
			
			if (!$response) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to delete all driver's position.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "All driver's position successfully deleted.";
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }	

	public function getDriverAllPosition()
   	{
		$listpoints = array();
		
		try {
			//getting last sequence
			$query=$this->con->prepare("select * from ed_driverposition where companyid = :param and deliveryid = :param2 order by creationdate");
			$query->bindParam(':param', $this->companyid);
			$query->bindParam(':param2', $this->deliveryid );
			$query->execute();
			
			// $this->debug .= '<br/>'.$query_string;
			
			$ar = $query->fetch(PDO::FETCH_ASSOC);
			if ($ar) {
				while ($ar) {
					array_push($listpoints, $ar);
					$ar = $query->fetch(PDO::FETCH_ASSOC);
				}
			} else {
				//getting last sequence
				$query=$this->con->prepare("select 0 as ID, dl.CompanyID, dl.DeliveryID, dl.LineID, cust.latitude, cust.longitude, '0001-01-01 00:00:00' as CreationDate from ed_deliveryline dl inner join ed_customers cust on cust.id = dl.CustomerID  where dl.companyid = :param and dl.deliveryid = :param2 and dl.lineid = 1");
				$query->bindParam(':param', $this->companyid);
				$query->bindParam(':param2', $this->deliveryid );
				$query->execute();
				
				// $this->debug .= '<br/>'.$query_string;
				
				$ar = $query->fetch(PDO::FETCH_ASSOC);
				if ($ar) {
					while ($ar) {
						array_push($listpoints, $ar);
						$ar = $query->fetch(PDO::FETCH_ASSOC);
					}
				}				
			}
		}
		catch(PDOException $ex) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
			$listpoints = $this->error;
		}
		return $listpoints;
	}
	
	//get the last available position for a Driver
	public function getDriverLastPosition() 
	{
		try {
			//fetching the first available step
			$query=$this->con->prepare("SELECT up.* FROM ed_driverposition up
									INNER JOIN 
									( 
										SELECT companyid, deliveryid, MAX(creationdate) as maxcreationdate
										FROM ed_driverposition upmax
										GROUP BY companyid, deliveryid
									) A
									ON  A.companyid = up.companyid
									AND A.deliveryid = up.deliveryid
									AND A.maxcreationdate = up.creationdate
									WHERE up.companyid = :param and up.deliveryid = :param2");
			$query->bindParam(':param', $this->companyid);
			$query->bindParam(':param2', $this->deliveryid );
			$query->execute();
			
			// $this->debug .= '<br/>'.$query_string;

			$ms = $query -> fetch();	
			if (!$ms) {
				$this->error['success'] = 1;
				$this->error['message'] = 'No information found.';
				$ms = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
			$ms = $this->error;
		}
		return $ms;
	}
	/* --------------------------------
	
	Dealing with Delivery Data
	
	-----------------------------------*/
	//Delete data from Delivery
	public function delDelivery()
   	{
		try {
			//Begin a transaction
			$this->con->beginTransaction();
			
			//delete from ed_deliveries
			$query_string = $this->con->prepare("DELETE FROM ed_deliveries 
											   WHERE companyid = :companyid
											   AND ID = :id");
			
			$response = $query_string->execute(array(
				":companyid" 	=> $this->companyid,
				":id" 			=> $this->deliveryid
			));
			// $this->debug .= '<br/>'.$ret;
			
			$count = $query_string->rowCount();
			if ($count == 0) {
				$this->error['success'] = 1;
				$this->error['message'] = "No delivery to delete.";
				$this->con->commit();	
			} else {			
				if (!$response) {
					$this->error['success'] = 1;
					$this->error['message'] = "Error while trying to delete a delivery.";
					$this->con->rollBack();
				} else {
					$this->delDeliveryLines();
					if (isset($this->error['error']) && $this->error['error'] > 0) {
						$this->error['success'] = 1;
						$this->error['message'] = "Error while trying to delete a delivery.";
						$this->con->rollBack();
					} else {
						$this->error['success'] = 0;
						$this->error['message'] = "Delivery successfully deleted.";
						$this->con->commit();						
					}
				}
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
			$this->con->rollBack();
		}
    }	
	//Delete from DeliveryLines
	public function delDeliveryLines()
   	{
		try {
			//delete from ed_driverposition
			$query_string = $this->con->prepare("DELETE FROM ed_deliveryline 
											   WHERE companyid = :companyid
											   AND ID = :id");
			
			$response = $query_string->execute(array(
				":companyid" 	=> $this->companyid,
				":id" 			=> $this->deliveryid
			));
			//$this->debug .= '<br/>'.$ret;

			if (!$response) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to delete a delivery line.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Delivery line successfully deleted.";
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}	
    }	

	//Set Delivery
	public function setDelivery()
   	{
		try {
			$query_string = $this->con->prepare("INSERT 
								   INTO ed_deliveries (id, companyid, description, driverid, isdriverbeginning, vehicleid, datecreated, dateinitiated, datecompleted) 
								   VALUES (:id, :companyid, :description, :driverid, :isDriverBeginning, :vehicleid, :datecreated, :dateinitiated, :datecompleted)");
			$result = $query_string->execute(array(
				":id" 					=> $this->id,
				":companyid"			=> $this->companyid,
				":description"			=> $this->description,
				":driverid" 			=> $this->driverid,
				":isDriverBeginning" 	=> $this->isdriverbeginning,
				":vehicleid" 			=> $this->vehicleid,
				":datecreated" 			=> $this->datecreated,
				":dateinitiated" 		=> $this->dateinitiated,
				":datecompleted" 		=> $this->datecompleted
			));

			// $this->debug .= '<br/>'.$query_string;
			if (!$result) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to creating a delivery.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Delivery successfully created.";
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }
	
	//Set DeliveryLine
	public function setDeliveryLine()
   	{
		try {

			$query_string = $this->con->prepare("INSERT 
								   INTO ed_deliveryline (deliveryid, companyid, lineid, customerid, distance, cumulativedistance, timeinsec, cumulativetimeinsec, datecompleted) 
								   VALUES (:deliveryid, :companyid, :lineid, :customerid, :distance, :cumulativedistance, :timeinsec, :cumulativetimeinsec, :datecompleted)");
			$result = $query_string->execute(array(
				":deliveryid" 			=> $this->deliveryid,
				":companyid"			=> $this->companyid,
				":lineid"				=> $this->lineid,
				":customerid" 			=> $this->customerid,
				":distance" 			=> $this->distance,
				":cumulativedistance" 	=> $this->cumulativedistance,
				":timeinsec" 			=> $this->timeinsec,
				":cumulativetimeinsec" 	=> $this->cumulativetimeinsec,
				":datecompleted" 		=> $this->datecompleted
			));

			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
			if (!$result) {
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to creating a delivery line.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Delivery line successfully created.";
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = $ex->getMessage();
		}
    }
	public function setDeliveryLineCompleted()
   	{
		try {		

			if ($this->lineid == 9999999)
			{
				$query_string = $this->con->prepare("UPDATE ed_deliveries 
											   SET datecompleted = :datecompleted                                       
											   WHERE id = :id AND companyid = :companyid");
			
				$response = $query_string->execute(array(
					":datecompleted" 	=> $this->datecompleted,
					":id" 				=> $this->deliveryid,
					":companyid"		=> $this->companyid
				));
			}
			else
			{
				$query_string = $this->con->prepare("UPDATE ed_deliveryline 
											   SET datecompleted = :datecompleted                                       
											   WHERE deliveryid = :id AND companyid = :companyid AND lineid = :lineid");
			
				$response = $query_string->execute(array(
					":datecompleted" 	=> $this->datecompleted,
					":id" 				=> $this->deliveryid,
					":companyid" 		=> $this->companyid,
					":lineid" 			=> $this->lineid
				));
			}
			
			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
			if (!$response){
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to complete a delivery.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Delivery successfully completed.";
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = "An error has occurred while updating data.";
		}	
    }
        
    public function setDeliveryInitiated()
   	{
		try {		
		
			$query_string = $this->con->prepare("UPDATE ed_deliveries d
										   SET dateinitiated = :dateinitiated                                
										   WHERE id = :id AND companyid = :companyid");
			
			$response = $query_string->execute(array(
				":dateinitiated" 	=> $this->dateinitiated,
				":id" 				=> $this->deliveryid,
				":companyid" 		=> $this->companyid
			));
			
			//echo $query_string;
			//$this->debug .= '<br/>'.$query_string;

			if (!$response){
				$this->error['success'] = 1;
				$this->error['message'] = "Error while trying to initiate a delivery.";
			} else {
				$this->error['success'] = 0;
				$this->error['message'] = "Delivery line successfully initiated.";
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = "An error has occurred while retrieving data.";
		}	
    }	
        
	//Get first available waipoint of a delivery
	public function getFirstDeliveryLine() 
	{
		$response = array();
		
		try {
			//fetching the first available step
			$query=$this->con->prepare("SELECT del.*, dell.LineID, dell.CustomerID, cust.Latitude as LineLatitude, cust.Longitude as LineLongitude
										FROM ed_deliveries del
										INNER JOIN ed_deliveryline dell 
										ON  dell.DeliveryID = del.ID 
										AND dell.CompanyID 	= del.CompanyID 
										INNER JOIN ed_customers cust 
										ON  cust.id = dell.CustomerID 
										INNER JOIN 
										( 
											SELECT CompanyID, DeliveryID, MIN(LineID) as minlineid
											FROM ed_deliveryline dell
											WHERE dell.DateCompleted = '0001-01-01 00:00:00' 
											GROUP BY CompanyID, DeliveryID
										) A
										ON  A.CompanyID 	= dell.CompanyID
										AND A.DeliveryID 	= dell.DeliveryID
										AND A.minlineid 	= dell.LineID
										WHERE del.companyid = :companyid 
										AND del.ID = :id");
			$query->bindParam(':companyid', $this->companyid);
			$query->bindParam(':id', $this->deliveryid );
			$query->execute();

			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
			$response = $query->fetchall();	
			
			if (count($response) == 0)
			{
				//fetching the way back to base
				$query=$this->con->prepare("SELECT del.*, 9999999 as LineID, 9999999 as CustomerID, 0 as LineLatitude, 0 as LineLongitude
										FROM ed_deliveries del
										WHERE del.companyid = :companyid 
										AND del.ID = :id");
				$query->bindParam(':companyid', $this->companyid);
				$query->bindParam(':id', $this->deliveryid );
				$query->execute();
								
				//echo $query_string;
				// $this->debug .= '<br/>'.$query_string;
			
				$response = $query->fetch();
				if (!$response) {
					$this->error['success'] = 1;
					$this->error['message'] = "No data to retrieve.";
					$response = $this->error;
				}
			}
		}
		catch (PDOException $e) {
			$this->error['success'] = 1;
			$this->error['message'] = "An error has occurred while retrieving data.";
			$response = $this->error;
		}
		
		return $response;
	}
	
	//get all available deliveries
	public function getAllDeliveries()
	{
		$ret = array();
		
		try {
			//fetching the first available step
			$query=$this->con->prepare("SELECT del.ID, del.DriverID, del.isDriverBeginning, del.VehicleID, del.DateCreated, del.DateInitiated, del.DateCompleted
									FROM ed_deliveries del
									WHERE del.CompanyID = :companyid");
			$query->bindParam(':companyid', $this->companyid);
			$query->execute();

			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
				
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
			}
			else {
				$this->error["success"] = 1;
				$this->error["message"] = "No data to retrieve.";
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = "An error has occurred while retrieving data.";
			$ret = $this->error;
		}
		
		return $ret;
	}

    //get all available deliveries for a driver 
	public function getDriverDeliveries()
	{
		$ret = array();
		
		try {
			//fetching all deliveries from company
			$query=$this->con->prepare("SELECT ID, DriverID, Description, isDriverBeginning, VehicleID, DateCreated, DateInitiated, DateCompleted
                                                FROM ed_deliveries 
                                                WHERE companyid = :companyid
                                                AND DateCompleted = '0001-01-01 00:00:00'");
			$query->bindParam(':companyid', $this->companyid);
			$query->execute();
			
			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
			} else {
				$this->error["success"] = 1;
				$this->error["message"] = "No data to retrieve.";
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = "An error has occurred while retrieving data.";
			$ret = $this->error;
		}
		
		return $ret;
	}
        
	//get all available deliverylines
	public function getAllDeliveryLines()
	{
		$ret = array();
		
		try {
			//fetching the first available step
			$query=$this->con->prepare("SELECT del.ID AS DeliveryID, dell.LineID, dell.CustomerID, cust.Latitude, cust.Longitude, dell.Distance, dell.CumulativeDistance, dell.TimeinSec, dell.CumulativeTimeinSec, dell.DateCompleted as LDateCompleted
									FROM ed_deliveries del
									INNER JOIN ed_deliveryline dell 
									ON  dell.DeliveryID = del.ID 
									INNER JOIN ed_customers cust
									ON  cust.id = dell.CustomerID
									AND dell.CompanyID 	= del.CompanyID 
									WHERE del.CompanyID = :companyid");
			$query->bindParam(':companyid', $this->companyid);
			$query->execute();
			
			//echo $query_string;
			// $this->debug .= '<br/>'.$query_string;
				
			$ms = $query->fetch(PDO::FETCH_ASSOC);
			
			if ($ms) {
				while ($ms) {
					array_push($ret, $ms);
					$ms = $query->fetch(PDO::FETCH_ASSOC);
				}
				
			} else {
				$this->error["success"] = 1;
				$this->error["message"] = "No data to retrieve.";
				$ret = $this->error;
			}
		}
		catch (PDOException $e) {
			$this->error["success"] = 1;
			$this->error["message"] = "An error has occurred while retrieving data.";
			$ret = $this->error;
		}
		
		return $ret;
	}
}

?>