<?php
session_start();
/*
//logout
if (isset($_POST['navlogout']))
{
	if (isset($_SESSION['email']))
	{
		$db = mysql_connect ($config['hostname'],$config['admin'], $config['password']) or die('Database access denied!');
		mysql_select_db ($config['database'], $db);
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');	
		
		$query_string="update ".$config['prefix']."user set sessionid = '' where email=\"".$_SESSION['email']."\";";
		$response=mysql_query($query_string, $db);
	}
 	unset($_SESSION['authenticate']);
	unset($_SESSION['email']);
	unset($_SESSION['name']);
	unset($_SESSION['usertype']);
	unset($_SESSION['origin']);
	session_unset();
	session_destroy();
}

//try to login
if (isset($_POST['navloginok']))
{
	$defs = array(
		'navusername'  	=> array('filter'=>FILTER_SANITIZE_STRING,
							'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW),
		'navpassword'   => array('filter'=>FILTER_SANITIZE_STRING,
							'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW)
		);
 
	$input = filter_input_array(INPUT_POST, $defs);
	// check on that shit 1' or '1' = '1'		
		
	$ret_login = $user->authenticate($input['navusername'], md5($input['navpassword']));

	if (isset($_SESSION['authenticate']) && $_SESSION['authenticate'] == 'true' && isset($_SESSION['origin']))
		header("location: ".$_SESSION['origin']);
}

//try to login

if (isset($_POST['login']))
{
	$defs = array(
		'email'			  	=> array('filter'=>FILTER_SANITIZE_STRING,
							'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW),
		'password'		   	=> array('filter'=>FILTER_SANITIZE_STRING,
							'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW)
		);
 
	$input = filter_input_array(INPUT_POST, $defs);
	// check on that shit 1' or '1' = '1'		
		
	$ret_login = $user->authenticate($input['email'], md5($input['password']));
	
	if (isset($_SESSION['authenticate']) && $_SESSION['authenticate'] == 'true') {
		if (!isset($_SESSION['origin'])) {
			$_SESSION['origin'] =  $config['path']."addnewhouse";
				if (isset($_SESSION['lang'])) { 
					$_SESSION['origin'] .= '/'.$_SESSION['lang']; 
				}
		}
		header("location: ".$_SESSION['origin']);
        }
	else {
		$retorno = 1;
        }
}
*/	
if (!isset($_SESSION['lang'])) {
	$infoIP = Array();
	$infoIP = @unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
	//$infoIP = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=77.54.221.119'));
	//echo $infoIP['geoplugin_countryCode'];

	if (!isset($_SESSION['lang']) && isset($infoIP['geoplugin_countryCode']) && $infoIP['geoplugin_countryCode'] == 'PT')
		$_SESSION['lang'] = 'pt';
	else {
		if (!isset($_SESSION['lang']) && isset($infoIP['geoplugin_countryCode']) && $infoIP['geoplugin_countryCode'] == 'FR')
			$_SESSION['lang'] = 'fr';
		else
			$_SESSION['lang'] = 'en';
	}
}	


?>