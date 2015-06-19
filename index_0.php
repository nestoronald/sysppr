<?php
	require ('../class/xajax_core/xajax.inc.php');
	require ('../class/dbconnect.php');
	require('../class/smarty/Smarty.class.php');
	require ("pprModel.php");
	require ("security.php");
	include("../class/easy_upload/upload_class.php");
	//require ("phpFileTree.php");
	$xajax=new xajax();
	$xajax->configure('javascript URI', 'js/');
	date_default_timezone_set('America/Lima');



	function menuAdmin(){
		$objResponse = new xajaxResponse();
		//$smarty = new Smarty;
		//$html= $smarty->fetch('tpl/login.tpl');

		$objResponse->assign("indexContent","style.display","none");
		//$objResponse->assign("loginContent","innerHTML",$html);
		$objResponse->assign("divListProject","innerHTML","");
		$objResponse->assign("divactividadproducto","innerHTML","");
		$objResponse->assign("divmenuCategory","innerHTML","");
		$objResponse->assign("divmenuSubcategory","innerHTML","");
		$objResponse->assign("divmenuData","innerHTML","");
		// $objResponse->assign("divnuevo","innerHTML","");
		// $objResponse->assign("tabsadmin","innerHTML","");
		// $objResponse->assign("divResult","innerHTML","");
		return $objResponse;
	}



/*---*/
	function menuProject($idyear){
		$objResponse = new xajaxResponse();

		$resultCategory=selectcategory_year($idyear);
		$category_description = "";
		 if ($resultCategory["Error"]==0) {
			$category_description .= "<option value='999' selected>Seleccione una opción</option>";
			for($i=0; $i<$resultCategory["Count"]; $i++){
				$category_description.="<option value=".$resultCategory["id_years_category"][$i]." >".$resultCategory["category_description"][$i]."</option>";
				}
		 }
		 else{
		 	$category_description= "<div class='msjdel'>Todavía no se encuentran Productos en este año</div>";
		 }
		// elseif ($resultyear["Count"]==1) {
		// 	$category_description="<h1><span class='divselect'> Programa:<span class='select'>".$resultCategory["category_description"][0]."</span></span></h1>";
		// }
		// else{
		// 	$category_description="<span class='msjdel'>Todavía no se encuentran Productos en este año</span>";
		// }
		$category_description='<h3 class="f-main">Productos y Actividades: <span class="divselect">'.$resultCategory["year_description"][0].'</span></h3>
			<div class="divcenter"><div class="divselect " >
			<label for="prog_main">Programa: </label>
			<select class="select" for="prod_main" onchange="xajax_listSubCategory(this.value,775)" id="cat_select">'.$category_description.'</select>
			</div></div>';

		//$resultCategory=selectcategory($idcategory);
		//$category_description="<h1><span class='divselect'> Año:<span class='select'>".$resultCategory["category_description"][0]."</span></span></h1>";

		// $resultSubCategory=selectsubcategory($idcategory);
		// $subcategory_description="<option value='999'>Seleccione una opción</option>";

		// for($i=0; $i<count($resultSubCategory["subcategory_description"]); $i++){
		// 	$subcategory_description.="<option value='".$resultSubCategory["idsubcategory"][$i] ."'>".$resultSubCategory["subcategory_description"][$i]."</option>";
		// }

		//$subcategory_description='<div class="divselect" id="ListProject"><label for="prod_main">Producto: </label><select class="select" for="prod_main" onclick="xajax_actividadproducto(this.value,'.$idcategory.')" id="subcat_select">'.$subcategory_description.'</select></div>';
		  //                  $d= "<select onclick=\"xajax_actividadproducto(this.value,".$idcategory.")\">";
		//$subcategory_description.="<p>&nbsp;</p>";

		$objResponse->assign("indexContent","style.display","none");
		$objResponse->assign("loginContent","innerHTML","");
		$objResponse->assign("divactividadproducto","innerHTML","");
		$objResponse->assign("divCategory_frond","innerHTML",$category_description);
		$objResponse->assign("divmenuCategory","innerHTML","");
		$objResponse->assign("divmenuSubcategory","innerHTML","");
		$objResponse->assign("divmenuData","innerHTML","");
		$objResponse->assign("divnuevo","innerHTML","");
		$objResponse->assign("divResult","innerHTML","");
		$objResponse->assign("divSubcategory_frond","innerHTML","");

		//$objResponse->alert(print_r($resultCategory["Query"],TRUE));
		return $objResponse;
	}

	function actividadproducto($idsubcategory,$idcategory){
		$objResponse = new xajaxResponse();
		$smarty = new Smarty;
		//$result=selectPPR($idsubcategory);


		//$result=selectPPR($idsubcategory);
		$html="";
		$html.=subcategory_detalle($idsubcategory,$idcategory);

		//$html.=activity($idsubcategory,$idcategory);
		$idactivity="";
		$resultprod= product_details($idsubcategory, $idcategory,$idactivity);
		// $objResponse->alert(print_r($resultprod,TRUE));
		for ($i=0; $i <$resultprod["Count"]; $i++) {
			$x=number_format($resultprod['costo_23'][$i],2);
			$y=number_format($resultprod['costo_26'][$i],2);
			$total=$resultprod['costo_23'][$i]+$resultprod['costo_26'][$i];
			$html.='<table class="activity">

			<tbody><tr class="prog title">
				<th class="thnum">N°</th>
				<th>Nombre de la Actividad</th>
				<th>Universo</th>
				<th>Linea Base</th>
				<th>Responsable</th>
			</tr>

			<tr class="prog">
				<td class="num">'.($i+1).'</td>
				<td>'.$resultprod['activity_description'][$i].'</td>
				<td>'.$resultprod['activity_universo'][$i].'</td>
				<td>'.$resultprod['activity_lb'][$i].'</td>
				<td>'.$resultprod['resp_nombre'][$i].'</td>
			</tr>
			</tbody></table>

			<table id="activity_'.$i.'" class="activity">
				<tbody><tr class="prog title">
					<td rowspan="2" class="tdProg">Programación</td>
					<td rowspan="2" class="tdInd">Indicadores</td>
					<td rowspan="2" class="tdMetafisica">Meta Fisica</td>
					<td colspan="3">Presupuesto S/.</td>

				</tr>
				<tr class="prog title">
					<td>2,3</td>
					<td>2,6</td>
					<td>Total</td>
				</tr>';
				$idactivity=$resultprod["idactivity"][$i];

				$result_0=  product_details($idsubcategory, $idcategory, $idactivity);

				for ($j=0; $j < $result_0["Count"] ; $j++) {
					$x = number_format($result_0["costo_23"][$j],2);
					$y = number_format($result_0["costo_26"][$j],2);
					$sum= ($result_0["costo_23"][$j] + $result_0["costo_26"][$j]);
					$html.='<tr class="prog">
						<td class="tdProg">'.$result_0['year_description'][$j].'</td>
						<td class="tdInd">'.$result_0['ind_description'].'</td>
						<td class="tdMetafisica">'.$result_0['metafisica'][$j].'</td>
						<td> '.$x.'</td>
						<td> '.$y.'</td>
						<td> '.number_format($sum,2).'</td>
					</tr>';
				}
				$html.='</tbody></table><div class="divblock"></div>';






		}



		$objResponse->assign("divactividadproducto","innerHTML",$html);
		$objResponse->script('$(".mostrarfiltro").click(function(event) {
					   event.preventDefault();
					    $(".masfiltros").slideToggle();
					});
					$(".a-result-'.$i.'").click(function(){
						$(".result-'.$i.'").addClass("r-borde")
					});

					$("a.map-gallery").colorbox({ opacity:0.5 , rel:"group1" });
					');
		//$objResponse->alert(print_r($resultprod["Query"],TRUE));

		return $objResponse;
	}
