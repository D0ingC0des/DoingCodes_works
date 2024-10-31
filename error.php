<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="pt-br" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="cache-control" content="no-store" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="robot" content="noindex, nofollow" />
<meta name="robot" content="nosnippet, noarchive, noimageindex" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="copyright" content="Doing Codes" />
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
.div_doing {
    padding: 1px;
	margin: 0px;
	position: absolute;
    bottom: 0;
	width: 100%;
	top: 80vh;
	height: 80px;
}
</style>
</head>

<body>
<div style="width: 100%; padding: 10px; text-align: center;">
	<div id="logo_scpe-wb">
	<img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" />
	</div>
	<br />&nbsp;
</div>
<?php
$code = isset($_POST['code'])? $_POST['code'] : $_GET['code'];

$msg = array();
$msg['400'] = "<big><b>Erro 400</b></big><br /><span>Desculpe, mas não conseguimos processar sua solicitação. Parece que algo deu errado com a URL que você forneceu. Verifique se a URL está correta e tente novamente. Se o problema persistir, entre em contato com o administrador do site para obter assistência.</span>";
$msg['401'] = "<big><b>Erro 401</b></big><br /><span>O erro 401 ocorre quando você tenta acessar uma página que requer credenciais de autenticação válidas, mas as atuais não são reconhecidas ou estão ausentes. </span>";
$msg['403'] = "<big><b>Erro 403</b></big><br /><span>O erro 403 Forbidden ocorre quando o servidor entende a sua solicitação, mas se recusa a autorizá-la. </span>";
$msg['404'] = "<big><b>Erro 404</b></big><br /><span>O erro 404 ocorre quando a página solicitada não é encontrada no servidor.</span>";

//for ($i = 0; $i < count($msg); $i++) {

    if ($code != null) {
        echo $msg[$code];
    } else {
        echo "Desculpe! Ocorreu um erro desconhecido...";
    }

//}
?>
<div style="width: 100%; padding: 10px; text-align: center;" class="div_doing">
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