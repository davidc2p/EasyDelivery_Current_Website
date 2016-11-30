<?php
$title="Create your account and earn extra money by renting your holiday house";
$keywords="holiday renting, holiday house, holiday apartments, holiday in Portugal, renting house";
$description="Find amazing houses for your holidays in Portugal. Register for free. Create an announcement for your holiday house or apartment for free and be visited by millions of potential customers";

$registerinfotitle = 'Register your account';
$registerinfo = 'If you want to create an announcement for your holiday house or apartment, this is where you should start. You also need to create an account in order to communicate with owners when you are interested in their porperties.<br/>
Creating an account and an announcement for your holiday house or apartment is free, and will remain like this.<br/><br/>As you create your account you will have to provide a nickname or your name, a valid email and a password of your choice, nothing else is required. Also note that the only information we will show on screen, in your renting announcement would be your name or nickname. All other information would be used for invoicing purposes only and will never be shown on screen.';

$registerlogintitle="Login";
$registerregistertitle="Register a new account";
$registerusername="Full Name: ";
$registeremail="Email: ";
$registeraddress="Address: ";
$registerzip="Zip code: ";
$registercity="City: ";
$registercountry="Country: ";
$registerpassword="Password: ";
$registerrepeatpassword="Repeat password: ";
$registerlanguage="Your language: ";
$registerlanguagerent="I will fill my rent announcement in: ";
$registerbtnregister="Register";
//tips
$registerremailqtip="Choose an email account (This email should be valid and will be used to login).";
$registeremailqtip="Fill your username in.";
$registerpasswordqtip="Fill your password in.";
$registerrpasswordqtip="Choose a password.";
$registerreapeatpasswordqtip="Fill again your password in.";
$registerusernameqtip="Fill your name or nickname in.";
$registeraddressqtip="Fill your address in (this is not mandatory).";
$registerzipqtip="Fill your zip code (this is not mandatory).";
$registercityqtip="Fill your city in (this is not mandatory).";
$registercountryqtip="Fill your country in (this is not mandatory).";
$registersiteqtip="Choose the language of the site.";
$registerrentqtip="Choose the languages which to fill your announcement in.";
//errors
$registererrorremail = "The Email you've supplied is not valid.<br/>";
$registererrorusername = "Fill your name in.<br/>";
$registererroraddress = "Fill your address in.<br/>";
$registererrorzip= "Fill your zip code in.<br/>";
$registererrorcity = "Fill your city in.<br/>";
$registererrorcountry = "Fill your country in.<br/>";
$registererrorrpassword = "Choose a password.<br/>";
$registererrorrrepeatpassword = "Write your password again.<br/>";
$registererrorrrepeatpasswordmatch = "Passwords don't match.<br/>";
$registererrorsendmail = "The registration is successful but the confimation Email has not been sent due to an error.<br/>";
$registererrorcaptcha = 'The image text is different from what you filled.<br />';
//info
$registerinfosendmail = "Check your email box for a confirmation letter.<br>You might also have to check your spam box.<br>If you don't receive the confirmation email within several hours, please <a href=\"contactus.php\"";
if (isset($_SESSION['lang'])) 
	{ $registerinfosendmail .= '/'.$_SESSION['lang']; }
$registerinfosendmail .= "\">contact us</a>, we will confirm your registration manually.";
//email
$registeremailconfirmationsubject = 'Answer this Email to end the Registration Process';
$registeremailconfirmationmessage1 = '
<p>Dear Madam/Sir</p>
<p>We wish to congratulate you for the successful registration on rentingholidayhouse.com website. You are almost a member. In order to complete your registration, we have sent you this Email so that we can confirm that there was no mistake when you digit it.</p>
<p>Please click on the following link in order to become a member.</p>
<p>---------------------------------------------------------<br>';
$registeremailconfirmationmessage2 = '
<br/>----------------------------------------------------------</p>
<br/>
<p>Case it is not possible to click on the link, you can still copy it into your browser and confirm your account directly from there.</p>
<p>Yours Faithfully,</p>
<p>The RentingHolidayHouse team</p>
';
?>