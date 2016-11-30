<?php
switch ($_GET['topic']) {
	case 'Ville':
		$title="Holiday houses to rent in major cities";
		$description="Find amazing vacation houses and apartments for your holidays in the urban areas of Portugal.";
		break;
	case 'Culture':
		$title="Houses to rent for your cultural holidays in Portugal";
		$description="Find amazing vacation houses and apartments for your cultural holidays in Portugal.";
		break;
	case 'Country field':
		$title="Houses to rent for your holidays in the country side of Portugal";
		$description="Find amazing vacation houses and apartments for your holidays in the rural area of Portugal.";
		break;
	case 'Mountain':
		$title="Houses to rent for your holidays in the mountains of Portugal";
		$description="Find amazing vacation houses and apartments for your holidays in the mountains of Portugal.";
		break;
	case 'Beach':
		$title="Houses to rent for your holidays on the beaches of Portugal";
		$description="Find amazing vacation houses and apartments for your holidays on the beaches of Portugal.";
		break;
	default: 
		$title="Holiday houses to rent organized by points of interest";
		$description="Find amazing vacation houses and apartments for your holidays in Portugal organized by different points of interest.";
		break;
}

$viewtopic_title = "Holiday house in Portugal organized by interests";
$searchpricefrom="From ";
$searchpricecurrencyfrommonth=" € per month";
$searchpricecurrencyfromweek=" € per week";
$searchpricecurrencyfromday=" € per day";

$viewtopic_home = 'House';
$viewtopic_museum = 'Museum';
$viewtopic_monument = 'Monument';
$viewtopic_bar = 'Bar';
$viewtopic_park = 'Park';
$viewtopic_sport = 'Sport';
$viewtopic_restaurant = 'Restaurant';
$viewtopic_legend = "Legend: ";
?>