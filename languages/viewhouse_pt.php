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
	
$title="Casas e apartamentos de férias em Portugal".$tit.' em '.$input['cidade'];
$keywords="aluguer férias, casas de férias, apartamentos para férias, casas para alugar, apartamentos para alugar, férias em Portugal, casas de férias em Portugal, apartamentos de férias em Portugal";
$description="Descubra casas e apartamentos incríveis para as suas férias em Portugal. Está a consultar a propriedade nº. ".$id_house;

$monthNames = array('Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
		'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

$viewhouse_btnadddescription = "Guardar";

$viewhousetitle = 'Visualizar uma propriedade';
$viewhouse_yourhouses = 'As suas propriedades';
$viewhouse_consult = 'Ver propriedade';
$viewhouse_description = 'Descrição da casa';
$viewhouse_location = 'Localização do bem';
$viewhouse_photo = 'Fotos';
$viewhouse_equipment = 'Equipamentos';
$viewhouse_pricing = 'Preçario';
$viewhouse_owner = 'Proprietário';
$viewhouse_availability = 'Disponibilidade';
$viewhouse_share = 'Se gosta desta propriedade, partilhe!';

//Property list
$viewhouse_view = 'Adicione um novo bem';
$viewhouse_published = 'Publicado';
$viewhouse_unpublished = 'Não publicado';


//Location
$viewhouse_infodrag = 'Arraste os ícones sobre o mapa';
$viewhouse_infodrag2 = 'Faça clique no ícone e arraste-o para alterar a sua posição.';
$viewhouse_infodrag3 = 'Faça duplo clique sobre um ícone para elimina-lo.';
$viewhouse_museum = 'Museu';
$viewhouse_monument = 'Monumento';
$viewhouse_bar = 'Bar';
$viewhouse_park = 'Parque';
$viewhouse_sport = 'Desporto';
$viewhouse_restaurant = 'Restaurante';
$viewhouse_address = "Morada: ";
$viewhouse_legend = "Legenda: ";

//picture
$viewhouse_picturedescription = 'Descrição da foto';

//description
$viewhouse_type_house = 'Tipo de casa: ';
$viewhouse_reference = 'Ref.: ';
$viewhouse_title = 'Título: ';
$viewhouse_shortdesc = 'Descrição abreviada: ';
$viewhouse_descriptiond = 'Descrição do bem: ';
$viewhouse_qt_people = 'Número de ocupantes: ';
$viewhouse_nb_bedrooms = 'Número de quartos: '; 

//pricing
$viewhouse_pricingtitle = 'Preços de aluguer';
$viewhouse_pricingperiode = 'Período';
$viewhouse_pricingbegin = 'Início';
$viewhouse_pricingend = 'Fim';
$viewhouse_pricingmonth = 'Mês';
$viewhouse_pricingweek = 'Semana';
$viewhouse_pricingweekend = 'Fim de<br/> semana';
$viewhouse_pricingweeknight = 'Noite de<br/> semana';
$viewhouse_pricingweekendnight = 'Noite fim<br/> de semana';
$viewhouse_pricingextranight = 'Noite extra';
$viewhouse_pricingminimalduration = 'Estadia mínima';
$viewhouse_getpricetitle = 'Preços a partir da selecção no calendário :';
$viewhouse_getpricemonth = 'Para o mês de ';
$viewhouse_getpriceweek = 'Para a semana do ';
$viewhouse_getpriceday = 'Para o dia ';
$viewhouse_getpriceuntil = ' até ao ';

//Calendar
$viewhouse_calendartitle = 'Disponibilidades';

//Contact
$viewhouse_contacttitle = 'Contacte o proprietário';
$viewhouse_contactname = 'Nome: ';
$viewhouse_contactemail = 'Email: ';
$viewhouse_contactenquiry = 'O seu pedido: ';
$viewhouse_requestingdays = 'Pedido para os seguintes dias: ';
$viewhouse_captcha = 'Digite o texto da imagem: ';
$viewhouse_ownerspokenlanguages = 'O proprietário poderá responder nos seguintes idiomas:';
$viewhouse_ownerspokenportuguese = 'Português';
$viewhouse_ownerspokenenglish = 'Inglês';
$viewhouse_ownerspokenfrench = 'Francês';


//Message
$viewhouse_error_type_house = 'Selecione um tipo de habitação!<br />';
$viewhouse_error_title = 'Deverá acrescentar um título!<br />';
$viewhouse_error_description = 'Preenche a descrição da sua casa!<br />';
$viewhouse_error_qt_people = 'Digite quantas pessoas pode receber o seu bem<br />';
$viewhouse_error_qt_bedrooms = 'Quantos quartos tem a sua casa?<br />';
$viewhouse_error_insert = 'Erro na gravação dos seus dados!<br />';
$viewhouse_error_delpicture = 'Erro na remoção da foto!<br />';
$viewhouse_error_captcha = 'O texto da imagem não foi correctamente digitado.<br />';
$viewhouse_error_contactname = 'Preenche o seu nome ou identifique-se.<br/>';
$viewhouse_error_contactemail = 'Preenche o seu email ou identifique-se.<br/>';
$viewhouse_error_contactenquiry = 'Deve colocar uma pergunta ao proprietário.<br/>';


$viewhouse_info_selecttypehouse = 'Seleccione um tipo de casa';
$viewhouse_info_insert = 'Os seus dados foram provisoriamente guardados.<br />';
$viewhouse_info_delpicture = 'A foto foi correctamente apagada.<br />';

//comments
$viewhouse_commenttitle = 'Comentários dos visitantes';
$viewhouse_commentlegend = 'Escreve o seu comentário';
$viewhouse_commentrate = 'Avaliar esta casa';
$viewhouse_commentrate1 = 'Muito fraco';
$viewhouse_commentrate2 = 'Fraco';
$viewhouse_commentrate3 = 'Ok';
$viewhouse_commentrate4 = 'Bom';
$viewhouse_commentrate5 = 'Muito bom';
$viewhouse_commentdesc = 'Escreve um comentário: ';
$viewhouse_commentlogin = 'Deverá entrar no site para escrever um comentário!';

//buttons
$viewhouse_btnsend = 'Enviar';
$viewhouse_btnsave = 'Gravar';
$viewhouse_btnDelete = 'Apagar';

//email
//sender
$viewhouse_subjectsend = 'Confirmação de envio de mensagem';
$viewhouse_messagesend = '
<p>A sua mensagem foi enviada</p>
<p>Caro(a) Senhor(a),</p>
<p>Este email foi enviado para confirmar o envio da sua mensagem. Será comunicado logo após a validação pelos nossos serviços.</p>
<p>Os nossos melhores cumprimentos,</p>
<p>A equipa RentingHolidayHouse</p>
';
//owner
$viewhouse_subjectowner = 'Confirmação de envio de mensagem';
$viewhouse_messageowner = '
<p>Recebeu uma nova mensagem</p>
<p>Caro(a) Senhor(a),</p>
<p>Este email foi enviado para informar de um novo contacto de um cliente potencial. Por favor acede ao seu espaço utilizador e responde o mais rapidamente possível.</p>
<p>Os nossos melhores cumprimentos,</p>
<p>A equipa RentingHolidayHouse</p>
';
?>