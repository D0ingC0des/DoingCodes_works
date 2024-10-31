<!--

 DEUS seja louvado por sua Grandeza, Justiça e Poder. A ELE a Honra, a Glória e o Louvor! 

//-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
/* 

---> DEUS seja louvado por sua Grandeza, Justi&ccedil;a e Poder. A ELE a Honra, a Gl&oacute;ria e o Louvor! <---

Sistema de controle de portaria e encomendas (SCPE-wb)
Versao web
localhost com SQL
Author: Kyocerah (WRVN_261078)
Ultimo update: 28/08/2023

Atencao! 
Trocar utf8_encode por mb_convert_encoding($variavel, 'UTF-8', 'ISO-8859-1')
Trocar utf8_decode por mb_convert_encoding($variavel, 'ISO-8859-1', 'UTF-8')

*/

//ini_set ( 'display_errors' , 1); 
//error_reporting (E_ALL);
if (!isset($_SESSION)) {
    session_start();
}

$variaveis = "Scripts/variaveis_gerais.php";
$funcoes = "Scripts/funcoes.php";

if(file_exists($variaveis)){
	
	include_once($variaveis);
	
} else {

	$avisoErro = "<div class=\"destaque-erro\">&nbsp;<span>OOps.... Encontramos um erro inexperado!</span></div>";
	$avisoErro .= "<br /><br />&nbsp;<span class=\"texto-erro\">&nbsp;<span>N&atilde;o foi possivel carregar parte(s) deste site, o funcionamento dele foi comprometido. Informe ao desenvolvedor o codigo ERRO-VARS-FL</span><br />";
	
	echo($avisoErro);
	exit;
	
}

if(file_exists($funcoes)){
	
	include_once($funcoes);
	
} else {
	
	$avisoErro = "<div class=\"destaque-erro\">&nbsp;<span>OOps.... Encontramos um erro inexperado!</span></div>";
	$avisoErro .= "<br /><br />&nbsp;<span class=\"texto-erro\">&nbsp;<span>N&atilde;o foi possivel carregar parte(s) deste site, o funcionamento dele foi comprometido. Informe ao desenvolvedor o codigo ERRO-FUNC-FL</span><br />";
	
	echo($avisoErro);
	exit;
	
}

$conecta = mysqli_connect($server, $user, $pass, $database);

if(!$conecta){
	
	echo(mysqli_connect_error());
	exit();
	
} 


?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>

	<meta http-equiv="Content-Language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="cache-control" content="no-store" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<meta charset="utf-8" />

	<meta name="robot" content="noindex, nofollow" />
	<meta name="robot" content="nosnippet, noarchive, noimageindex" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Propriedade -->
    <meta property="og:title" content="Doing Codes" />
    <meta property="og:description"
        content="Este site é uma propriedade de código na empresa Doing Codes, localizada em Maringá, Paraná, Brasil." />
    <meta property="og:image" content="URL_DA_IMAGEM" />
    <meta property="og:url" content="https://www.doingcodes.rf.gd/" />
    <meta property="og:site_name" content="Doing Codes" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR" />
	
	<title id="siteNome"></title>

	<link rel="shortcut icon" type="image/x-icon" href="imagem/favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="Scripts/estilo.css" />
	<link rel="stylesheet" type="text/css" href="webcam/style.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	
	<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" />
		
	<style type="text/css">
	#siteMobile, #rodape_mobile, #tab-principal, #rodape_web {
		display:none;
	}
	</style>
	
	<script language="javascript" type="text/javascript" src="Scripts/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="Scripts/jquery-3.6.3.js"></script>
	<script language="javascript" type="text/javascript" src="Scripts/script_forms.js"></script>
	
	<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		var Java = navigator.javaEnabled();
		if(Java != true){
			processar();
			$("#avisoErroJS").hide();
		} else {
			$("#avisoErroJS").html("Olá. Seu navegador não suporta <b>JavaScript</b> ou ele está desabilitado. Para este site funcionar ele é obrigatório! <i>Instale ou habilite o JavaScript.</i>");
			$("#avisoErroJS").show();
		}
	});
	
	function processar(){
	$('#aguarde').show();
	$("#tab-principal").hide();
	$("#siteMobile").hide();
	var navegador = navigator.userAgentData.mobile;
	var tituloMobile = "SCPE-mbl - Sistema de Controle de Portaria e Encomendas (versão mobile)";
	var tituloWeb = "SCPE-wb - Sistema de controle de portaria e encomendas (versão website)";
	$.ajax( 'index.php' )
		.done(function() {			
			$('#aguarde').hide();			
			if(navegador == true){
				$("#siteMobile").show();
				$("#rodape_mobile").show();
				$("#tab-principal").hide();
				$("#rodape_web").hide();
				var wwidth = $(window).width();
				$("#rodape_mobile").width(wwidth);
				$("#siteNome").html(tituloMobile);
			} else {
				$("#siteMobile").hide();
				$("#rodape_mobile").hide();
				$("#tab-principal").show();
				$("#rodape_web").show();
				$("#siteNome").html(tituloWeb);
			}
		})
		.fail(function() {
			$("#aguarde").html('O funcionamento do SCPE-wb foi comprometido! Informe o mais rápido possivel ao desenvolvedor!');
			$('#loader').hide();
		});  
	}
	
	$(document).ready(function(){
		$("#dropdown-cadastro").click(function(){
			$("#dropdown-cad").slideToggle("slow");
		});
		
		$("#dropdown-consulta").click(function(){
			$("#dropdown-cons").slideToggle("slow");
		});
		
		$("#dropdown-baixa").click(function(){
			$("#dropdown-bx").slideToggle("slow");
		});
		
		$("#dropdown-atualizar").click(function(){
			$("#dropdown-f5").slideToggle("slow");
		});
	});

	$(document).ready(function(){
		$("#avisoTexto").removeClass("texto-justificado");
		$("#avisoTexto").addClass("principal");
		
		$("#totalAvisos").removeClass("texto-esquerda");
		$("#totalAvisos").addClass("principal");
		
		$("#contadoresGerais").removeClass("texto-informativo");
		$("#contadoresGerais").addClass("principal");
	});
	</script>
	<script>
		function validar(form){
			if(typeof(Storage) !== 'undefined'){
				if(form["base64"].value != ""){
					sessionStorage.setItem('base64', form["base64"].value);
					return true;
				} else {
					alert('Preencha o campo');
				}
			} else {
				alert('O navegador nao suporta storage');
			}
			return false;
		}		
		</script>

