<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Editar reporte</title>

    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>	
    <script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>
    <link rel="stylesheet" href="css/style_dropdowns.css" type="text/css" media="screen, projection"/>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
    
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">

	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.blockUI.js"></script>
	<script type='text/javascript' src='js/OpenLayers.js'></script>

<script>
	function mostrarPerfiles(){
		latitud=document.getElementById('latitud').value;
		longitud=document.getElementById('longitud').value;
		profundidad=document.getElementById('profundidad_valor').value;
		pagina='py/perfiles.py?lon='+longitud+'&lat='+latitud+'&prof=-'+profundidad;
		document.getElementById('frame_perfiles').src=pagina;
	}

	function mapaSismo(lon,lat){
		
		var map;
		format = 'image/png';		
		 	    
		var bounds = new OpenLayers.Bounds(	-81.27, -18.01, -68.05, -0.95);
 		var options = {
 	 		controls: [],	
 			maxExtent: bounds,
 			maxResolution: 0.1,
 	 		projection: 'EPSG:4326',
 	 		units: 'degrees'
 	 	};	    
	    
		map = new OpenLayers.Map('map_element', options);
		fondo = new OpenLayers.Layer.WMS(
				 'Fondo', 'http://10.10.0.19:8080/geoserver/sismos/wms',
				 {
				 LAYERS: 'sismos_group_minimal',
				 STYLES: '',
				 format: format,
				 tiled: true
				 },
				 {
				 buffer: 0,
				 displayOutsideMaxExtent: true,
				 isBaseLayer: true,
				 yx : {'EPSG:4326' : true}
				 }
				);
		
		map.addLayers([fondo]);
		/*
		for (i=0; i<10; i++){
			k = i.toString();
			eval("var city"+ k +"=document.getElementById('city"+ k +"').value;"); 
			eval("locmap"+ k +"=city"+ k +".split(',');");
			// texto de las referencias
			// location 0=Longitud; 1=Latitud; 2=Nombre de la ciudad
			eval("var lv"+ k +" = new OpenLayers.Layer.Vector('referencia"+ k +"');");
			eval("var p"+ k +" = new OpenLayers.Geometry.Point(locmap"+ k +"[0],locmap"+ k +"[1]);");
			eval("var pstyle"+ k +" = OpenLayers.Util.extend(OpenLayers.Feature.Vector.style['default"+ k + "'],OpenLayers.Feature.Vector.style['default"+ k +"']);");
			eval("pstyle"+ k +".graphic = false;");
			eval("pstyle"+ k +".label = locmap"+ k +"[2];");
			eval("pstyle"+ k +".labelAlign = 'l';");
			eval("pstyle"+ k +".labelXOffset = 8;");
			eval("pstyle"+ k +".fontColor = '#00008B';");
			eval("pstyle"+ k +".fontOpacity = 1;");
			eval("pstyle"+ k +".fontFamily='Arial';");
			eval("pstyle"+ k +".fontSize = '10';");
			eval("pstyle"+ k +".fontWeight = 'bold';");		
			eval("var feat"+ k +" = new OpenLayers.Feature.Vector(p"+ k +",null,pstyle"+ k +");");
			eval("lv"+ k +".addFeatures([feat"+ k +"]);");
			eval("map.addLayer(lv"+ k +");");
			
			// iconos de las referencias			
		    eval ("var markers"+ k +" = new OpenLayers.Layer.Markers('icoref"+ k +"');");
		    eval ("var size"+ k +" = new OpenLayers.Size(7,7);");
		    eval ("var offset"+ k +" = new OpenLayers.Pixel(-(size"+ k +".w/2), -(size"+ k +".h/2));");
		    eval ("var icon"+ k +" = new OpenLayers.Icon('img/iconos/guion_circulo.png', size"+ k +", offset"+ k +");");
		    eval ("markers"+ k +".addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(locmap"+ k +"[0],locmap"+ k +"[1]),icon"+ k +"));");					
		    eval("map.addLayer(markers"+ k +");");
			
		}
		
		*/
		
		// Epicentro		
	    var markers = new OpenLayers.Layer.Markers( "Sismo" );
	    var size = new OpenLayers.Size(32,32);
	    var offset = new OpenLayers.Pixel(-(size.w/2), -(size.h/2));
	    var icon = new OpenLayers.Icon('img/circulos.gif', size, offset);
	    markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
	    map.addLayer(markers);
		
		map.addControl(new OpenLayers.Control.Navigation());
		//map.addControl(new OpenLayers.Control.LayerSwitcher());		
		map.addControl(new OpenLayers.Control.PanZoomBar({
			position: new OpenLayers.Pixel(2, 15)
		}));
		
		map.setCenter(new OpenLayers.LonLat(lon,lat));
		map.zoomTo(3);
			if(!map.getCenter()){
				map.zoomToMaxExtent();
			}
	
	}	

		
	function borrarReferencias(){
		document.getElementById("referencia").value='';	
	}
	
	function enviar_parametros(){
		if(confirm("Desea publicar estos parámetros en la pagina web del IGP?")){
			$.blockUI({ message: '<span style="font-size:20px" >Publicando parámetros...</span>',css: {border:'none',backgroundColor: '#000', color: '#FFF' }});
			xajax_sendParameters(xajax.getFormValues('formArchivo'));
		}
	}	
	
	function enviar_correo(){
		if(confirm("Desea enviar los correos ?")){
			$.blockUI({ message: '<span style="font-size:20px" >Enviando correo...</span>',css: {border:'none',backgroundColor: '#000', color: '#FFF' }});
			xajax_sendEmails(xajax.getFormValues('formArchivo'));
		}
	}		

	function enviar_facetw(){
		if(confirm("Desea publicar en facebook y twitter ?")){
			$.blockUI({ message: '<span style="font-size:20px" >Publicando en Facebook y Twitter...</span>',css: {border:'none',backgroundColor: '#000', color: '#FFF' }});
			xajax_sendFaceTw(xajax.getFormValues('formArchivo'));
		}
	}		
	
	
	
		
