<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
	var $con;
	
    // constructor
    function __construct() {
        // connecting to database
        $this->con = $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once 'db_config.php';
		try {        
			// Connecting to mysql database
			//$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
			$con = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
		}
		catch(PDOException $ex) {
			print "An Error occurred: ".$ex->getMessage(); //user friendly message
		}

        // Selecting database
        //$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
 
        // returning connection cursor
        return $con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        //mysql_close();
		$this->con = null;
    }
 
}
 
?>
 