</head>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$_SESSION['login'];
	$_SESSION['senha'];
	$_SESSION['registro'];
	$_SESSION['nivel'];
	$_SESSION['idLogin'];
	$_SESSION['nome'];
}
//print_r($_SESSION);
?>
<body id="siteWeb">
<!-- LOADER -->
<center>
	<div id="aguarde">
		<img src="imagem/loader.gif" id="loader" />
	</div>
</center>

<!-- ERROR -->
<center>
	<div id="avisoErroJS"></div>
</center>

<!-- INICIO DO SITE PARA DESKTOP -->

<table align="center" border="0" bgcolor="white" cellpadding="0" cellspacing="0" id="tab-principal" height="1000" style="display:none;">
	<tr>
		<td colspan="2" width="800" height="100">
			<a href="index.php"><img border="0" src="imagem/logotipo.png" width="1200" height="100" alt="" /></a>
		</td>
	</tr>
	<tr>
		<td class="texto-esquerda" style="width: 200px" valign="top">
			<table align="left" cellspacing="0" cellpadding="0" style="width: 200px;">
				<tr>
					<td class="socorro_link" onclick="javascript:socorroElevador();">
						PEDIDO DE SOCORRO! Se algum elevador parar click aqui!
					</td>
				</tr>
				<tr>
					<td align="left" valign="top" style="font-size: 10px; padding: 1px;">
						Olá <b><?php
							if($_SESSION['login'] != NULL){
								print_r($_SESSION['nome']);
								//print_r($_SESSION);
							} else {
								echo ("Visitante");
							}
						?></b>, para <?php echo (($_SESSION['login'] == NULL)? "logar" : "deslogar"); ?> <a href="<?php echo (($_SESSION['login'] == NULL)? "teste-login.php" : "teste-login.php?logar=out") ?>">clique aqui!</a>
					</td>
				</tr>
				<tr>
					<td>
						<div>
							<div id="tituloMenuCad"></div>
							<div id="menuCad"></div>
							<div id="tituloMenuBaixas"></div>
							<div id="menuBaixas"></div>
							<div id="tituloMenuCons"></div>
							<div id="menuCons"></div>
							<div id="tituloMenuF5"></div>
							<div id="menuF5"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="itens-menu" 
						valign="middle" id="avisosPainel"
						onmouseover="this.setAttribute('style','background-color: #ffffff');"
						onmouseout="this.setAttribute('style','background-color: #ffffff');">
						<?php
						if(file_exists($avisos)){
							include_once($avisos);
						} else {
							print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[36] . "</b></span>");
							criaLog(2,2,0,$erroNum[36]);
						}
						?>
						<script language="javascript" type="text/javascript">
						setInterval(atualizarPageB, 1000);
						function atualizarPageB() {
							var dataJS = new Date();
							var horaJS = dataJS.getHours();
							var minJS = dataJS.getMinutes();
							var secJS = dataJS.getSeconds();
							
							//Atualiza a page
							if(horaJS == 10 && minJS == 30 && secJS == 00){
								window.location.replace("index.php");

								//Iniciando backup por AJAX
								$.ajax({
  									url: '_geraBackupSQL/gera_backup_sql.php',
  									type: 'POST',
  									success: function(data) {
    									console.log("Backup realizado com sucesso");
  									},
  									error: function() {
    									console.log("Erro ao realizar backup");
  									}
								});

								//Iniciando WORKER
								var worker = new Worker('Scripts/worker.js');

								worker.onmessage = function(e) {
  									console.log(e.data);  
								};

								worker.postMessage('Iniciar backup');
							}
							
							if(horaJS == 12 && minJS == 00 && secJS == 00){
								window.location.replace("index.php");
							} 
							
							if(horaJS == 23 && minJS == 59 && secJS == 59){
								window.location.replace("index.php");
							}
							
							//Faz log-off automatico
							if(horaJS == 7 && minJS == 00 && secJS == 00){
								window.location.replace("https://scpe-wb.cond.br/scpe-wb/teste-login.php?logar=out");
							}
							
							if(horaJS == 19 && minJS == 00 && secJS == 00){
								window.location.replace("https://scpe-wb.cond.br/scpe-wb/teste-login.php?logar=out");
							}
							
						}
						</script>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 1000px;" valign="top" cellpadding="0" cellspacing="0">
			<div style="background-color: white; border: 0px; padding: 0px; float:none">
		<?php 
			//Inicio das instrucoes PHP para processamento dos servicos
			
			if($tipo == "forms"){ 
				
				//Funcoes para cadastros em geral
				
				if($processa == "slctApObjt"){
					
					//Seleciona o apartamento
					
					$queryAp = mysqli_query($conecta, "SELECT apartamentos FROM coisas") or die(mysqli_error());
					$html = "<div class=\"destaque-titulos\"><img src=\"imagem/icon-titulo-geral.png\" border=\"0\" alt=\"\" vspace=\"0\" hspace=\"0\" />&nbsp;Cadastro de objetos</div>\r\n";
					$html .= "<div>";
					$html .= "<form name=\"selectAp\" action=\"index.php?tipo=forms&processa=objetos\" method=\"post\">";
					$html .= "<div><div class=\"texto-formulario\"><label for=\"apto\">Selecione o apartamento</label></div>";
					$html .= "<select id=\"apto\" name=\"apto\" onchange=\"javascript:document.selectAp.submit();\" class=\"campos-formulario\">";
					$html .= "<option>&nbsp;</option>";

					while($reg = mysqli_fetch_array($queryAp, MYSQLI_ASSOC)){
						$html .= "<option value=\"".$reg['apartamentos']."\">&bull;&nbsp;".$reg['apartamentos']."</option>\r\n";
					}
					
					mysqli_free_result($queryAp);

					$html .= "</select></form></div>";
					echo($html);
				} else if($processa == "slctApto"){
					
					//Seleciona o apartamento
					
					$queryAp = mysqli_query($conecta, "SELECT apartamentos FROM coisas") or die(mysqli_error());
					$html = "<div class=\"destaque-titulos\"><img src=\"imagem/icon-titulo-geral.png\" border=\"0\" alt=\"\" vspace=\"0\" hspace=\"0\" />&nbsp;Cadastro de encomendas</div>\r\n";
					$html .= "<div>";
					$html .= "<form name=\"selectAp\" action=\"index.php?tipo=forms&processa=encomenda\" method=\"post\">";
					$html .= "<div><div class=\"texto-formulario\"><label for=\"apto\">Selecione o apartamento</label></div>";
					$html .= "<select id=\"apto\" name=\"apto\" onchange=\"javascript:document.selectAp.submit();\" class=\"campos-formulario\">";
					$html .= "<option>&nbsp;</option>";

					while($reg = mysqli_fetch_array($queryAp, MYSQLI_ASSOC)){
						$html .= "<option value=\"".$reg['apartamentos']."\">&bull;&nbsp;".$reg['apartamentos']."</option>\r\n";
					}
					
					mysqli_free_result($queryAp);

					$html .= "</select></form></div>";
					echo($html);
				} else if($processa == "encomenda"){
					
					//Form de encomendas
					
					if(file_exists($form_encmd)){
						
						include_once($form_encmd);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[0] . "</b></span>");
						criaLog(2,2,0,$erroNum[0]);
						
					}
					
					//Fim from de encomendas

				} elseif($processa == "oc_geral"){
					
					//formulario de ocorrencia
					
					if(file_exists($form_ocorrencia)){
						
						include_once($form_ocorrencia);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[1] . "</b></span>");
						criaLog(2,2,0,$erroNum[1]);
						
					}
					
					//fim form de ocorrencia
					
				} elseif($processa == "oc_elevador"){
					
					//Formulario de ocorrencia dos elevadores
					
					if(file_exists($form_oc_elev)){
						
						include_once($form_oc_elev);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[2] . "</b></span>");
						criaLog(2,2,0,$erroNum[2]);
						
					}
					
					//fim form ocorrencia elevadores
					
				} elseif($processa == "objetos"){
					
					//Form retirada de objetos
					
					if(file_exists($form_cad_objetos)){
						
						include_once($form_cad_objetos);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[3] . "</b></span>");
						criaLog(2,2,0,$erroNum[3]);
						
					}
					
					//Fim form de retirada de objetos
					
				} elseif($processa == "prestadores"){
					
					//Form cadastro de prestadores
					
					if(file_exists($form_cad_prestador)){
						
						include_once($form_cad_prestador);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[4] . "</b></span>");
						criaLog(2,2,0,$erroNum[4]);
						
					}
					
					//fim form cadastro de prestadores
					
				} elseif($processa == "moradores"){
					
					//Form cadastro de moradores
					
					if(file_exists($form_cad_morador)){
						
						include_once($form_cad_morador);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[5] . "</b></span>");
						criaLog(2,2,0,$erroNum[5]);
						
					}
					
					//Fim form cadastro de moradores
					
				} elseif($processa == "funcionario"){
					
					//Form cadastro de funcionario
					
					if(file_exists($form_cad_funcionario)){
						
						include_once($form_cad_funcionario);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[6] . "</b></span>");
						criaLog(2,2,0,$erroNum[6]);
						
					}
					
					//Fim cadastro de funcionario
					
				} else if($processa == "proprietario"){
					
					//Inicio cadastro de proprietario
					
					if(file_exists($form_cad_proprietario)){
						
						include_once($form_cad_proprietario);
						
					} else {
						
						print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[38] . "</b></span>");
						criaLog(2,2,0,$erroNum[38]);
						
					}
					
					//Fim cadastro de proprietario
					
				} else if($processa == "cadFuncAp"){
					
					//Inicio do cadastro de funcionarios dos apartamentos
					
					if(file_exists($form_cad_func_ap)){
						
						include_once($form_cad_func_ap);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[39] . "</b></span>");
						criaLog(2,2,0,$erroNum[39]);
						
					}
					
					//Fim do cadastro de funcionarios dos apartamentos
				}
				
				//Fim das funcoes de cadastro
				
			} else if($tipo == "executa"){
				
				//Inicio das funcoes de gravacao
				
				if($acao == "cadencmd"){
					
					//cadastra nova encomenda
					
					if(file_exists($acao_cad_encmd)){
						
						include_once($acao_cad_encmd);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[17] . "</b></span>");
						criaLog(2,2,0,$erroNum[17]);
						
					}
					
					//Fim do cadastro de encomendas
					
				} else if($acao == "cadOc"){
					
					//Cadastra nova ocorrencia
					
					if(file_exists($acao_cad_oc)){
						
						include_once($acao_cad_oc);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[18] . "</b></span>");
						criaLog(2,2,0,$erroNum[18]);
						
					}
					
					//Fim do cadastro de ocorrencias
					
				} else if($acao == "cadOcElv"){
					
					//Inicio cadastro de ocorencias dos elevadores
					
					if(file_exists($acao_cad_oc_elev)){
						
						include_once($acao_cad_oc_elev);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[19] . "</b></span>");
						criaLog(2,2,0,$erroNum[19]);
						
					}
					
					//Fim cadastro de ocorencias dos elevadores
					
				} else if($acao == "cadObjetos"){
					
					//Inicio cadastro de objetos
					
					if(file_exists($acao_cad_objeto)){
						
						include_once($acao_cad_objeto);
						
					} else {						
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[20] . "</b></span>");
						criaLog(2,2,0,$erroNum[20]);
						
					}
					
					//Fim cadastro de objetos
					
				} else if($acao == "cadfunc"){
					
					//Inicio do cadastro de funcionarios
					
					if(file_exists($acao_cad_func)){
						
						include_once($acao_cad_func);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[22] . "</b></span>");
						criaLog(2,2,0,$erroNum[22]);
						
					}
					
					//Fim do cadastro de funcionarios
					
				} else if($acao == "cadprestador"){
					
					//Inicio cadastro de prestadores
					
					if(file_exists($acao_cad_prestador)){
						
						include_once($acao_cad_prestador);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[23] . "</b></span>");
						criaLog(2,2,0,$erroNum[23]);
						
					}
					
					//Fim cadastro de prestadores
					
				} else if($acao == "cadMorador"){
					
					//Inicio do cadastro de moradores
					
					if(file_exists($acao_cad_morador)){
						
						include_once($acao_cad_morador);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[26] . "</b></span>");
						criaLog(2,2,0,$erroNum[26]);
						
					}
					
					//Fim do cadastro de moradores
					
				} else if($acao == "cadProprietario"){
					
					//Inicio do cadastro de Proprietarios
					
					if(file_exists($acao_cad_proprietario)){
						
						include_once($acao_cad_proprietario);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[38] . "</b></span>");
						criaLog(2,2,0,$erroNum[38]);
						
					}
					
					//Fim do cadastro de propriearios
					
				} else if($acao == "cadFuncAp"){
				
					//Inicio do cadastro de funcionario dos aps
					
					if(file_exists($acao_cad_func_ap)){
						
						include_once($acao_cad_func_ap);
						
					} else {
						
						print($erroAcao . "<span class=\"texto-erro\"><b>-". $erroNum[38] . "</b></span>");
						criaLog(2,2,0,$erroNum[39]);
						
					}
					
					//Inicio do cadastro de funcionario dos aps
				
				}				
				
				//Fim das funcoes de cadastro
				
			} else if($tipo == "cons"){
			
				//Inicio das funcoes de consulta
				
				if($consulta == "encmd"){
				
					//Consulta encomendas
				
					if(file_exists($cons_encomendas)){
						
						include_once($cons_encomendas);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[25] . "</b></span>");
						criaLog(2,2,0,$erroNum[25]);
						
					}
					
					//Fim consulta encomendas
					
				} else if($consulta == "func"){
					
					//Inicio consulta funcionarios
					
					if(file_exists($cons_funcionarios)){
						
						include_once($cons_funcionarios);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[21] . "</b></span>");
						criaLog(2,2,0,$erroNum[21]);
						
					}
					
					//Fim consulta funcionarios
					
				} else if($consulta == "moradores"){
					
					//Inicio consulta moradores
					
					if(file_exists($cons_moradores)){
						
						include_once($cons_moradores);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[12] . "</b></span>");
						criaLog(2,2,0,$erroNum[12]);
						
					}
					
					//Fim consulta moradores
					
				} else if($consulta == "objt"){
					
					//Inicio consulta objetos retirados da portaria
					
					if(file_exists($cons_objts)){
						
						include_once($cons_objts);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[27] . "</b></span>");
						criaLog(2,2,0,$erroNum[27]);
						
					}
					
					//Fim consulta objetos retirados da portaria
					
				} else if($consulta == "vagas"){
					
					//Inicio consulta vagas de carro
					
					echo("<div class=\"destaque-titulos\">Consulta de vagas por apartamento</div><br /><br />");
					echo("<div class=\"texto-justificado\">");
					
					$sqlGeraVagas = "SELECT id, apartamentos FROM coisas WHERE apartamentos ORDER BY apartamentos ASC";
					$queryGeraVagas = mysqli_query($conecta, $sqlGeraVagas) or die(mysqli_error());
					
					echo("<select id=\"apMrd\" name=\"apMrd\" class=\"campos-formulario\" onchange=\"javascript:geraVagas();\">");
					
					while($apVagas = mysqli_fetch_array($queryGeraVagas, MYSQLI_ASSOC)){
						$idVagas = $apVagas["id"];
						$numApVagas = $apVagas["apartamentos"];
						$stringOpcao = "<option value=\"$idVagas\">$numApVagas</option>";
						echo($stringOpcao);
					}
					
					echo("</select>");
					echo("&nbsp;&nbsp;");
					echo("<input name=\"vagaMrd\" id=\"vagaMrd\" type=\"text\" style=\"width:140px\" class=\"campos-formulario\" readonly=\"readonly\" />");
					
					mysqli_free_result($queryGeraVagas);
					
					echo("</div>");
					
					//Fim consulta de vagas de carro
					
				} else if($consulta == "ocgeral"){
					
					//Inicio da consulta de ocorrencias
					
					if(file_exists($cons_oc_geral)){
						
						include_once($cons_oc_geral);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[14] . "</b></span>");
						criaLog(2,2,0,$erroNum[14]);
						
					}
					
					//Fim da consulta de ocorrencias
					
				} else if($consulta == "ocelevador"){
					
					//Inicio da consulta de ocorrencias
					
					if(file_exists($cons_oc_elev)){
						
						include_once($cons_oc_elev);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[15] . "</b></span>");
						criaLog(2,2,0,$erroNum[15]);
						
					}
					
					//Fim da consulta de ocorrencias
					
				} else if($consulta == "prestadores"){
				
					//Inicio consulta prestadores
					
					if(file_exists($cons_prestador)){
						
						include_once($cons_prestador);
						
					} else {
						
						print($erroConslt . "<span class=\"texto-erro\"><b>-". $erroNum[16] . "</b></span>");
						criaLog(2,2,0,$erroNum[16]);
						
					}
					
					//Fim consulta prestadores
				
				}

				//Fim das funcoes de consulta
				
			} else if($tipo == "baixa"){
				
				//Inicio das funcoes de baixa
				
				if($processa == "encomendas"){
					
					//Inicio da baixa de encomenda
					
					if(file_exists($baixa_encomenda)){
						
						include_once($baixa_encomenda);
						
					} else {
						
						print($erroBxa . "<span class=\"texto-erro\"><b>-". $erroNum[7] . "</b></span>");
						criaLog(2,2,0,$erroNum[7]);
						
					}
					
					//Fim da baixa de encomenda
					
				} else if($processa == "objetos"){
					
					//Inicio da baixa de objetos
					
					if(file_exists($baixa_objetos)){
						
						include_once($baixa_objetos);
						 
					} else {
						
						print($erroBxa . "<span class=\"texto-erro\"><b>-". $erroNum[8] . "</b></span>");
						criaLog(2,2,0,$erroNum[8]);
						
					}
					
					//Fim da baixa de objetos
					
				} else if($processa == "prestadores"){
					
					//Inicio da baixa de objetos
					
					if(file_exists($baixa_prestadores)){
						
						include_once($baixa_prestadores);
						 
					} else {
						
						print($erroBxa . "<span class=\"texto-erro\"><b>-". $erroNum[9] . "</b></span>");
						criaLog(2,2,0,$erroNum[9]);
						
					}
					
					//Fim da baixa de objetos
					
				} else if($processa == "moradores"){
					
					//Inicio da baixa de moradores
					
					if(file_exists($baixa_moradores)){
						
						include_once($baixa_moradores);
						 
					} else {
						
						print($erroBxa . "<span class=\"texto-erro\"><b>-". $erroNum[9] . "</b></span>");
						criaLog(2,2,0,$erroNum[11]);
						
					}
					
					//Fim da baixa de moradores
					
				}
				
				//Fim das funcoes de baixa
			
			} else if($tipo == "atualiza"){
				
				//Inicio das funcoes de atualizacao
				
				//Atualizacao de funcionarios
				
				if($f5_dt == "f5_fnc"){
					
					if(file_exists($f5_func)){
						
						include_once($f5_func);
						 
					} else {
						
						print($erroF5 . "<span class=\"texto-erro\"><b>-". $erroNum[37] . "</b></span>");
						criaLog(2,2,0,$erroNum[37]);
						
					}
					
				}
				
				//FIM Atualizacao de funcionarios
				
				//Atualizacao moradores
				
				if($f5_dt == "f5_mrd"){
					
					if(file_exists($f5_mrdr)){
						
						include_once($f5_mrdr);
						 
					} else {
						
						print($erroF5 . "<span class=\"texto-erro\"><b>-". $erroNum[40] . "</b></span>");
						criaLog(2,2,0,$erroNum[40]);
						
					}
					
				}
				
				//FIM Atualizacao moradores
				
				//Fim das funcoes de atualizacao

			} else { 
			//Funcoes da pagina inicial
			?>
			<table width="99%" border="0" cellpadding="1" cellspacing="0" height="700">
				<tr>
					<td valign="top">
						<div class="destaque-titulos">
							<img src="imagem/icon-titulo-geral.png" border="0" alt="" vspace="0" hspace="0" />&nbsp;Sistema de controle de portaria e encomendas (SCPE-wb)
						</div>
						<?php
						if(file_exists($contadores)){
							include_once($contadores);
						} else {
							print($erroGeral . "<span class=\"texto-erro\"><b>-". $erroNum[24] . "</b></span>");
						}
						?>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
												
						<!-- Inicio das pesquisas de codigo Ifood e vagas por apto -->
						
						<table align="center" bgcolor="white" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
							<tr>
								<td width="50%" valign="top" align="left">
								
									<div class="destaque-titulos">
										<img src="imagem/ifood.png" border="0" alt="" vspace="0" hspace="0" />&nbsp;Consultar codigos IFOOD
									</div>
									
									<div>						
									<form method="get" id="formIfood">
									<?php
									$geraApIfood = "SELECT id, apartamentos FROM coisas WHERE apartamentos ORDER BY apartamentos ASC";
									$queryApIfood = mysqli_query($conecta, $geraApIfood) or die(mysqli_error());
									?>
									<select id="apIfood" name="apIfood" class="campos-formulario" onchange="javascript:document.getElementById('formIfood').submit();">
										<option>Selecione o apto...</option>
										<?php
										while($apIfood = mysqli_fetch_array($queryApIfood, MYSQLI_ASSOC)){
											if($apIfood["apartamentos"] != NULL){
												$ordenaAps = $apIfood["apartamentos"];
												$idApIfood = $apIfood["id"];
												echo("<option value='$ordenaAps'>$ordenaAps</option>\r\n");
											}
										}
										?>
									</select>
									</form>
									<?php
									@$getIfood = $_GET["apIfood"];
									$queryMorador2 = mysqli_query($conecta, "SELECT Apartamento, Nome, Contato FROM listamoradoresb WHERE Apartamento='$getIfood' ORDER BY Apartamento ASC") or die(mysqli_error());
									$html = "<textarea name=\"textIfood\" id=\"textIfood\" cols=\"50\" rows=\"4\" class=\"campos-formulario\" disabled=\"disabled\" readonly=\"readonly\" style='resize: none;'>";
									$html .= "APTO | NOME | CODIGO"."\r\n";
									while($morador2 = mysqli_fetch_array($queryMorador2, MYSQLI_ASSOC)){
										if($morador2['Contato'] != NULL){
											if($morador2['Apartamento'] < 1000){
												$novoAp = "0" . $morador2['Apartamento'];
											} else {
												$novoAp = $morador2['Apartamento'];
											}
											$html .= "&bull;&nbsp;". $novoAp . " | " . mb_convert_encoding($morador2['Nome'], 'UTF-8', 'ISO-8859-1') . " | " . substr($morador2['Contato'], -4) ."\r\n";											
										}
									}
									$html .= "</textarea>";
					
									mysqli_free_result($queryMorador2);
									mysqli_free_result($queryApIfood);
									echo($html);
									?>
									</div>
									<div class="destaque-titulos">
										<img src="imagem/ifood.png" border="0" alt="" vspace="0" hspace="0" />&nbsp;Códigos IFood que não estão cadastros
									</div>
									<i class="fas fa-user" style="font-size:12px;"></i>&nbsp;<span onclick='javascript:window.open("processaJson.php","_blank","toolbar=false, scrollbars=false, resizable=false, top=50, left=50, width=500, height=550");' style='cursor: pointer;'>Cadastrar codigo IFood</span> <br />
									<i class="fas fa-search" style="font-size:12px;"></i>&nbsp;<span onclick='javascript:window.open("exibeJson.htm","_blank","toolbar=false, scrollbars=true, resizable=false, top=50, left=50, width=500, height=550");' style='cursor: pointer;'>Consultar código IFood</span>
								</td>
								<td width="50%" valign="top" align="left">
								
								<div>
									<div class="destaque-titulos">
										<img src="imagem/icon-carro.png" border="0" alt="" vspace="0" hspace="0" width="32" height="32" />&nbsp;Consulta de vagas por apartamento
									</div>
									<?php
									echo("<div class=\"texto-justificado\">");
					
									$sqlGeraVagas = "SELECT id, apartamentos FROM coisas WHERE apartamentos ORDER BY apartamentos ASC";
									$queryGeraVagas = mysqli_query($conecta, $sqlGeraVagas) or die(mysqli_error());
					
									echo("<select id=\"apMrd\" name=\"apMrd\" class=\"campos-formulario\" onchange=\"javascript:geraVagas();\">");
									echo("<option value='0'>Selecione o apto...</option>");
					
									while($apVagas = mysqli_fetch_array($queryGeraVagas, MYSQLI_ASSOC)){
										$idVagas = $apVagas["id"];
										$numApVagas = $apVagas["apartamentos"];
										$stringOpcao = "<option value=\"$idVagas\">$numApVagas</option>\r\n";
										echo($stringOpcao);
									}
					
									echo("</select>");
									echo("&nbsp;&nbsp;");
									echo("<input name=\"vagaMrd\" id=\"vagaMrd\" type=\"text\" style=\"width:140px\" class=\"campos-formulario\" readonly=\"readonly\" />");
					
									mysqli_free_result($queryGeraVagas);
					
									echo("</div>");
									?>
									<div style="height: 73px;">&nbsp;</div>
									<div class="destaque-titulos">
										<img src="imagem/icon-carro.png" border="0" alt="" vspace="0" hspace="0" width="32" height="32" />&nbsp;Solicitação de TAG veicular
									</div>
									<i class="fa fa-car" aria-hidden="true" style="font-size: 12px;"></i>&nbsp;<span onclick='javascript:window.open("Scripts/solicitacao_tags_veicular.html","_blank","toolbar=false, scrollbars=false, resizable=false, top=50, left=50, width=500, height=550");' style='cursor: pointer;'>Cadastrar pedido de TAG veicular</span> <br />
									<i class="fa fa-car" aria-hidden="true" style="font-size: 12px;"></i>&nbsp;<span onclick='javascript:window.open("Scripts/baixa_tags_veiculares.php","_blank","toolbar=false, scrollbars=false, resizable=false, top=50, left=50, width=500, height=550");' style='cursor: pointer;'>Baixar pedido de TAG veicular</span>
								</div>
								
								</td>
							</tr>
						</table>
						
						<!-- Fim das pesquisas de codigo Ifood e vagas por apto -->
						
						<!-- Inicio dos registros de entradas diarias -->
						
						<div class="destaque-titulos">
							<img src="imagem/icon-people.png" border="0" alt="" vspace="0" hspace="0" />&nbsp;Registro de entradas de visitantes e prestadores
						</div>
						
						<div style="border:0px;">
						<?php
						
						if(file_exists($reg_visitas)){
							
							include_once($reg_visitas);
							
						} else {
							
							print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[33] . "</b></span>");
							criaLog(2,2,0,$erroNum[33]);
							
						}
						?>
						</div>
						
						<!-- Fim dos registros de entradas diarias -->
						
						<!-- Inicio das informacoes diversas -->
						
						<table width="100%" border="0" cellpadding="1" cellspacing="0" style="background-color:#ffffff">
							<tr>
								<td colspan="3">
									<div class="destaque-titulos" style="float: none">
										<img src="imagem/icon-fone.png"  border="0" alt="" vspace="0" hspace="0" />&nbsp;Ramais de interfone
									</div>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<script language="javascript" type="text/javascript">
										geraRamais(1);
									</script>
								</td>
								<td valign="top">
									<script language="javascript" type="text/javascript">
										geraRamais(2);
									</script>
								</td>
								<td valign="top">
									<script language="javascript" type="text/javascript">
										geraRamais(3);
									</script>
								</td>
							</tr>
						</table>
						
						<div class="destaque-titulos">
							<img src="imagem/icon-info.png" width="32" height="32" border="0" alt="" vspace="0" hspace="0" />&nbsp;Informa&ccedil;&otilde;es diversas
						</div>
						<div class="texto-informativo">
							<ul type="circle">
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> Unidade consumidora da Copel: <b>98945246.</b></li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> Quadros da Vivo nos andares: <b>4, 12, 17 e 22.</b></li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> Quadros da <b>Net, Claro e Tim</b> est&atilde;o no painel do hall de entrada.</li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> Loca&ccedil;&atilde;o dos espa&ccedil;os devem ser feitas pelo app da <b>EURO</b>. Por&eacute;m &eacute; obrigat&oacute;rio o preenchimento do <b>termo de uso</b> do espa&ccedil;o.</li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> Capacidade dos espa&ccedil;os: Sal&atilde;o de festas <b>61</b> pessoas, Gourmet <b>29</b> pessoas, Churrasqueira <b>22</b> pessoas.</li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');"> O valor da loca&ccedil;&atildeo dos espa&ccedil;os &eacute; de <b>18%</b> para o sal&atilde;o de festas, <b>14%</b> para o gourmet e <b>10%</b> para a churrasqueira, de um sal&aacute;rio minimo.</li>
								<li onmouseover="this.setAttribute('style','background-color: #F5DEB3');" 
									onmouseout="this.setAttribute('style','background-color: #ffffff');">
										Valores atualizados em reais do ano vigente: sal&atilde;o de festas <span id="valorSF"></span> ||
										sal&atilde;o gourmet <span id="valorGourmet"></span> 
										|| churrasqueira <span id="valorChurras"></span></li>
								
									<?PHP
										$pegaSalario = mysqli_query($conecta, "SELECT salario_nacional FROM coisas");
										$valorSalario =  mysqli_fetch_array($pegaSalario);
										$vlSl = limpa($valorSalario['salario_nacional']);
										mysqli_free_result($pegaSalario);
									?>									
									<script language="javascript" type="text/javascript">
										$("#valorSF").html(calcula(<?php echo($vlSl); ?>, 18));
										$("#valorGourmet").html(calcula(<?php echo($vlSl); ?>, 14));
										$("#valorChurras").html(calcula(<?php echo($vlSl); ?>, 10));
									</script>
							</ul>
						</div>
						
						<!-- Fim das informacoes diversas -->
						
					</td>
				</tr>
			</table>
			<?php
			//Fim da pagina inicial
			}
		//Fim das instrucoes PHP
		?>
		</div>
		</td>
	</tr>
