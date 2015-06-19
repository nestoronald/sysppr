<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<link href="bootstrap/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Módulo Programa de Presupuesto por Resultado - IGP</title>
    <!--     Boostrap de twitter -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="css/colorbox_3.css" />
    <link type="text/css" href="css/jquery-ui.css" rel="stylesheet">
    <script src="js/sha512.js" type="text/javascript"></script>
    <script src="js/hash.js" type="text/javascript"></script>
    <script src="js/jquery-1.8.3.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>
    <script src="js/colorbox/jquery.colorbox-min.js"></script>
    <script src="js/smoothzoom/jquery.smoothzoom.js"></script>
{$xajax}
</head>
<body>
    <div class = "container main-igp">
        <div id="header" class="cabecera">
            <div class="row-fluid">
                <div class="span4"><br>
                    <img src="bootstrap/img/logo-minan-igp_2012.png"/>
                </div>
                <div class="span6">
                        <h1> Módulo de Presupuesto por Resultado </h1>
                </div>
                <div class="span2">
                    <img src="bootstrap/img/igp-trans.png">
                </div>
            </div>
            <div class="container main-menu" id="menuppr">

                    <div class="navbar navbar-inverse">
                        <div class="navbar-inner">
                            <button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="caret"></span>
                               <span>Menu</span>
                            </button>
                            <div class="nav-collapse collapse">
                                <ul id="menu" class="nav"></ul>
                                <ul class="nav nav-pills pullright menu">
                                    <li><a href="index.php">Inicio</a></li>
                                    {$ppr_menu}

                                    {$result_menu}
                                    <li id="frigth"><span class="help"></span>  <a href="docs/Instructivo_Modulo_PPR.pdf" target="_blank" title="Manual de Usuario"> Orientación de Uso</a></li>
                                    <!-- <li><a href="#">Resultados</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container div-login-main" id="formLogin">
                <div id="divformlogin" name="formlogin">
                <form method="post"   class="form-inline" method="post" name="login_form">
                    <div class="input-prepend">
                    <span class="add-on label-id"></span>
                    <!-- <input type="text" placeholder="Usuario" id="user" name="user" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" class="input-small"> -->
                    <input class="text ui-widget-content ui-corner-all input-small" id="user" name="user" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" placeholder="Usuario">
                    </div>
                    <div class="input-prepend">
                    <span class="add-on label-pw"></span>
                    <!-- <input type="password" placeholder="Contraseña" id="password" name="password" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" class="input-small"> -->
                    <input class="text ui-widget-content ui-corner-all input-small" value="" id="password" name="password" type="password" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()"  placeholder="Contraseña">
                    </div>
                    <!-- <input type="submit" value="Ingresar" class="btn" name="Login" onclick="formhash(this.form, this.form.password);"> -->
                    <input value="Ingresar" onclick="formhash(this.form, this.form.password);" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only btn" id="btnLogin" type="button">
                    <div id="error"></div>
                </form>
                </div>
        </div>

        <div class="last container-fluid" id="contenido_inv">
            <div class="row-fluid">


                    <!-- <form method="post" name="login_form">

                                <span class="add-on label-id"></span>
                                <input class="text ui-widget-content ui-corner-all span4" id="user" name="user" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()" placeholder="Usuario">

                                <span class="add-on label-pw"></span>
                                <input class="text ui-widget-content ui-corner-all span4" value="" id="password" name="password" type="password" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()"  placeholder="Contraseña">

                                <input value="Ingresar" onclick="formhash(this.form, this.form.password);" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only btn" id="btnLogin" type="button">
                    </form> -->
                    <!--  -->


                <div id="indexContent">
                          <div id="divmain" class=" prepend-1 span6">
                            <span id="firts">E</span><span>l programa Presupuesto por Resultado (PPR) es una estrategia
                            de gestión pública que vincula la asignación de recursos a productos y resultados a favor de la población. Estos se vienen incrementando progresivamente a través de programas presupuestales, las acciones de seguimiento por desempeño sobre la base de indicadores, las evaluaciones y los incentivos a la gestión, entre otros instrumentos que determina el Ministerio de Economía y Finanzas (MEF) a través de la Dirección General de resupuesto Público, en colaboración con las demás entidades de Estado. </span>
                          </div>

                          <div id="divright" class="span3 last">
                                <div id="divCommentRight">
                                <div id="ppr_img"></div>
                                </div>
                          </div>
                </div>
                <div id="navigp"></div>
                <div id="divactividadproducto" style="padding-top:10px;"> </div>
                <div id="result_details"> </div>
                <div class="span12">
                        <div id="divnuevo"></div>
                        <div id="tabsadmin"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row-fluid navbar-inverse">
             <div class="contenedor-pie navbar-inner">
                <br>
                <p>Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte | Central Telefónica: 317-2300 |
                <a class="mostaza" href="#">Contacto </a>| Escríbenos a: <a rel="propover" class="mostaza" href="mailto:web@igp.gob.pe" >web@igp.gob.pe</a>
                </p><br>
             </div>
            </div>
        </div>
  </div>
<!-- <script type="text/javascript" src="bootstrap/js/jquery-1.7.2.min.js"></script> -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/igp.min.js"></script>
<!-- <script src="/bootstrap/js/bootstrap-collapse.js"></script>
<script src="/bootstrap/js/bootstrap-tooltip.js"></script> -->
<!-- <script src="bootstrap/js/bootstrap-popover.js"></script> -->
<!-- <script src="/bootstrapjs/typeahead.js"></script> -->
<!-- <script src="/bootstrap/js/modal.js"></script> -->
<!-- <script src="/bootstrap/js/bootstrap-scrollspy.js"></script> -->
</body>
</html>
