<?php  
require_once 'session.php';
require_once 'EasyDelivery/class/GeoAlgorithm.class.php';
require_once 'EasyDelivery/class/generic.class.php';
require_once 'EasyDelivery/class/model.class.php';

//This requires login
if (!isset($_SESSION["authenticate"]) || $_SESSION["authenticate"]!='true')
header("location: login.php");


if (!isset($_SESSION['lang']))
$_SESSION['lang'] = 'pt';

require "languages/driver_".$_SESSION['lang'].".php";


// include db config class
require_once 'EasyDelivery/db/db_config.php';
$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');
$generic = new Generic(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');


$defs = array(
    'email'         => FILTER_VALIDATE_EMAIL,
    'password'      => array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW),
    'login'			=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW)
);


//retrieve the driver's list for the logged company 
$model->companyid = $_SESSION['companyid'];
$drivers=$model->getdrivers();
$input = filter_input_array(INPUT_POST, $defs);

if (isset($input['driver'])) {	
	$error  = ''; 	
	$info = ''; 	
	
	if (!$input['email']) {		
		$error  .= $loginemailqtip."<br/>";	
	} 	
	if (!$input['password']) {
		$error  .= $loginpasswordqtip."<br/>";	
	} 		
	if (isset($input['email']) && isset($input['password'])) {
        $model->email = $input['email'];			
		$model->password = $input['password'];					
		$model->login();				
		if ($model->error['success'] == 0) {			
			$error .= $model->error['message'];			
			unset($_SESSION['authenticate']);			
			unset($_SESSION['companyid']);			
			unset($_SESSION['driverid']);			
			unset($_SESSION['uid']);			
			unset($_SESSION['email']);			
			unset($_SESSION['creationdate']);			
			unset($_SESSION['drivername']);			
			unset($_SESSION['companyname']);			
			session_unset();			
			session_destroy();		
		} else {			
			$_SESSION['authenticate'] = 'true';			
			$_SESSION['companyid'] = $model->companyid;			
			$_SESSION['driverid'] = $model->driverid;			
			$_SESSION['uid'] = $model->uid;			
			$_SESSION['email'] = $model->email;			
			$_SESSION['creationdate'] = $model->creationdate;			
			$_SESSION['drivername'] = $model->drivername;			
			$_SESSION['companyname'] = $model->companyname;						
			header("location: index.html");		
		}	
	}
}
?>
<!DOCTYPE HTML>
<html lang="<?php print $_SESSION['lang'];?>">
<head>	
	<meta charset="UTF-8">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="generator" content="Mobirise v3.8.4, mobirise.com">	
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="shortcut icon" href="assets/images/easydelivery-logo-256-128x128-60.png" type="image/x-icon">	
	<meta name="description" content="">	
	<title>Register a new account</title>	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">	
	<link rel="stylesheet" href="assets/et-line-font-plugin/style.css">	
	<link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">	
	<link rel="stylesheet" href="assets/tether/tether.min.css">	
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">	
	<link rel="stylesheet" href="assets/socicon/css/socicon.min.css">	
	<link rel="stylesheet" href="assets/animate.css/animate.min.css">	
	<link rel="stylesheet" href="assets/dropdown/css/style.css">	
	<link rel="stylesheet" href="assets/theme/css/style.css">	
	<link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">	
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">		
	
	<style>		
	div { margin: 20px;	}		 		
	ul { list-style-type: none;	width: 500px; }
	h3 { font: bold 20px/1.5 Helvetica, Verdana, sans-serif; }		 		
	li.round img { float: left; margin: 0 15px 0 0; }		 		
	li.round p { font: 200 12px/1.5 Georgia, Times New Roman, serif; }		 		
	li.round { padding: 10px; overflow: auto; }		 		
	li.round:hover { background: #eee; cursor: pointer; }				
	.numberCircle {
		float: left; margin: 0 15px 0 0;
		font: 32px Arial, sans-serif;

		width: 2em;
		height: 2em;
		box-sizing: initial;
		
		background: #fff;
		border: 0.1em solid #666;
		color: #666;
		text-align: center;
		border-radius: 50%;    
		
		line-height: 2em;
		box-sizing: content-box;   
	}
	</style>
</head>
<body>
<noscript>
	<div class="message">	
		<em>Uhoh!</em>	Looks like you have JavaScript disabled... you'll need to turn it on to use the site properly! 	<a href="https://www.google.com/adsense/support/bin/answer.py?hl=en&amp;answer=12654">Find out how</a>
	</div>
</noscript>

<section id="menu-0">   
	<?php require_once 'nav.php'; ?>
</section>

<section class="mbr-section mbr-after-navbar" style="background-color: rgb(255, 255, 255); padding-top: 120px; padding-bottom: 0px;">
	<div class="mbr-section mbr-section__container mbr-section__container--middle">		
		<div class="container">			
			<div class="row">				
				<div class="col-xs-12 text-xs-center">					
					<h3 class="mbr-section-title display-2">Drivers</h3>					
					<small class="mbr-section-subtitle">Manage your drivers</small>				
				</div>			
			</div>		
		</div>	
	</div>	    
	<div class="mbr-section mbr-section-nopadding">        
		<div class="container">            
			<div class="row">                
				<div class="col-xs-12 col-lg-10 col-lg-offset-1">										
					<?php if (!empty($info)) { ?>                    
						<div class="row row-sm-offset">                        
							<div class="alert alert-form alert-success text-xs-center"><?php echo $info; ?></div>                    
						</div>					
					<?php } ?>
					<?php if (!empty($error)) { ?>
						<div class="row row-sm-offset">                        
							<div class="alert alert-form alert-danger text-xs-center"><?php echo $error; ?></div>
						</div>					
					<?php } ?>	
					
					<div class="row row-sm-offset">														
						<div class="col-xs-12 col-md-6 col-md-offset-3">								
							<ul>									
							<?php 
								foreach ($drivers as $d) { 
									print "<li class=\"round\" onclick=\"alert('a');\">";
									print "<div class=\"numberCircle\" style=\"font-size: 12px\">".$d["driverid"]."</div>";	
									print "<address>";
									print "<h3>".$d["drivername"]."</h3>"; 	
									print "<p>".$d["driveraddress"]."</p>"; 
									print "<p>".$d["email"]."</p>";
									print "</address>"; 
									print "</li>";
								}
							?>
							</ul>
						</div>
					</div>

					<div class="row row-sm-offset">
						<form id="formDriver" action="" method="post" class="form-horizontal" data-form-title="Driver">                        

						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-2">Company</label>
							<div class="col-xs-10 col-md-8 col-md-offset-2">
								<p class="form-control-static"><?php print $_SESSION["companyname"];?></p>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label col-xs-2">Email</label>
							<div class="col-xs-10 col-md-8 col-md-offset-2">
								<input type="text" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-10 col-md-8 col-md-offset-2">
								<input type="text" class="form-control" id="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-10 col-md-8 col-md-offset-2">
								<input type="text" class="form-control" id="rpassword" name="rpassword" placeholder="Repeat password">
							</div>
						</div>
						<div class="form-group">
							<label for="drivername" class="control-label col-xs-2">Driver name</label>
							<div class="col-xs-10 col-md-8 col-md-offset-2">
								<input type="text" class="form-control" id="drivername" name="drivername">
							</div>
						</div>
						<div class="form-group">
							<label for="driveraddress" class="control-label col-xs-2">Address<span class="form-asterisk">*</span></label>
							<div class="col-xs-10 col-md-6 col-md-offset-2">
								<input type="text" class="form-control" name="driveraddress" id="driveraddress">
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-md-offset-3">
							<button type="submit" name="create" class="btn btn-primary">CREATE</button>
						</div>
						</form>
					</div> 
				</div>
			</div>        
		</div>    
	</div>
</section>
	
<section class="mbr-footer mbr-section mbr-section-md-padding" id="contacts3-8" style="background-color: rgb(0, 0, 0); padding-top: 90px; padding-bottom: 90px;">
    <div class="row">
        <div class="mbr-company col-xs-12 col-md-6 col-lg-3">
            <div class="mbr-company card">
				<div><a href="#top"><img src="assets/images/easydelivery-logo-256-and-text-265x265-56.png" class="card-img-top"></a></div>
				<div class="card-block">
					<p class="card-text">Footer with solid color background and a contact form, Easily add subscribe and contact forms without any server-side integration.</p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<span class="list-group-icon"><span class="etl-icon icon-phone mbr-iconfont-company-contacts3"></span></span>
						<span class="list-group-text">+351 218518295</span>
					</li>
					<li class="list-group-item">
						<span class="list-group-icon"><span class="etl-icon icon-map-pin mbr-iconfont-company-contacts3"></span></span>
						<span class="list-group-text">Rua Cidade Vila Cabral, 42, 2esq - 1800-131 Lisboa</span>
					</li>
					<li class="list-group-item active">
						<span class="list-group-icon"><span class="etl-icon icon-envelope mbr-iconfont-company-contacts3"></span></span>
						<span class="list-group-text"><a href="mailto:support@mobirise.com">support@mobirise.com</a></span>
					</li>
				</ul>
			</div>

		</div>
		<div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
			<h4>Categories</h4>
			<ul><li>Home</li><li><span style="font-size: 0.875rem; line-height: 1.8;">Features</span></li><li><span style="font-size: 0.875rem; line-height: 1.8;">Prices</span></li><li><span style="font-size: 0.875rem; line-height: 1.8;">About</span></li><br><p></p></ul>
		</div>
		<div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
			<p><strong>Contacts</strong><br>Email: support@mobirise.com<br>Phone: +1 (0) 000 0000 001<br>Fax: +1 (0) 000 0000 002<br><br><br><strong>Address</strong><br>Rua Cidade Vila Cabral, 42, 2esq - 1800-131 Lisboa<br></p>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3" data-form-type="formoid">

			<div data-form-alert="true">
				<div hidden="" data-form-alert-success="true">Thanks for filling out form!</div>
			</div>

			<form action="contact.php" method="post" data-form-title="MESSAGE">

				<input type="hidden" value="hxjelILf0yY2sHAR/XucN9RLnaMAhinmbOMZqHsPENDm5RRv80TRF5KLDsGWROnOeSohvmidxxVy9T6a4v3sxW4vI2OPTOekOtEqTDZ5GBjKUKeeHh+Bb/kML4YuGfm4" data-form-email="true">

				<div class="form-group">
					<label class="form-control-label" for="contacts3-8-name">Name<span class="form-asterisk">*</span></label>
					<input type="text" class="form-control input-sm input-inverse" name="name" required="" data-form-field="Name" id="contacts3-8-name">
				</div>

				<div class="form-group">
					<label class="form-control-label" for="contacts3-8-email">Email<span class="form-asterisk">*</span></label>
					<input type="email" class="form-control input-sm input-inverse" name="email" required="" data-form-field="Email" id="contacts3-8-email">
				</div>
		

				<div class="form-group">
					<label class="form-control-label" for="contacts3-8-message">Message</label>
					<textarea class="form-control input-sm input-inverse" name="message" data-form-field="Message" rows="5" id="contacts3-8-message"></textarea>
				</div>

				<div><button type="submit" class="btn btn-sm btn-black">Contact us</button></div>

			</form>

		</div>
	</div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-7" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    <div class="container">
        <p class="text-xs-center">Copyright (c) 2016 Easy Delivery.</p>
    </div>
</footer>
<?php
if ($_SERVER['HTTP_HOST'] == 'localhost' || substr($_SERVER['HTTP_HOST'], 0, 9) == '127.0.0.1')
{ 
?>	
	<div>
		<?php
		print '<br/>controlo SESSION<br/>';
		
		foreach ($_SESSION as $key => $value) {
			print "$key=$value<br/>";
		}	
		print '<br/>controlo POST<br/>';
		$post = 0;
		
		foreach ($_POST as $key => $value) {
			print "$key=$value<br/>";
			$post = 1;
		  }
		  
		print '<br/>controlo FILES<br/>';
		foreach ($_FILES as $key => $value) {
			print "$key=$value<br/>";
			$post = 1;
		}

		?>

	</div>	
<?php
}
?>		

	<script src="assets/web/assets/jquery/jquery.min.js"></script>	
	<script src="assets/tether/tether.min.js"></script>	
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>	
	<script src="assets/smooth-scroll/SmoothScroll.js"></script>	
	<script src="assets/viewportChecker/jquery.viewportchecker.js"></script>	
	<script src="assets/dropdown/js/script.min.js"></script>
	<script src="assets/touchSwipe/jquery.touchSwipe.min.js"></script>
	<script src="assets/theme/js/script.js"></script>
	<script src="assets/formoid/formoid.min.js"></script>
	<input name="animation" type="hidden">
	
	<script>
	var email = document.getElementById("email");

	email.addEventListener("keyup", function (event) {
	  if (email.validity.typeMismatch) {
		email.setCustomValidity("This is not a correct email!");
	  } else {
		email.setCustomValidity("");
	  }
	});
	
	// Note: This example requires that you consent to location sharing when
	// prompted by your browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.

	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
		  center: {lat: -34.397, lng: 150.644},
		  zoom: 6
		});
		
		var geocoder = new google.maps.Geocoder();
		
		document.getElementById('getlocation').addEventListener('click', function() {
			geocodeAddress(geocoder, map);
		});
		
		var infoWindow = new google.maps.InfoWindow({map: map});

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
		  navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
			  lat: position.coords.latitude,
			  lng: position.coords.longitude
			};

			infoWindow.setPosition(pos);
			infoWindow.setContent('Location found.');
			map.setCenter(pos);
			
			//reverse geocode
			geocodeLatLng(geocoder, map, infoWindow, position.coords.latitude, position.coords.longitude)
			
		  }, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		  });
		} else {
		  // Browser doesn't support Geolocation
		  handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('companyaddress').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
			resultsMap.setZoom(11);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
			var longitudediv = jQuery('.longitude');
			var latitudediv = jQuery('.latitude');
			var latitude = results[0].geometry.location.lat();;
			var longitude  = results[0].geometry.location.lng();;
			longitudediv.html('Longitude: '+longitude);
			latitudediv.html('Latitude: '+latitude);
			document.getElementById('latitude').value = latitude;
			document.getElementById('longitude').value = longitude;
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    }
	
	function geocodeLatLng(geocoder, map, infowindow, latitude, longitude) {
        // var input = document.getElementById('latlng').value;
        // var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[1]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
			  
			document.getElementById('companyaddress').value = results[1].formatted_address;
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(map, marker);
			  
			var longitudediv = jQuery('.longitude');
			var latitudediv = jQuery('.latitude');
			var latitude = results[0].geometry.location.lat();;
			var longitude  = results[0].geometry.location.lng();;
			longitudediv.html('Longitude: '+longitude);
			latitudediv.html('Latitude: '+latitude);
			document.getElementById('latitude').value = latitude;
			document.getElementById('longitude').value = longitude;
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
	
	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
						  'Error: The Geolocation service failed.' :
						  'Error: Your browser doesn\'t support geolocation.');
	}
    </script>
	
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiLSmvTYCZ5W3kGz6onHHmAdxlV5gNPN0&callback=initMap"></script>
</body>
</html>