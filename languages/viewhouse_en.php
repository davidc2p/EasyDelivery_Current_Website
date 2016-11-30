<?php
if (!isset($input['title']))
	$tit = '';
else
	$tit = rawurldecode($input['title']);

if (!isset($input['cidade']))
	$input['cidade'] = '';

if (!isset($house->id_house))
	$id_house = '';
else	
	$id_house = $house->id_house;
	
$title="Vacation houses and apartments in Portugal :: ".$tit.' in '.$input['cidade'];
$keywords="holiday renting, holiday house, holiday apartments, renting a holiday house, renting a holiday apartment, holiday in Portugal, holiday houses in Portugal, holiday apartment in Portugal";
$description="Find amazing houses for your holidays in Portugal. You are viewing property nº ".$id_house;

$monthNames = array('January','February','March','April','May','June',
			'July','August','September','October','November','December');
$viewhouse_btnadddescription = "Save";

$viewhousetitle = 'View a property';
$viewhouse_yourhouses = 'Your properties';
$viewhouse_consult = 'View property';
$viewhouse_description = 'House description';
$viewhouse_location = 'Location';
$viewhouse_photo = 'Pictures';
$viewhouse_equipment = 'Equipments';
$viewhouse_pricing = 'Pricing';
$viewhouse_owner = 'Owner';
$viewhouse_availability = 'Availability';
$viewhouse_share = 'if you like this house, share it!';

//Property list
$viewhouse_view = 'Add a new property';
$viewhouse_published = 'Published';
$viewhouse_unpublished = 'Unpublished';

//picture
$viewhouse_picturedescription = 'Picture Description';

//description
$viewhouse_type_house = 'House type: ';
$viewhouse_reference = 'Ref.: ';
$viewhouse_title = 'Title: ';
$viewhouse_shortdesc = 'Short description: ';
$viewhouse_descriptiond = 'Description: ';
$viewhouse_qt_people = 'Max. number of people: ';
$viewhouse_nb_bedrooms = 'Number of bedrooms: '; 

//Location
$viewhouse_infodrag = 'Drag the markers to a new location on the map';
$viewhouse_infodrag2 = 'Click on marker and drag it if you want to move it to another location.';
$viewhouse_infodrag3 = 'Double click on marker to remove it.';
$viewhouse_museum = 'Museum';
$viewhouse_monument = 'Monument';
$viewhouse_bar = 'Bar';
$viewhouse_park = 'Park';
$viewhouse_sport = 'Sport';
$viewhouse_restaurant = 'Restaurant';
$viewhouse_address = "Address: ";
$viewhouse_legend = "Legend: ";

 

//pricing
$viewhouse_pricingtitle = 'Renting prices';
$viewhouse_pricingperiode = 'Period';
$viewhouse_pricingbegin = 'Begin';
$viewhouse_pricingend = 'End';
$viewhouse_pricingmonth = 'Month';
$viewhouse_pricingweek = 'Week';
$viewhouse_pricingweekend = 'Week end';
$viewhouse_pricingweeknight = 'Week night';
$viewhouse_pricingweekendnight = 'Week end night';
$viewhouse_pricingextranight = 'Extra night';
$viewhouse_pricingminimalduration = 'Minimal renting';
$viewhouse_getpricetitle = 'Price from current calendar selection:';
$viewhouse_getpricemonth = 'For the month ';
$viewhouse_getpriceweek = 'For the week from ';
$viewhouse_getpriceday = 'For the date ';
$viewhouse_getpriceuntil = ' until ';


//Calendar
$viewhouse_calendartitle = 'Availability';

//Contact
$viewhouse_contacttitle = 'Contact the owner';
$viewhouse_contactname = 'Name: ';
$viewhouse_contactemail = 'Email: ';
$viewhouse_contactenquiry = 'Your enquiry: ';
$viewhouse_requestingdays = 'Requesting the following days: ';
$viewhouse_captcha = 'Please enter the text from the picture: ';
$viewhouse_ownerspokenlanguages = 'The owner can answer in one of the following languages:';
$viewhouse_ownerspokenportuguese = 'Portuguese';
$viewhouse_ownerspokenenglish = 'English';
$viewhouse_ownerspokenfrench = 'French';


//Message
$viewhouse_error_type_house = 'You should select a house category!<br />';
$viewhouse_error_title = 'You should give a title to your rental!<br />';
$viewhouse_error_description = 'Please fill the description in!<br />';
$viewhouse_error_qt_people = 'How many people can be living in the house?<br />';
$viewhouse_error_qt_bedrooms = 'How many bedrooms are in the house?<br />';
$viewhouse_error_insert = 'An error occurred while saving your data!<br />';
$viewhouse_error_delpicture = 'An error occurred while removing the picture!<br />';
$viewhouse_error_captcha = 'The image text is different from what you filled.<br />';
$viewhouse_error_contactname = 'Please fill your contact name or log in.<br/>';
$viewhouse_error_contactemail = 'Please fill your email address or log in.<br/>';
$viewhouse_error_contactenquiry = 'Please enquire the owner of the house.<br/>';

$viewhouse_info_selecttypehouse = 'Select a type of house';
$viewhouse_info_insert = 'Your data have been kept.<br />';
$viewhouse_info_delpicture = 'This picture has been successfuly removed.<br />';

//comments
$viewhouse_commenttitle = 'Guest\'s comments';
$viewhouse_commentlegend = 'Make your own comment';
$viewhouse_commentrate = 'Rate this house';
$viewhouse_commentrate1 = 'Very poor';
$viewhouse_commentrate2 = 'Poor';
$viewhouse_commentrate3 = 'Ok';
$viewhouse_commentrate4 = 'Good';
$viewhouse_commentrate5 = 'Very good';
$viewhouse_commentdesc = 'Write your comment: ';
$viewhouse_commentlogin = 'You must be logged in to rate or write a comment about a house!';

//buttons
$viewhouse_btnsend = 'Send';
$viewhouse_btnsave = 'Save';
$viewhouse_btnDelete = 'Delete';

//email
//sender
$viewhouse_subjectsend = 'Message sending confirmation';
$viewhouse_messagesend = '
<p>Your message has been sent</p>
<p>Dear Madam/Sir</p>
<p>This email is sent in order to let you know that your message will be delivered to the property owner as soon as it is validated.</p>
<p>Yours Faithfully,</p>
<p>The RentingHolidayHouse.com Staff</p>
';
//owner
$viewhouse_subjectowner = 'Message reception confirmation';
$viewhouse_messageowner = '
<p>Your have a new message</p>
<p>Dear Madam/Sir</p>
<p>This email is sent in order to let you know that you have a new message from a customer. Access your message area and answer it as soon as possible.</p>
<p>Yours Faithfully,</p>
<p>The RentingHolidayHouse.com Staff</p>
';
?>