//nrl

	function subcategory_detalle($idsubcategory,$idcategory){
		$smarty = new Smarty;
		$objResponse=new xajaxResponse();
		//$resultSubCategory=selectsubcategory($idcategory);

		//PRODUCTO
		$idactivity="";
		$res_01 =product_details($idsubcategory, $idcategory,$idactivity);
		if (isset($res_01["category_description"])) {
			$category_title =$res_01["category_description"][0];
			$smarty->assign("title_c",$category_title);
		}
		if (isset($res_01["subcategory_description"])) {
			$subcategory_title=$res_01["subcategory_description"][0];
			$smarty->assign("title_sc",$subcategory_title);
		}
		if (isset($res_01["subcategory_universo"])) {
			$subcategory_universo =$res_01["subcategory_universo"][0];
			$smarty->assign("universo",$subcategory_universo);
		}
		if (isset($res_01["responsable"])) {
			$subcategory_responsable =$res_01["responsable"][0];
			$smarty->assign("responsable",$subcategory_responsable);
		}
		if (isset($res_01["subcategory_lb"])) {
			$subcategory_lb=$res_01["subcategory_lb"][0];
			$smarty->assign("lineabase",$subcategory_lb);
		}
		$total_23=0;
		$total_26=0;
		for ($i=0; $i < $res_01["Count"]; $i++) {
			$total_23 += $res_01["costo_23"][$i];
			$total_26 += $res_01["costo_26"][$i];
		}
		$total = ($total_23 + $total_26);
		$total = number_format($total,2);
		//$subcategory_metafisica=$res_01["metafisica"][0];

		if (isset($res_01["subcategory_um"])) {
			$subcategory_um = $res_01["subcategory_um"][0];
			$smarty->assign("unidadmedida_sc",$subcategory_um);
		}

		$smarty->assign("total_23",number_format($total_23,2));
		$smarty->assign("total_26",number_format($total_26,2));
		$smarty->assign("total",$total);
		//$smarty->assign("metafisica_sc",$subcategory_metafisica);


		//subcategory: templatre
		//$arrayProject = xmltoarray($result["data_template"]);
		//$smarty->assign("actividad",$arrayProject["actividad"]);



		//$subcategory_title='Nombre de Producto';


		//$subcategory_title = $resultSubCategory["subcategory_description"][0];
		$html= "";
		//$smarty->assign("subcategory_title",$subcategory_title);
		$html.= $smarty->fetch('tpl/subcat_data.tpl');
		//$objResponse->alert(print_r($res_01["Count"],TRUE));

		//$objResponse->assign("subcatdetalle","innerHTML",$html);
		return $html;
	}

	function xmltoarray($xmlstring){
		//It works with simple XML structure

		$xml = simplexml_load_string($xmlstring);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array;
	}

	//Nuevo PPR(CATEGORY) no-activo
	function nuevoppr()
	{
		$objResponse = new xajaxResponse();
		$smarty = new Smarty;
		$html= "";
		// lista de productos
		$resultSubCategory= subcategory();
		$subcategory_description="";
		 for ($i=0; $i < count($resultSubCategory['subcategory_description']); $i++) {
		 	$subcategory_description.="<option value='".$resultSubCategory["idsubcategory"][$i] ."'>".$resultSubCategory["subcategory_description"][$i]."</option>";

		 }
		$subcategory_description='<select onclick="xajax_titleProduct(this.value)" id="subcategory">'.$subcategory_description.'</select>';
		$smarty->assign('product',$subcategory_description);

		//Lista de Actividades
		$resultactivity = selectActivity();
		$activity_description = "";
		 for ($i=0; $i < count($resultactivity['activity_description']); $i++) {
		 	$acti_des = $resultactivity['activity_description'][$i];
		 	$activity_description .= "<input type='checkbox' class='ck' value='".$acti_des."' name='activity'>".$acti_des."<br>";
		}
		$smarty->assign('activity',$activity_description);

		$html.= $smarty->fetch('tpl/nuevo_ppr.tpl');
		$objResponse->assign("divnuevo","innerHTML",$html);
		$objResponse->assign("update","innerHTML",'');
		//$objResponse->alert(print_r($activity_description,TRUE));
		$objResponse->script("

		$('.ck').click(function(){


				if($(this).is(':checked')) {

	               seleccionado=$(this).val();
	                $('table tbody#acti tr:last').after('<tr><td>'+seleccionado+'</td><td><input></td><td><input></td><td><input></td></tr>');
	            } else {
	                $('table tbody#acti tr:last').remove();
	            }


      	});


		");


		return $objResponse;


	}

	function titleProduct($val){
		$objResponse= new xajaxResponse();
		$html="";

		$objResponse->script("
			$('#subcategory').click(function(){
				var subcategory_title=$('#subcategory option:selected').html();
				$('#Nprod').text(subcategory_title);
			});

			");


	// 	$objResponse->assign("divtitleProducto","innerHTML",$html);
 	return $objResponse;
	 }


	function select_category(){
		//$objResponse= new xajaxResponse();
		$smarty = new Smarty;
		$resultCategory = selectcategory();
		$category_description = "<>";
		 for ($i=0; $i < count($resultactivity['activity_description']); $i++) {
		 	$acti_des = $resultactivity['activity_description'][$i];
		 	$category_description .= "<input type='checkbox' class='ck' value='".$acti_des."' name='activity'>".$acti_des."<br>";
		}
		//$objResponse->assign("selectactivity","innerHTML",$category_description);
		$smarty->assign("activity",$category_description);
		//$objResponse->alert(print_r($resultactivity['activity_description'], TRUE));
		//return $objResponse;

	}

	function select_activity(){
		//$objResponse= new xajaxResponse();
		$smarty = new Smarty;
		$resultactivity = selectActivity();
		$activity_description = "";
		 for ($i=0; $i < count($resultactivity['activity_description']); $i++) {
		 	$acti_des = $resultactivity['activity_description'][$i];
		 	$activity_description .= "<input type='checkbox' class='ck' value='".$acti_des."' name='activity'>".$acti_des."<br>";
		}
		//$objResponse->assign("selectactivity","innerHTML",$activity_description);
		$smarty->assign("activity",$activity_description);
		//$objResponse->alert(print_r($resultactivity['activity_description'], TRUE));
		//return $objResponse;

	}

	function secureLogin($form){

		$objResponse = new xajaxResponse();
		$smarty=new smarty;

		secure_session_start(); // Our custom secure way of starting a php session.

		$t_hasher = new PasswordHash(8, FALSE);
		$hash1 = $t_hasher->HashPassword("loginfailed");
		$hash2 = $t_hasher->HashPassword("incorrectpost");

		if(isset($form['user'], $form['p'])) {
			$user = $form['user'];
			$password = $form['p']; // The hashed password.

			$result=login($user, $password);
			$category_description="<option value='999' selected>Seleccione un año</option>";
			if (!$result["error"]){

				$preview="<li><a href='index.php' target='_blank'>&nbsp;&nbsp;Vista Previa</a></li>";
				$objResponse->assign("mainmenu","innerHTML","");

				//Seleccion de Categoria
				$htmlyear="";
				for ($i=2013; $i < 2030; $i++) {
					$htmlyear.="<option>".$i."</option>";
				}
				$smarty->assign("htmlyear",$htmlyear);

				//year filter Programa
				$result_year = selectyear($year="enable",$action="y");
				$year_filter = "<select class='select' name='cate_p' onchange='xajax_Listppr(this.value)'> ".$result_year."</select>";
				$smarty->assign("selectyear_prog",$year_filter);

				//year filter Producto
				$year_filter_p = "<select class='select' name='cate_p' onchange='xajax_listCategory(this.value,-1); xajax_ListProducts(this.value,\"year\")'> ".$result_year."</select>";
				$smarty->assign("selectyear_p",$year_filter_p);

				//year filter Activity
				$idsubcategory="\"\"";
				$year_filter_a = "<select class='select' name='cate_p' onchange='xajax_listCategory(this.value,0); xajax_ListActivity(".$idsubcategory.",this.value,\"year\")'>".$result_year."</select>";
				$smarty->assign("selectyear_a",$year_filter_a);

				//year filter Indicator
				$year_filter_i = "<select class='select' name='cate_p' onchange='xajax_listCategory(this.value,1); xajax_ListIndicator(999,this.value,999,\"year\"); xajax_listSubCategory(999,1); xajax_ListActividadProducto(999,999,1)'> ".$result_year."</select>";
				$smarty->assign("selectyear_i",$year_filter_i);

				//year filter unidadfinanciera
				$year_filter_uf = "<select class='select' name='cate_p' onchange='xajax_listCategory(this.value,2); xajax_ListUF(999,this.value,999,\"year\"); xajax_listSubCategory(999,2); xajax_ListActividadProducto(999,999,2)'> ".$result_year."</select>";
				$smarty->assign("selectyear_uf",$year_filter_uf);

				$resultCategory=selectcategory();
				$result_filterCategory=filterCategory();

				//Unidad Financiera
				//$select_UF="<select id='ddlcategory_uf' name='cate_uf' class='select' onchange='xajax_ListUF(this.value,999,999)'>".$result_filterCategory."</select>";
				//$smarty->assign("select_UF",$select_UF);

				$tabs=$smarty->fetch("tpl/tabs_admin.tpl");
				$category_description.="<div id='divlistSubCategory'></div>";

				$objResponse->assign("projectContent","innerHTML","");
				$objResponse->assign("login_home","innerHTML","");
				$objResponse->assign("indexContent","innerHTML","");
				$objResponse->assign("loginContent","innerHTML","");
				$objResponse->assign("divnuevo","innerHTML",$nuevo);
				$objResponse->assign("tabsadmin","innerHTML",$tabs);
				$objResponse->assign("divmenuCategory","innerHTML",$category_description);
				$objResponse->assign("divmenuSubcategory","innerHTML",$select);
				$objResponse->assign("divmenuData","innerHTML",$select);

				$objResponse->script('

				xajax_Listppr();xajax_ListUM();
				$(function() {
				$( "#tabs" ).tabs();

				$(".editYear, #divNewCat, #divNuevoProducto, #divNuevoActivity, #newUF, #newIndicator, #newUM, .editCat, .DivEditSubcat, .DivEditAct, .DivEditResp, .DivEditInd, .DivEditUM, .DivEditUF,.divDelCat, .divDelSubcat, .divDelAct, .divDelResp, .divDelInd, .divDelUM, .divDelUF").dialog({
						autoOpen: false,
						modal: true,
						show: "fade",
						hide: "fade",
			            height: "auto",
			            width: 500
				});
				$(".editYear").dialog({
						title:"Editar Año"
				});
				$("#divNewCat").dialog({
						title:"Nuevo Programa"
				});
				$("#divNuevoProducto").dialog({
						title:"Nuevo Producto"
				});
				$("#divNuevoActivity").dialog({
						title:"Nueva Actividad"
				});
				$("#newUF").dialog({
						title:"Nueva Unidad Financiera"
				});
				$("#newIndicator").dialog({
						title:"Nuevo Indicador"
				});
				$("#newUM").dialog({
						title:"Nueva Unidad de Medida"
				});
				$(".editCat").dialog({
						title:"Editar Categoria"
				});
				$(".DivEditSubcat").dialog({
						title:"Editar Subcategoria"
				});
				$(".DivEditAct").dialog({
						title:"Editar Actividad"
				});
				$(".DivEditInd").dialog({
						title:"Editar Indicador"
				});
				$(".DivEditResp").dialog({
						title:"Editar Responsable"
				});
				$(".DivEditUM").dialog({
						title:"Editar Unidad de Medida"
				});
				$(".DivEditUF").dialog({
						title:"Editar Unidad Financiera"
				});

				$(".divDelCat").dialog({
						title:"Eliminar programa"
				});
				$(".divDelSubcat").dialog({
						title:"Eliminar Producto"
				});
				$(".divDelAct").dialog({
						title:"Eliminar Actividad"
				});
				$(".divDelResp").dialog({
						title:"Eliminar Responsable"
				});
				$(".divDelInd").dialog({
						title:"Eliminar Indicador"
				});
				$(".divDelUM").dialog({
						title:"Eliminar Unidad de Medida"
				});
				$(".divDelUF").dialog({
						title:"Eliminar Unidad Financiera"
				});

				var new_UF= $(".divnuevo").clone();
				$("#tab-unidadfinanciera").prepend(new_UF);

				$(".openUF").click(function() {
					$("#newUF").dialog("open");
					return false;
				});

				$("#openIndicator").click(function() {
					$("#newIndicator").dialog("open");
					return false;
				});
				$("#openUM").click(function() {
					$("#newUM").dialog("open");
					return false;
				});
				$(".btnDelInd").click(function() {
					$(".divDelInd").dialog("open");
					return false;
				});



				});
				$("#ddlcategory").change(function() { xajax_listSubCategory(document.getElementById("ddlcategory").options[document.getElementById("ddlcategory").selectedIndex].value,0);} );
				$("#ddlcategory_i").change(function() { xajax_listSubCategory(document.getElementById("ddlcategory_i").options[document.getElementById("ddlcategory_i").selectedIndex].value,1);} );
				$("#ddlcategory_uf").change(function() { xajax_listSubCategory(document.getElementById("ddlcategory_uf").options[document.getElementById("ddlcategory_uf").selectedIndex].value,2);} );

				$(".conteResp").hide();
				$("#respTitle").click(function(){
					var a = $(".conteResp").css("display")
					if (a=="block") {
						$(".conteResp").hide("slow");
						$(this).addClass("menosTitle");
						$(this).removeClass("masTitle");
					}
					else{
						$(".conteResp").animate({height:"show", opacity:"show"});
						$(this).addClass("masTitle");
						$(this).removeClass("menosTitle");
					}
				});
				$(".contUM").hide();
				$("#UMtitle").click(function(){
					var a = $(".contUM").css("display")
					if (a=="block") {
						$(".contUM").hide("slow");
						$(this).addClass("menosTitle");
						$(this).removeClass("masTitle");
					}
					else{
						$(".contUM").animate({height:"show", opacity:"show"});
						$(this).addClass("masTitle");
						$(this).removeClass("menosTitle");
					}
				});

				xajax_ListProducts('.$idcategory="999".');
							xajax_ListResponsible();
							xajax_filterCategory();
							xajax_ListActivity('.$idcategory="000".','.$idsubcategory="000".');
							xajax_ListIndicator('.$idsubcategory="999".','.$idcategory="999".','.$idactivity="999".','.$action="999".');
							xajax_ListUF("999","999","999");

				');


			}
			else{
				$objResponse->alert($result["msgError"]);
			}


		} else {

		}
		//$objResponse->alert(print_r($htmlindicator,TRUE));


		$objResponse->script("
			var thumb = ('#UploadButton');
			new AjaxUpload('#UploadButton', {
				name:'file',
				action:'ajax-upload.php',
				onSubmit : function(file , ext){
				$('#InfoBox').html('Cargando...');
				},
				onComplete: function(file, response){

						$('#InfoBox').html('carga completa');

				}
			});
							");


		return $objResponse;


	}
	function selectyear($idyear,$act){
		$result_year = selectcategory_year($idyear,$act);
		$html = "<option value='999'></option>";
		for ($i=0; $i < $result_year["Count"] ; $i++) {
			$html .= "<option value=".$result_year["idyear"][$i].">".$result_year["year_description"][$i]." </option>";
		}
		return $html;
	}

	function filterCategory(){
		$objResponse = new xajaxResponse;
		$resultCategory=selectcategory();
		$smarty = new Smarty;

		//filtro de productos por año
			$category_description="<option value='999'>Todos</option>";

			for($i=0; $i<count($resultCategory["category_description"]); $i++){

				$category_description.="<option value='".$resultCategory["idcategory"][$i]."'>".$resultCategory["category_description"][$i]."</option>";

			}

			//$objResponse->assign("divcategory","innerHTML",$category_description);
			return $category_description;
	}
	function filterSubCategory(){
		$subcategory_description="<option value='*'>Seleccione un Producto</option>";
		$resultSubCategory=selectsubcategory($idcategory);

		for($i=0; $i<count($resultSubCategory["subcategory_description"]); $i++){
				$subcategory_description.="<option value='".$resultSubCategory["idsubcategory"][$i]."'>".$resultSubCategory["subcategory_description"][$i]."</option>";
			}
		return $subcategory_description;
	}

	function actionyear(){
		$objResponse = new xajaxResponse();
		$html = "<form id='eYear' name='eYear'>

				<span class='msjmin'>(marque o desmarce para habilitar y/o deshabilitar un año)</span></br>";
		$result = selectcategory_year("year","y");
		for ($i=0; $i <$result["Count"] ; $i++) {

			$html .= "<input type='checkbox' value=".$result["idyear"][$i]." class='years_".$i."'";
				if ($result["year_enable"][$i]==1) {
					$html .="checked='yes'";

				}
			$html.="name=yearss[]><span class='des_year'>".$result["year_description"][$i]."</span><br>";
		}
		$html .= "<div class='btnActions'>
	            <input type='button' onclick='xajax_updateYear(xajax.getFormValues(\"eYear\"))' value='Actualizar'>

	            <input type='button' value='Cancelar' class='btnCancel'>
	            </form></div>";
		$objResponse->assign("div_YearAction","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
				$('.editYear').dialog('close')
				});
			");
		//$objResponse->alert(print_r($result["year_enable"][2],TRUE));
		return $objResponse;

	}

	function updateYear($form){
		$objResponse = new xajaxResponse();

		$result_year = selectcategory_year("year","y");
		$band=0;
		for ($i=0; $i < $result_year["Count"]  ; $i++) {

			for ($j=0; $j < count($form["yearss"]); $j++) {
				if ($result_year["idyear"][$i]==$form["yearss"][$j]) {
					$band = 1;
				}
			}
			if ($band==1) {
				$resul_update = updateYears($result_year["idyear"][$i],1);

				$band=0;
			}
			else{
				$resul_update = updateYears($result_year["idyear"][$i],0);
			}
		}

		$html="<p class='msj'>El estado de los años han sido actualizados correctamente.</p>";

		$objResponse->assign("div_YearAction","innerHTML",$html);
		$objResponse->script("xajax_Listppr();");

		return $objResponse;
	}

	function Listppr($idyear){
		$objResponse=new xajaxResponse();

		$htmlcategory="";

				$resultCategory=selectcategory_year($idyear);
				for($i=0; $i<count($resultCategory["category_description"]); $i++){
					$idcat=$resultCategory["idcategory"][$i];
					// if ($resultCategory['category_enable'][$i]==1) {
					// 	$estado="activo";
					// }
					// else {
					// 	$estado="inactivo";
					// }
					$htmlcategory.='<tr class="odd">
									<input type=hidden value='.$resultCategory["idcategory"][$i].'>
									<td>'.($i+1).'</td>
								    <td id="des'.($i).'" align="center">'.$resultCategory['category_description'][$i].'</td>
								    <td id="des'.($i).'" align="center">'.$resultCategory['year_description'][$i].'</td>

								    <td id="act'.($i).'" class="action" align="center">
								    	<button class="openeditCat edit" onclick="xajax_editCat('.$resultCategory["idcategory"][$i].','.$resultCategory["idyear"][$i].','.$i.')" >Editar</button>
								    	<button class="btnDelCat del" onclick="xajax_deleteCat('.$resultCategory["idcategory"][$i].','.$resultCategory["idyear"][$i].')">Eliminar</button></td>
								</tr>';
				}
		$objResponse->assign("tabsCategory","innerHTML",$htmlcategory);
		//$objResponse->alert(print_r($resultCategory["Query"],TRUE));
		$objResponse->script('
			$( "#openCat" ).click(function() {
					$( "#divNewCat" ).dialog( "open" );
		 			return false;
		 		});
			$("#openYear_action").click(function() {
					$(".editYear").dialog("open");
		 			return false;
		 		});

			$(".btnDelCat").click(function() {
					$(".divDelCat").dialog("open");
					return false;
				});

				$(".openeditCat").click(function() {
				$(".editCat").dialog("open");
				return false;
				});


		');
		return $objResponse;
	}


	function NewCategory(){
		$objResponse= new xajaxResponse();
		//$html="";
		$html="<form id=\"nCategory\"><div id=\"newcategory\" class='new'>
		    <label for='c_description'>Programa: </label>
		    <!--input type='text' name='c_description'-->
		    <textarea  name='c_description'></textarea>
		    <span id='msj_cdescription' class='msjalert'></span>

          	<label for=\"c_idyear\"> Selecione año</label> ";
            $resultCategory=selectcategory_year($idyear="year",$act="y");
	       for ($i=0; $i < $resultCategory["Count"]; $i++) {
	        	//$html.="<option value=".$resultCategory["idyear"][$i].">".$resultCategory["year_description"][$i]."</option>";
	        	$year_des = $resultCategory['year_description'][$i];
		 		$html .= "<input type='checkbox' class='ck' value='".$resultCategory["idyear"][$i]."' name='idyears[]'>".$year_des."";
	        }
        $html.="
        	<input type='hidden' name='c_enable' value='1'>
        	<div id='Nppr'></div>
        	<span id='msj_cyars' class='msjalert'></span>
        	<div class='btnActions'>
            <input type=\"button\" value=\"Guardar\"
            onclick=\"xajax_guardarCategory(xajax.getFormValues('nCategory'))\">

            <input type=\"button\" value=\"Cancelar\" class=\"btnCancel\">
            </div>


        </div> </form>";
		$objResponse->assign("divNewCat","innerHTML",$html);
		$objResponse->script("


			$('.btnCancel').click(function(){
					$('#divNewCat').dialog('close')
				});
			");

	 	return $objResponse;

	}


	function guardarCategory($formProduct) {
		$objResponse= new xajaxResponse();

		//$result["Query"];
		if (empty($formProduct["c_description"])) {
			$objResponse->assign("msj_cdescription","innerHTML","El nombre del Programa es requerido");
			$objResponse->assign("msj_cyars","innerHTML","");
		}
		elseif (!isset($formProduct["idyears"])) {
			$objResponse->assign("msj_cyars","innerHTML","Debe seleccionar al menos un año");
			$objResponse->assign("msj_cdescription","innerHTML","");
		}
		else{
			 $result = insertCategory($formProduct);
			 if ($result["Error"]==0) {
			 	$result_last = selectcategory($idcategory="last");
			 	if ($result_last["Error"]==0) {
			 		$resul_YC = insertYearCat($formProduct,$result_last);
			 			if ($resul_YC["Error"]==0) {
			 				$html="<p class='msj'> Datos insertados correctamente</p>";
			  				$objResponse->script("xajax_Listppr()");
			 			}
			 	}

			  }
			  else {
			  	$html="<p class='msjdel'> Debió ocurrir un error, intentalo mas luego</p>";
			  }
			$objResponse->assign("newcategory","innerHTML",$html);
		}

		//$objResponse->alert(print_r($formProduct,TRUE));
		return $objResponse;
	}

	function editCat($idcategory,$idyear,$id){
		$objResponse= new xajaxResponse();
		//$result_filterCategory=filterCategory();
		$html = '<form id="eCategory">
				<input type="hidden" name="idcategory" value='.$idcategory.'>

	          	<label for="c_titulo"> Nombre</label>
	            <!--input type="text" name="c_titulo" class="c_titulo" value=""-->
	            <textarea name="c_titulo" class="c_titulo" ></textarea>';

	    $html .='<label for="c_year"> Años: </label></br>';

	    $result_year_active=selectcategory_year($year="",$action="",$idcategory);
	    $result_year = selectcategory_year("year","y");
	    $band = 0;
	       for ($i=0; $i < $result_year["Count"]; $i++) {
	        	$year_des = $result_year['year_description'][$i];
		 		$html .= "<input type='checkbox' class='ck' value='".$result_year["idyear"][$i]."' name='idyears[]' ";

		 		for ($j=0; $j < $result_year_active["Count"]; $j++) {
		 			if ($result_year["idyear"][$i] == $result_year_active["idyear"][$j]) {
		 				$band = 1;
		 			}
		 		}
		 		if ($band==1) {
		 			$html .= "checked='yes'";
		 			$band = 0;
		 		}
		 		$html .= ">".$year_des;
	        }

	    $html .= '<div id="valid_cat"></div>
	    		</br><div class="btnActions">
	            <input type="button" onclick="xajax_updateCat(xajax.getFormValues(\'eCategory\'),'.$result_year_active.')" value="Actualizar">

	            <input type="button" value="Cancelar" class="btnCancel">
	            </div>
	        </form>';


		//$objResponse->assign("$id_tdDes","innerHTML",$td_des);
		//$objResponse->assign("$id_tdEstado","innerHTML",$td_estado);
		$objResponse->assign("updatecat","innerHTML",$html);
		$objResponse->script("
			var val = $('#des".$id."').text();
			//$('.c_titulo').attr('value',val);
			$('.c_titulo').html(val);
			$('.btnCancel').click(function(){
					$('.editCat').dialog('close')
				});
			$('#catYear option[value=".$idyear."]').attr('selected',true);
			");
		//$objResponse->alert(print_r($result_year_active["idyear"],TRUE));
		return $objResponse;
	}

	function updateCat($form) {
		$objResponse= new xajaxResponse();

		$result = updateCategory($form);
		$result1 = updateYearsCategory($form);

		$result_year_active=selectcategory_year($year="",$action="",$form["idcategory"][0]);
		 $in=0;
		 $band = 0;
		 /*insert and iguales*/
	    //    for ($i=0; $i < count($form["idyears"]); $i++) {

		 		// for ($j=0; $j < $result_year_active["Count"]; $j++) {

			 	// 	if ($result_year_active["Count"]==1) {

			 	// 		if ($form["idyears"][$i] != $result_year_active["idyear"][$j]) {
			 	// 			$form["insert"][$in]= $form["idyears"][$i];
			 	// 			$in +=1;
			 	// 		}
			 	// 		else{
			 	// 			$form["iguales"][$i]=$form["idyears"][$i];
			 	// 		}

			 	// 	}

			 	// 	else{

			 	// 		if ($form["idyears"][$i] != $result_year_active["idyear"][$j]) {
			 	// 			$band += 1;
			 	// 		}
			 	// 		else{
			 	// 			$j = $result_year_active["Count"];
			 	// 			$form["iguales"][$i]=$form["idyears"][$i];
			 	// 		}
			 	// 	}

		 		// }
		 		// if ($band>1) {
		 		// 	$form["insert"][$in]= $form["idyears"][$i];
		 		// 	$in +=1;
		 		// 	$band=0;

		 		// }

	    //     }
	    /*delete years*/
	    $del=0;
	    $band1 =0;

	 if (!empty($form["idyears"])) {

	    for ($i=0; $i < $result_year_active["Count"]; $i++) {

		 		for ($j=0; $j < count($form["idyears"]); $j++) {

			 		if ($result_year_active["Count"]==1 & count($form["idyears"])==1) {

			 			if ($result_year_active["idyear"][$i] != $form["idyears"][$j]) {
			 				$form["delete"][$del]= $result_year_active["idyear"][$i];
			 				//$band1 += 1;
			 				$del +=1;
			 			}


			 			else{
			 				$band=0;
			 			}
			 		}
			 		elseif ($result_year_active["Count"]==1 or count($form["idyears"])==1) {

			 			if ($result_year_active["idyear"][$i] != $form["idyears"][$j]) {
			 				//$form["delete"][$del]= $result_year_active["idyear"][$i];
			 				$band1 += 1;
			 				//$del +=1;
			 			}


			 			else{
			 				$j = count($form["idyears"]);
			 				$band=0;
			 			}
			 		}



			 		else{
			 			if ($result_year_active["idyear"][$i] != $form["idyears"][$j]) {
			 				$band += 1;
			 			}
			 			else{
			 				$j = count($form["idyears"]);
			 				$band=0;
			 			}
			 		}

		 		}
		 		if ($band>1 or $band1>1) {
		 			$form["del"][$del]= $result_year_active["idyear"][$i];
		 			$del +=1;
		 			$band=0;

		 		}

	        }

	      if ($result["Error"]==0 and $result1["Error"]==0) {
		  	$html="<p class='msj'> Datos actualizados correctamente</p>";
		  	$objResponse->script("xajax_Listppr()");
		  }
		  else {
		  	$html="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }

		  $objResponse->assign("updatecat","innerHTML",$html);

	}
	else{
		$objResponse->assign("valid_cat","innerHTML","<span class='msjdel'>Debe seleccionar un año como mínimo</span>");
	}
	    /*----------*/



		//$objResponse->alert(print_r($result1,TRUE));


		return $objResponse;
	}
	function year_supr(){

		$result_year_active=selectcategory_year($year="",$action="",$form["idcategory"][0]);
		 $in=0;
		 $band = 0;
	       for ($i=0; $i < $result_year_active["Count"]; $i++) {

		 		for ($j=0; $j < count($form["idyears"]); $j++) {

			 		if ($result_year_active["Count"]==1) {

			 			if ($result_year_active["idyear"][$i] != $form["idyears"][$j]) {
			 				$form["delete"][$del]= $result_year_active["idyear"][$i];
			 				$del +=1;
			 			}
			 			else{
			 				$band=0;
			 			}
			 		}
			 		else{
			 			if ($result_year_active["idyear"][$i] != $form["idyears"][$j]) {
			 				$band += 1;
			 			}
			 			else{
			 				$j = $result_year_active["Count"];
			 				$form["iguales"][$i]=$form["idyears"][$i];
			 			}
			 		}

		 		}
		 		if ($band>1) {
		 			$form["del"][$del]= $result_year_active["idyear"][$i];
		 			$del +=1;
		 			$band=0;

		 		}

	        }

	}

	function deleteCat($idcategory, $idyear){

		$objResponse = new xajaxResponse();
		$html="<p class='msj'>Está seguro que desea eliminar el programa.</p>
		   <div class='btnActions'>
		   	<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteCat($idcategory, $idyear)'>
		   	<input type='button' value='Cancelar' class='btnCancel'>
		   </div>";

		$objResponse->assign("deleteCategory","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('.divDelCat').dialog('close')
				});");
		return $objResponse;
	}
	function ConfirmDeleteCat($idcategory, $idyear){
		$objResponse = new xajaxResponse();
		$result = deleteCategory($idcategory);
		//$result1 = deleteYearsCategory($idyear);
		//$html="no se ejecuto la sentencia";
		if ($result["Error"]==0 ) {

			$html="<p class='msj'>Se ha eliminado el Programa </p>";
		 	$objResponse->script("xajax_Listppr()");
		 }
		 else{
		 	$html="<p class='msjdel'>No fue posible eliminar el Programa, intente mas luego </p>";
		 	$objResponse->script("xajax_Listppr()");
		 }
		//$objResponse->alert(print_r($result["Query"],TRUE));
		//$objResponse->alert(print_r($html,TRUE));
		 $objResponse->assign("deleteCategory","innerHTML",$html);
		 return $objResponse;
	}

	function ListProducts($idcategory,$action){
		$objResponse= new xajaxResponse();
		//$smarty = new smarty;
		if ($idcategory=="999") {
			$resultSubCategory=selectsubcategory($idcategory="");
		}
		else{
			if ($action=="year") {
				$resultSubCategory=selectsubcategory($idcategory,$action);
			}
			else{
				$resultSubCategory=selectsubcategory($idcategory);
			}
		}

		$htmlsubcategory="";

		for($i=0; $i<count($resultSubCategory["subcategory_description"]); $i++){
			$idsubcategory = $resultSubCategory["idsubcategory"][$i];
			$resumen = $resultSubCategory["subcategory_resumen"][$i];
			if (strlen($resumen)>=100) {
				$resumen = substr($resumen, 0, 100);
				$resumen .= "...";
			}

			//$form = array($sc_name[$i],$res[$i]);

			$htmlsubcategory.='

							<tr class="odd">
							<td>'.($i+1).'</td>
						    <td id="sc_nom'.($i).'">'.$resultSubCategory["subcategory_description"][$i].'</td>
						    <td id="sc_res'.($i).'"> '.$resumen.'</td>
						    <td id="sc_resumen'.($i).'" style="display:none;"> '.$resultSubCategory["subcategory_resumen"][$i].'</td>
						    <td id="sc_action'.($i).'" class="action" >

						    		<button class="btnEditSubcat edit" onclick="xajax_editSubcat('.$i.','.$idsubcategory.')" >Editar</button>
								    <button class="btnDelSubcat del" onclick="xajax_deleteSubcat('.$resultSubCategory["idsubcategory"][$i].')">Eliminar</button></td>
						</tr>
						';

		}

		//$objResponse->alert(print_r($resultSubCategory["Query"],TRUE));
		$objResponse->assign("tabsProducts","innerHTML",$htmlsubcategory);
		$objResponse->script('$( "#openProd" ).click(function() {
					$( "#divNuevoProducto" ).dialog( "open" );
					return false;
				});
				$(".btnEditSubcat").click(function() {
					$(".DivEditSubcat").dialog("open");
					return false;
				});
				$(".btnDelSubcat").click(function() {
					$(".divDelSubcat").dialog("open");
					return false;
				});');
		return $objResponse;
	}

	function NewProduct(){
		$objResponse= new xajaxResponse();
		//$html="";
		$html="<form id=\"nproduct\"><div id=\"newproduct\" class='new'>
          <label for=\"sc_titulo\"> Nombre de Producto</label>
              <input type=\"text\" name=\"sc_titulo\">
              <span id='msj_sctitulo' class='msjalert'></span>
            <label for=\"sc_detalle\"> Resumen</label>
              <textarea name=\"sc_detalle\" rows=\"10\" cols=\"30\"></textarea>";
        // $result_filterCategory=filterCategory();
        // $html.="<label for=\"c_description\"> Seleccione PPR</label>
        // <select name='c_description'>".$result_filterCategory."</select>";
        $html .="<label for=\"c_idyear\"> Selecione Programa:</label> </br>
        		<select name='prog' onchange='xajax_Select_YearCategory(this.value,\"new\",\"\")'><option> </option>";
            $resultCategory=selectcategory_year();
	       for ($i=0; $i < $resultCategory["Count"]; $i++) {
	        	//$html.="<option value=".$resultCategory["idyear"][$i].">".$resultCategory["year_description"][$i]."</option>";
	        	$cat_des = $resultCategory['category_description'][$i];
		 		$html .= "<option value='".$resultCategory["idcategory"][$i]."' >".$cat_des."</option>";
	        }

        $html.="</select>
        	<div id='new_sel_yc'></div>
        	<span id='msj_scyars' class='msjalert'></span>
        	<div class='btnActions'>
        	<input type=\"button\" value=\"Guardar\"
              onclick=\"xajax_guardarProduct(xajax.getFormValues('nproduct'))\">

              <input type=\"button\" value=\"Cancelar\" class='btnCancel'></div>

        </div> </form>";
		$objResponse->assign("divNuevoProducto","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('#divNuevoProducto').dialog('close')
				});	");
	 	return $objResponse;

	}
	function Select_YearCategory($idcategory,$act,$idsubcategory){
		$objResponse = new xajaxResponse();
	    $result = selectcategory_year($year="",$action="",$idcategory);
	    $result_YC_SC = selectYC_subcat($idsubcategory);
	    $html="<label> Año(s):</label>";
	    //$band =0;
	    for ($i=0; $i < $result["Count"]; $i++) {
	        	//$html.="<option value=".$result["idyear"][$i].">".$result["year_description"][$i]."</option>";
	        	$year_des = $result['year_description'][$i];
		 		$html .= "
		 				<input type='checkbox' value='".$result["id_years_category"][$i]."' name='id_catyears[]' ";

		 		if ($act=="edit") {
		 			for ($j=0; $j < $result_YC_SC["Count"]; $j++) {
			 			if ($result["id_years_category"][$i] == $result_YC_SC["id_years_category"][$j]) {
			 				$band = 1;
			 			}
		 			}
			 		if ($band==1) {
			 			$html .= "checked='yes'";
			 			$band = 0;
			 		}
		 		}
		 		$html .= ">".$year_des."";

	        }
	    if ($act=="new") {
	    	$id_div = "new_sel_yc";
	    }
	    elseif ($act=="edit") {
	    	$id_div = "edit_sel_yc";
	    }
	    else{
	    	$id_div = "sel_yc";
	    }
    	$objResponse->assign($id_div,"innerHTML",$html);
    	//$objResponse->alert(print_r($result_YC_SC["id_years_category"],TRUE));

		return $objResponse;
	}

	function guardarProduct($formProduct) {
		$objResponse= new xajaxResponse();
		if (empty($formProduct["sc_titulo"])) {
			$objResponse->assign("msj_sctitulo","innerHTML","El nombre del Producto es requerido");
			$objResponse->assign("msj_scyars","innerHTML","");
		}
		elseif (!isset($formProduct["id_catyears"])) {
			$objResponse->assign("msj_scyars","innerHTML","Debe seleccionar al menos un programa y año(s)");
			$objResponse->assign("msj_sctitulo","innerHTML","");
		}
		else{


			$result = insertProduct($formProduct);

			$result_last = selectsubcategory($idsubcategory="",$action="last");

			$resultYC_subcat = insertYC_subcat($formProduct,$result_last);

			 if ($result["Error"]==0 and $resultYC_subcat["Error"]==0 ) {
			  	$html.="<p class='msj'> El nuevo producto fue agregado correctamente</p>";
			  	$objResponse->script("xajax_ListProducts('999')");
			  }
			  else {
			  	$html.="<p class='msjdel'> Debió ocurrir un error correctamente</p>";
			  }
			$objResponse->assign("newproduct","innerHTML",$html);
		}
		//$objResponse->alert(print_r($resultYC_subcat,TRUE));
		return $objResponse;
	}

	function editSubcat($id, $idsubcategory){
		$objResponse= new xajaxResponse();

		$html = '<form id="eSubcategory">
				<label for="sc_name" >Nombre</label >
				<input type="hidden" name="idsubcategory" value='.$idsubcategory.'>
	          	<input class="cat_des" name="sc_name" type="text" value="">
	          	<label for="sc_res">Resumen</label>
	          	<textarea class="cat_res" name="sc_res" rows="10" cols="30"></textarea>';
	    $html .="<label for=\"c_idyear\"> Programa:</label> </br>
        		<select name='prog' onchange='xajax_Select_YearCategory(this.value,\"edit\",$idsubcategory)'><option> </option>";
            $resultCategory=selectcategory_year();

	       for ($i=0; $i < $resultCategory["Count"]; $i++) {
	        	//$html.="<option value=".$resultCategory["idyear"][$i].">".$resultCategory["year_description"][$i]."</option>";
	        	$cat_des = $resultCategory['category_description'][$i];
		 		$html .= "<option value='".$resultCategory["idcategory"][$i]."' >".$cat_des."</option>";


	        }

        $html.="</select>
        	<div id='edit_sel_yc'></div>";


	    $html .='<div class="btnActions">
	            <input type="button" onclick="xajax_updateSubcat(xajax.getFormValues(\'eSubcategory\'))" value="Actualizar">

	            <input type="button" value="Cancelar"class="btnCancel">
	            </div>
	        </form>';

		$objResponse->assign("updatesubcat","innerHTML",$html);
		//$objResponse->alert(print_r($form,TRUE));
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditSubcat').dialog('close')
				});
			var sc = $('#sc_nom".$id."').text();
			$('.cat_des').attr('value',sc);
			var sc_res = $('#sc_resumen".$id."').text();
			$('.cat_res').text(sc_res);
			");
		return $objResponse;
	}

	function updateSubcat($form){
		$objResponse= new xajaxResponse();
		$result = updateSubcategory($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> El producto fue actualizado correctamente</p>";
		  	$objResponse->script("xajax_ListProducts('999')");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }
		//$objResponse->alert(print_r($result,TRUE));
		$objResponse->assign("updatesubcat","innerHTML",$html);

		return $objResponse;

	}

	function deleteSubcat($idsubcategory){
		$objResponse= new xajaxResponse();
		$html="<p class='msj'> Esta seguro que desea eliminar el Producto </p>
		<div class='btnActions'>
		<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteSubcat($idsubcategory)'>
		<input type='button' value='Cancelar' class='btnCancel'>
		</div> ";
		//$objResponse->alert(print_r($html,TRUE));
		$objResponse->assign("deleteSubcategory","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('.divDelSubcat').dialog('close')
				});");
		return $objResponse;

	}
	function ConfirmDeleteSubcat($idsubcategory){
		$objResponse = new xajaxResponse();
		$result = deleteSubcategory($idsubcategory);
		if ($result["Error"]==0) {
			$objResponse->script("xajax_ListProducts(".$idcategory='999'.")");
			$html="<p class='msj'>Se ha eliminado el producto</p>";
		}
		else{
			$html="<p class='msjdel'>No fue posible eliminar el producto</p>";
		}
		$objResponse->assign("deleteSubcategory","innerHTML",$html);
		return $objResponse;
	}


	function ListActivity($idsubcategory, $idcategory, $action)
	{
		$objResponse=new xajaxResponse();
		$htmlactivity="";
		if( ($idcategory=="999" and $idsubcategory=="" ) or ($idcategory=="000" and $idsubcategory=="000") ){
			$resultActivity = selectactivity();
		}
		elseif ($idsubcategory=="*") {

			$resultActivity=product_details($idsubcategory="",$idcategory,$idactivity="");
		}
		else{

			$resultActivity=product_details($idsubcategory,$idcategory,$idactivity="",$action);
		}

		for ($i=0; $i < $resultActivity["Count"]; $i++) {
		 			$idactivity=$resultActivity["idactivity"][$i];
		 			$idresponsable=$resultActivity["idresponsable"][$i];
					$htmlactivity.='<tr class="odd">
							<td>'.($i+1).'</td>
							<td id="actName_'.$i.'" align="center">'.$resultActivity["activity_description"][$i].'</td>
						    <td id="actResp_'.$i.'" align="center">'.$resultActivity["resp_nombre"][$i].'</td>
						    <td id="actUniv_'.$i.'" align="center">'.$resultActivity["activity_universo"][$i].'</td>
						    <td id="actLB_'.$i.'" align="center">'.$resultActivity["activity_lb"][$i].'</td>

						    <td align="center" class="action">
						    	<button class="btnEditAct edit" onclick="xajax_editAct('.$idactivity.','.$idresponsable.','.$i.')" >Editar</button>
								<button class="btnDelAct del" onclick="xajax_deleteAct('.$resultActivity["idactivity"][$i].')">Eliminar</button>
						    </td>
						</tr>';
				}

		$objResponse->assign("tabsActivitys","innerHTML",$htmlactivity);
		$objResponse->script('
			$( "#openAct" ).click(function() {
					$( "#divNuevoActivity" ).dialog( "open" );
					return false;
				});
			$(".btnEditAct").click(function() {
					$(".DivEditAct").dialog("open");
					return false;
				});
			$(".btnDelAct").click(function() {
					$(".divDelAct").dialog("open");
					return false;
				});
					');
		//$objResponse->alert(print_r($action,TRUE));
		return $objResponse;
	}

	function NewActivity(){
		$objResponse= new xajaxResponse();
		//$html="";
		$html="<form id=\"nactivity\"><div id=\"newactivity\" class='new'>

			<label for='a_titulo'> Nombre </label>
				<input type='text' name='a_titulo'>";

		$resultresponsable = selectResponsable();
		$html.="<label for='a_responsable'> Responsable </label>
			<select name='a_responsable'> <option value=999>Seleccione Responsable</option>";
		for ($i=0; $i <$resultresponsable["Count"]; $i++) {
			$html.="<option value=".$resultresponsable['idresponsable'][$i].">".$resultresponsable['resp_nombre'][$i]."</option>";
		}

        $html.="</select>
        	<div id='newresp'></div>
        	<label for='a_universo'> Universo </label>
			<input type='text' name='a_universo'>
			<label for='a_lineabase'> Linea Base </label>
			<input type='text' name='a_linebase'>
			 <div class='btnActions'>
        		<input type=\"button\" value=\"Guardar\"
              onclick=\"xajax_guardarActivity(xajax.getFormValues('nactivity'))\">

              	<input type=\"button\" value=\"Cancelar\" class='btnCancel'>
             </div>

        </div> </form>";
		$objResponse->assign("divNuevoActivity","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('#divNuevoActivity').dialog('close')
				});	");
	 	return $objResponse;

	}

	function guardarActivity($form) {
		$objResponse= new xajaxResponse();
		$result = insertActivity($form);

		if ($result["Error"]==0) {
		  	$html.="<p class='msj'>La nueva actividad fue insertado correctamente</p>";
		  	$objResponse->script("xajax_ListActivity('000','000')");
		  }
		  else {
		  	$html.="<p class='msjdel'> No se pudo guardar, debió ocurrir un error</p>";
		  }
		$objResponse->assign("newactivity","innerHTML",$html);

		//$objResponse->alert(print_r($result,TRUE));
		return $objResponse;
	}



	function editAct($idactivity,$idresponsable,$id){
		$objResponse= new xajaxResponse();

		$html = '<form id="eActivity">
				<input type="hidden" name="idresponsable" value='.$idresponsable.'>
				<input type="hidden" name="idactivity" value='.$idactivity.'>
				<label for="a_name" >Nombre</label >
	          	<input class="act_name" name="a_name" type="text" value="">';
	    $resultresponsable = selectResponsable();
		$html.="<label for='a_idresp'> Responsable </label>
				<select id='edit_responsable' name='a_idresp'>";
		for ($i=0; $i <$resultresponsable["Count"]; $i++) {
			if ($idresponsable==$resultresponsable['idresponsable'][$i]) {
			 	$html.="<option value=".$resultresponsable['idresponsable'][$i]." selected>".$resultresponsable['resp_nombre'][$i]."</option>";
			 }
			else{
				$html.="<option value=".$resultresponsable['idresponsable'][$i].">".$resultresponsable['resp_nombre'][$i]."</option>";
			}
		}

	    $html .= '</select>

	          	<label for="a_universo">Universo</label>
	          	<input class="act_universo" type="text" name="a_universo" value="univ">

	          	<label for="a_lineabase">Linea Base</label>
	          	<input class="act_lineabase" type="text" name="a_lineabase" value="">

	          	<div class="btnActions">
	            <input type="button" onclick="xajax_updateAct(xajax.getFormValues(\'eActivity\'))" value="Actualizar">

	            <input type="button" value="Cancelar" class="btnCancel">
	            </div>
	        </form>';

		$objResponse->assign("updateact","innerHTML",$html);
		//$objResponse->alert(print_r($resultresponsable,TRUE));
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditAct').dialog('close')
				});

			var a_name = $('#actName_".$id."').text();
			$('.act_name').attr('value',a_name);

			var a_uni = $('#actUniv_".$id."').text();
			$('.act_universo').attr('value',a_uni);

			var a_lb = $('#actLB_".$id."').text();
			$('.act_lineabase').attr('value',a_lb);


			");
		/*$('#edit_responsable').change(function() { xajax_demo(document.getElementById('edit_responsable').options[document.getElementById('edit_responsable').selectedIndex].value);} );*/
		return $objResponse;
	}


	function updateAct($form){
		$objResponse= new xajaxResponse();
		$result = updateActivity($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> La Actividad  fue actualizada correctamente</p>";
		  	$objResponse->script("xajax_ListActivity('000','000')");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }
		//$objResponse->alert(print_r($form,TRUE));
		$objResponse->assign("updateact","innerHTML",$html);

		return $objResponse;

	}


	function deleteAct($idactivity)	{
		$objResponse = new xajaxResponse();
		$html = " <p class='msj'>Esta seguro que desea eliminar la Actividad</p>
		<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteAct($idactivity)'>
		<input type='button' value='Cancelar' class='btnCancel'>" ;
		$objResponse->assign("deleteActivity","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('.divDelAct').dialog('close')
				});");
		return $objResponse;
	}
	function ConfirmdeleteAct($idactivity){
		$objResponse = new xajaxResponse();
		$result = deleteActivity($idactivity);
		if ($result["Error"]==0) {
			$html="<p class='msj'>Se ha eliminado la actividad</p>";
			$objResponse->script("xajax_ListActivity('000','000')");
		}
		else{
			$html="<p class='msjdel'>No se ha podido eliminar la actividad</p>";
		}
		$objResponse->assign("deleteActivity","innerHTML",$html);
		return $objResponse;

	}

	function ListResponsible()
	{
		$objResponse=new xajaxResponse();
		$htmlresponsable = "";
		$resultResponsible = selectResponsable();
		for ($i=0; $i <$resultResponsible["Count"] ; $i++) {
			$htmlresponsable.='<tr class="odd">
							<td>'.($i+1).'</td>
						    <td id="rNom_'.$i.'" align="center">'.$resultResponsible["resp_nombre"][$i].'</td>
						    <td align="center" class="action">
						    	<button class="btnEditResp edit" onclick="xajax_editResp('.$resultResponsible["idresponsable"][$i].','.$i.')" >Editar</button>
								<button class="btnDelResp del" onclick="xajax_deleteResp('.$resultResponsible["idresponsable"][$i].')">Eliminar</button>
						    </td>
						</tr>';

		}
		$objResponse->assign("tabsResponsibles","innerHTML",$htmlresponsable);
		$objResponse->script('
			$(".btnEditResp").click(function() {
					$(".DivEditResp").dialog("open");
					return false;
				});
			$(".btnDelResp").click(function() {
					$(".divDelResp").dialog("open");
					return false;
				});');
		return $objResponse;
	}

	function nuevoresponsable()
		{
		$objResponse=new xajaxResponse();
		$html="";

		$html.="<form id='nresponsable'>
				<label for='resp_nombre'>Ingrese Responsable Nuevo</label>
				<input type='text' name='resp_nombre'>
				<input type='button' value='Guardar' onclick=\"xajax_guardarResponsable(xajax.getFormValues('nresponsable'))\">
				<input type='button' value='Cancelar' class='btnCancel'>
				</form>";


		$objResponse->assign("newresp","innerHTML",$html);
		$objResponse->script("

			$('.btnCancel').click(function(){
				$('#newresp').html('');
			});
			");
		return $objResponse;

	}
	function guardarResponsable($formResponsable){
		$objResponse= new xajaxResponse();
		$result = insertResponsable($formResponsable);

		 if ($result["Error"]==0) {
		  	$objResponse->script("xajax_ListResponsible()");
		  	$objResponse->assign("newresp","innerHTML","");
		  	$objResponse->alert(print_r("Nuevo Responsable a sido añadido correctamente",TRUE));
		  }
		  else {

		  	$objResponse->alert(print_r("Debió ocurrir un error, intentalo nuevamente",TRUE));
		  }


		//$objResponse->alert(print_r($result,TRUE));
		return $objResponse;

	}

	function editResp($idresponsable,$id){
		$objResponse = new xajaxResponse();
		$html = '<form id="eResponsable">
				<input type="hidden" name="idresponsable" value='.$idresponsable.'>
				<label for="r_nombre">Nombre</label>
				<input class="resp_name" type="text" name="r_nombre" value="">
				<div class="btnActions">
	            	<input type="button" onclick="xajax_updateResp(xajax.getFormValues(\'eResponsable\'))" value="Actualizar">
	                <input type="button" value="Cancelar" class="btnCancel">
	            </div>
				</form>';
		$objResponse->assign("updateresp","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditResp').dialog('close')
				});

			r_name = $('#rNom_".$id."').text();
			$('.resp_name').attr('value',r_name);
			");
		return $objResponse;
	}
	function updateResp($form){
		$objResponse = new xajaxResponse();
		$result = updateresponsable($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> Los Dattos del Responsable  fueron actualizados correctamente</p>";
		  	$objResponse->script("xajax_ListResponsible()");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }
		$objResponse->assign("updateresp","innerHTML",$html);
		return $objResponse;
	}

	function deleteResp($idresponsable)	{
		$objResponse = new xajaxResponse();
		$html = " <p class='msj'>Esta seguro que desea eliminar el Responsable</p>
		<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteResp($idresponsable)'>
		<input type='button' value='Cancelar' class='btnCancel'>" ;
		$objResponse->assign("deleteResponsible","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.divDelResp').dialog('close')
				});
		");
		return $objResponse;
	}
	function ConfirmDeleteResp($idresponsable){
		$objResponse = new xajaxResponse();
		$result = deleteResponsible($idresponsable);
		if ($result["Error"]==0) {
			$html="<p class='msj'>Se ha eliminado el Responsable</p>";
			$objResponse->script("xajax_ListResponsible()");
		}
		else{
			$html="<p class='msjdel'>No se ha podido eliminar el Responsable</p>";
		}
		$objResponse->assign("deleteResponsible","innerHTML",$html);
		return $objResponse;

	}


	function ListIndicator($idsubcategory,$idcategory,$idactivity,$action)
	{
		$objResponse=new xajaxResponse();
		$htmlindicator = "";

		if ($idsubcategory=="999" and $idcategory=="999" and $idactivity=="999" and $action=="999") {
			$resultIndicator = selectindicator_um(2);
		}
		else {

			if ($idactivity=="*") {
				$resultIndicator = indicator_details($idsubcategory,$idcategory,$idactivity="");

			}
			else {
				$resultIndicator = indicator_details($idsubcategory,$idcategory,$idactivity,$action);

			}
		}
		 for ($i=0; $i < $resultIndicator["Count"] ; $i++) {
			$htmlindicator.='<tr class="odd">';
			$result=selectIndicator_uf($resultIndicator["id_uf"][$i]);
			$htmlindicator .= '<tr class="odd">
								<td>'.($i+1).'</td>
								<td id="ind_nom'.$i.'">'.$resultIndicator["ind_description"][$i].'</td>
					    		<td>'.$resultIndicator["um_description"][$i].'</td>
					    		<td align="center" class="action">
								   	<button class="btnEditInd edit" onclick="xajax_editInd('.$resultIndicator["idindicator"][$i].','.$resultIndicator["id_um"][$i].','.$i.')" >Editar</button>
									<button class="btnDelInd del" onclick="xajax_deleteInd('.$resultIndicator["idindicator"][$i].')">Eliminar</button>
								</td>
							   </tr>';

			// if ($result["Count"]>=1) {

			// 	for ($j=0; $j <$result["Count"] ; $j++) {
			// 				$htmlindicator.='<tr class="odd">';
			// 		    	$htmlindicator.=' <td>'.($i+1).'</td>
			// 		    						<td>'.$result["ind_description"][$j].'</td>
			// 		    						<td>'.$result["um_description"][$j].'</td>
			// 		    						<td align="center" class="action">
			// 								    	<button class="btnEditInd edit" onclick="xajax_editInd('.$result["I_idindicator"][$j].','.$result["id_um"][$j].','.$j.')" >Editar</button>
			// 										<button class="btnDelInd del" onclick="xajax_deleteInd('.$result["I_idindicator"][$j].')">Eliminar</button>
			// 								    </td></tr>';
			// 		    }
			// }
			// else{
			// 	$htmlindicator.='<tr class="odd">';
			// 	$htmlindicator.='
			// 					<td>'.($i+1).'</td>
			// 				    <td id="ind_nom'.$i.'">'.$resultIndicator["ind_description"][$i].'</td>
			// 				    <td id="ind_um'.$i.'">'.$resultIndicator["um_description"][$i].'</td>
			// 				    <td align="center" class="action">
			// 				    	<button class="btnEditInd edit" onclick="xajax_editInd('.$resultIndicator["idindicator"][$i].','.$resultIndicator["id_um"][$i].','.$i.')" >Editar</button>
			// 						<button class="btnDelInd del" onclick="xajax_deleteInd('.$resultIndicator["idindicator"][$i].')">Eliminar</button>
			// 				    </td>
			// 				</tr>';
			// }

		 }
		$objResponse->assign("tabsIndicator","innerHTML",$htmlindicator);

		$objResponse->script('
				$(".btnEditInd").click(function() {
					$(".DivEditInd").dialog("open");
					return false;
				});
				$(".btnDelInd").click(function() {
					$(".divDelInd").dialog("open");
					return false;
				});');
		//$objResponse->alert(print_r($resultIndicator["Query"],TRUE));
		return $objResponse;
	}

	function NewIndicator(){
		$objResponse= new xajaxResponse();
		$html="";

		$resultUM = selectindicator_um(0);

		$html='<form id="nIndicator">
			<label for="i_name">Ingrese Nombre</label>
			<input type="text" name="i_name">';
		$html.="<label for='i_UM'> Unidad de Medida </label>
			<select name='i_UM'> <option value=999>Seleccione Unidad de Medida</option>";
		for ($i=0; $i <$resultUM["Count"]; $i++) {
			$html.="<option value=".$resultUM["id_um"][$i].">".$resultUM['um_description'][$i]."</option>";
		}
		$html.="</select>";

		$html.='<div class="btnActions">
				<input type="button" value="Guardar"
	            onclick="xajax_guardarIndicator(xajax.getFormValues(\'nIndicator\'))">
	            <input type="button" value="Cancelar" class="btnCancel">
            </div>
		</form>';


		$objResponse->assign("nIndicator","innerHTML",$html);
		$objResponse->script('
			$(".btnCancel").click(function(){
					$("#newIndicator").dialog("close")
				});
			');
		return $objResponse;

	}
	function guardarIndicator($formIndicator){
		$objResponse= new xajaxResponse();
		$result = insertIndicator($formIndicator);

		if ($result["Error"]==0) {
		  	$html.="<p class='msj'>El nuevo Indicador fue insertado correctamente</p>";
		  	$objResponse->script("xajax_ListIndicator(999,999,999,999)");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error</p>";
		  }
		$objResponse->assign("nIndicator","innerHTML",$html);
		return $objResponse;

		//$objResponse->alert(print_r($result,TRUE));
	}

	function editInd($idindicator, $id_unidadmedida, $id){
		$objResponse= new xajaxResponse();

		$html = '<form id="eIndicator">

				<input type="hidden" name="idindicator" value='.$idindicator.'>
				<label for="i_name" >Nombre</label >
	          	<input class="ind_name" name="i_name" type="text" value="">';
	    $result_um = selectindicator_um(0);
		$html.="<label for='ind_um'> Unidad de Medida </label>
				<select id='edit_um' name='ind_unidadmedida'>";
		for ($i=0; $i <$result_um["Count"]; $i++) {
			if ($id_unidadmedida == $result_um['id_um'][$i]) {
			 	$html.="<option value=".$result_um['id_um'][$i]." selected>".$result_um['um_description'][$i]."</option>";
			 }
			else{
				$html.="<option value=".$result_um['id_um'][$i].">".$result_um['um_description'][$i]."</option>";
			}
		}

	    $html .= '</select>';
	    $html .='
	          	<div class="btnActions">
	            <input type="button" onclick="xajax_updateInd(xajax.getFormValues(\'eIndicator\'))" value="Actualizar">

	            <input type="button" value="Cancelar" class="btnCancel">
	            </div>
	        </form>';

		$objResponse->assign("updateInd","innerHTML",$html);
		//$objResponse->alert(print_r($form,TRUE));
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditInd').dialog('close')
				});
			var ind = $('#ind_nom".$id."').text();
			$('.ind_name').attr('value',ind);


			");
		return $objResponse;
	}

	function updateInd($form){
		$objResponse= new xajaxResponse();
		$result = updateIndicator($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> El Indicador fue actualizado correctamente</p>";
		  	$objResponse->script("xajax_ListIndicator('999','999','999','999')");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";

		  }

		$objResponse->assign("updateInd","innerHTML",$html);

		return $objResponse;

	}

	function deleteInd($idindicator)	{
		$objResponse = new xajaxResponse();
		$html = " <p class='msj'>Esta seguro que desea eliminar el Indicator</p>
		<div class='btnActions'>
			<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteInd($idindicator)'>
			<input type='button' value='Cancelar' class='btnCancel'>
		</input>" ;
		$objResponse->assign("deleteIndicator","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.divDelInd').dialog('close')
				});
			");
		return $objResponse;
	}
	function ConfirmDeleteInd($idindicator){
		$objResponse = new xajaxResponse();
		$result = deleteIndicator($idindicator);
		if ($result["Error"]==0) {
			$html="<p class='msj'>Se ha eliminado el Indicador</p>";
			$objResponse->script("xajax_ListIndicator('999','999','999','999')");
		}
		else{
			$html="<p class='msj'>No se ha podido eliminar el Indicador</p>";
		}
		$objResponse->assign("deleteIndicator","innerHTML",$html);
		return $objResponse;
	}

	function ListUM()
	{
		$objResponse=new xajaxResponse();
		$htmlUM = "";
		$selectUM = selectindicator_um(0);
		for ($i=0; $i <$selectUM["Count"] ; $i++) {
			$htmlUM.='<tr class="odd">
							<td>'.($i+1).'</td>
						    <td id="umNom_'.$i.'" align="center">'.$selectUM["um_description"][$i].'</td>
						    <td align="center" class="action">
						    	<button class="btnEditUM edit" onclick="xajax_editUM('.$selectUM["id_um"][$i].','.$i.')" >Editar</button>
								<button class="btnDelUM del" onclick="xajax_deleteUM('.$selectUM["id_um"][$i].')">Eliminar</button>
						    </td>
						</tr>';

		}
		$objResponse->assign("tabsUM","innerHTML",$htmlUM);
		$objResponse->script('
				$(".btnEditUM").click(function() {
					$(".DivEditUM").dialog("open");
					return false;
				});
				$(".btnDelUM").click(function() {
					$(".divDelUM").dialog("open");
					return false;
				});');
		//$objResponse->alert(print_r($selectUM["id_um"],TRUE));
		return $objResponse;
	}

	function NuevoUM(){
			$objResponse= new xajaxResponse();
			$html="<form id='nUnidadmedida'>
				<label for='name_um'>Tipo de Unidad Medida</label>
				<input type='text' name='name_um'>

				<div class='btnActions'>
					<input type='button' value='Guardar'
		            onclick=\"xajax_guardarUM(xajax.getFormValues('nUnidadmedida'))\">
		            <input type='button' value='Cancelar' class='btnCancel'>
	            </div>
			</form>";
			$objResponse->assign("newUM","innerHTML",$html);
			$objResponse->script('
			$(".btnCancel").click(function(){
					$("#newUM").dialog("close")
				});
			');
			return $objResponse;
		}
	function guardarUM($formUM){
		$objResponse= new xajaxResponse();
		$result = insertUM($formUM);

		 if ($result["Error"]==0) {
		 	$htmlUM="<p class='msj'>Datos guardados correctamente";
		  	$objResponse->script("xajax_ListUM()");
		  }
		  else {
		  	$htmlUM="<p class='msjdel'>No fue posible insertar la Unidad de medida, intentalo nuevamente.";
		  }
		//$objResponse->alert(print_r($formUM,TRUE));
		$objResponse->assign("newUM","innerHTML",$htmlUM);
		return $objResponse;

	}

	function editUM($id_um,$id){
		$objResponse = new xajaxResponse();
		$html = '<form id="eUnidadMedida">
				<input type="hidden" name="id_um" value='.$id_um.'>
				<label for="um_nombre">Nombre</label>
				<input class="um_name" type="text" name="um_nombre" value="">
				<div class="btnActions">
	            	<input type="button" onclick="xajax_updateUM(xajax.getFormValues(\'eUnidadMedida\'))" value="Actualizar">
	                <input type="button" value="Cancelar" class="btnCancel">
	            </div>
				</form>';
		$objResponse->assign("updateUM","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditUM').dialog('close')
				});

			um_nametext = $('#umNom_".$id."').text();
			$('.um_name').attr('value',um_nametext);
			");
		return $objResponse;
	}
	function updateUM($form){
		$objResponse = new xajaxResponse();
		$result = updateUnidadMedida($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> La Unidad de Medida fue actualizada correctamente</p>";
		  	$objResponse->script("xajax_ListUM()");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }
		$objResponse->assign("updateUM","innerHTML",$html);

		return $objResponse;
	}

	function deleteUM($id_um){
		$objResponse = new xajaxResponse();
		$html = " <p class='msj'>Esta seguro que desea eliminar la unidad de medida</p>
		<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteUM($id_um)'>
		<input type='button' value='Cancelar' class='btnCancel'>" ;

		$objResponse->assign("deleteUM","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('.divDelUM').dialog('close')
				});
		");
		return $objResponse;
	}

	function ConfirmDeleteUM($id_um){
		$objResponse = new xajaxResponse();
		$result = deleteUnidMed($id_um);
		if ($result["Error"]==0) {
			$html="<p class='msj'>Se ha eliminado la Unidad de Medida</p>";
			$objResponse->script("xajax_ListUM()");
		}
		else{
			$html="<p class='msjdel'>No se ha podido eliminar la Unidad de Medida</p>";
		}
		$objResponse->assign("deleteUM","innerHTML",$html);
		return $objResponse;
	}

	function ListUF($idcategory,$idsubcategory,$idactivity,$action) {
		$objResponse = new xajaxResponse();
		// $smarty = new smarty;
		// $result_filterCategory=filterCategory();
		// $select_UF="<select onclick='xajax_selectproducto'>".$result_filterCategory."</select>";
		// $objResponse->assign("tabsUF","innerHTML",$htmlUF);
		// $smarty->assign("selectcategory_uf",$select_UF);
		$htmlUF ="";
		if ($idcategory=="999" and $idsubcategory=="999" and $idactivity="999") {

			$result = indicator_details($idcategory,$idsubcategory,$idactivity);
		}

		if ($idactivity=="*") {
			$result = indicator_details($idsubcategory,$idcategory,$idactivity="");
		}
		else {
			$result = indicator_details($idsubcategory,$idcategory,$idactivity,$action);
		}
		for ($i=0; $i < $result["Count"]; $i++) {
			$htmlUF.='<tr class="odd">
					    <td id="td1">'.($i+1).'</td>
					    <td id="prog_'.$i.'">'.$result["category_description"][$i].'</td>
					    <td id="prod_'.$i.'">'.$result["subcategory_description"][$i].'</td>
					    <td id="act_'.$i.'">'.$result["activity_description"][$i].'</td>
					    <td>';
					    $resultInd_UF=selectIndicator_uf($result["id_uf"][$i]);
					    	$htmlUF .= "<ul class='listIND ind_".$i."'>";
					    for ($j=0; $j <$resultInd_UF["Count"] ; $j++) {
					    	$htmlUF.='<li>'.$resultInd_UF["ind_description"][$j].'
					    				<input type="hidden" value='.$resultInd_UF["I_idindicator"][$j].'>
					    			  </li>';
					    }
					    $htmlUF .= "</ul>";

			$htmlUF .= '</td>
						<td>
							<ul class="listIND mf_'.$i.'">';
								for ($j=0; $j <$resultInd_UF["Count"] ; $j++) {
							    	$htmlUF.='<li>'.$resultInd_UF["metafisica"][$j].'</li>';
							    }

			$htmlUF.='		</ul>
						</td>
					    <td id="c23_'.$i.'">'.$result["costo_23"][$i].'</td>
					    <td id="c26_'.$i.'">'.$result["costo_26"][$i].'</td>
					    <td class="action">
					    	<button class="btnEditUF edit" onclick="xajax_editUF('.$result["id_uf"][$i].','.$i.')" >Editar</button>
							<button class="btnDelUF del" onclick="xajax_deleteUF('.$result["id_uf"][$i].','.$result["id_uf_indicator"][$i].','.$result["id_cat_subcat"][$i].')">Eliminar</button>
					    </td>
					</tr>';
		}


		$objResponse->assign("tabsUF","innerHTML",$htmlUF);
		$objResponse->script("
			$('.btnEditUF').click(function(){
				$('.DivEditUF').dialog('open');
					return false;
			});
			$('.btnDelUF').click(function() {
					$('.divDelUF').dialog('open');
					return false;
				});
			");

		//$objResponse->alert(print_r($resultInd_UF["Count"],TRUE));

		return $objResponse;
	}

	function NuevoUF(){
			$objResponse= new xajaxResponse();
			$smarty = new Smarty;
			$html ="<form id='nUnidadFinanciera'>
				<label for='years_uf'>Año: </label>
				<select name='years_uf' onchange='xajax_listCategory(this.value,777)' >";
			$result_years = selectyear("year","y");
			$html .= $result_years;
			$html .="</select>
				<span id='v_ufyears' class='msjalert'></span>
				<div id='listprog'></div>
				<span id='v_ufprog' class='msjalert'></span>
				<div id='divSubcategory_newuf'></div>
				<span id='v_ufprod' class='msjalert'></span>
				<div id='listact'></div>
				<span id='v_ufact' class='msjalert'></span>";


			// $html.= "<label for='category_uf'>Seleccione Programa</label>
			// 	<select name='category_uf' > ";

			// $resultCategory= selectcategory($idcategory="");
			// for ($i=0; $i < $resultCategory["Count"]; $i++) {
			// 	$html .= "<option id='select_c' value=".$resultCategory["idcategory"][$i].">".$resultCategory["category_description"][$i]."</option>";
			// }
			// $html .= "</select>
			// 		<label for='subcategory_uf'>Seleccione Producto</label>
			// 		<select id='select_sc' name='subcategory_uf' >";
			// $resultSubCategory = selectsubcategory($idcategory="");

			// for ($i=0; $i <$resultSubCategory["Count"] ; $i++) {
			// 	$html .= "<option  value=".$resultSubCategory["idsubcategory"][$i].">".$resultSubCategory["subcategory_description"][$i]."</option>";
			// }
			// $html .= "</select>
			// 		<label for='activity_uf'>Seleccione Actividad</label>
			// 		<select id='select_a' name='activity_uf'>";

			// $resultActivity = selectActivity();
			// for ($i=0; $i < $resultActivity["Count"] ; $i++) {
			// 	$html .= "<option  value=".$resultActivity["idactivity"][$i].">".$resultActivity["activity_description"][$i]."</option>";
			// }
			// $html .= "</select>";

			// $html .= "
			// 		<fieldset style='position:relative'>

			// 			<legend>Resultados</legend>
			// 			<div class='absolute'>
			// 				<label for='num_file' style='width:auto'>Cantidad</label>
			// 				<select id='num_file' style='width:auto'>";
			// for ($j=0; $j < 10 ; $j++) {
			// 		$html .="<option value=".($j).">".($j)."</option>";
			// 	}

			// $html .="		</select>
			// 			</div>
			// 			<div id='upload_result'></div>
			// 		</fieldset>";

			$resultIndicator = selectindicator_um(1);
			$html .= "
			<fieldset style='position:relative'>
				<legend >Indicadores</legend>
				<div class='absolute'>
				<label for='num_ind' style='width:auto'>Cantidad</label>
				<select name='num_ind' id='num_ind' style='width:auto'>";
				for ($i=0; $i <($resultIndicator["Count"]+1) ; $i++) {
					$html .="<option value=".$i.">".$i."</option>";
					}
			$html .="</select></div>
					<div class='uf_indicator_label'>
					<span id='uf_indicator_name'>Nombre de Indicador</span>
					<span id='uf_metafis'>Meta Física</span>

					</div>
					<div id='selectIndicator'></div>";


			$html .="</fieldset>

				<label for='costo23_uf'>Ingrese Costo_23</label>

				<input type='text' name='costo23_uf'>
				<label for='costo26_uf'>Ingrese Costo_26</label>
				<input type='text' name='costo26_uf'>

				<div class='btnActions'>
					<input type='button' value='Guardar'
		            onclick='xajax_guardarUF(xajax.getFormValues(\"nUnidadFinanciera\"))'>
		            <input type='button' value='Cancelar' class='btnCancel'>
	            </div>
			</form>";

			$objResponse->assign("newUF","innerHTML",$html);


			$objResponse->script("
				$('.btnCancel').click(function(){
					$('#newUF').dialog('close')
				});
				$('#num_ind').change(function(){
					xajax_indicator_UF(document.getElementById('num_ind').options[document.getElementById('num_ind').selectedIndex].value);
				});

				$('#num_file').click(function(){
					xajax_result_files(document.getElementById('num_file').options[document.getElementById('num_file').selectedIndex].value);
				});
				");
			//$objResponse->alert(print_r($valueSelect,TRUE));
			return $objResponse;

		}
	function result_files($num){
		$objResponse = new xajaxResponse();
		for ($i=0; $i < $num ; $i++) {
			$html .= "<label for='file_".$i."'>Archivo Nro ".($i+1)."</label>
					<input type='file' name='file_".($i+1)."' id='file_".($i+1)."'>";
		}

		$objResponse->assign("upload_result","innerHTML",$html);
		return $objResponse;
	}


	function indicator_UF($id){
		$objResponse = new xajaxResponse();
		//$resultIndicator = selectindicator_um(1);
		$result = selectInd();
		$html="";
		for ($i=0; $i < $id ; $i++) {
			//$html .= $result;

				$html .= "<select class='newUF_".$i."' name='newUF[]'>";
				$html .= $result;
				$html .= "</select>";
			$html .= "<input class='new_metafisica' type='text' name='newMF[]'>";
		}
		$objResponse->assign("selectIndicator","innerHTML",$html);
		$objResponse->script("
						mfis = $('.mf_".$id." li').html();
						$('.new_metafisica').attr('value',mfis);

						");

		//$objResponse->alert(print_r($html,TRUE));

		return $objResponse;
	}
	function selectInd(){
		$resultIndicator = selectindicator_um(1);
		$html = "";
		for ($i=0; $i <$resultIndicator["Count"]; $i++) {
			$html.="<option value=".$resultIndicator["idindicator"][$i].">".$resultIndicator['ind_description'][$i]."</option>";
		}
		return $html;
	}
	function guardarUF($form){
		$objResponse = new xajaxResponse();
		// if (!empty($form["years_uf"]) or $form["years_uf"]=="") {
		// 	$objResponse->assign("v_ufyears","innerHTML","El año es requerido!");
		// }
		// elseif (!isset($form["cat_select"]) ){
		// 	$objResponse->assign("v_ufprog","innerHTML","El Programa es requerido!");
		// 	$objResponse->assign("v_ufyears","innerHTML"," ");
		// }
		// elseif (!empty($form["id_cat_subcat"])) {
		// 	$objResponse->assign("v_ufprod","innerHTML","El Producto es requerido!");
		// 	$objResponse->assign("v_ufyears","innerHTML","");
		// }
		// elseif (!empty($form["activity_uf"])) {
		// 	$objResponse->assign("v_ufact","innerHTML","La Actividad es requerido!");
		// 	$objResponse->assign("v_ufyears","innerHTML","");
		// }
		// else{
		//$objResponse->alert(print_r($form,TRUE));
		$html="<p class='msjdel'>Su solicitud no ha sido procesada, intentalo mas luego.</p>";

				$resultinsertUF = insertUF($form);
				//inserta Unidad Finaciera por actividada
				if ($resultinsertUF["Error"]==0) {
					//select la ultima UF insetada

							$resultselectLast_UF = select_UnidFinan();
							if ($resultselectLast_UF["Error"]==0) {
								$resultinsertUF_ind = insert_UF_Indicator($resultselectLast_UF,$form);
								if ($resultinsertUF_ind["Error"]==0) {
									$html="<p class='msj'>La Unidad Financiera se ha guardado con éxito</p>";
									$objResponse->script("xajax_ListUF('999','999','999')");
									//upload resultados
									// $resultinsertupload= insertUpload($resultselectLast_UF,$form);
									// if ($resultinsertupload["Error"]==0) {
									// 	$html="La Unidad Financiera se ha guardado con éxito";
									// 	$objResponse->script("xajax_ListUF('999','999','999')");
									// }
									// else{
									// $hml="Debió ocurrir algun error, inténtalo mas tarde";
									// }

								}
								else{
									$hml="<p class='msj'>Debió ocurrir algun error, inténtalo mas tarde</p>";
									}
							}
				}

		$objResponse->assign("newUF","innerHTML",$html);
		// }
		//$objResponse->alert(print_r($objResponse));
		return $objResponse;

	}


	function editUF($id_uf,$id)
	{
		$objResponse = new xajaxResponse();

		$html = '<form id="eUnidadFinanciera">
				<input type="hidden" name="id_uf" value='.$id_uf.'>

				<label for="uf_ppr">Programa</label>
				<input class="uf_prog" type="text" name="uf_ppr" readonly value="">
				<label for="uf_prod">Producto</label>
				<input class="uf_prod" type="text" name="uf_prod" readonly value="">
				<label for="uf_act">Actividad</label>
				<input class="uf_act" type="text" name="uf_act" readonly value="">';
		//$resultIndicator = selectindicator_um(1);
			$html .= "
				<fieldset style='position:relative'>
					<legend >Indicadores</legend>

					<div class='uf_indicator_label'>
					<span id='uf_indicator_name'>Nombre de Indicador</span>
					<span id='uf_metafis'>Meta Física</span>

					</div>
					<div id='selectIndicator'></div>";


			$html .= "</fieldset>";

			$html .= '

				<label for="uf_23"> 2_3</label>
				<input class="uf_23" type="text" name="uf_23" value="">

				<label for="uf_26">2_6</label>
				<input class="uf_26" type="text" name="uf_26" value="">
				<div class="btnActions">
	            	<input type="button" onclick="xajax_updateUF(xajax.getFormValues(\'eUnidadFinanciera\'))" value="Actualizar">
	                <input type="button" value="Cancelar" class="btnCancel">
	            </div>
				</form>';
		$objResponse->assign("updateUF","innerHTML",$html);
		$objResponse->script("
			$('.btnCancel').click(function(){
					$('.DivEditUF').dialog('close')
				});

			// $('.ind_".$id." input').each(function(index){
			// 	var val = $(this).value();
			// });
			//var val_li = $('.ind_".$id." input').value();
			var num_li = $('.ind_".$id." li').size();
			xajax_indicator_UF(num_li);

		    //$('.new_metafisica').attr('value','val_c3');

			prog = $('#prog_'+".$id.").html();
			$('.uf_prog').attr('value',prog);

			prod = $('#prod_'+".$id.").html();
			$('.uf_prod').attr('value',prod);

			act = $('#act_'+".$id.").html();
			$('.uf_act').attr('value',act);


			val_c3 = $('#c23_'+".$id.").html();
			$('.uf_23').attr('value',val_c3);
			val_26 = $('#c26_".$id."').html();
			$('.uf_26').attr('value',val_26);


			");

		return $objResponse;
	}
	function updateUF(){
		$objResponse = new xajaxResponse();
		$result = updateUnidadFinanciera($form);
		if ($result["Error"]==0) {
		  	$html.="<p class='msj'> La Unidad de Financiera fue actualizada correctamente</p>";
		  	$objResponse->script("xajax_ListUF()");
		  }
		  else {
		  	$html.="<p class='msjdel'> Debió ocurrir un error, intentalo mas tarde</p>";
		  }
		$objResponse->assign("updateUF","innerHTML",$html);

		return $objResponse;
	}

	function deleteUF($id_uf,$id_uf_ind,$id_cat_subcat){
		$objResponse = new xajaxResponse();
		$html = " <p class='msj'>Esta seguro que desea eliminar la unidad Financiera</p>
		<div class='btnActions'>
			<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteUF($id_uf_ind,$id_uf,$id_cat_subcat)'>
			<input type='button' value='Cancelar' class='btnCancel'>
		</div>" ;

		$objResponse->assign("deleteUF","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('.divDelUF').dialog('close')
				});
		");
		return $objResponse;
	}
	function ConfirmDeleteUF($id_uf_indicator,$id_uf,$id_cat_subcat){
		$objResponse = new xajaxResponse();
		$result = deleteInd_UF($id_uf_ind);
		$result_01 = deleteUnidFinanciera($id_uf);
		$result_02 = deleteCat_Subcat($id_cat_subcat);
		if ($result["Error"]==0 and $result_01["Error"]==0 and $result_02["Error"]==0) {
			$html="<p class='msj'>Se ha eliminado la Unidad Financiera</p>";
			$objResponse->script("xajax_ListUF(999,999,999)");
		}
		else{
			$html="<p class='msjdel'>No se ha podido eliminar la Unidad Financiera</p>";
		}
		//$objResponse->alert(print_r($result_02["Query"],TRUE));
		$objResponse->assign("deleteUF","innerHTML",$html);
		return $objResponse;
	}

	function listCategory($idyear,$action){
		$objResponse = new xajaxResponse();

		$resultCategory=selectcategory_year($idyear);
		$category_description = "";
		 if ($resultCategory["Error"]==0) {
			$category_description .= "<option value='999' selected>Seleccione una opción</option>";
			for($i=0; $i<$resultCategory["Count"]; $i++){
				$category_description.="<option value=".$resultCategory["id_years_category"][$i]." >".$resultCategory["category_description"][$i]."</option>";
				}
			//case producto
			if ($action==-1) {
				$category_description='<div class="divselect">
					<label for="prog_main">Programa: </label>
					<select class="select" for="prod_main" onchange="xajax_ListProducts(this.value)" id="cat_select">'.$category_description.'</select>
					</div>';
				$objResponse->assign("menuprogramas_p","innerHTML",$category_description);

				}
			//case activity
			elseif ($action==0) {
				$category_description='<div class="divselect">
					<label for="prog_main">Programa: </label>
					<select class="select" for="prod_main" onchange="xajax_listSubCategory(this.value,'.$action.')" id="cat_select">'.$category_description.'</select>
					</div>';
				$objResponse->assign("menuprogramas_a","innerHTML",$category_description);
				}
			//case indicator
			elseif ($action==1) {
				$category_description='<div class="divselect">
					<label for="prog_main">Programa: </label>
					<select class="select" for="prod_main" onchange="xajax_listSubCategory(this.value,'.$action.');xajax_ListIndicator(999,this.value,999,999); xajax_ListActividadProducto(this.value,999,'.$action.')" id="cat_select">'.$category_description.'</select>
					</div>';
				$objResponse->assign("menuprogramas_i","innerHTML",$category_description);
				}
			//case unidadfinanciera
			elseif ($action==2) {
				$category_description='<div class="divselect">
					<label for="prog_main">Programa: </label>
					<select class="select" for="prod_main" onchange="xajax_listSubCategory(this.value,'.$action.');xajax_ListUF(this.value,999,999); xajax_ListActividadProducto(this.value,999,'.$action.')" id="cat_select">'.$category_description.'</select>
					</div>';
				$objResponse->assign("menuprogramas_uf","innerHTML",$category_description);
				}
				//nuevo UF
			else{
				$category_description='<div class="divselect1">
					<label for="prog_main">Programa: </label>
					<select class="select1" for="prod_main" onchange="xajax_listSubCategory(this.value,777)" id="cat_select" name="cat_select">'.$category_description.'</select>
					</div>';
				$objResponse->assign("listprog","innerHTML",$category_description);
			}
		 }
		 else{
		 	$category_description= "<div class='msjdel'>Todavía no se encuentran Productos en este año</div>";
		 }

		//$objResponse->alert(print_r($objResponse,TRUE));
	return $objResponse;
	}


	function listSubCategory($idcategory, $action){

		$objResponse = new xajaxResponse();

		$resultSubCategory=selectsubcategory($idcategory);
		$subcategory_description ="<option value='999'>Seleccione Producto</option>";

		if($resultSubCategory["Error"]==0){

			for($i=0; $i<count($resultSubCategory["subcategory_description"]); $i++){
				$subcategory_description.="<option value='".$resultSubCategory["idsubcategory"][$i]."'>".$resultSubCategory["subcategory_description"][$i]."</option>";
			}
			//case vacio
			if ($resultSubCategory["Count"]==0) {
				$subcategory_description="<option value='999'>Debe selecionar un Programa valido</option>";
			}
			//case activity
			if ($action==0) {
				$subcategory_description="<div class='divselect' style='text-align:left;'><label for='product_a'>Producto: </label><select name='product_a' class='select' id='ddlsubcategory' onchange='xajax_ListActivity(this.value,".$idcategory.")'>$subcategory_description</select></div>";
				$objResponse->assign("divmenuSubcategory","innerHTML",$subcategory_description);
				//$objResponse->script('$("#ddlsubcategory").change(function() { xajax_listActividadProducto(document.getElementById("ddlsubcategory").options[document.getElementById("ddlsubcategory").selectedIndex].value);} );');
			}
			//case indicator
			elseif ($action==1) {
			 	$subcategory_description="<div class='divselect' style='text-align:left;'><label for='product_a'>Producto: </label><select name='product_a' class='select' id='ddlsubcategory_i'  onchange='xajax_ListIndicator(this.value,".$idcategory.",999,1)' >$subcategory_description</select></div>";
			 	$objResponse->assign("divmenuSubcategory_i","innerHTML",$subcategory_description);
			 }
			 //case uf
			 elseif ($action==2) {
			 	$subcategory_description="<div class='divselect' style='text-align:left;'><label for='product_a'>Producto: </label><select name='product_a' class='select' id='ddlsubcategory' onchange='xajax_ListActividadProducto(this.value,$idcategory,$action); xajax_ListUF($idcategory,this.value,999)'>$subcategory_description</select></div>";
			 	$objResponse->assign("divmenuSubcategory_uf","innerHTML",$subcategory_description);
			 }
			  //case frondend
			 elseif ($action==775) {
			 	$subcategory_description="<div class='divselect'><label for='product'>Producto : </label><select name='product' class='select' id='ddlsubcategory' onchange='xajax_actividadproducto(this.value,".$idcategory.")'>$subcategory_description</select></div>";
			 	$objResponse->assign("divSubcategory_frond","innerHTML",$subcategory_description);
			 }
			 //case new UF
			 elseif ($action==777) {
			 	$subcategory_description ="<option></option>";
			 	for($i=0; $i<$resultSubCategory["Count"]; $i++){
				$subcategory_description.="<option value='".$resultSubCategory["id_cat_subcat"][$i]."'>".$resultSubCategory["subcategory_description"][$i]."</option>";
				}
			 	$subcategory_description="<div class='divselect1'><label for='product'>Producto : </label><select name='id_cat_subcat' class='select1' id='ddlsubcategory' onchange='xajax_ListActividadProducto(this.value,$idcategory,$action)'>$subcategory_description</select></div>";
			 	$objResponse->assign("divSubcategory_newuf","innerHTML",$subcategory_description);
			 }
			 else{
			 	$subcategory_description="<div class='divselect'><label for='product'>Producto : </label><select name='product' class='select' id='ddlsubcategory' onchange='xajax_ListActividadProducto(this.value,$idcategory,$action)'>$subcategory_description</select></div>";
			 	$objResponse->assign("divmenuSubcategory_res","innerHTML",$subcategory_description);
			 	}


		}
		else{
			$subcategory_description="<div style='text-align:left; padding:5px 0px 5px 0px; '><select id='ddlsubcategory'></select></div>";
		}



		//$objResponse->alert(print_r($resultSubCategory["Query"],TRUE));
		$objResponse->script("
			$('#ddlsubcategory_i').change( function(){
				xajax_ListActividadProducto(document.getElementById('ddlsubcategory_i').options[document.getElementById('ddlsubcategory_i').selectedIndex].value,".$idcategory.",".$action.");
			});
			");
		return $objResponse;

	}

	function upload_result(){
		$objResponse = new xajaxResponse();

		$upload = new file_upload();

			$upload->upload_dir = 'files/'.$_POST["idppr"]."/";
			$upload->extensions = array('.png', '.jpg', '.zip', '.pdf'); // specify the allowed extensions here
			$upload->rename_file = true;


			if(!empty($_FILES)) {
				$upload->the_temp_file = $_FILES['userfile']['tmp_name'];
				$upload->the_file = $_FILES['userfile']['name'];
				$upload->http_error = $_FILES['userfile']['error'];
				$upload->do_filename_check = 'y'; // use this boolean to check for a valid filename
				if ($upload->upload("demo_file")){


					$html = '<div id="message">'. $upload->file_copy .' Archivo subido con éxito</div>';
					//return the upload file
					$html .= '<div id="uploadedfile">'. $upload->file_copy .'</div>';

				} else {


					$html = '<div id="message">'. $upload->show_error_string() .'</div>';

				}
			}
		$objResponse->assign("result_demo","innerHTML",$html);
		return $objResponse;
	}


    // no activo
	function ListActividadProducto($idsubcategory,$idcategory,$action){
		$objResponse = new xajaxResponse();
		// $smarty = new Smarty;
		//$idactivity="9999";

			$resultFilterActivity=product_details($idsubcategory, $idcategory, $idactivity="");

			$htmlfilter="<option value='999'> </option>";

			if($resultFilterActivity["Error"]==0){

				for($i=0; $i<$resultFilterActivity["Count"]; $i++){
					//$arrayProject = xmltoarray($result["data_content"][$i]);
					$htmlfilter.="<option value= '".$resultFilterActivity["idactivity"][$i]."'>".$resultFilterActivity["activity_description"][$i]."</option>";
				}
				if ($resultFilterActivity["Count"]==0 and $idcategory==999) {
					$htmlfilter="<option value='999'>Debe selecionar un Producto y/o PPR valido</option>";
				}

				//indicadores
				if ($action==1) {
					$htmlfilter = "<div class='divselect' style='text-align:left; '><label for='actividad_i'>Actividad: </label><select class='select' name='actividad_i' onchange='xajax_ListIndicator($idsubcategory,$idcategory,this.value,$action)'>".$htmlfilter."</select></div>";
					$objResponse->assign("divactividadproducto","innerHTML",$htmlfilter);
				}
				// unidad finaciera
				elseif ($action==2) {
					$htmlfilter = "<div class='divselect' style='text-align:left;'><label for='actividad_uf'>Actividad: </label><select class='select' name='actividad_uf' onchange='xajax_ListUF($idcategory,$idsubcategory,this.value)'>".$htmlfilter."</select></div>";
					$objResponse->assign("divactividadproducto_uf","innerHTML",$htmlfilter);
				}
				//nuevo UF
				elseif ($action==777) {

					$resultActivity = selectActivity();
					for ($i=0; $i < $resultActivity["Count"] ; $i++) {
						$htmlfilter .= "<option  value=".$resultActivity["idactivity"][$i].">".$resultActivity["activity_description"][$i]."</option>";
					}

					$htmlfilter = "<div class='divselect1' style='text-align:left;'><label for='actividad_uf'>Actividad: </label><select class='select1' name='activity_uf' >".$htmlfilter."</select></div>";
					$objResponse->assign("listact","innerHTML",$htmlfilter);
					}
				else {
					$htmlfilter ="<div class='divselect' style='text-align:left;'><label for='actividdad'>Actividad : </label><select class='select' name='actividdad' onchange='xajax_resultdetails($idsubcategory,$idcategory,this.value,$action)'>".$htmlfilter."</select></div>";
					$objResponse->assign("divactividadproducto_result","innerHTML",$htmlfilter);
				}
			}

		// $objResponse->alert(print_r($idcategory,TRUE));

		//$objResponse->assign("divmenuData","innerHTML",$html);
		//$objResponse->assign("divactividadproducto","innerHTML",$htmlfilter);
		return $objResponse;
	}

	// no activo
	function editActividadProducto($iddata){
		$objResponse = new xajaxResponse();
		$smarty = new Smarty;
		$result=selectDATA($iddata);
		if($result["Error"]==0){

			$arrayProject = xmltoarray($result["data_content"][0]);
			$smarty->assign("actividad",$arrayProject["actividad"]);
			$html= $smarty->fetch('tpl/editProductoActividad.tpl');
		}
		else{
			$html="";
		}
		$objResponse->assign("divactividadproducto","innerHTML",$html);

		return $objResponse;
	}

	// no activo
	function dataUpdate($form){
		$objResponse = new xajaxResponse();
		$result = updatePPR($form);
		if ($result["Error"]==0){
			$objResponse->alert("Actualizacion correcta");
			//$objResponse->alert($result["Query"]);
		}
		else{
			$objResponse->alert("Error al actualizar");
			//$objResponse->alert($result["Query"]);
		}

		return $objResponse;
	}

	//no activo
	function pprEdit($idppr){
		$objResponse = new xajaxResponse();

		$result=selectPPR($idppr);
		$xmlstring =  "<pprs>".$result["data_content"][0].$result["data_content"][0]."</pprs>";
		$arrayProject = xmltoarray($xmlstring);

		$smarty = new Smarty;
		$smarty->assign("data",$arrayProject["ppr"][0] );
		$smarty->assign("idppr",$result["iddata"][0]);
		$html= $smarty->fetch('tpl/edit.tpl');

		$smarty->assign("idppr",$result["iddata"][0]);
		$htmlFileUpload= $smarty->fetch('tpl/listFiles.tpl');

		$objResponse->assign("divproyectos","style.display","none");
		$objResponse->assign("divedit","innerHTML",$html);
		//$objResponse->assign("divLoginForm","innerHTML",$htmlFileUpload);
		$objResponse->script('jQuery(function($){$(\'.fileUpload\').fileUploader();});');
		$htmlFileTree = phpFileTree("/data/paginasweb/sysppr/","files/".$result["iddata"][0]."/");
		$objResponse->assign("divListFiles","innerHTML",$htmlFileTree);
		$objResponse->script('$(function($){$(\'#tabs\').tabs();});');
		return $objResponse;
	}

	function reloadFileTree($idppr){
		$objResponse = new xajaxResponse();
		$htmlFileTree = phpFileTree("/data/paginasweb/sysppr/","files/".$idppr."/");
		$objResponse->assign("divListFiles","innerHTML","$htmlFileTree");
		return $objResponse;
	}


	function deleteFile($basepath,$relativepath,$file){
		$objResponse = new xajaxResponse();
		$pathDirectory = $basepath.$relativepath;

		if (unlink($pathDirectory.$file)){
			$objResponse->alert("Archivo borrado");
			$htmlFileTree = phpFileTree($basepath,$relativepath);
			$objResponse->assign("divListFiles","innerHTML",$htmlFileTree);

		}
		else{
			$objResponse->alert("No se pudo eliminar el archivo");
		}

		return $objResponse;
	}


	function cancelUpdate(){
		$objResponse = new xajaxResponse();
		$objResponse->assign("divproyectos","style.display","block");
		$objResponse->assign("divLoginForm","innerHTML","");
		$objResponse->assign("divedit","innerHTML","");
		return $objResponse;
	}

	function ppr_menu()
	{
		$objResponse = new xajaxResponse();
		$html='<li><a href="#">Productos y Actividades</a>
					       		<ul>';
								$result= selectcategory_year($idyear="enable",$action="y");
								for ($i=0; $i < $result["Count"]; $i++) {
									$html.='<li>
					       				<a href="#" onclick="xajax_menuProject('.$result["idyear"][$i].')">'.$result["year_description"][$i].'</a>
					       			</li>';
									}

		$html .='</ul> </li>';
		return $html;
	}

	function ppr_result()
	{

		$html='<li><a href="#">Resultados</a>
					       		<ul>';
								$result= selectcategory_year($idyear="enable",$action="y");
								for ($i=0; $i < $result["Count"]; $i++) {
									$html.='<li>
					       				<a href="#" onclick="xajax_menuResult('.$result["idyear"][$i].')">'.$result["year_description"][$i].'</a>
					       			</li>';
									}

		$html .='</ul> </li>';

		return $html;
	}

	function menuResult($idyear)
	{
		$objResponse = new xajaxResponse();
		$resultCategory=selectcategory_year($idyear);

		if ($resultCategory["Error"]==0) {
			$html="<div class='menuResult'>";
			$category_description .= "<option value='999' selected>Seleccione una opción</option>";
			for($i=0; $i<$resultCategory["Count"]; $i++){
				$category_description.="<option value='".$resultCategory["id_years_category"][$i] ."' >".$resultCategory["category_description"][$i]."</option>";
				}

			$html .='<h3 class="f-main"> Resultados: <span class="divselect">'.$resultCategory["year_description"][0].'</span></h3>

					<div class="divselect" >
					<label for="prog_main">Programa: </label>
					<select class="select" for="prod_main" onchange="xajax_listSubCategory(this.value,999); xajax_ListActividadProducto(999,this.value,999)" id="cat_select">'.$category_description.'</select>
					</div>';

			$html.= "<div id='divmenuSubcategory_res'></div>
					<div id='divactividadproducto_result'></div>
					<div id='result_details'>	</div>

				</div>
				";
		 }
		 else{
		 	$html= "<div class='msjdel'>Todavía no se encuentran Productos en este año</div>";
		 }




		$objResponse->assign("indexContent","innerHTML","");
		$objResponse->assign("loginContent","innerHTML","");
		//frond-end
		$objResponse->assign("divCategory_frond","innerHTML","");
		$objResponse->assign("divSubcategory_frond","innerHTML","");
		$objResponse->assign("divactividadproducto","innerHTML","");

		$objResponse->assign("divResult","innerHTML",$html);
		$objResponse->assign("divactividadproducto","innerHTML","");
		$objResponse->script("");
		return $objResponse;
	}

	function resultdetails($idsubcategory,$idcategory,$idactivity,$action){
		$objResponse = new xajaxResponse();

			$result_1 = result_upload($idsubcategory, $idcategory, $idactivity);
			// $objResponse->alert(print_r($result_1["Query"],TRUE));
			$html = '';
			 $dir= "results/result_";

			if ( $result_1["Count"] > 0) {
				$html .= '<div class="result">';
				for ($i=0; $i < $result_1["Count"] ; $i++) {
				$arrayResult = xmltoarray($result_1["data_upload"][$i]);
				$arrayResult_1 = simplexml_load_string($result_1["data_upload"][$i],null , LIBXML_NOCDATA);


				$html .= '

				<h3>'.$arrayResult["title"].'</h3>


					<div class="r-details a-result-'.$i.'">
					 <p>'.(string)$arrayResult_1->description;

					 if ($result_1["idupload"][$i]!=7) {
					 	if (isset($arrayResult["file_main"])) {
					 		if (file_exists($dir.$result_1["idupload"][$i].'/'.trim($arrayResult["file_main"]).'.pdf')) {
					 			$html .= '	<span class="plus-download f-right"><a target="_blank"  href="'.$dir.$result_1["idupload"][$i].'/'.$arrayResult["file_main"].'.pdf" rel="nofollow" class="view_details">[+Leer Mas] </a>&nbsp &nbsp
								 	<a  href="download.php?file='.$dir.$result_1["idupload"][$i].'/'.$arrayResult["file_main"].'.pdf" rel="nofollow" class="download">[<span>▼</span>Descargar]</a></span>
								 ';
					 		}
					 	}
					 }
				$html .= '</p>';
				// resultados tavera
				if ($result_1["idupload"][$i]==7) {
						$html_cat ="";
					for ($t=0; $t <count($arrayResult["category"]) ; $t++) {
						$html_cat .= '<h3><span>'.($t+1).'. </span><a href="'.$dir.$result_1["idupload"][$i].'/anexos/'.$arrayResult["category"][$t]["file_main"].'.pdf" class="r-category" target="_blank">'.$arrayResult["category"][$t]["file_main"]."</a></h3>";
						$html_cat .= "<h5 class='r-anexo'>Anexos: </h5>";
						$html_file =  "";
						if (count($arrayResult["category"][$t]["anexos"]["file"])>1) {

							for ($j=0; $j < count($arrayResult["category"][$t]["anexos"]["file"]) ; $j++) {
								$html_file .= '<li><a href="'.$dir.$result_1["idupload"][$i].'/anexos/'.$arrayResult["category"][$t]["anexos"]["file"][$j].'.pdf" target="_blank" >'.$arrayResult["category"][$t]["anexos"]["file"][$j].'</a> </li>';
							}
						}
						$html_cat .= "<ul class='r-pdf'>".$html_file."</ul>";
					}

				}
				$html .= $html_cat;
			   //fin result tavera

			   if (!empty($arrayResult["anexos"]["file"]) ) {
			   	if ($result_1["idupload"][$i]!=7) {
			   		$html .='<h4 class="r-title">Anexos: </h4> ';

					    $html1="";
					   if (count($arrayResult["anexos"]["file"])>1) {


						$cont = count($arrayResult["anexos"]["file"]);
							for ($x=0; $x < $cont ; $x++) {
						    	$html1 .= '<li><a href="'.$dir.$result_1["idupload"][$i].'/anexos/'.$arrayResult["anexos"]["file"][$x].'.pdf" target="_blank" >'.$arrayResult["anexos"]["file"][$x].'</a> </li>';

						    	}

						}
						else{
							$html1 .= '<li><a href="'.$dir.$result_1["idupload"][$i].'/anexos/'.$arrayResult["anexos"]["file"].'.pdf" target="_blank" >'.$arrayResult["anexos"]["file"].'</a> </li>';
						}


					     // <li><a href="result/INFORME_CHOSICA_ZONIFICACION_SISMICA_GEOTECNICA_2012.pdf" target="_blank">INFORME_CHOSICA_ZONIFICACION_SISMICA_GEOTECNICA_2012INFORME_CHOSICA_ZONIFICACION_SISMICA_GEOTECNICA_2012 </a>
					     // </li><li><a href="#">Mapa 02 </a></li>
					$html .= '<ul class="r-pdf">'.$html1.'</ul>';

				  }
			   	}
			   	if (!empty($arrayResult["notes"]) ) {
					$html .="<p>".$arrayResult["notes"]."</p>";
				}

			  if (!empty($arrayResult["mapas"]["categoria"]) ) {

				$html .=' <h4 class="r-title">Mapas: </h4>
					    <ul class="cat-mapas">';
					for ($k=0; $k < count($arrayResult["mapas"]["categoria"]); $k++) {
						$html .= '<li>
										<a onclick="$(\'.a-map-'.$k.'\').toggle()" class="a-map-'.$k.'" > <span>▶</span>  '.$arrayResult["mapas"]["categoria"][$k]["nombre"].'</a>
										<a onclick="$(\'.a-map-'.$k.'\').toggle()" class="hide a-map-'.$k.'" > <span>▼</span> '.$arrayResult["mapas"]["categoria"][$k]["nombre"].'</a>
									  <div class="hide a-map-'.$k.'">
									    <ul class="img-mapas">';
								for ($j=0; $j < count($arrayResult["mapas"]["categoria"][$k]["files"]["file"]); $j++) {
									$html .= '<li> <a title="demo'.$j.'" class="map-gallery map-gallery'.$i.'" rel="group'.$i.'" href="'.$dir.$result_1["idupload"][$i].'/mapas/'.$arrayResult["mapas"]["categoria"][$k]["nombre"].'/'.$arrayResult["mapas"]["categoria"][$k]["files"]["file"][($j)].'">
									<img src="'.$dir.$result_1["idupload"][$i].'/mapas/'.$arrayResult["mapas"]["categoria"][$k]["nombre"].'/small/'.$arrayResult["mapas"]["categoria"][$k]["files"]["file"][($j)].'"></a></li>';
								}


						    $html .= '  </ul>
						    		  </div>
						       </li> <div class="clear"></div>';

						    }

				$html .='
					    </ul>
					    <div class="clear"></div>';
				}

				$html .='</div>

				';
			  }
			$html .= '</div>';
			}
			else
			{
				$html .= "<div class='result_0'>No existe resultados en esta actividad</div>";
			}

		//<img class="idimg" src="img/mapas/imagen01.jpg"  float: none;">
		// $html="<h2>titulo de resultado 01</h2>
		// 			<div class='res_description'> pequeña descripcion de resultado 01</div>
		// 			<h4>Mapas</h4>
		// 			<div>detalle de Mapas</div>
		// 			<h4>Anexos</h4>
		// 			<div>detalle de Anexos</div>";
		//$objResponse->alert(print_r($arrayResult["anexos"]["file"],TRUE));

		$objResponse->assign("result_details","innerHTML",$html);
		$objResponse->script('
			$( ".result" ).accordion({
		      collapsible: true
		    });
		var  i;
		var cont = 0;
		$(".img-mapas").each(function(index){
			cont = cont +1;
		});


				var sel = ".map-gallery"+0;
				$(sel).colorbox({ opacity:0.5, rel:"group0", title:"dem"}, function(){
					$(".cboxPhoto").smoothZoom({width: 700,  height: 495});
				});
		$(".a-result-0").css("display","none");

		');
		return $objResponse;
	}
	$xajax->registerFunction('actionyear');
	$xajax->registerFunction('updateYear');
	$xajax->registerFunction('menuAdmin');
	$xajax->registerFunction('menuResult');
	$xajax->registerFunction('menuProject');
	$xajax->registerFunction('secureLogin');
	$xajax->registerFunction('pprEdit');
	$xajax->registerFunction('reloadFileTree');
	$xajax->registerFunction('cancelUpdate');
	$xajax->registerFunction('deleteFile');
	$xajax->registerFunction('actividadproducto');
	$xajax->registerFunction('listSubCategory');
	$xajax->registerFunction('ListActividadProducto');
	$xajax->registerFunction('editActividadProducto');
	$xajax->registerFunction('dataUpdate');
	$xajax->registerFunction('nuevoppr');
	$xajax->registerFunction('titleProduct');
	$xajax->registerFunction('NewCategory');
	$xajax->registerFunction('guardarCategory');
	$xajax->registerFunction('NewProduct');
	$xajax->registerFunction('guardarProduct');
	$xajax->registerFunction('select_subcategory');
	$xajax->registerFunction('select_activity');
	$xajax->registerFunction('Listppr');
	$xajax->registerFunction('ListProducts');
	$xajax->registerFunction('ListActivity_0');
	$xajax->registerFunction('ListActivity');
	$xajax->registerFunction('NewActivity');
	$xajax->registerFunction('guardarActivity');
	$xajax->registerFunction('ListResponsible');
	$xajax->registerFunction('nuevoresponsable');
	$xajax->registerFunction('guardarResponsable');
	$xajax->registerFunction('idsubcategory');
	$xajax->registerFunction('ListIndicator');
	$xajax->registerFunction('ListUM');
	$xajax->registerFunction('guardarIndicator');
	$xajax->registerFunction('filterCategory');
	$xajax->registerFunction('NewIndicator');
	$xajax->registerFunction('NuevoUM');
	$xajax->registerFunction('guardarUM');
	$xajax->registerFunction('ListUF');
	$xajax->registerFunction('NuevoUF');
	$xajax->registerFunction('guardarUF');

	$xajax->registerFunction('editCat');
	$xajax->registerFunction('editSubcat');
	$xajax->registerFunction('editAct');
	$xajax->registerFunction('editResp');
	$xajax->registerFunction('editInd');
	$xajax->registerFunction('editUM');
	$xajax->registerFunction('editUF');
	$xajax->registerFunction('updateCat');
	$xajax->registerFunction('updateSubcat');
	$xajax->registerFunction('updateAct');
	$xajax->registerFunction('updateResp');
	$xajax->registerFunction('updateInd');
	$xajax->registerFunction('updateUM');
	$xajax->registerFunction('updateUF');

	$xajax->registerFunction('deleteCat');
	$xajax->registerFunction('deleteSubcat');
	$xajax->registerFunction('deleteAct');
	$xajax->registerFunction('deleteResp');
	$xajax->registerFunction('deleteInd');
	$xajax->registerFunction('deleteUM');
	$xajax->registerFunction('deleteUF');
	$xajax->registerFunction('ConfirmDeleteCat');
	$xajax->registerFunction('ConfirmDeleteSubcat');
	$xajax->registerFunction('ConfirmDeleteAct');
	$xajax->registerFunction('ConfirmDeleteResp');
	$xajax->registerFunction('ConfirmDeleteInd');
	$xajax->registerFunction('ConfirmDeleteUM');
	$xajax->registerFunction('ConfirmDeleteUF');
	$xajax->registerFunction('indicator_UF');
	$xajax->registerFunction('ppr_menu');
	$xajax->registerFunction('resultdetails');
	$xajax->registerFunction('result_files');
	$xajax->registerFunction('upload_result');
	//$xajax->registerFunction('ppr_result');
	$xajax->registerFunction('listCategory');

	$xajax->registerFunction('Select_YearCategory');

	$xajax->processRequest();

	$ua = $_SERVER["HTTP_USER_AGENT"];
	if (stristr($ua, "MSIE")){
	$css_link= "<link rel='stylesheet' type='text/css' href='css/estiloIE.css' />";
	}
	else {
	$css_link = "<link rel='stylesheet' type='text/css' href='css/estiloMoz.css' />";
	}

	$smarty = new Smarty;

	//$smarty->caching = true;
	//$smarty->cache_lifetime = 120;
	$smarty->assign("xajax",$xajax->printJavascript());
	$smarty->assign("ppr_menu",ppr_menu());
	$smarty->assign("ppr_result",ppr_result());
	$smarty->assign("css_link",$css_link);
	//$html_01 = $smarty->fetch('tpl/listFiles.tpl');
	//$smarty->assign("newUF_01",$html_01);

	$smarty->display('tpl/main.tpl');


?>