</script>
{ajax}

<script language="javascript" src="js/AjaxUpload.2.0.min.js"></script>
 
<script language="javascript">
$(document).ready(function(){
	var button = $('#upload_button'), interval;
	new AjaxUpload('#upload_button', {
        action: 'upload.php',
		onSubmit : function(file , ext){
		if (! (ext && /^(txt)$/.test(ext))){
			// extensiones permitidas
			alert('Error: el nombre del archivo debe ser reporte.txt');
			// cancela upload
			return false;
		} else {
			if (file=="reporte.txt"){
				this.disable();
			}
			else{
				alert('Error: el nombre del archivo debe ser reporte.txt');
				return false;
			}
		}
		},
		onComplete: function(file, response){
			this.enable();			
			//alert("El reporte se subió correctamente");
			xajax_checkReport();
		}
	});
});
</script>
	     
  </head>
  <body onload="xajax_referenciaInicial({latitud},{longitud});">
	<div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
		<div class="container" style="margin: 0 auto;">
	    	<div id="header" class="cabecera1">
	    		<div class="span-9" style="text-align:center;"><br/><img src="img/logo-minan-igp_2012.png"></div>
			
	    		<div class="span-11">&nbsp;</div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>				
                        <div class="span-24">
                            <ul class="dropdown">
					        	<li><a href="#" onclick="enviar_parametros(); return false;">
					        			<img style="vertical-align:middle;" width=16px; src="img/publish.png" />&nbsp;Publicar
					        		</a>
					        	</li>
					        	<li>
					        		<a href="#" onclick="enviar_correo()">
					        			<img style="vertical-align:middle;" width=16px;  src="img/mail_send.png" />&nbsp;Enviar Correo
					        		</a>
					        	</li>
					        	<li>
					        		<a href="#" onclick="enviar_facetw()">
					        			<img style="vertical-align:middle;" width=16px;  src="img/facebook.png" />&nbsp;Facebook&nbsp;&nbsp;
					        			<img style="vertical-align:middle;" width=16px;  src="img/twitter.png" />&nbsp; Twitter
					        		</a>
					        	</li>

					        	

					        	<li>
					        		<a href="reporteathena.php">
					        			<img style="vertical-align:middle;" width=16px;  src="img/webreport.png" />&nbsp;Reporte Athena
					        		</a>
					        	</li>
                            </ul>

                        </div>
                </div>
                <div style="background-color:#EEEEEE; text-align:right; border-bottom: 1px solid #BBBBBB; border-top: 1px solid #BBBBBB;">

                </div>
	
	      <hr class="space">
	      <div class="span-24">
				<form onsubmit='return false;' method='POST' name='formArchivo' id='formArchivo'>
					<div class="span-6 prepend-1">
											
						<table class="tablacebra">
						<tr class="cebra"><td>&nbsp;</td><td>&nbsp;</td>
						</tr>						
						<tr class="cebra"><td>N° Reporte</td><td>: <input class='caja-login' name='correlativo' id='correlativo' type='text'></td>
						</tr>						
						<tr class="cebra"><td>Fecha</td><td>: <input class='caja-login' name='fecha' id='fecha' type='text' value={fecha_local}></td>
						</tr>
						<tr class="cebra"><td>Hora Local</td><td>: <input class='caja-login' name='hora' id='hora' type='text' value={hora_local}></td></tr>
						<tr class="cebra"><td>Latitud</td><td>: <input class='caja-login' name='latitud' id='latitud' type='text' value={latitud}></td></tr>
						<tr class="cebra"><td>Longitud</td>
							<td>: 
								<input class='caja-login' type='text' name='longitud' id='longitud' value={longitud}>
							</td>
						</tr>
						<tr class="cebra"><td>Profundidad</td><td>: <input class='caja-valor' type='text' name='profundidad_valor' id='profundidad_valor' value={profundidad_valor}>
						<input class='caja-unidad' type='text' name='profundidad_unidad' id='profundidad_unidad' value={profundidad_unidad}>
						</td></tr>
						<tr class="cebra"><td>Magnitud</td><td>: <input class='caja-valor' type='text' name='magnitud_valor' id='magnitud_valor' value={magnitud_valor}>
						<input class='caja-unidad' type='text' name='magnitud_unidad' id='magnitud_unidad' value={magnitud_unidad}>
						</td></tr>
						</table>
						
					</div>
					<div class="span-6">						
						<table class="tablacebra">
							<tr class="cebra"><td>Intensidad:</td></tr>
							<tr><td><textarea style="border: 1px solid #CD840F; width:200px; height:180px" name='intensidad' id='intensidad'></textarea></td></tr>
						</table>

					</div>
					
					<div class="span-6">
						<table class="tablacebra">
							<tr class="cebra"><td>Referencias:</td></tr>
							<tr class="cebra"><td><textarea style="border: 1px solid #CD840F; width:200px; height:180px" id='referencia' name='referencia'></textarea>
							<!-- <div style="height:180px; border: 1px solid #CD840F; padding:2px" id='referencia' name='referencia'></div>
							 -->
							</td></tr>
							<tr class="cebra"><td><a href=# onclick="borrarReferencias(); xajax_referencias(xajax.getFormValues('formArchivo')); return false;"><img src="img/trash.png"></a></td></tr>
						</table>
					</div>
					
					<div class="span-5 last">
						<table class="tablacebra">
							<tr class="cebra"><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr class="cebra">
								<td><div id="tabla_referencia"></div>
									<div id="hidden_referencia">
									
									</div>
								</td></tr>
						</table>
											
					</div>
					

					<div class="span-24">
						<div style="background-color:#EEEEEE;">
						<table width="100%" style="font-size:12px">
							<tr>
								<td>
									<span >Reporte: 
										<select id="report_type" name="report_type" style="background-color: #FFFFFF; border: 1px solid #CD840F; width: 100px;"><option value="P">Preliminar</option><option value="D">Definitivo</option></select>
									</span>
								</td>
								<td><input name="lista_sismos" id="lista_sismos" type="checkbox">
									<span>Agregar a la lista de sismos</span>
								</td>
								<td>
									<span id="content_replica">
										<input name="replica_sismos" id="replica_sismos" type="checkbox"><span>Marcar como r&eacute;plica </span>
									</span>
								</td>
								<td>
								
					        		<a id="upload_button" style="font-weight:bold;" href="#">
					        			<img style="vertical-align:middle;" width=16px;  src="img/import.png" />&nbsp;Importar archivo
					        		</a>
								</td>
								<td>								
									<a style="font-weight:bold;" onclick="borrarReferencias();  mostrarPerfiles(); xajax_referencias(xajax.getFormValues('formArchivo')); return false;" href=# >
									<img style="vertical-align:middle;" width=16px;  src="img/plot.png" />&nbsp;Plotear y Calcular referencias
									</a>
								</td>
							</tr>
						</table>						
						</div>
					</div>					
				</form>					
					
					<div class="span-24">

					<div class="span-14" style="height:320px">					
						<iframe id="frame_perfiles" src="py/perfiles.py?lon={longitud}&lat={latitud}&prof=-{profundidad_valor}" width="100%" height="100%" frameborder="0">
						</iframe>
					</div>
					<div class="span-10 last">
					
						<div id="map_element" style='padding-left:5px; width: 380px; height: 400px; background-color:#CCCCCC'></div>
					</div>					
					</div>
					
					
					        
	      </div>
	      
	      <div class="span-24 contenedor-pie">
	      	    <br>
				<p>Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte | Central Telefónica: 317-2300 |
				<a class="mostaza" href="#">Contacto</a>| Escríbenos a: <a class="mostaza" href="mailto:web@igp.gob.pe">web@igp.gob.pe</a>
				</p>
				      
	      </div>
		</div>
	</div>
  </body>
</html>
