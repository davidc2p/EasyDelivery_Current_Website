<?php
switch ($_GET['topic']) {
	case 'Ville':
		$title="Locations de maisons de vacances à la ville";
		$description="Découvrez d'incroyables locations pour vos vacances au Portugal organisées par villes.";
		break;
	case 'Culture':
		$title="Locations de maisons pour des vacances culturelles";
		$description="Découvrez d'incroyables locations pour vos vacances au Portugal organisées par intérêt culturel.";
		break;
	case 'Campagne':
		$title="Locations de maisons pour des vacances à la campagne";
		$description="Découvrez d'incroyables locations pour vos vacances dans la campagne portugaise.";
		break;
	case 'Montagne':
		$title="Locations de maisons pour des vacances à la montagne";
		$description="Découvrez d'incroyables locations pour vos vacances à la montagne au Portugal.";
		break;
	case 'Plage':
		$title="Locations de maisons pour des vacances au bord de mer";
		$description="Découvrez d'incroyables locations pour vos vacances à la plage au Portugal.";
		break;
	default: 
		$title="Locations de vacances organisées para intérets";
		$description="Découvrez d'incroyables locations pour vos vacances au Portugal organisées par centres d'intérets.";
		break;
}
$keywords="locations de vacances, maisons de vacances, appartement de vacances, maisons à louer, appartement à louer, vacances au Portugal, maisons de vacances au Portugal, appartements de vacances au Portugal";

$viewtopic_title = "Maisons de vacances au Portugal organisées par intérets";
$searchpricefrom="À partir de ";
$searchpricecurrencyfrommonth=" € par mois";
$searchpricecurrencyfromweek=" € par semaine";
$searchpricecurrencyfromday=" € par jour";

$viewtopic_home = 'Maison';
$viewtopic_museum = 'Musée';
$viewtopic_monument = 'Monument';
$viewtopic_bar = 'Bar';
$viewtopic_park = 'Park';
$viewtopic_sport = 'Sport';
$viewtopic_restaurant = 'Restaurant';
$viewtopic_legend = "Legende: ";
?>