</table>

<!-- FIM DO SITE PARA DESKTOP -->

<!-- INICIO SITE PARA MOBILE -->

<script>
function adeptImage(targetImg){
	var wheight = $(window).height();
	var wwidth = $(window).width();
				
	targetImg.removeAttr("width")
	.removeAttr("height")
	.css({ width: "", height: "" });
			
	var imgwidth = targetimg.width();
	var imgheight = targetimg.height();
				
	var destwidth = wwidth;
	var destheight = wheight;
				
	if(imgheight < wheight) {
		destwidth = (imgwidth * wheight)/imgheight;
		$('#logo_mobile img').height(destheight);
		$('#logo_mobile img').width(destwidth);
	}
				
	destheight = $('#logo_mobile img').height();
	var posy = (destheight/2 - wheight/2);
	var posx = (destwidth/2 - wwidth/2);
				
	if(posy > 0) {
		posy *= -1;
	}
				
	if(posx > 0) {
		posx *= -1;
	}
				
	$('#logo_mobile').css({'top': posy + 'px', 'left': posx + 'px'});
		
	$(window).resize(function() {
		adaptImage($('#logo_mobile img'));
	});
				
	$(window).load(function() {
		$(window).resize();
	});
}
</script>

<div id="siteMobile">
	<table cellpadding="0" cellspacing="0" bgcolor="white" border="0" align="center" width="100%" height="100%">
		<tr>
			<td height="315" width="100%" align="center" valign="middle" id="logo_mobile">			
				<img align="left" src="imagem/img_mobile/logo_estilizado.png" id="img_mobile" />
			</td>
		</tr>
		<tr>
			<td align="center" width="100%" valign="top">
				<div id="nav" style="text-align: center;">
					<div id="dropdown-cadastro">Cadastros</div>
					<div id="dropdown-cad"></div>
				</div>	
				<div id="nav">
					<div id="dropdown-consulta">Consultas</div>
					<div id="dropdown-cons">
						<ul>
							<li><a href="#">Menu Item</a></li>
							<li><a href="#">Menu</a></li>
							<li><a href="#">Settings</a></li>
							<li><a href="#">Search</a></li>
						</ul>
					</div>
				</div>	
				<div id="nav">
					<div id="dropdown-baixa">Baixas</div>
					<div id="dropdown-bx">
						<ul>
							<li><a href="#">Menu Item</a></li>
							<li><a href="#">Menu</a></li>
							<li><a href="#">Settings</a></li>
							<li><a href="#">Search</a></li>
						</ul>
					</div>
				</div>
				<div id="nav">
					<div id="dropdown-atualizar">Atualizar</div>
					<div id="dropdown-f5">
						<ul>
							<li><a href="#">Menu Item</a></li>
							<li><a href="#">Menu</a></li>
							<li><a href="#">Settings</a></li>
							<li><a href="#">Search</a></li>
						</ul>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td valign="top" align="left" width="100%" height="100%">
				<div id="titulo_mobile" align="center">
					<b>SCPE-mbl</b> - <b>S</b>istema de <b>C</b>ontrole de <b>P</b>ortaria e <b>E</b>ncomendas (versão Mobile)
				</div>
				<div id="teste" style="width: 88px;"></div>
				<div id="navegacao">
					<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#FFFFFF">
						<tr>
							<td>
								<div id="principal_mobile">
									<?php
									if(file_exists("Scripts/infos_mobile.php")){
										include_once("Scripts/infos_mobile.php");
									} else {
										echo("O arquivo não foi encontrado\r\n");
									}
									?>
								</div>
								<div id="avisos">
									<?php
									
									if(file_exists($avisos_mobile)){
										include_once($avisos_mobile);
									} else {
										print($erroForm . "<span class=\"texto-erro\"><b>-". $erroNum[36] . "</b></span>");
										criaLog(2,2,0,$erroNum[36]);
									}
									
									?>
								</div>
								<div id="RamaisDiversos">
									<div class="destaque-titulos">
										<img src="imagem/icon-fone.png"  border="0" alt="" vspace="0" hspace="0" />&nbsp;Ramais de interfone
									</div>
									<div id="listaRamais">
										<div id="ramaisGerais">
											<script language="javascript" type="text/javascript">
												geraRamais(1);
												geraRamais(2);
												geraRamais(3);
											</script>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
