<?php 
$sec = "inicio";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Integridad Ecosistémica</title>
	<meta name="author" content="Yanku" />
	<meta name="description" content="Integridad ecosistémica en México" />
	<meta name="keywords"  content="ecosistema" />
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="css/scroll.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/jquery.fullPage.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({

			});
		});
	</script>

</head>
<body>

<?php include 'header.php'; ?>
    
<div id="fullpage">
	<div class="section " id="section0">
        <img id="slider-logo" src="img/logo.png">
        <p class="intro-right">A thing is right when it tends to preserve the integrity, stability, and beauty of the biotic community. It is wrong when it tends otherwise. – <span class="it">Aldo Leopold, A Sand County Almanac (1949. Oxford University Press)</span></p>
    </div>
    <div class="section" id="section1">
        <img id="slider-mapa" src="img/mapadegradado.png">
        <div class="intro-left">
            <p>La Integridad se refiere a una condición subyacente de la organización funcional de un ecosistema que se refleja en variables estructurales y funcionales observables. A su vez, estas variables se relacionan directamente con la generación de servicios del ecosistema.</p>
            <p>Para poder definir acciones específicas en materia ambiental es necesario contar con datos sobre la condición en la que se encuentran los ecosistemas en su conjunto. La integridad ecológica es una propuesta conceptual para la gestión de escenarios propicios para un desarrollo sustentable del país.</p>
        </div>
    </div>
	<div class="section" id="section2">
        <div class="col-md-6">
            <h1>Integridad Ecológica</h1>
        </div>
        <div class="col-md-6">
            <p>Para lograr amalgamar este concepto en instrumentos de política pública nacional se deben revisar las necesidades y la disponibilidad de datos pertinentes. México es un país megadiverso y la integridad ecosistémica depende de las condiciones biofísicas locales (v. gr. tipo de vegetación, suelo y clima). Asumimos entonces que los patrones de asociación entre las variables y las condiciones de integridad no son genéricos, sino que pueden variar según el contexto definido por las fuerzas que impulsan la dinámica ecológica así como por los linajes biológicos presentes.</p>        
        </div>
        <div class="clear marg-bottom"></div>
        <div class="col-md-8">
            <img src="img/grafica.png" width="100%">
        </div>
        <div class="col-md-4">
            <div class="col-md-2 marg-bottom"><img src="img/green-icon.png"></div>
            <div class="col-md-10"><p>Aliquet sollicitudin, mauris dapibus nibh amet.</p></div>
            <div class="clear"></div>
            <div class="col-md-2 marg-bottom"><img src="img/white-icon.png"></div>
            <div class="col-md-10"><p>Aliquet sollicitudin, mauris dapibus nibh amet. </p></div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>