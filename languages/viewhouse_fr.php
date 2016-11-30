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
	
$title="Maisons e appartements de vacances au Portugal :: ".$tit.' à '.$input['cidade'];
$keywords="locations de vacances, maisons de vacances, appartement de vacances, maisons à louer, appartement à louer, vacances au Portugal, maisons de vacances au Portugal, appartements de vacances au Portugal";
$description="Découvrez d'incroyables locations pour vos vacances au Portugal. Vous consultez la propriété nº ".$id_house;

$monthNames = array('Janvier','Février','Mars','Avril','Mai','Juin',
'Juillet','Août','Septembre','Octobre','Novembre','Décembre');

$viewhouse_btnadddescription = "Guarder";

$viewhousetitle = 'Voir une propriété';
$viewhouse_yourhouses = 'Vos propriétés';
$viewhouse_consult = 'Consultation de propriété';
$viewhouse_description = 'Description';
$viewhouse_location = 'Localisation';
$viewhouse_photo = 'Photos';
$viewhouse_equipment = 'Equipements';
$viewhouse_pricing = 'Prix';
$viewhouse_owner = 'Propriétaires';
$viewhouse_availability = 'Disponibilité';

//Property list
$viewhouse_view = 'Additionnez un nouveau bien';
$viewhouse_published = 'Publié';
$viewhouse_unpublished = 'Non publié';

//picture
$viewhouse_picturedescription = 'Description de la photo';

//Location
$viewhouse_infodrag = 'Faites glisser les icônes sur la cartes pour situer votre bien';
$viewhouse_infodrag2 = 'Cliquez sur l&#039icone et faites le glisser si vous souhaitez changer sa position.';
$viewhouse_infodrag3 = 'Faites double click sur un icone pour le supprimer.';
$viewhouse_museum = 'Musée';
$viewhouse_monument = 'Monument';
$viewhouse_bar = 'Bar';
$viewhouse_park = 'Park';
$viewhouse_sport = 'Sport';
$viewhouse_restaurant = 'Restaurant';
$viewhouse_address = "Adresse : ";
$viewhouse_legend = "Legende : ";

//description
$viewhouse_type_house = 'Type de maison : ';
$viewhouse_reference = 'Réf. : ';
$viewhouse_title = 'Titre : ';
$viewhouse_shortdesc = 'Description courte: ';
$viewhouse_descriptiond = 'Description du bien : ';
$viewhouse_qt_people = 'Nombre max. d&#039occupants : ';
$viewhouse_nb_bedrooms = 'Nombre de chambres : '; 
$viewhouse_requestingdays = 'Demande concernant les jours suivants : ';
$viewhouse_share = 'Si vous aimez cette propriété, partagez-la!';

//pricing
$viewhouse_pricingtitle = 'Tarifs de location';
$viewhouse_pricingperiode = 'Période';
$viewhouse_pricingbegin = 'Début';
$viewhouse_pricingend = 'Fin';
$viewhouse_pricingmonth = 'Mois';
$viewhouse_pricingweek = 'Semaine';
$viewhouse_pricingweekend = 'Week-end';
$viewhouse_pricingweeknight = 'Nuitée en<br/> semaine';
$viewhouse_pricingweekendnight = 'Nuitée en<br/> week-end';
$viewhouse_pricingextranight = 'Nuitée<br/> extra';
$viewhouse_pricingminimalduration = 'Durée minimum';
$viewhouse_getpricetitle = 'Prix indicatifs à partir de la sélection :';
$viewhouse_getpricemonth = 'Pour de mois de ';
$viewhouse_getpriceweek = 'Pour la semaine du ';
$viewhouse_getpriceday = 'Pour le ';
$viewhouse_getpriceuntil = ' jusqu&#039au ';

//Calendar
$viewhouse_calendartitle = 'Disponibilité';

//Contact
$viewhouse_contacttitle = 'Contactez le propriétaire';
$viewhouse_contactname = 'Nom : ';
$viewhouse_contactemail = 'Email : ';
$viewhouse_contactenquiry = 'Votre question : ';
$viewhouse_requestingdays = 'Demande pour les jours suivants : ';
$viewhouse_captcha = 'Saisissez le texte de l&#039image : ';
$viewhouse_ownerspokenlanguages = 'Le propriétaire pourra vous répondre dans l&#039une de ces langues:';
$viewhouse_ownerspokenportuguese = 'Portuguais';
$viewhouse_ownerspokenenglish = 'Anglais';
$viewhouse_ownerspokenfrench = 'Français';


//Message
$viewhouse_error_type_house = 'Choisissez un type d&#039habitation!<br />';
$viewhouse_error_title = 'Vous devez saisir un titre!<br />';
$viewhouse_error_description = 'Vous devez introduire une description pour votre bien!<br />';
$viewhouse_error_qt_people = 'Saisissez le nombre maximun de personne peut loger!<br />';
$viewhouse_error_qt_bedrooms = 'Combien de chambres possède votre maison?<br />';
$viewhouse_error_insert = 'Erreur d&#039enregistrement des données!<br />';
$viewhouse_error_delpicture = 'Une erreur s&#039est produite em supprimant la photo!<br />';
$viewhouse_error_captcha = 'Le texte de l&#039image est différent de celui saisi.<br />';
$viewhouse_error_contactname = 'Vous devez introduire votre nom ou identifiez vous.<br/>';
$viewhouse_error_contactemail = 'Vous devez introduir votre email ou identifiez vous.<br/>';
$viewhouse_error_contactenquiry = 'Vous devez poser une question au propriétaire.<br/>';



$viewhouse_info_selecttypehouse = 'Selectionnez un type de maison';
$viewhouse_info_insert = 'Vos données ont été provisoirement sauvegardées<br />';
$viewhouse_info_delpicture = 'Cette photo a été correctement supprimée.<br />';

//comments
$viewhouse_commenttitle = 'Commentaires des visiteurs';
$viewhouse_commentlegend = 'Écrivez votre commentaire';
$viewhouse_commentrate = 'Évaluer cette maison';
$viewhouse_commentrate1 = 'Très faible';
$viewhouse_commentrate2 = 'Faible';
$viewhouse_commentrate3 = 'Ok';
$viewhouse_commentrate4 = 'Bon';
$viewhouse_commentrate5 = 'Très bon';
$viewhouse_commentdesc = 'Écrivez un commentaire: ';
$viewhouse_commentlogin = 'Vous devez entrez sur le site pour noter ou écrire un commentaire!';

//buttons
$viewhouse_btnsend = 'Envoyer';
$viewhouse_btnsave = 'Guarder';
$viewhouse_btnDelete = 'Supprimer';

//email
//sender
$viewhouse_subjectsend = 'Confirmation d&#039envoi de message';
$viewhouse_messagesend = '
<p>Votre message a été envoyé</p>
<p>Chère madame, cher monsieur,</p>
<p>Nous vous envoyons cet email pour confirmer l&#039envoi de votre message. Il sera communiqué au propriétaire dès sa validation effectuée.</p>
<p>Sincères salutations,</p>
<p>L&#039équipe RentingHolidayHouse</p>
';
//owner
$viewhouse_subjectowner = 'Confirmation de réception de message';
$viewhouse_messageowner = '
<p>Vous avez un nouveau message</p>
<p>Chère madame, cher monsieur,</p>
<p>Cet email vous est envoyé pour vous informé qu&#039un nouveau message vous a été envoyé par un client potentiel. Accédez à votre espace message et répondez aussitôt que possible.</p>
<p>Sincères salutations,</p>
<p>L&#039équipe RentingHolidayHouse</p>
';
?>