<div id="rodape_mobile">
	Condom&iacute;nio <b>Maison Porto Fino</b><br />
	CNPJ: <b><?php echo formatCnpj("21348042000198"); ?></b><br />
	<b>Av. Guedner, 891, Jd. Aclima&ccedil;&atilde;o, CEP: <?php echo formatCep("87050390"); ?>, Maring&aacute; - Pr</b><br />
	Telefone: <b><?php echo formatTel("4430403330"); ?></b><br />
	Celular: <b><?php echo formatCel("44999400026"); ?></b><br />
	E-mail: <b>cond.maison.portofino@hotmail.com</b><br />
	E-mail: <b>condmaisonportofino@yahoo.com</b><br />
	E-mail: <b>maisonportofinoportaria@gmail.com</b><br />
	<br /><br />
	Intra-site desenvolvido por &reg;DOING CODES<br />
	Todos os direitos reservados.<br />
	Os dados contidos neste sistema são de propriedade de: Cond. Maison Porto Fino.<br />
	A divulgação, cópia, extravio, ou, qualquer ação que possa causar vazamento de informação é CRIME! De acordo com a lei 13.709/2018.
</div>

<!-- FIM DO SITE PARA MOBILE -->

<!-- FIM DA PAGINA -->

<div class="div-especial" id="rodape_web">
	Intra-site desenvolvido por &reg;DOING CODES<br />
	Todos os direitos reservados.<br />
	Os dados contidos neste sistema são de propriedade de: Cond. Maison Porto Fino.<br />
	A divulgação, cópia, extravio, ou, qualquer ação que possa causar vazamento de informação é CRIME! De acordo com a lei 13.709/2018.
