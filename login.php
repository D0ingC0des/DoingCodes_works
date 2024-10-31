<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if (!isset($_SESSION)) {
    session_start();
}

$conn = "_scripts/_publica_scripts/_php/conecta_sql.php";

if(file_exists($conn)){
	
	include_once($conn);
	
} 

@$login = isset($_POST['login'])? $_POST['login'] : $_GET['login'];
@$senha = isset($_POST['senha'])? $_POST['senha'] : $_GET['senha'];

@$logar = $_GET['logar'];

$nomePc = getenv("USERNAME");

date_default_timezone_set("America/Sao_Paulo");
$dataLimpa = date("dmY", time());
$horaLimpa = date("Hi", time());


if(!$conecta){
	
	echo("<big>Ooopps! Ocorreu um erro ao conectar o banco de dados!</big><br />");
	exit();
	
} 

if(file_exists("Scripts/funcoes.php")){
	include_once("Scripts/funcoes.php");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="pt-br" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="cache-control" content="no-store" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="robot" content="noindex, nofollow" />
<meta name="robot" content="nosnippet, noarchive, noimageindex" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="copyright" content="Kyocerah(W26R10VN78)" />
<title>Sistema de controle de portaria e encomendas (SCPE-wb)</title>
<link rel="shortcut icon" type="image/x-icon" href="imagem/_icon/scpe_favicon.ico" />
<style type="text/css">
html, body {
	width: 100vw;
	height: 100vh;
	overflow: hidden;
	margin: 0px;
}
body {
	font-family: Verdana;
	color: #000000;
}
#avisoLogin {
	font-family: Verdana;
	font-size: 10px;
	font-weight: bold;
	color: red;
	border: 1px solid #000000;
	background-color: white;
	padding: 1px;
}
#logo {
	padding: 2px;
	border: 0px;
}
#nick, #pass {
	padding: 1px;
	background-color: #E3E3D5;
	border: 0px;
	width: 15%;
	font-family: Calibri;
	font-size: 14px;
	font-weight: bold;
	float:left;
}
#nickCampo, #passCampo {
	width: 83%;
	padding: 1px;
	background-color: #ffffff;
	border: 0px;

}
small {
	font-size: 12px;
	font-family: Calibri;
}
input {
	border: 1px black solid;
	font-family: Verdana;
	font-size: 14px;
	border-radius: 2px 2px 2px 2px;
	width: 300px;
	padding: 8px;
}
button {
	border: 1px olive solid;
	font-family: "Courier New";
	font-weight: bold;
	font-size: 14px;
	width: 200px;
	height: 50px;
}
.div-especial {
	font-family: Verdana;
	font-size: 10px;
	font-weight: normal;
	font-style: italic;
	color: #000000;
	vertical-align: text-bottom;
	text-align: justify;
	background-color: #F2F2F2;
	border: thin dotted #808080;
	padding: 1px;
	margin: 0px;
	position: absolute;
    bottom: 0;
	width: 100%;
	top: 93vh;
	height: 60px;
}
#logoSCPE {
	width: 100vw;
	border: 0px;
}
</style>
</head>

<body>
<center>
	<div id="logo_scpe-wb">
	<img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" />
	</div>
	<br />&nbsp;
