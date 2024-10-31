<?php
mb_internal_encoding('UTF-8');
date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if (!isset($_SESSION)) {
    session_start();
}

$variaveis = "_scripts/_publica_scripts/_php/variaveis_gerais.php";
$funcoes = "_scripts/_publica_scripts/_php/funcoes.php";
$conn = "_scripts/_publica_scripts/_php/conecta_sql.php";

if(file_exists($conn)){
	
	include_once($conn);
	
} 

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

//$conecta = mysqli_connect($server, $user, $pass, $database);

if(!$conecta){
	
	echo(mysqli_connect_error());
	exit();
	
} 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$_SESSION['login'];
	$_SESSION['senha'];
	$_SESSION['registro'];
	$_SESSION['nivel'];
	$_SESSION['idLogin'];
	$_SESSION['nome'];
}

if (($_SESSION['login'] == null) && ($_SESSION['senha'] == null)) {

    header("Location: login.php");
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta lang="pt-br" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title id="titulo_site"></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="imagem/_icon/scpe_favicon.ico" />
    <script src="_scripts/_publica_scripts/_js/jquery-3.6.3.js"></script>
    <script src="_scripts/_publica_scripts/_js/functions_gerais.js"></script>
    <script src="_scripts/_publica_scripts/_js/script_forms.js"></script>
    <style type="text/css">
        @import url("_scripts/_publica_scripts/_css/scpe_final_estilo.css");

        html {
            width: 100vw;
            height: 100vh;
            border-radius: 4px 4px 4px 4px;
        }
    </style>
    <script>
        /*document.onreadystatechange = function () {
            document.getElementById("titulo_site").innerHTML = "SCPE-web (Sistema de Controle de Portaria e Encomendas) - versão: 2";
            if (document.readyState === "loading" || document.readyState === "interactive") {
                document.getElementById("loader").style.display = "flex";
                document.getElementById("table_principal").style.display = "none";
            } else if (document.readyState === "complete") {
                document.getElementById("loader").style.display = "none";
                document.getElementById("table_principal").style.display = "table";
            }
        }*/

        $(document).ready(function () {
            //Loader
            $("#titulo_site").html("SCPE-web (Sistema de Controle de Portaria e Encomendas) - versão: 2");
            $.ajax('index.php')
            .done(function () {
                $("#loader").hide();
                $("#table_principal").show();
            })
            .fail(function () {
                $("#loader").show();
                $("#loader").css("width", "100%");
                $("#loader").css("height","100%");
                $("#table_principal").hide();
            })
        });
    </script>
</head>

<body>

    <!-- LOADER -->
    <div id="loader" class="loader">
        <img src="imagem/logos_novos/logo_novo_oficial.jpg" id="logo_app" /><br />
        <b>SCPE-web</b> powered by <b>Doing Codes</b><br />
        <img src="imagem/logo_peq_doing_codes.jpg" id="logo_doing" />
    </div>

    <!-- TABELA PRINCIPAL -->
    <table id="table_principal" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td colspan="2" class="topo_cell">
                    <img src="imagem/logos_novos/logo_novo_oficial.jpg" id="logo_app_peq" align="left" alt='Sistema de controle de portaria e encomendas' />
                    <div class="infos_gerais">
                        <div class="conteudo">
                            Olá <b>
                            <?php
                            if($_SESSION['login'] != NULL){
								print_r ($_SESSION['nome']);
                                echo ", <a href='login.php?logar=out'>Sair</a>";
								
							} else {
								echo ("Visitante");
                                //echo ('<script>window.alert("ATENÇÃO!!!\r\nNão é permitido o acesso a esse sistema sem efetuar log-in!\r\nPor favor, informe seus dados na tela de log-in!");</script>');
							}
                            ?>
                            </b><br />
                            <span id="conta_avisos" class="warning"></span><br />
                            <span id="conta_tags" class="warning"></span><br /> 
                            <span id="aviso_backup" class="warning"></span>   
                        </div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="cell">
                    <div class="button-cell" id="open_forms_nav"><i class="fa fa-plus-square" aria-hidden="true"></i>Cadastros</div>
                </td>
                <td class="cell">
                    <div class="button-cell" id="open_baixas_nav"><i class="fa fa-check-circle" aria-hidden="true"></i>Baixas</div>
                </td>
            </tr>
            <tr>
                <td class="cell">
                    <div class="button-cell" id="open_consultas_nav"><i class="fa fa-search" aria-hidden="true"></i>Consultas</div>
                </td>
                <td class="cell">
                    <div class="button-cell" id="open_atualizacoes_nav"><i class="fas fa-undo-alt"></i>Atualizações</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="separador" style="display: none;">Outros menus</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="button-cell-peq" id="ccif">Consultar código IFood</div>
                    <div class="button-cell-peq" id="ccifnc">Consultar código IFood não cadastrados</div>
                    <div class="button-cell-peq" id="cvapto">Consultar vagas por apto.</div>
                    <div class="button-cell-peq" id="cptag">Consultar pedidos de TAG</div>
                    <div class="button-cell-peq" id="cdcif">Cadastrar código IFood</div>
                    <div class="button-cell-peq" id="cdptag">Cadastrar pedido de TAG</div>
                    <div class="button-cell-peq" id="bxtag">Baixar TAG entregue</div>
                    <div class="button-cell-peq" id="cravs">Criar aviso</div>
                    <div class="button-cell-importante" id="regvst">Registrar visitante</div>
                    <div class="button-cell-importante" id="regprst">Registrar prestador de serviço</div>
                    <div class="button-cell-peq" id="sysstt">Status do sistema</div>
                    <div style="clear: left; width: 100%;"></div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="rodape">
                    Intra-site desenvolvido por <span id="auth">DOING CODES&reg;</span>. Todos os direitos reservados.<br />
                    É proibida a cópia, comercialização e edição sem autorização do desenvolvedor!<br />
                    Os dados contidos neste sistema são de propriedade de: Cond. Maison Porto Fino.<br />
                    A divulgação, cópia, extravio, ou, qualquer ação que possa causar vazamento de informação é CRIME!
                    De acordo com a lei 13.709/2018.<br />
                    Dados armazenados com cryptografia!
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- FORMULARIOS DE CADASTROS -->

    <div id="forms_nav">
        <div>
            <div class="titulo_menu">&nbsp;&nbsp;&nbsp;Cadastros gerais</div>
            <div id="close_forms_nav"><i class="fas fa-window-close" style="color: red;"></i></div>
        </div>
        <div style="clear: both;"></div>
        <table id="forms_cadastros">
            <tbody>
                <tr>
                    <td id="menu_cadastros">
                    <?php
                        $dom =  new DOMDocument();
                        $dom->load('_scripts/_publica_scripts/_xml/menu.xml');
                        $config = $dom->documentElement;

                        $items = $config->getElementsByTagName('item');

                        foreach ($items as $item) {
                            $itemId = $item->getAttribute('id');
                            $itemAncora = $item->getAttribute('ancora');
                            $itemAJAX = $item->getAttribute("id_link");
                            $itemConteudo = $item->textContent;

                            if($itemId == "cdt"){
                                $div_menu = "<div class=\"button-cell-menu\" id=\"$itemAJAX\">$itemAncora</div><div style='height: 3px;'></div>";
                                echo $div_menu;
                            }
                        }
                    ?>
                    </td>
                    <td id="formularios_cadastros">
                        <div id="div_exibe_forms">
                            <div id="logos_peq">
                                <img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" /><br /><br />
                                <img src="imagem/logo_peq_doing_codes.jpg" style="width: 200px; height: 200px; border: 0px;" />
                            </div>
                            <div id="forms_cad"></div>
                            <script>
                                $(document).ready(function() {

                                    $("#close_forms_nav").click(function() {
                                        $("#forms_cad").empty();
                                        $("#logos_peq").show();
                                    });

                                    //Cadastro de encomendas
                                    $("#cdt-001").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-001.');
                                            }
                                        });
                                    }); 
                                    
                                    //Cadastro de ocorrencias gerais
                                    $("#cdt-002").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_ocorrencia.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-002.');
                                            }
                                        });
                                    });

                                    //Cadastro de ocorrências de elevadores
                                    $("#cdt-003").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_ocorrencia_elev.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-003.');
                                            }
                                        });
                                    });

                                    //Cadastro de retirada de objetos
                                    $("#cdt-004").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_b.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-004.');
                                            }
                                        });
                                    });

                                    //Cadastro de prestadores de serviço
                                    $("#cdt-005").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_prestador.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-005.');
                                            }
                                        });
                                    });

                                    //Cadastro de moradores
                                    $("#cdt-006").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_morador.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-006.');
                                            }
                                        });
                                    });

                                    //Cadastro de funcionarios do condominio
                                    $("#cdt-007").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_funcionario.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-007.');
                                            }
                                        });
                                    });

                                    //Cadastro de funcionarios dos apartamentos
                                    $("#cdt-008").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_func_ap.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-008.');
                                            }
                                        });
                                    });

                                    //Cadastro de funcionarios dos apartamentos
                                    $("#cdt-009").click(function() {
                                        $("#logos_peq").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/forms/form_cad_proprietario.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_cad").html(data);
                                                $("#forms_cad").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_cad").html('Erro ao carregar o formulário cdt-009.');
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FORMULARIOS DE BAIXAS -->

    <div id="baixas_nav">
        <div>
            <div class="titulo_menu">&nbsp;&nbsp;&nbsp;Baixas gerais</div>
            <div id="close_baixas_nav"><i class="fas fa-window-close" style="color: red;"></i></div>
        </div>
        <div style="clear: both;"></div>
        <table id="baixas_geral">
            <tbody>
                <tr>
                    <td id="menu_baixas">
                    <?php
                        $dom =  new DOMDocument();
                        $dom->load('_scripts/_publica_scripts/_xml/menu.xml');
                        $config = $dom->documentElement;

                        $items = $config->getElementsByTagName('item');

                        foreach ($items as $item) {
                            $itemId = $item->getAttribute('id');
                            $itemAncora = $item->getAttribute('ancora');
                            $itemAJAX = $item->getAttribute("id_link");
                            $itemConteudo = $item->textContent;

                            if($itemId == "bxs"){
                                $div_menu = "<div class=\"button-cell-menu\" id=\"$itemAJAX\">$itemAncora</div><div style='height: 3px;'></div>";
                                echo $div_menu;
                            }
                        }
                    ?>
                    </td>
                    <td id="formularios_consultas">
                        <div id="div_exibe_forms">
                            <div id="logos_peq_b">
                                <img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" /><br /><br />
                                <img src="imagem/logo_peq_doing_codes.jpg" style="width: 200px; height: 200px; border: 0px;" />
                            </div>
                            <div id="forms_baixas"></div>
                            <script>
                                $(document).ready(function() {

                                    $("#close_baixas_nav").click(function() {
                                        $("#forms_baixas").empty();
                                        $("#logos_peq_b").show();
                                    });

                                    //Baixa de encomendas
                                    $("#bxs-001").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_c.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-001.');
                                            }
                                        });
                                    });

                                    //Baixa de objetos retirados
                                    $("#bxs-002").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_espacos.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erro ao carregar a formulário de baixas:", status, error);
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-002.');
                                            }
                                        });
                                    });

                                    //Baixa de prestadores de serviço
                                    $("#bxs-003").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/baixas/baixa_prestadores.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erro ao carregar a formulário de baixas:", status, error);
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-003.');
                                            }
                                        });
                                    });

                                    //Baixa de moradores
                                    $("#bxs-004").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_d.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erro ao carregar a formulário de baixas:", status, error);
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-004.');
                                            }
                                        });
                                    });

                                    //Baixa de funcionários do condominio
                                    $("#bxs-005").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/baixas/baixa_func_cond.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erro ao carregar a formulário de baixas:", status, error);
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-005.');
                                            }
                                        });
                                    });

                                    //Baixa de funcionários dos apartamentos
                                    $("#bxs-006").click(function() {
                                        $("#logos_peq_b").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/baixas/baixa_func_aptos.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_baixas").html(data);
                                                $("#forms_baixas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Erro ao carregar a formulário de baixas:", status, error);
                                                $("#forms_baixas").html('Erro ao carregar o formulário bxs-006.');
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FORMULARIOS DE CONSULTAS -->

    <div id="consultas_nav">
        <div>
            <div class="titulo_menu">&nbsp;&nbsp;&nbsp;Consultas gerais</div>
            <div id="close_consultas_nav"><i class="fas fa-window-close" style="color: red;"></i></div>
        </div>
        <div style="clear: both;"></div>
        <table id="consultas_geral">
            <tbody>
                <tr>
                    <td id="menu_consultas">
                    <?php
                        $dom =  new DOMDocument();
                        $dom->load('_scripts/_publica_scripts/_xml/menu.xml');
                        $config = $dom->documentElement;

                        $items = $config->getElementsByTagName('item');

                        foreach ($items as $item) {
                            $itemId = $item->getAttribute('id');
                            $itemAncora = $item->getAttribute('ancora');
                            $itemAJAX = $item->getAttribute("id_link");
                            $itemConteudo = $item->textContent;

                            if($itemId == "cnt"){
                                $div_menu = "<div class=\"button-cell-menu\" id=\"$itemAJAX\">$itemAncora</div><div style='height: 3px;'></div>";
                                echo $div_menu;
                            }
                        }
                    ?>
                    </td>
                    <td id="formularios_consultas">
                        <div id="div_exibe_forms">
                        <div id="logos_peq_d">
                                <img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" /><br /><br />
                                <img src="imagem/logo_peq_doing_codes.jpg" style="width: 200px; height: 200px; border: 0px;" />
                            </div>
                            <div id="forms_consultas">
                                <script>
                                $(document).ready(function() {

                                    $("#close_consultas_nav").click(function() {
                                        $("#forms_consultas").empty();
                                        $("#logos_peq_d").show();
                                    });

                                    //consulta encomendas recebidas
                                    $("#cnt-001").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_encmd.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-001.');
                                            }
                                        });
                                    });

                                    //consulta objetos retirados
                                    $("#cnt-002").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_objts.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-002.');
                                            }
                                        });
                                    });

                                    //consulta ocorrencias gerais
                                    $("#cnt-003").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_oc_geral.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-003.');
                                            }
                                        });
                                    });

                                    //consulta ocorrencias dos elevadores
                                    $("#cnt-004").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_oc_elev.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-004.');
                                            }
                                        });
                                    });

                                    //consulta prestadores de serviço
                                    $("#cnt-005").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_prestador.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-005.');
                                            }
                                        });
                                    });

                                    //consulta moradores
                                    $("#cnt-006").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_morador.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-006.');
                                            }
                                        });
                                    });

                                    //consulta funcionários condominio
                                    $("#cnt-007").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/consultas/cons_func.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-007.');
                                            }
                                        });
                                    });

                                    //consulta funcionários dos apartamentos
                                    $("#cnt-008").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_h.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-008.');
                                            }
                                        });
                                    });

                                    //consulta funcionários dos apartamentos
                                    $("#cnt-009").click(function() {
                                        $("#logos_peq_d").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_i.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_consultas").html(data);
                                                $("#forms_consultas").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_consultas").html('Erro ao carregar o formulário cnt-009.');
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FORMULARIOS DE ATUALIZAÇÃO -->

    <div id="updates_nav">
        <div>
            <div class="titulo_menu">&nbsp;&nbsp;&nbsp;Atualizações gerais</div>
            <div id="close_updates_nav"><i class="fas fa-window-close" style="color: red;"></i></div>
        </div>
        <div style="clear: both;"></div>
        <table id="updates_geral">
            <tbody>
                <tr>
                    <td id="menu_updates">
                    <?php
                        $dom =  new DOMDocument();
                        $dom->load('_scripts/_publica_scripts/_xml/menu.xml');
                        $config = $dom->documentElement;

                        $items = $config->getElementsByTagName('item');

                        foreach ($items as $item) {
                            $itemId = $item->getAttribute('id');
                            $itemAncora = $item->getAttribute('ancora');
                            $itemAJAX = $item->getAttribute("id_link");
                            $itemConteudo = $item->textContent;

                            if($itemId == "atz"){
                                $div_menu = "<div class=\"button-cell-menu\" id=\"$itemAJAX\">$itemAncora</div><div style='height: 3px;'></div>";
                                echo $div_menu;
                            }
                        }
                    ?>
                    </td>
                    <td id="formularios_updates">
                        <div id="div_exibe_forms">
                            <div id="logos_peq_c">
                                <img src="imagem/logos_novos/logo_novo_oficial.jpg" style="width: 300px; height: 250px; border: 0px;" /><br /><br />
                                <img src="imagem/logo_peq_doing_codes.jpg" style="width: 200px; height: 200px; border: 0px;" />
                            </div>
                            <div id="forms_updates">
                                <script>
                                $(document).ready(function() {

                                    $("#close_updates_nav").click(function() {
                                        $("#forms_updates").empty();
                                        $("#logos_peq_c").show();
                                    });

                                    //Atualiza infos dos funcionários do condomínio
                                    $("#atz-001").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/update/lista_func_updt.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-001.');
                                            }
                                        });
                                    });

                                    //Atualiza infos dos moradores do condomínio
                                    $("#atz-002").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_e.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-002.');
                                            }
                                        });
                                    });

                                    //Atualiza infos dos prestadores de serviço
                                    $("#atz-003").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/update/seleciona_prestador.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-003.');
                                            }
                                        });
                                    });

                                    //Atualiza infos dos funcionários dos aptos
                                    $("#atz-004").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_f.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-004.');
                                            }
                                        });
                                    });

                                    //Atualiza infos dos proprietários dos aptos
                                    $("#atz-005").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/gera_lista_aps_g.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-005.');
                                            }
                                        });
                                    });

                                    //Atualiza infos dos condominio
                                    $("#atz-006").click(function() {
                                        $("#logos_peq_c").hide();

                                        $.ajax({
                                            url: '_scripts/_publica_scripts/_php/update/update_dados.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            success: function(data) {
                                                $("#forms_updates").html(data);
                                                $("#forms_updates").scrollTop(0);
                                            },
                                            error: function(xhr, status, error) {
                                                
                                                $("#forms_updates").html('Erro ao carregar o formulário atz-006.');
                                            }
                                        });
                                    });
                                });
                                </script>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MENUS MENORES -->

    <div id="menus_menores">
        <div>
            <div class="titulo_menu" id="titulo_menu_peq">&nbsp;&nbsp;&nbsp;Menus menores</div>
            <div id="close_menus_menores"><i class="fas fa-window-close" style="color: red;"></i></div>
        </div>
        <div style="clear: both;"></div>
        <div id="div_exibe_forms_menores" class="show_dados_peq"></div>
    </div>

    <!-- SCRIPTS -->

    <script>
        $(document).ready(function () {
            
            //Mostra os menus

            $("#open_forms_nav").click(function () {
                $("#forms_nav").fadeIn(500); //Menus de cadastros
            });

            $("#open_baixas_nav").click(function () {
                $("#baixas_nav").fadeIn(500); // Menus de baixas
            });

            $("#open_consultas_nav").click(function(){
                $("#consultas_nav").fadeIn(500) // Menus de consultas
            });

            $("#open_atualizacoes_nav").click(function(){
                $("#updates_nav").fadeIn(500); // Menus de atualizações
            });

            $("#ccifnc").click(function(){ // Lista os códigos IFood não cadastrados
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Consultar códigos IFood");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();
                $("#div_exibe_forms_menores").html(listaCodesIfood());
                $("#div_exibe_forms_menores").scrollTop(0);

            }); 

            $("#cdcif").click(function(){ // Cadastra códigos IFood
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Cadastrar códigos IFood");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: '_scripts/_publica_scripts/_php/processaJson.php',
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });

                $('#meuFormulario').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '_scripts/_publica_scripts/_php/processaJson.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(data) {
                            $("#div_exibe_forms_menores").empty();
                            $('#div_exibe_forms_menores').html(data);
                        },
                        error: function() {
                            $("#div_exibe_forms_menores").empty();
                            $("#div_exibe_forms_menores").html('Erro ao enviar o formulário.');
                        }
                    });
                });
            });

            $("#cdptag").click(function(){ // Cadastrar pedidos de TAG veicular
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Cadastrar pedidos TAGs");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/cadastrar_tags_b.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });

                $('#cadPddTag').submit(function(event) {
                    event.preventDefault();
                    var form = $(this);
                    var formData = form.serialize();
                    $.ajax({
                        url: "_scripts/_publica_scripts/_php/cadastrar_tags_b.php",
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            $("#div_exibe_forms_menores").empty();
                            $("#div_exibe_forms_menores").html(data);
                        },
                        error: function() {
                            console.error("AJAX Error:", status, error);
                            $("#div_exibe_forms_menores").empty();
                            $("#div_exibe_forms_menores").html('Erro ao enviar o formulário.');
                        }
                    });
                });
            });

            $("#bxtag").click(function(){ //Baixar TAGs veiculares
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Baixar pedidos TAGs");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/baixa_tags_veiculares_b.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });

                $('#bxsPddTag').submit(function(event) {
                    event.preventDefault();
                    var form = $(this);
                    var formData = form.serialize();
                    $.ajax({
                        url: "_scripts/_publica_scripts/_php/baixa_tags_veiculares_b.php",
                        type: 'POST',
                        data: formData,
                        success: function(data) {
                            $("#div_exibe_forms_menores").empty();
                            $("#div_exibe_forms_menores").html(data);
                        },
                        error: function() {
                            console.error("AJAX Error:", status, error);
                            $("#div_exibe_forms_menores").empty();
                            $("#div_exibe_forms_menores").html('Erro ao enviar o formulário.');
                        }
                    });
                });
            });

            $("#ccif").click(function(){ // Consulta códigos IFood cadastros no sistema principal
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Consulta códigos IFood");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/consulta_codigo_ifood.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#cvapto").click(function(){ // Consulta vagas de garagem por apto
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Consulta vagas por apto");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/consultas/cons_vaga_carro.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#cptag").click(function(){ // Consulta todos os pedidos de TAGs
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Consulta pedidos TAG");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.getJSON("_scripts/_publica_scripts/_json/solicitacao_tag.json", function(data) {
                    const sortedData = data.sort((a, b) => parseInt(a.apto_solicitante) - parseInt(b.apto_solicitante));
                    const finalizados = sortedData.filter(item => item.finalizado === "S");
                    const naoFinalizados = sortedData.filter(item => item.finalizado === "N");

                    function createItemList(items) {
                        const list = $("<ul>");
                        items.forEach(item => {
                            const listItem = $("<li style='border-bottom: 1px solid #000000; padding: 4px;'>");

                            if(!item.data_finalizacao == 0){
                                listItem.html("<b>Apto:</b> " + item.apto_solicitante + "<br /><b>Data entrega:</b> " + item.data_finalizacao);
                            } else {
                                listItem.html("<b>Apto:</b> " + item.apto_solicitante + "<br /><b>Data solicitação:</b> " + item.data_solicitacao);
                            }
                            list.append(listItem);
                        });
                        return list;
                    }

                    const finalizadosList = createItemList(finalizados);
                    const naoFinalizadosList = createItemList(naoFinalizados);

                    $("#div_exibe_forms_menores")
                    .append("<h3>Itens Não Finalizados:</h3>")
                    .append(naoFinalizadosList)
                    .append("<h3>Itens Finalizados:</h3>")
                    .append(finalizadosList);
                
                });
            });

            $("#cravs").click(function(){ // Adiciona novo aviso
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Criar aviso");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/forms_avisos.html",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#regvst").click(function(){ // Cadastra entrada de visitante
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Cadastrar visitante");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/forms/form_reg_entradas_b.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#regprst").click(function(){ // Registra a entrada de prestadores de serviço
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Entrada de prestadores");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/forms/form_reg_entradas_c.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#sysstt").click(function(){ //Status do sistema
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Status e contadores");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/_php/infos_nova.php",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            $("#auth").click(function(){
                $("#titulo_menu_peq").empty();
                $("#titulo_menu_peq").html("&nbsp;Doing Codes");
                $("#menus_menores").fadeIn(500);
                $("#div_exibe_forms_menores").empty();

                $.ajax({
                    url: "_scripts/_publica_scripts/form.html",
                    dataType: 'html',
                    success: function(data) {
                        $("#div_exibe_forms_menores").html(data);
                        $("#div_exibe_forms_menores").scrollTop(0); 
                    },
                    error: function() {
                        $("#div_exibe_forms_menores").html('Erro ao carregar o formulário.');
                    }
                });
            });

            //Fecha os menus

            $("#close_forms_nav").click(function () {
                $("#forms_nav").fadeOut(500); // Fecha cadastros
            });

            $("#close_baixas_nav").click(function () {
                $("#baixas_nav").fadeOut(500); // Fecha baixas
            });

            $("#close_consultas_nav").click(function(){
                $("#consultas_nav").fadeOut(500); // Fecha consultas
            });

            $("#close_updates_nav").click(function(){
                $("#updates_nav").fadeOut(500);
            });

            $("#close_menus_menores").click(function(){
                $("#menus_menores").fadeOut(500);
            });
        });
    </script>

    <!-- Script de funções ocultas do site -->
    <script language="javascript" type="text/javascript">
		setInterval(atualizarPageB, 1000);
		function atualizarPageB() {
			var dataJS = new Date();
            var diaSemanaJS = dataJS.getDay() + 1;
			var horaJS = dataJS.getHours();
			var minJS = dataJS.getMinutes();
			var secJS = dataJS.getSeconds();
							
			//Atualiza a page e inicia backup
			if(horaJS == 8 && minJS == 35 && secJS == 00){
			    window.location.replace("index.php");

				//Iniciando backup por AJAX
				$.ajax({
  					url: '_geraBackupSQL/gera_backup_sql.php',
  					type: 'POST',
  					success: function(data) {
    					$("#aviso_backup")
                        .html("Backup realizado com sucesso")
                        .delay(60000)
                        .fadeOut(500);
  					},
  					error: function() {
    					$("#aviso_backup")
                        .html("Erro ao realizar backup")
                        .delay(60000)
                        .fadeOut(500);
  					}
				});

				//Iniciando WORKER
				var worker = new Worker('_scripts/_publica_scripts/_js/worker.js');

				worker.onmessage = function(e) {
  					console.log(e.data);  
				};

				worker.postMessage('Iniciar backup');
			}
							
			//Faz log-off automatico
			if(horaJS == 7 && minJS == 00 && secJS == 00){
                window.location.replace("login.php?logar=out");
			}
							
			if(horaJS == 19 && minJS == 00 && secJS == 00){
				window.location.replace("login.php?logar=out");
			}
					
		}
	</script>
</body>
<?php
//Código para as TAGs

$json_content = file_get_contents('_scripts/_publica_scripts/_json/solicitacao_tag.json');
$data = json_decode($json_content, true);
$count_N = 0;
foreach ($data as $entry) {
    if ($entry['finalizado'] === 'N') {
        $count_N++;
    }
}
if($count_N > 0){
    $script = "<script>";
    $script .= "$('#conta_tags').html('Existem <b>$count_N</b> pedidos de TAGs em aberto!');";
    $script .= "</script>";

    echo $script;
    
} else {
    $script = "<script>";
    $script .= "$('#conta_tags').html('Sem solicitações de TAGs');";
    $script .= "</script>";

    echo $script;
}

//Código para os avisos
$alertaAvisos = mysqli_query($conecta, "SELECT * FROM avisos_portaria WHERE aviso_ativo='S'");
$numeroDeAvisos = mysqli_num_rows($alertaAvisos);
$diaFull = date("dmY");
			
if($numeroDeAvisos >= 1){
				
	if($numeroDeAvisos > 1){
		$JQuery = "<script>";		
		$JQuery .= "$('#conta_avisos').html('Existem <b>($numeroDeAvisos)</b> novos avisos para hoje!');";
        $JQuery .= "</script>";

        echo $JQuery;
					
	} else {
		$JQuery = "<script>";		
		$JQuery .= "$('#conta_avisos').html('Há <b>($numeroDeAvisos)</b> um novo aviso para hoje!</a>');";
        $JQuery .= "</script>";

        echo $JQuery;
					
	}
				
} else {
				
	$JQuery = "<script>";		
	$JQuery .= "$('#conta_avisos').html('Sem novos avisos para hoje.');";
    $JQuery .= "</script>";

    echo $JQuery;
}

while ($x = mysqli_fetch_array($alertaAvisos, MYSQLI_ASSOC)) {
    $alert_01 = $x['id_aviso'];
    $alert_02 = $x['data_validade'];
    $alert_03 = $x['aviso_ativo'];

    if ($alert_02 == $diaFull) {
        $sqlUpdateAvisoX = "UPDATE avisos_portaria SET aviso_ativo = 'N' WHERE data_validade = '$diaFull'";
        $fazUpdateX = mysqli_query($conecta, $sqlUpdateAvisoX) or die (mysqli_error());
        $ajax = "<script>";
        $ajax .= "$(\"#aviso_backup\").html(\"Lista de avisos atualizada com sucesso\").delay(60000).fadeOut(500);";
        $ajax .= "</script>";

        echo $ajax;
    } else {
        $ajax = "<script>";
        $ajax .= "$(\"#aviso_backup\").html(\"Nenhum aviso para atualização\").delay(60000).fadeOut(500);";
        $ajax .= "</script>";

        echo $ajax;
    }
}
			
mysqli_free_result($alertaAvisos);
?>
</html>
<?php
mysqli_close($conecta);
clearstatcache();
?>