</div>

<script language="javascript" type="text/javascript">
$(document).ready(function () {
    //Menu WEB
	$("#menuCad").append("<ul></ul>");
	$("#menuBaixas").append("<ul></ul>");
	$("#menuCons").append("<ul></ul>");
	$("#menuF5").append("<ul></ul>");
	
	//Menu Moblie
	$("#dropdown-cad").append("<ul></ul>");
    $.ajax({
        type: "GET",
        url: "Scripts/menu.xml",
        dataType: "xml",
        success: function (xml) {
			$(xml).find('separadores').each(function () {
				var sNomeId = $(this).find('titulo').attr('id');
				var sNome = $(this).find('titulo').attr('name');
				var sUrl = $(this).find('titulo').text();
				
				if(sNomeId == "cdt"){ //Destaque cadastro
					$("#tituloMenuCad").html('<img src="' + sUrl + '"  border="0" alt="" vspace="0" hspace="0" />' + sNome);
					$("#tituloMenuCad").addClass("destaque-titulos");
				}
				
				if(sNomeId == "bxs"){ //Destaque baixas
					$("#tituloMenuBaixas").html('<img src="' + sUrl + '"  border="0" alt="" vspace="0" hspace="0" />' + sNome);
					$("#tituloMenuBaixas").addClass("destaque-titulos");
				}
				
				if(sNomeId == "cnt"){ //Destaque consultas
					$("#tituloMenuCons").html('<img src="' + sUrl + '"  border="0" alt="" vspace="0" hspace="0" />' + sNome);
					$("#tituloMenuCons").addClass("destaque-titulos");
				}
				
				if(sNomeId == "atz"){ //Destaque atualizacao
					$("#tituloMenuF5").html('<img src="' + sUrl + '"  border="0" alt="" vspace="0" hspace="0" />' + sNome);
					$("#tituloMenuF5").addClass("destaque-titulos");
				}
			});
			
			$(xml).find('menu').each(function () {
				var sId = $(this).find('item').attr("id");
				var sNivel = $(this).find('item').attr("nivel");
				var sAncora = $(this).find('item').attr("ancora");
				var sLink = $(this).find('item').text();
				
				if(sLink == null){
					sLink = "#";
				} else {
					sLink = $(this).find('item').text();
				}
                        
				if(sId == "cdt"){ //Itens de cadastro
					$("<li></li>").html("<a id='" + sNivel + "' href='" + sLink + "'>" + sAncora + "</a>").appendTo("#menuCad ul");
					$("<li></li>").html("<a id='" + sNivel + "' href='" + sLink + "'>" + sAncora + "</a>").appendTo("#dropdown-cad ul");
					$("li").on({
						mouseenter: function(){
							$(this).css("background-color", "#F5DEB3");
						},
								
						mouseleave: function(){
							$(this).css("background-color", "#FFFFFF");
						},
								
						click: function(){
							$(this).css("background-color", "yellow");
						}
					});
					$("li").addClass("itens-menu");
				}
				
				if(sId == "bxs"){ //Itens de baixa
					$("<li></li>").html("<a id='" + sNivel + "' href='" + sLink + "'>" + sAncora + "</a>").appendTo("#menuBaixas ul");
					$("li").on({
						mouseenter: function(){
							$(this).css("background-color", "#F5DEB3");
						},
								
						mouseleave: function(){
							$(this).css("background-color", "#FFFFFF");
						},
								
						click: function(){
							$(this).css("background-color", "yellow");
						}
					});
					$("li").addClass("itens-menu");
				}
				
				if(sId == "cnt"){ //Itens de consulta
					$("<li></li>").html("<a id='" + sNivel + "' href='" + sLink + "'>" + sAncora + "</a>").appendTo("#menuCons ul");
					$("li").on({
						mouseenter: function(){
							$(this).css("background-color", "#F5DEB3");
						},
								
						mouseleave: function(){
							$(this).css("background-color", "#FFFFFF");
						},
								
						click: function(){
							$(this).css("background-color", "yellow");
						}
					});
					$("li").addClass("itens-menu");
				}
				
				if(sId == "atz"){ //Itens de atualizacao
					$("<li></li>").html("<a id='" + sNivel + "' href='" + sLink + "'>" + sAncora + "</a>").appendTo("#menuF5 ul");
					$("li").on({
						mouseenter: function(){
							$(this).css("background-color", "#F5DEB3");
						},
								
						mouseleave: function(){
							$(this).css("background-color", "#FFFFFF");
						},
								
						click: function(){
							$(this).css("background-color", "yellow");
						}
					});
					$("li").addClass("itens-menu");
				}
			});
		},
		error: function () { //Se não carregar o XML gera erro na tela
			$("#menu").html("Não foi possivel carregar o menu de opções! Informe ao desenvolvedor com o código ERROR_MENU_XML.");
			$("#menu").addClass("aviso");
		}
	});
});
</script>

</body>

</html>
<?php
checaDataAviso();
mysqli_close($conecta);
clearstatcache();

$backupSQL_file = "_geraBackupSQL/gera_backup_sql.php";
$confere_data = date("d");
$confere_hora = date("H");
$confere_minuto = date("i");

function agendaBackupSQL() {
	$command = "59 23 30 * * php -r '\$backup_file = geraBackupSQL();'";
	exec("crontab -l | { cat; echo '$command'; } | crontab -");
	//return "Backup do banco de dados agendado com sucesso.";
}
agendaBackupSQL();

if(($confere_data === "15" && $confere_hora === "10" && $confere_minuto === "30") || ($confere_data === "30" && $confere_hora === "10" && $confere_minuto === "30")){
	if(file_exists($backupSQL_file)){
		include_once($backupSQL_file);
		echo("<script>window.alert('Arquivo $backupSQL_file foi carregado com sucesso!');</script>");		  
	} else {
		echo("Arquivo de trabalho falhou ou não foi encontrado!<br/>\r\n");
		echo("Erro: #Bckp_sql_file");
	}
}
?>