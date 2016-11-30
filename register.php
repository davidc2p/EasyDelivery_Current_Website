<?php 
require_once('session.php'); 
require_once('EasyDelivery/class/GeoAlgorithm.class.php');
require_once('EasyDelivery/class/generic.class.php');
require_once('EasyDelivery/class/model.class.php');

if (!isset($_SESSION['lang']))
	$_SESSION['lang'] = 'pt';

require "languages/register_".$_SESSION['lang'].".php";	

// include db config class
require_once 'EasyDelivery/db/db_config.php';
$model = new Model(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');
$generic = new Generic(DB_SERVER, DB_DATABASE, DB_USER, DB_PASSWORD, 'ed_');

$defs = array(
	'email'     		=> FILTER_VALIDATE_EMAIL,
	'password'			=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW),
	'companyname'		=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),			
	'companyaddress'	=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),			
	'industry'			=> array('filter'=>FILTER_SANITIZE_NUMBER_INT),							
	'latitude'			=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),							
	'longitude'			=> array('filter'=>FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),							
	'rpassword'		  	=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW),
	'register'			=> array('filter'=>FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_HIGH |FILTER_FLAG_STRIP_LOW)										
);

$input = filter_input_array(INPUT_POST, $defs);			
if (isset($input['register'])) 
{
	$error  = ''; 
	$info = ''; 

	if (!$input['companyname'])
	{
		$error  .= $registererrorusername;
	}

	if (!$input['companyaddress'])
	{
		$error  .= $registererroraddress;
	}
	
	if (!$input['password'])
	{
		$error  .= $registererrorrpassword;
	} else {
		if (!$input['rpassword'])
		{
			$error  .= $registererrorrrepeatpassword;
		} else {
			if ($input['rpassword'] != $input['password'])
			{
				$error  .=  $registererrorrrepeatpasswordmatch;
			}
		}
	}
	
	if ($error == '')
	{
		// require_once(dirname(__FILE__).'/class/recaptchalib.php');
	  	// $privatekey = "6LchkN4SAAAAADR6Z8JhgGARYxTnKrTi4d6APtLl";
	  	// $resp = recaptcha_check_answer ($privatekey,
	                                // $_SERVER["REMOTE_ADDR"],
	                                // $_POST["recaptcha_challenge_field"],
	                                // $_POST["recaptcha_response_field"]);
									
		// if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
			// //your site secret key
			// $secret = '6Lft7AoUAAAAAHZ5WQyTBX4JF_ForrpazJnLHqSb';
			// //get verify response data
			// $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			// $responseData = json_decode($verifyResponse);
			// if(!$responseData->success) {
				// $error .= 'Robot verification failed, please try again.';
			// } else {
				// $error .= 'Please click on the reCAPTCHA box.';
			// }
		// }
		
		//if ($responseData->success) {
			if (isset($_POST['email']) && isset($_POST['industry']) && isset($_POST['password']) && isset($_POST['rpassword']) && isset($_POST['companyname']))
			{
				$model->email = $input['email'];	
				$model->industry = $input['industry'];	
				$model->password = $input['password'];	
				$model->companyname = $input['companyname'];	
				$model->companyaddress = $input['companyaddress'];	
				$model->latitude = $input['latitude'];	
				$model->longitude = $input['longitude'];	
				
				$model->register();
				
				if ($model->error['success'] == 0) {
					$error .= $model->error['message'];
				} else {
					$info .= $model->error['message'].'<br/>';
				}
				
				//send email
				if ($error == '') {
					$message = $registeremailconfirmationmessage1;
					$message .= 'http://easydeliveryed.eu.pn/registerconfirmation/'.$model->token; 
					$message .= $registeremailconfirmationmessage2;
					$subject = $registeremailconfirmationsubject;
// print 'message: '.$message.'<br/>';
// print 'subject: '.$subject.'<br/>';
// print 'model->email: '.$model->email.'<br/>';
					$a = $generic->sendmail($model->email, $subject, $message);
					if ($a)
					{
						$info  .= $registerinfosendmail;
					}
					else
					{
						$info  .= $registererrorsendmail;
					}
				}
				
			} else {
				$error .=  "Input data are not correctly formatted.";	
			}
		//} else {
		//	 $error = $registererrorcaptcha;
		//}	
	}
}
?>
<!DOCTYPE HTML>
<html lang="<?php print $_SESSION['lang']; ?>">
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

