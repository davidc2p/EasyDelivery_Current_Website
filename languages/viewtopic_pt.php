<?php
switch ($_GET['topic']) {
	case 'Cidade':
		$title="Aluguer para férias em cidades, casas e apartamentos de férias organisados pelo tema da cidade";
		$description="Descubra casas e apartamentos incríveis para as suas férias ligadas às cidades de Portugal. Consulta de casas com a temática da cidade.";
		break;
	case 'Cultura':
		$title="Aluguer para férias culturais, casas e apartamentos de férias organisados pelo tema da cultura";
		$description="Descubra casas e apartamentos incríveis para as suas férias ligadas à cultura de Portugal. Consulta de casas com a temática da cultura.";
		break;
	case 'Campo':
		$title="Aluguer para férias em meio rural, casas e apartamentos de férias organisados pelo tema do campo";
		$description="Descubra casas e apartamentos incríveis para as suas férias nos meios rurais de Portugal. Consulta de casas com a temática do campo.";
		break;
	case 'Montanha':
		$title="Aluguer para férias na montanha, casas e apartamentos de férias organisados pelo tema da montanha";
		$description="Descubra casas e apartamentos incríveis para as suas férias nas montanhas de Portugal. Consulta de casas com a temática da montanha.";
		break;
	case 'Praia':
		$title="Aluguer para férias de praia, casas e apartamentos de férias organisados pelo tema da praia";
		$description="Descubra casas e apartamentos incríveis para as suas férias nas praias de Portugal. Consulta de casas com a temática da praia.";
		break;
	default: 
		$title="Aluguer para férias, casas e apartamentos de férias organisados por temas";
		$description="Descubra casas e apartamentos incríveis para as suas férias em Portugal. Consulta organizada por centros de interesse.";
		break;
}
$keywords="aluguer férias, casas de férias, apartamentos para férias, casas para alugar, apartamentos para alugar, férias em Portugal, casas de férias em Portugal, apartamentos de férias em Portugal";

$viewtopic_title = "Casas de férias organizadas por ".$_GET['topic'];
$searchpricefrom="A partir de ";
$searchpricecurrencyfrommonth=" € por mês";
$searchpricecurrencyfromweek=" € por semana";
$searchpricecurrencyfromday=" € por dia";

$viewtopic_home = 'Casa';
$viewtopic_museum = 'Museu';
$viewtopic_monument = 'Monumento';
$viewtopic_bar = 'Bar';
$viewtopic_park = 'Parque';
$viewtopic_sport = 'Desporto';
$viewtopic_restaurant = 'Restaurante';
$viewtopic_legend = "Legenda: ";
?>