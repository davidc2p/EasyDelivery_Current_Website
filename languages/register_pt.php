<?php
$title="Arrendar casas de férias. Crie um anúncio para alugar a sua casa de férias";
$keywords="arrendar casas de férias, aluguer férias, casas de férias, apartamentos para férias, férias em Portugal, criar conta, alugar casa";
$description="Registe e coloque gratuitamente o seu anúncio em várias línguas para arrendar a sua casa de férias. O seu anúncio será potencialmente lido por milhões.";

$registerinfotitle = 'Arrendar casas de férias. Criação de uma conta';
$registerinfo = 'Se deseja arrendar a sua casa de férias e colocar gratuitamente um anúncio, deverá em primeiro lugar criar uma conta. É tambem necessário criar uma conta para poder responder a um anúncio e contactar um proprietário.<br/>
A criação da sua conta e do seu anúncio para arrendar casas de férias são grátis.<br/><br/>Para a criação da sua conta, apenas necessitamos do preenchimento de um nome ou alcunha, de um email válido e de uma palavra chave da sua escolha. Nenhuma informação adicional é obrigatória. Note ainda que a única informação a aparecer no ecrã será o seu nome ou alcunha, junto do seu anúncio de aluguer de casa de férias. Nenhuma das outras informações aparecerá no ecrã e terão apenas utilizadade em caso de facturação de serviços adicionais.';

$registerlogintitle="Login";
$registerregistertitle="Registar uma nova conta para arrendar casas de férias";
$registerusername="Nome: ";
$registeremail="Email: ";
$registeraddress="Morada: ";
$registerzip="Código postal: ";
$registercity="Cidade: ";
$registercountry="País: ";
$registerpassword="Palavra chave: ";
$registerrepeatpassword="Repetir palavra chave: ";
$registerlanguage="O seu idioma: ";
$registerlanguagerent="Quero inserir o meu anúncio em: ";
$registerbtnregister="Registar";
//tips
$registerremailqtip="Preenche a seu email de utilizador (este email deverá ser válido e irá servir para efectuar o login).";
$registeremailqtip="Preenche a seu nome de utilizador.";
$registerpasswordqtip="Preenche a sua palavra chave.";
$registerrpasswordqtip="Escolhe a sua palavra chave.";
$registerreapeatpasswordqtip="Preenche novamente a sua palavra chave.";
$registerusernameqtip="Preenche o seu nome completo ou se preferir uma alcunha.";
$registeraddressqtip="Preenche a sua morada (não é obrigatório).";
$registerzipqtip="Preenche o código postal da sua área de residência (não é obrigatório).";
$registercityqtip="Preenche o nome da sua cidade (não é obrigatório).";
$registercountryqtip="Preenche o seu país (não é obrigatório).";
$registersiteqtip="Escolhe o idioma no qual o site deverá aparecer após o login.";
$registerrentqtip="Escolhe um ou vários idiomas nos quais redigir o seu anúncio.";
//errors
$registererrorremail = "O seu Email não é válido.<br/>";
$registererrorusername = "Preenche o seu nome.<br/>";
$registererroraddress = "Preenche a sua morada.<br/>";
$registererrorzip= "Preenche o seu código postal.<br/>";
$registererrorcity = "Preenche a sua cidade.<br/>";
$registererrorcountry = "Preenche o seu país.<br/>";
$registererrorrpassword = "Escolhe uma palavra chave.<br/>";
$registererrorrrepeatpassword = "Escreve novamente a sua palavra chave.<br/>";
$registererrorrrepeatpasswordmatch ="As palavras chaves não correspondem.<br/>";
$registererrorsendmail = "As sua conta foi criada, mas o email de confirmação não foi enviado devido à problemas de ordem técnica.<br/>";
$registererrorcaptcha = 'O texto da imagem não foi correctamente digitado.<br />';
//info
$registerinfosendmail = "Deverá receber um email de confirmação da sua inscrição.<br>Se não receber este email, deverá olhar para a sua caixa de spam.<br>Se mesmo assim não receber o nosso email no prazo de algumas horas, <a href=\"contactus.php\"";
if (isset($_SESSION['lang'])) 
	{ $registerinfosendmail  .= '/'.$_SESSION['lang']; }
$registerinfosendmail .= "\">contacte-nos</a>, iremos confirmar manualmente a abertura da sua conta.";

//email
$registeremailconfirmationsubject = 'Responde a este email para finalizar o processo de registo.';
$registeremailconfirmationmessage1 = '
<p>A confirmar o registo</p>
<p>Caro(a) Senhor(a)</p>
<p>Antes de tudo, gostariamos de apresentar-lhe os parabéns pelo registo no site da Home Holidays. É quase membro da nossa comunidade. Para completar o processo de registo, enviamos-lhe um email para que possa confirmar que recebe as nossas comunicações.</p>
<p>Por favor, clique no endereço abaixo para confirmar o seu registo.</p>
<p>---------------------------------------------------------<br>';
$registeremailconfirmationmessage2 = '
<br/>----------------------------------------------------------</p>
<br/>
<p>Caso não consiga fazer clique no endereço acima, poderá copia-lo para a barra de endereços do seu browser efectuar a confirmação do registo por esta via.</p>
<p>Os nossos melhores cumprimentos,</p>
<p>A equipa RentingHolidayHouse</p>
';
?>