</head>
<body>
<noscript>
<div class="message">
	<em>Uhoh!</em>
	Looks like you have JavaScript disabled... you'll need to turn it on to use the site properly! 
	<a href="https://www.google.com/adsense/support/bin/answer.py?hl=en&amp;answer=12654">Find out how</a>
</div>
</noscript>

<section id="menu-0">
	<?php require_once('nav.php'); ?>
</section>

<section class="engine"><a rel="external" href="https://mobirise.com">mobile web page maker software</a></section><section class="mbr-section mbr-after-navbar" id="form1-g" style="background-color: rgb(255, 255, 255); padding-top: 120px; padding-bottom: 0px;">
    
	<div class="mbr-section mbr-section__container mbr-section__container--middle">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-xs-center">
					<h3 class="mbr-section-title display-2">Register</h3>
					<small class="mbr-section-subtitle">Register your company</small>
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
					
                    <form id="formRegister" action="" method="post" data-form-title="Register">

                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-name">Company Name<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="companyname" required data-form-field="Name" id="companyname">
                                </div>
                            </div>

							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<div id="map">
									<span class="helper">Click the button below to show your location on the map</span>
									<img id="preloader" src="assets/images/257.gif">
								</div>
							</div> 

							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<br/><br/>
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-address">Company Address<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="companyaddress" required data-form-field="Address" id="companyaddress">
                                </div>
							</div>

							<div class="col-xs-12 col-md-6 col-md-offset-3">	
								<button id="getlocation" class="btn btn-primary">Find My Location</button>

								<div id="results">
									<input type="hidden" id="latitude" name="latitude" />
									<input type="hidden" id="longitude" name="longitude" />
									<span class="latitude"></span><br>
									<span class="longitude"></span><br>
									<span class="location"></span>
								</div>
									 
							</div>
							
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-industry">Describe your industry<span class="form-asterisk">*</span></label>
									<input list="industry" name="industry" required class="form-control" data-form-field="Industry" />
									<datalist id="industry">
										<option data-value="1">Food</option>
										<option data-value="2">Beverages</option>
										<option data-value="3">Toys</option>
										<option data-value="4">Multimedia</option>
										<option data-value="5">Flowers</option>
										<option data-value="6">Clothes</option>
										<option data-value="99">Other</option>
									</datalist >
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-email">Email<span class="form-asterisk">*</span></label>
                                    <input type="email" class="form-control" name="email" required placeholder="Enter a valid email address" data-form-field="Email" id="email">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-phone">Password</label>
                                    <input type="password" class="form-control" name="password" data-form-field="Password" id="password" pattern=".{8,}" required title="8 characters minimum">
                                </div>
                            </div>
							
							<div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-g-phone">Repeat password</label>
                                    <input type="password" class="form-control" name="rpassword" data-form-field="Password" id="rpassword">
                                </div>
                            </div>
							
							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<!-- reCaptcha -->
								<script src='https://www.google.com/recaptcha/api.js'></script>
								<div class="g-recaptcha" data-sitekey="6Lft7AoUAAAAAPTzcZKmfFQ5Od__cL-GO_K3vbj3"></div>
							</div>
							
							<div class="col-xs-12 col-md-6 col-md-offset-3"><button type="submit" name="register" class="btn btn-primary">REGISTER</button></div>
                        </div>
                    </form>
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
		print '<br/>ERROR LEVEL'.$ret;
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


		if ($post == 0)  
		{
			$newid = $house->getnewid();
			print "New id: ".$newid."<br/>";
		}

		print '<br/><br/>HOUSE DEBUG';
		PRINT $house->debug;

		print '<br/><br/>EQUIPMENT DEBUG';
		PRINT $equipment->debug;

		print '<br/><br/>user DEBUG';
		PRINT $user->debug;

		print '<br/><br/>pricing DEBUG';
		PRINT $pricing->debug;	

		print '<br/><br/>reservation DEBUG';
		PRINT $reservation->debug;

		print '<br/><br/>location DEBUG';
		PRINT $location->debug;	
		
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
