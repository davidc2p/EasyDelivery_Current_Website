<?php
$title="Créez votre compte. Enregistrez gratuitement votre maison de vacances";
$keywords="locations de vacances, maisons de vacances, appartement de vacances, vacances au Portugal, location maison";
$description="Découvrez d'incroyables locations pour vos vacances au Portugal. Créez votre compte et enregistrez gratuitement votre maison de vacances.";

$registerinfotitle = 'Créer votre compte';
$registerinfo = 'Si vous souhaitez créer une annonce pour votre appartement ou votre maison de vacances au Portugal, vous devez d&#039abord créer un compte. Vous devez également créer un compte si vous souhaitez répondre à une annonce et contacter un propriétaire.
La création d&#039un compte ainsi que l&#039enregistrement d&#039une annonce pour votre maison de vacances sont gratuit. <br/><br/>Pour la création de votre compte, nous vous demandons seulement de saisir un nom ou un surnom, un email valide et un mot de passe de votre choix. Aucune autre information n&#039est nécessaire. Notez également que la seule information affichée à l&#039écran, sur votre annonce, sera votre nom ou surnom. Toute autre information n&#039est utile qu&#039en cas de facturation.';

$registerlogintitle="Login";
$registerregistertitle="Se cadastrer";
$registerusername="Prénom, nom: ";
$registeremail="Email: ";
$registeraddress="Adresse: ";
$registerzip="Code Postal: ";
$registercity="Ville: ";
$registercountry="Pays: ";
$registerpassword="Mot de passe: ";
$registerrepeatpassword="Répéter mot de passe: ";
$registerlanguage="Votre langue: ";
$registerlanguagerent="Je saisie mon annonce en : ";
$registerbtnregister="Enregistrer";
//tips
$registerremailqtip="Choisissez un email d&#039utilisateur (cet email devra être valide et sera utilisé pour effectuer le login).";
$registeremailqtip="Écrivez votre email.";
$registerpasswordqtip="Écrivez votre not de passe.";
$registerrpasswordqtip="Choisissez votre mot de passe.";
$registerreapeatpasswordqtip="Remplissez à nouveau votre mot de passe.";
$registerusernameqtip="Écrivez vos nom et prénom.";
$registeraddressqtip="Remplissez votre addresse (ce n&#039est pas obligatoire).";
$registerzipqtip="Saisissez votre code postal (ce n&#039est pas obligatoire).";
$registercityqtip="Saisissez votre localité de résidence (ce n&#039est pas obligatoire).";
$registercountryqtip="Remplissez votre pais (ce n&#039est pas obligatoire).";
$registersiteqtip="Choisissez la langue dans laquelle votre site devra apparaitre après avoir fait le login.";
$registerrentqtip="Choisissez les langues dans lesquelles rédiger votre annonce.";
//errors
$registererrorremail = "Votre email est invalide.<br/>";
$registererrorusername = "Remplissez votre nom.<br/>";
$registererroraddress = "Remplissez votre adresse.<br/>";
$registererrorzip= "Remplissez votre code postal.<br/>";
$registererrorcity = "Saisissez votre ville de résidence.<br/>";
$registererrorcountry = "Saisissez votre pais.<br/>"; 
$registererrorrpassword = "Choisissez um mot de passe.<br/>";
$registererrorrrepeatpassword = "Écrivez à nouveau votre mot de passe.<br/>";
$registererrorrrepeatpasswordmatch = "Les deux mots de passe ne correspondent pas.<br/>";
$registererrorsendmail = "Votre compte vient d'être créé, toutefois un problème technique nous empêche d&#039envoyer l&#039email de confirmation.<br/>";
$registererrorcaptcha = 'Le texte de l&#039image est différent de celui saisi.<br />';
//info
$registerinfosendmail = "Vous devez recevoir un email de confirmation de votre inscription.<br>Si vous ne recevez pas cet email, vous devrez regarder dans votre boite spam.<br>Si toutefois vous ne recevez pas notre email de confirmation dans la prochaine heure, <a href=\"contactus.php\";
if (isset($_SESSION['lang']))
	{ $registerinfosendmail  .= '/'.$_SESSION['lang']; }
$registerinfosendmail .= "\">contactez nous</a>, nous confirmerons votre enregistrement manuellement.";
//email
$registeremailconfirmationsubject = 'Répondez à ce courriel pour finaliser la processus d&#039enregistrement';
$registeremailconfirmationmessage1 = '
<p>Confirmation de création de compte</p>
<p>Chère Madame, cher Monsieur</p>
<p>Nous vous félicitons pour la création de votre compte sur le site RentingHolidayHouse. Vous êtes presque l&#039un de nos membres. Pour finaliser la création de votre compte, nous vous demandons de confirmer votre email em cliquant sur le lien ci-dessous, afin de confirmer qu\'il s\'agit bien de votre email.</p>
<p>Cliquer sur le lien ci-dessous.</p>
<p>---------------------------------------------------------<br>';
$registeremailconfirmationmessage2 = '
<br/>----------------------------------------------------------</p>
<br/>
<p>Au cas oú il ne serait pas possible de suivre le lien ci-dessus, vous pourrez le copier sur votre browser et effectuer la confirmation de votre compte de cette manière.</p>
<p>Sincères salutations,</p>
<p>L&#039équipe RentingHolidayHouse</p>
';
?>