<?php
if($logar == NULL){

	session_destroy();

?>
	<form method="post" action="?logar=send" enctype="application/x-www-form-urlencoded" id="formLogin">
		<div id="camposLogin" align="left" style="vertical-align:middle; width: 400px">
			<div id="avisoLogin">Por favor, efetue o login para iniciar sua jornada de trabalho!</div>
			<br />&nbsp;
			<div id="nick">Usuário</div>
			<div id="nickCampo">
				<input type="text" id="login" name="login" value="" size="10" maxlength="11" />
				<small>Digite seu CPF com 11 digitos, apenas numeros!</small>
			</div>
			<br />&nbsp;
			<div id="pass">Senha</div>
			<div id="passCampo">
				<input type="password" id="senha" name="senha" value="" size="1" maxlength="4" />
				<small>Digite sua senha, somente 4 digitos!</small>
			</div>
			<br />&nbsp;
			<div id="botoes" align="center">
				<button type="submit">Logar</button><br />&nbsp;
			</div>
			<div id="avisoLogin"><b>Atenção!</b> O sistema desconecta o usuário automaticamente as 7 e às 19 hrs, para que o próximo usuario efetue login.</div>
		</div>
	</form> 
</center>
<?php
} else if($logar == "send") { //Processa login
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		/*$_SESSION['registro'] = "";
		$_SESSION['nivel'] = "";
		$_SESSION['idLogin'] = "";
		$_SESSION['nome'] = "";*/
		
		$sqlLogin = "SELECT * FROM cadporteiro WHERE cpf='$login' AND Senha='$senha' AND Ativo='S'";
		$executa = mysqli_query($conecta, $sqlLogin) or die(mysqli_error());
		$resultado = mysqli_num_rows($executa);
		
		if($resultado == 1){
			
			//Valida o login
			/*
			$checaAtivo = "SELECT cadporteiro.*, controlelogin.* FROM cadporteiro INNER JOIN controlelogin ON cadporteiro.registro = controlelogin.registroPorteiro ";
			$checaAtivo .= "WHERE (cadporteiro.cpf = '$login') AND (controlelogin.dataLogin = '$dataLimpa') AND (cadporteiro.registro = controlelogin.registroPorteiro) AND (controlelogin.loginAtivo = 'S')";
			$execAtivo = mysqli_query($conecta, $checaAtivo);
			$checaAtivoNum = mysqli_num_rows($execAtivo);
			
			if($execAtivo ==  true){
				echo ("Você já está logado! Não será necessário logar novamente.");
				sleep(10);
				header("location: index.php");
				exit();
			} 
			*/
			
			//Passa os dados para session
			while($user = mysqli_fetch_array($executa, MYSQLI_ASSOC)){

				echo("Olá <b>" . $user['Nome'] . "</b>, você foi logado com sucesso!<br />Aguarde redirecionamento para a area de trabalho!<br />Bom expediente!");
				echo("<br />Aguarde o redirecionamento...");
				$_SESSION['registro'] = $user['registro'];
				$_SESSION['nivel'] = $user['nivel'];
				$_SESSION['nome'] = $user['Nome'];
				$_SESSION['codigo'] = $user['codigo'];
				//print_r($_SESSION);

			}
			mysqli_free_result($executa);
			
			//Registra o login
			$sqlRegLogin = "INSERT INTO controlelogin (registroPorteiro, nomePorteiro, nomePc, dataLogin, horaLogin, nivelUser, loginAtivo) VALUES ('".$_SESSION['registro']."','".$_SESSION['nome']."','$nomePc','$dataLimpa','$horaLimpa','".$_SESSION['nivel']."','S')";
			if(mysqli_query($conecta, $sqlRegLogin)){
				//Apos registrar, pega o id do login e passa na session
				$sqlChecaAtivo = "SELECT * FROM controlelogin WHERE dataLogin='$dataLimpa' AND loginAtivo='S'";
				$executaCheck = mysqli_query($conecta, $sqlChecaAtivo) or die(mysqli_error());
				while($pegaID = mysqli_fetch_array($executaCheck, MYSQLI_ASSOC)){
					$_SESSION['idLogin'] = $pegaID['idLogin'];
				}
				mysqli_free_result($executaCheck);
			} else {
				die(mysqli_error());
			}
			
?>		
<div id="timer"></div>
<script language="javascript" type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
        } else if(--timer == 0){
        	//document.getElementById("timer").innerHTML = "terminou";
        	window.location.replace("index.php");
        }
    }, 1000);
}
window.onload = function () {
    var duration = 30; // Converter para segundos 60 * 5 (O 5 são minutos, pode alterar)
        display = document.querySelector('#timer'); // selecionando o timer
    startTimer(duration, display); // iniciando o timer
};
</script>
<?php
			
		} else {
			
			//Relata os possiveis erros de login						
			if($resultado == 0){			
				echo ("<div id=\"avisoLogin\">");
				echo ("<big>Acesso negado!</big><br />");
				echo ("Seu acesso não foi autorizado, as possiveis causas podem ser:<br />");
				echo ("- Usuário ou senha inválidos!<br />");
				echo ("- Você não possui mais permissão para acessar o sistema. Por favor consulte a administração.<br />");
				echo ("- Confira se seu CPF foi digitado corretamente, não use traço!<br />");
				echo ("- Confira se sua senha foi digitada corretamente, ela é os quatro digitos finais de seu celular.");
				echo ("<hr size='1' />");
				echo ("<a href='#' onclick='javascript:window.history.back();'>Voltar e tentar novamente</a>");
				echo ("</div>");
			} 
			
		}
	}
} else if($logar == "out") { //Faz o logout do usuario e destoi a sessao
	$sqlDestivaLogin = "UPDATE controlelogin SET horaLogout='$horaLimpa', loginAtivo='N' WHERE idLogin='".$_SESSION['idLogin']."' AND dataLogin='$dataLimpa' AND loginAtivo='S'";
	$fazLogOut = mysqli_query($conecta, $sqlDestivaLogin) or die(mysqli_error());
	
	if($fazLogOut == true){
		$msg = "<big>Funcionário deslogado com sucesso!</big><br />";
		$msg .= "Agradeçemos pelo seu esforço e desempenho! Até seu próximo turno!";
		echo($msg);
		session_destroy();
?>		
<div id="timer"></div>
<script language="javascript" type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
        } else if(--timer == 0){
        	//document.getElementById("timer").innerHTML = "terminou";
        	window.location.replace("login.php");
        }
    }, 1000);
}
window.onload = function () {
    var duration = 30; // Converter para segundos 60 * 5 (O 5 são minutos, pode alterar)
        display = document.querySelector('#timer'); // selecionando o timer
    startTimer(duration, display); // iniciando o timer
};
</script>
<?php
	} else {
		$msg = "Não foi possivel realizar o logout, informe o administrador do sistema!";
		echo($msg);
	}
}
?>
<div id="logo" align="center">
	<img src="imagem/logo_peq_doing_codes.jpg" style="width: 70px; height: 70px; border: 0px;" />
</div>	
<div class="div-especial" id="rodape_web">
	Intra-site desenvolvido por <span id="auth">DOING CODES&reg;</span>. Todos os direitos reservados.<br />
    É proibida a cópia, comercialização e edição sem autorização do desenvolvedor!<br />
    Os dados contidos neste sistema são de propriedade de: Cond. Maison Porto Fino.<br />
    A divulgação, cópia, extravio, ou, qualquer ação que possa causar vazamento de informação é CRIME!
    De acordo com a lei 13.709/2018.<br />
    Dados armazenados com cryptografia!
</div>

</body>

</html>
<?php
mysqli_close($conecta);
clearstatcache();
?>
