<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>IGP - PPR</title>

     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="css/style_dropdowns.css" type="text/css" media="screen, projection"/>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection">

    <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">

    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">

	<link type="text/css" href="css/jquery-ui.css" rel="stylesheet">

	<link href="css/fileUploader.css" rel="stylesheet" type="text/css" />

	<link media="screen" type="text/css" rel="stylesheet" href="csstree/jqueryFileTree.css">
	<link media="screen" type="text/css" rel="stylesheet" href="css/fileTree.css">
	<link rel="stylesheet" href="css/colorbox_3.css" />
	{$css_link}

	<!--
	<link type="text/css" rel="Stylesheet" href="css/ui-lightness/jquery-ui-1.8.14.custom.css">
	-->
	 <!--script src="bootstrap/js/bootstrap.js" type="text/javascript"></script-->
	<script src="js/jquery-1.8.3.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>
	<script language="javascript" src="js/AjaxUpload.2.0.min.js"></script>
	<script src="js/jquery.fileUploader.js" type="text/javascript"></script>
	<script src="js/jqueryFileTree.js" type="text/javascript"></script>
	<script src="js/jquery.dropdownPlain.js" type="text/javascript" ></script>

	<script src="js/sha512.js" type="text/javascript"></script>

	<script src="js/hash.js" type="text/javascript"></script>

	<script src="js/colorbox/jquery.colorbox-min.js"></script>
	<script src="js/smoothzoom/jquery.smoothzoom.js"></script>
	<!--script src="js/modernizr-latest.js" type="text/javascript"></script-->
 	<script type="text/javascript">
// 	if (Modernizr.rgba){
//    alert("SI sombra caja");
// }
// else{
//    alert("NO sombra caja");
// }


// 	</script>

	{$xajax}


  </head>
  <body>
	<div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
		<div class="container" style="margin: 0 auto;">
	    	<div id="header" class="cabecera1">
	    		<div class="span-9" style="text-align:center;"><br/><img src="img/logo-minan-igp_2012.png"></div>

	    		<div class="span-11 main-title"><h1>Modulo de Presupuesto por Resultado (PPR)</h1></div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>
					<div class="span-24 none" id="mainmenu">
						<ul class="dropdown">
					       <li><a href="index.php">&nbsp;&nbsp;Inicio - PPR</a></li>

					       {$ppr_menu}
					       {$ppr_result}

					      <li id="frigth"><span class="help"></span>  <a href="docs/Instructivo_Modulo_PPR.pdf" target="_blank" title="Manual de Usuario"> Orientación de Uso</a></li>

                         </ul>
					</div>
                </div>


	      <div id="login_home" class="span-24"><div style="/* float: right; */ margin-top: 5px;" id="admin"><form method="post" name="login_form">

						        <span class="add-on label-id"></span>
						        <input class="text ui-widget-content ui-corner-all" id="user" name="user" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" placeholder="Usuario">

						        <span class="add-on label-pw"></span>
						        <input class="text ui-widget-content ui-corner-all" value="" id="password" name="password" type="password" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" placeholder="Contraseña">

								<input value="Ingresar" onclick="formhash(this.form, this.form.password);" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="btnLogin" type="button">
						    </form></div>
		</div>

	    <div id="indexContent" class="span-24">
		      <div id="divmain" class="span-16 prepend-1">
				<span id="firts">E</span><span>l programa Presupuesto por Resultado (PPR) es una estrategia
				de gestión pública que vincula la asignación de recursos a productos y resultados a favor de la población. Estos se vienen incrementando progresivamente a través de programas presupuestales, las acciones de seguimiento por desempeño sobre la base de indicadores, las evaluaciones y los incentivos a la gestión, entre otros instrumentos que determina el Ministerio de Economía y Finanzas (MEF) a través de la Dirección General de resupuesto Público, en colaboración con las demás entidades de Estado. </span>



		      </div>

		      <div id="divright" class="span-6 last">

					<div id="divCommentRight">
					<div id="ppr_img"></div>
					</div>
		      </div>
		  </div>
		  <div id="divResult"></div>

		  <div id="loginContent" class="span-22 prepend-1">

		  	<div id="update">
			  		<div class="span-22 last" style="padding-top:10px;"></div>
		  	</div>


		  </div>


		  <div id="projectContent" class="span-201">


				<div id="divListProject" class="last ddl-menu">
					<div id="divCategory_frond" ></div>
					<div id="divSubcategory_frond" class="divcenter"></div>
					<div id="divactividadproducto" style="padding-top:10px;"> </div>

			  	</div>
		  </div>
		  <div class="span-200">
		  		<div id="divnuevo"></div>
				<div id="tabsadmin"></div>
		  </div>


	      <div class="span-24 contenedor-pie">
	      	    <br>
				<p>Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte | Central Telefónica: 317-2300 |
				Escríbenos a: <a class="mostaza" href="mailto:admin.cndg@igp.gob.pe">admin.cndg@igp.gob.pe</a>

				</p>


	      </div>
		</div>
	</div>
  </body>
</html>
