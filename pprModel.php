<?php

	function insertPPR($option,$form){

		$dbh=conx("sismos","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO listasismos( fecha_local, hora_local, latitud, longitud, magnitud, profundidad, referencia, intensidad) VALUES (";
		$sql.= "'".$year."-".$month."-".$day."',";
		$sql.= "'".$form["hora"]."',";
		$sql.= $form["latitud"].",";
		$sql.= $form["longitud"].",";
		$sql.= $form["magnitud_valor"].",";
		$sql.= $form["profundidad_valor"].",";
		$sql.= "'".$referencia."',";
		$sql.= "'".$form["intensidad"]."');";


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}


	function updatePPR($form){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$smarty = new Smarty;
		$smarty->assign("data",$form );
		$xml= $smarty->fetch('tpl/data.tpl');

		$sql = "UPDATE data SET data_content='$xml' WHERE iddata=".$form["iddata"];


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function updateYears($idyear,$year_enable){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE years SET year_enable= ".$year_enable." WHERE idyear=".$idyear;


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function updateCategory($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE category SET
		category_description = '".$form['c_titulo']."'

		 WHERE idcategory=".$form['idcategory'];

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}
	function selectYearsCategory($idcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "Select * from years_category where idcategory ='$idcategory' ";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_years_category"][$i]= $row["id_years_category"];
				//$result["data_content"][$i]= $row["data_content"];

				$i++;
			}

			if(isset($result["iddata"])){
				$result["Count"]=count($result["id_years_category"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;
	}

	function updateYearsCategory($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$result = selectYearsCategory($form["idcategory"]);
		if (count($form["c_idyear"])==$result["Count"]) {
			for ($i=0; $i < count($form["c_idyear"]); $i++) {
				$sql = "UPDATE years_category SET
					idyear = '".$form['c_idyear'][$i]."',
					idcategory = '".$form['idcategory']."'

					 WHERE idcategory=".$form['idcategory'];
				if($dbh->query($sql)){
					$result["Error"]=0;
				}
				else{
					$result["Error"]=1;
				}
			}

		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function updateSubcategory($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE subcategory SET subcategory_description =";
		$sql .="'". $form['sc_name']."',";
		$sql .=" subcategory_resumen =";
		$sql .="'".$form['sc_res']."'";
		$sql .=" WHERE idsubcategory=";
		$sql .= $form['idsubcategory'];

		/*subcategory_description =".$form['sc_nombre'].",
		subcategory_resumen = ".$form['sc_resumen']."
		WHERE idsubcategory=".$form['idsubcategory'];*/

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function updateActivity($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE activity SET idresponsable =";
		$sql .="'". $form['a_idresp']."',";
		$sql .=" activity_description =";
		$sql .="'".$form['a_name']."',";
		$sql .=" activity_universo=";
		$sql .="'".$form['a_universo']."',";
		$sql .=" activity_lb=";
		$sql .="'".$form['a_lineabase']."'";
		$sql .=" WHERE idactivity=";
		$sql .= $form['idactivity'];


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function updateResponsable($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE responsable SET
		resp_nombre='".$form['r_nombre']."'
		 WHERE idresponsable=".$form['idresponsable'];

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function updateIndicator($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE indicator SET ind_description =";
		$sql .="'". $form['i_name']."',";
		$sql .=" id_um =";
		$sql .="'".$form['ind_unidadmedida']."'";
		$sql .=" WHERE idindicator=";
		$sql .= $form['idindicator'];


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
	function updateUnidadMedida($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "UPDATE unidadmedida SET
		um_description='".$form['um_nombre']."'
		 WHERE id_um=".$form['id_um'];

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}


	function selectPPR($idsubcategory){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "SELECT * FROM data WHERE idsubcategory=$idsubcategory";
		/*$sql = "SELECT subcategory.subcategory_description
		       FROM  cat_subcat, subcategory, category
		       WHERE (cat_subcat.idsubcategory = subcategory.idsubcategory
		       AND cat_subcat.idcategory = category.idcategory AND cat_subcat.idcategory=$idcategory)";	*/

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["iddata"][$i]= $row["iddata"];
				$result["data_content"][$i]= $row["data_content"];

				$i++;
			}

			if(isset($result["iddata"])){
				$result["Count"]=count($result["iddata"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}



	function selectDATA($iddata){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "SELECT * FROM data WHERE iddata=$iddata";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["iddata"][$i]= $row["iddata"];
				$result["data_content"][$i]= $row["data_content"];
				$i++;
			}

			if(isset($result["iddata"])){
					$result["Count"]=count($result["iddata"]);
			}
			else{
			$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}



	function selectcategory($idcategory=""){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		if ($idcategory!=""){
			$sql = "SELECT * FROM category WHERE idcategory=$idcategory";

			if ($idcategory=="enable") {
			$sql = "SELECT * FROM category where category_enable=1";
			}
			if ($idcategory=="last") {
			$sql = "SELECT * FROM category ORDER BY idcategory DESC LIMIT 1 ";
			}

		}

		else{
			$sql = "SELECT * FROM category";
		}

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {

				$result["idcategory"][$i]= $row["idcategory"];
				$result["category_description"][$i]= $row["category_description"];
				$result["category_enable"][$i]= $row["category_enable"];

				$i++;
			}


			if(isset($result["idcategory"])){
				$result["Count"]=count($result["idcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function selectcategory_year($idyear="", $act="", $idcategory="",$year=""){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		//year con dato
		if ($idyear!=""){
			if ($act=="y") {
				if ($idyear=="year") {
					$sql = "SELECT * FROM years";
				}
				elseif ($idyear=="enable") {
					$sql = "SELECT * FROM years where year_enable=1";
				}
				else{
					$sql = "SELECT * FROM years WHERE idyear=$idyear";
				}

			}
			elseif ($act=="c"){
				$sql = "SELECT * FROM category WHERE idyear=$idyear";
			}
			else{
				if ($year!="999") {

				$sql = "SELECT YC.id_years_category, C.idcategory, C.category_description, C.category_enable, Y.idyear, Y.year_description, Y.year_enable
				   FROM years as Y, category as C, years_category as YC
				   WHERE (Y.idyear = YC.idyear and C.idcategory = YC.idcategory and Y.idyear = $idyear)";
				}
			}
		}
		//year vacio

		elseif ($idcategory!="") {
			$sql= "SELECT YC.id_years_category, C.idcategory, C.category_description, C.category_enable, Y.idyear, Y.year_description, Y.year_enable
				   FROM years as Y, category as C, years_category as YC
				   WHERE (Y.idyear = YC.idyear and C.idcategory = YC.idcategory and C.idcategory = $idcategory)";
			}
		else{
			$sql = "SELECT YC.id_years_category, C.idcategory, C.category_description, C.category_enable, Y.idyear, Y.year_description, Y.year_enable
				   FROM years as Y, category as C, years_category as YC
				   WHERE (Y.idyear = YC.idyear and C.idcategory = YC.idcategory and Y.year_enable=1) GROUP BY idcategory";
		}


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				if (isset($row["id_years_category"])) {
					$result["id_years_category"][$i]= $row["id_years_category"];
				}
				if (isset($row["idcategory"])) {
					$result["idcategory"][$i]= $row["idcategory"];
				}
				if (isset($row["category_description"])) {
					$result["category_description"][$i]= $row["category_description"];
				}

				if (isset($row["category_description"])) {
					$result["category_description"][$i]= $row["category_description"];
				}
				if ($row["idyear"]) {
					$result["idyear"][$i]= $row["idyear"];
				}
				if ($row["year_description"]) {
					$result["year_description"][$i]= $row["year_description"];
				}
				if ($row["year_enable"]) {
					$result["year_enable"][$i]= $row["year_enable"];
				}
				if (isset($row["category_enable"])) {
					$result["category_enable"][$i]= $row["category_enable"];
				}

				$i++;
			}


			if(isset($result["idyear"])){
				$result["Count"]=count($result["idyear"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function selectC_SC(){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

			$sql = "SELECT * FROM cat_subcat order by id_cat_subcat desc limit 1";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_cat_subcat"][$i]= $row["id_cat_subcat"];
				$result["idcategory"][$i]= $row["idcategory"];
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$i++;
			}


			if(isset($result["id_cat_subcat"])){
				$result["Count"]=count($result["id_cat_subcat"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function selectYC_subcat($idsubcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

			$sql = "SELECT YC_S.id_cat_subcat, SC.idsubcategory, SC.subcategory_description, YC.id_years_category
					FROM subcategory AS SC, years_category AS YC, YC_subcat AS YC_S
					WHERE (
					YC.id_years_category = YC_S.id_years_category
					AND SC.idsubcategory = YC_S.idsubcategory
					AND SC.idsubcategory =$idsubcategory
					)";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_cat_subcat"][$i]= $row["id_cat_subcat"];
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$result["subcategory_description"][$i]= $row["subcategory_description"];
				$result["id_years_category"][$i]=$row["id_years_category"];
				$i++;
			}


			if(isset($result["id_cat_subcat"])){
				$result["Count"]=count($result["id_cat_subcat"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function select_UnidFinan(){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

			$sql = "SELECT * FROM unidadfinanciera order by id_uf desc limit 1";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_uf"][$i]= $row["id_uf"];
				$result["id_cat_subcat"][$i]= $row["id_cat_subcat"];
				$result["idactivity"][$i]= $row["idactivity"];
				$i++;
			}


			if(isset($result["id_uf"])){
				$result["Count"]=count($result["id_uf"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}



	function selectsubcategory($idcategory="",$action=""){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		if ($idcategory!="") {
				$sql = "SELECT subcategory.idsubcategory, subcategory.subcategory_description, subcategory.subcategory_resumen, YC_subcat.id_cat_subcat
		       FROM  YC_subcat, subcategory, years_category
		       WHERE (YC_subcat.idsubcategory = subcategory.idsubcategory
		       AND YC_subcat.id_years_category = years_category.id_years_category ";
		       if ($action=="year") {
		       		$sql .="AND years_category.idyear=$idcategory";
		       	}
		       else {
		       		$sql .= "AND YC_subcat.id_years_category=$idcategory";
				}

				$sql .=")";
		}
		else {
			if ($action=="last") {
				$sql = "SELECT * FROM  subcategory ORDER BY idsubcategory DESC LIMIT 1 ";
			}
			else{
			$sql = "SELECT * FROM  subcategory ";}
		}
		//$sql = "SELECT * FROM subcategory WHERE idcategory=$idcategory";


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$result["subcategory_description"][$i]= $row["subcategory_description"];
				$result["subcategory_resumen"][$i]= $row["subcategory_resumen"];
				if (isset($row["subcategory_universo"])) {
					$result["subcategory_universo"][$i]= $row["subcategory_universo"];
				}
				if (isset($row["subcategory_lb"])) {
					$result["subcategory_lb"][$i]= $row["subcategory_lb"];
				}
				if (isset($row["subcategory_template"])) {
					$result["subcategory_template"][$i]= $row["subcategory_template"];
				}
				$result["id_cat_subcat"][$i] = $row["id_cat_subcat"];

				$i++;
			}


			if(isset($result["idsubcategory"])){
				$result["Count"]=count($result["idsubcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	/*nrlas*/
	function product($idsubcategory="", $idcategory=""){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		//$sql = "SELECT * FROM subcategory WHERE idcategory=$idcategory";
		$sql = "SELECT S.idsubcategory, C.category_description, S.subcategory_description,
				S.subcategory_template, S.subcategory_universo, S.subcategory_lb, S.subcategory_um , CS.metafisica
		       FROM  cat_subcat as CS, subcategory as S, category as C
		       WHERE (CS.idsubcategory = S.idsubcategory
		       AND CS.idcategory = C.idcategory AND CS.idcategory=$idcategory and S.idsubcategory =$idsubcategory)";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["category_description"][$i]=$row["category_description"];
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$result["subcategory_description"][$i]= $row["subcategory_description"];
				$result["subcategory_universo"][$i]= $row["subcategory_universo"];
				$result["subcategory_lb"][$i]= $row["subcategory_lb"];
				$result["subcategory_um"][$i]=$row["subcategory_um"];
				$result["metafisica"][$i]=$row["metafisica"];
				$i++;
			}


			if(isset($result["idsubcategory"])){
				$result["Count"]=count($result["idsubcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function product_details($idsubcategory="", $idcategory="", $idactivity="",$action=""){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		if ($idcategory!="" and $idactivity==""){

			if ($idsubcategory!="") {
				$sql = "SELECT years_category.id_years_category,
		      subcategory.subcategory_description,
		      subcategory.subcategory_universo,
		      subcategory.subcategory_lb,
		      activity.idactivity,
		      activity.activity_description,
		      responsable.idresponsable,
		      responsable.resp_nombre,
		      activity.activity_universo,
		      activity.activity_lb,
		      unidadmedida.um_description,
		      UF_indicator.metafisica,
      		  indicator.ind_description,
		      unidadfinanciera.costo_23,
		      unidadfinanciera.costo_26

		        FROM   UF_indicator, indicator, unidadmedida, unidadfinanciera, YC_subcat, activity, responsable, subcategory, years_category
		    	 WHERE (

		    	 	years_category.id_years_category = YC_subcat.id_years_category  and
		            subcategory.idsubcategory = YC_subcat.idsubcategory and
		            YC_subcat.id_cat_subcat = unidadfinanciera.id_cat_subcat and
		            activity.idactivity = unidadfinanciera.idactivity and
		            unidadfinanciera.id_uf=UF_indicator.id_uf and
		            indicator.idindicator=UF_indicator.idindicator and
		            unidadmedida.id_um = indicator.id_um and
		            responsable.idresponsable=activity.idresponsable and
		            years_category.id_years_category  = $idcategory and
		            subcategory.idsubcategory = $idsubcategory)";
			}
			else{
				$sql = "SELECT years_category.id_years_category,
		      subcategory.subcategory_description,
		      subcategory.subcategory_universo,
		      subcategory.subcategory_lb,
		      activity.idactivity,
		      activity.activity_description,
		      responsable.idresponsable,
		      responsable.resp_nombre,
		      activity.activity_universo,
		      activity.activity_lb,
		      unidadmedida.um_description,
		      UF_indicator.metafisica,
      		  indicator.ind_description,
		      unidadfinanciera.costo_23,
		      unidadfinanciera.costo_26

		        FROM  UF_indicator, indicator, unidadmedida, unidadfinanciera, YC_subcat, activity, responsable, subcategory, years_category
		    	 WHERE (
		    	 	years_category.id_years_category = YC_subcat.id_years_category  and
		            subcategory.idsubcategory = YC_subcat.idsubcategory and
		            YC_subcat.id_cat_subcat = unidadfinanciera.id_cat_subcat and
		            activity.idactivity = unidadfinanciera.idactivity and
		            unidadfinanciera.id_uf=UF_indicator.id_uf and
		            indicator.idindicator=UF_indicator.idindicator and
		            unidadmedida.id_um = indicator.id_um and
		            responsable.idresponsable=activity.idresponsable ";
		            if ($action=="year") {
		            	$sql.="and years_category.idyear = $idcategory ";
		            }
		            else{
						$sql.="and years_category.id_years_category = $idcategory";
		            }
		            $sql .= ");";

			}


		}
		else
		  {
			$sql = "SELECT  years_category.id_years_category,
		      subcategory.subcategory_description,
		      activity.idactivity,
		      activity.activity_description,
		      unidadmedida.um_description,
		      UF_indicator.metafisica,
      		  indicator.ind_description,
		      unidadfinanciera.costo_23,
		      unidadfinanciera.costo_26

		        FROM  UF_indicator, indicator, unidadmedida, unidadfinanciera, YC_subcat, activity, subcategory, years_category, upload
		    	WHERE (years_category.id_years_category = YC_subcat.id_years_category  and
		            subcategory.idsubcategory = YC_subcat.idsubcategory and
		            YC_subcat.id_cat_subcat = unidadfinanciera.id_cat_subcat and
		            activity.idactivity = unidadfinanciera.idactivity and
		            unidadfinanciera.id_uf=UF_indicator.id_uf and
		            indicator.idindicator=UF_indicator.idindicator and
		            unidadmedida.id_um = indicator.id_um and
		            years_category.id_years_category = $idcategory and
		            activity.idactivity = $idactivity and
		            subcategory.idsubcategory = $idsubcategory)
		            group by activity.idactivity";
		}


		//$sql = "SELECT * FROM subcategory WHERE idcategory=$idcategory";




		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				if (isset($row["year_description"])) {
					$result["year_description"][$i]=$row["year_description"];
				}
				if (isset($row["id_years_category"])) {
					$result["id_years_category"][$i]=$row["id_years_category"];
				}
				if (isset($row["category_description"])) {
					$result["category_description"][$i]=$row["category_description"];
				}
				if (isset($row["subcategory_description"])) {
					$result["subcategory_description"][$i]= $row["subcategory_description"];
				}
				if (isset($row["idresponsable"])) {
					$result["idresponsable"][$i]= $row["idresponsable"];
				}
				if (isset($row["resp_nombre"])) {
					$result["resp_nombre"][$i]= $row["resp_nombre"];
				}
				if (isset($row["subcategory_universo"])) {
					$result["subcategory_universo"][$i]= $row["subcategory_universo"];
				}
				if (isset($row["subcategory_lb"])) {
					$result["subcategory_lb"][$i]= $row["subcategory_lb"];
				}
				if (isset($row["idactivity"])) {
					$result["idactivity"][$i]=$row["idactivity"];
				}
				if (isset($row["activity_description"])) {
					$result["activity_description"][$i]=$row["activity_description"];
				}
				if (isset($row["activity_universo"])) {
					$result["activity_universo"][$i]=$row["activity_universo"];
				}
				if (isset($row["activity_lb"])) {
					$result["activity_lb"][$i]=$row["activity_lb"];
				}
				if (isset($row["unidadmedida"])) {
					$result["unidadmedida"][$i]=$row["unidadmedida"];
				}
				if (isset($row["ind_description"])) {
					$result["ind_description"]=$row["ind_description"];
				}
				if (isset($row["metafisica"])) {
					$result["metafisica"][$i]=$row["metafisica"];
				}
				if (isset($row["costo_23"])) {
					$result["costo_23"][$i]=$row["costo_23"];
				}
				if (isset($row["total_23"])) {
					$result["total_23"][$i]=$row["total_23"];
				}
				if (isset($row["costo_26"])) {
					$result["costo_26"][$i]=$row["costo_26"];
				}
				if (isset($row["total_26"])) {
					$result["total_26"][$i]=$row["total_26"];
				}
				$i++;
			}


			if(isset($result["id_years_category"])){
				$result["Count"]=count($result["id_years_category"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}
function result_upload($idsubcategory="", $idcategory="", $idactivity)
{
	$dbh=conx("bdppr","wmaster","igpwmaster");
	$dbh->query("SET NAMES 'utf8'");
	$sql = "SELECT category.idcategory, category.category_description,
		      subcategory.subcategory_description,
		      activity.idactivity,
		      activity.activity_description,
		      upload.idupload,
		      upload.nameupload,
              upload.typeupload,
              upload.sizeupload,
              upload.data_upload,
              upload.id_uf
		        FROM  years_category, UF_indicator, indicator, unidadmedida, unidadfinanciera, YC_subcat, activity, subcategory, category, upload
		    	WHERE (years_category.id_years_category = YC_subcat.id_years_category  and
		            subcategory.idsubcategory = YC_subcat.idsubcategory and
		            YC_subcat.id_cat_subcat = unidadfinanciera.id_cat_subcat and
		            activity.idactivity = unidadfinanciera.idactivity and
		            unidadfinanciera.id_uf=UF_indicator.id_uf and
		            indicator.idindicator=UF_indicator.idindicator and
		            unidadmedida.id_um = indicator.id_um and
		            unidadfinanciera.id_uf=upload.id_uf and
		            category.idcategory = $idcategory and
		            activity.idactivity = $idactivity and
		            subcategory.idsubcategory = $idsubcategory)
		            ";

if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_uf"][$i] = $row["id_uf"];
				$result["idcategory"][$i]=$row["idcategory"];
				$result["category_description"][$i]=$row["category_description"];
				$result["subcategory_description"][$i]=$row["subcategory_description"];
				$result["activity_description"][$i]=$row["activity_description"];
				$result["idupload"][$i] = $row["idupload"];
				$result["nameupload"][$i] = $row["nameupload"];
				$result["typeupload"][$i] = $row["typeupload"];
				$result["sizeupload"][$i] = $row["sizeupload"];
				$result["data_upload"][$i] = $row["data_upload"];
				$i++;
			}


			if(isset($result["idcategory"])){
				$result["Count"]=count($result["idcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;
}

function indicator_details($idsubcategory,$idcategory,$idactivity,$action)
{
	$dbh=conx("bdppr","wmaster","igpwmaster");
	$dbh->query("SET NAMES 'utf8'");
	$sql = "SELECT YC_subcat.id_cat_subcat, category.idcategory, years_category.id_years_category, category.category_description,
		      subcategory.subcategory_description,
		      subcategory.subcategory_universo,
		      subcategory.subcategory_lb,
		      activity.idactivity,
		      activity.activity_description,
		      responsable.resp_nombre,
		      activity.activity_universo,
		      activity.activity_lb,
		      unidadmedida.id_um,
		      unidadmedida.um_description,
		      unidadfinanciera.id_uf,
		      UF_indicator.metafisica,
		      indicator.idindicator,
      		  indicator.ind_description,
		      unidadfinanciera.costo_23,
		      unidadfinanciera.costo_26,
		      UF_indicator.id_uf_indicator

		        FROM  UF_indicator, indicator, unidadmedida, unidadfinanciera, YC_subcat, activity, responsable, subcategory, category, years_category
		    	 WHERE (
		    	 	years_category.id_years_category = YC_subcat.id_years_category  and
		            subcategory.idsubcategory = YC_subcat.idsubcategory and
		            YC_subcat.id_cat_subcat = unidadfinanciera.id_cat_subcat and
		            activity.idactivity = unidadfinanciera.idactivity and
		            unidadfinanciera.id_uf=UF_indicator.id_uf and
		            UF_indicator.idindicator=indicator.idindicator and
		            unidadmedida.id_um = indicator.id_um and
		            responsable.idresponsable=activity.idresponsable ";

				if ($idcategory!="999")
				{

					if ($action=="year") {
						$sql.="and years_category.idyear = $idcategory";

					}else{$sql.="and years_category.id_years_category = $idcategory";}

					if ($idsubcategory!="999") {
						//return $ab;
						$sql.=" and subcategory.idsubcategory = $idsubcategory";
						if ($idactivity!="999") {
							//return $abc;
							$sql.=" and activity.idactivity = $idactivity";
						}


					}
					else{
						if ($idactivity!="999") {
							//return $ac;
							$sql.=" and activity.idactivity = $idactivity";
						}
					}
				}
				else{
					if ($idsubcategory!="999") {
						//return $b;
						$sql.="and subcategory.idsubcategory = $idsubcategory";
						if ($idactivity!="999") {
							//return $bc;
							$sql.=" and activity.idactivity = $idactivity";
						}

					}
					else{
						//return $c;
						if ($idactivity!="999") {
							//return $bc;
							$sql.=" and activity.idactivity = $idactivity";
						}

					}

				}
	       $sql.= ") group by id_uf ";




    if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_years_category"][$i]=$row["id_years_category"];
				$result["id_cat_subcat"][$i] = $row["id_cat_subcat"];
				$result["idcategory"][$i] = $row["idcategory"];
				$result["category_description"][$i] = $row["category_description"];
				$result["subcategory_description"][$i] = $row["subcategory_description"];
				$result["resp_nombre"][$i] = $row["resp_nombre"];
				$result["subcategory_universo"][$i] = $row["subcategory_universo"];
				$result["subcategory_lb"][$i] = $row["subcategory_lb"];
				$result["idactivity"][$i] =$row["idactivity"];
				$result["activity_description"][$i] = $row["activity_description"];
				$result["activity_universo"][$i] = $row["activity_universo"];
				$result["activity_lb"][$i] = $row["activity_lb"];
				$result["unidadmedida"][$i] = $row["unidadmedida"];
				$result["idindicator"][$i] = $row["idindicator"];
				$result["ind_description"][$i] = $row["ind_description"];
				$result["id_um"][$i] = $row["id_um"];
				$result["um_description"][$i] = $row["um_description"];
				//$result["metafisica"][$i]=$row["metafisica"];
				$result["id_uf"][$i] = $row["id_uf"];
				$result["costo_23"][$i] = $row["costo_23"];
				$result["total_23"][$i] = $row["total_23"];
				$result["costo_26"][$i] = $row["costo_26"];
				$result["total_26"][$i] = $row["total_26"];
				$result["id_uf_indicator"][$i] = $row["id_uf_indicator"];
				$i++;
			}


			if(isset($result["idcategory"])){
				$result["Count"]=count($result["idcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;
}
	function selectIndicator_uf($id_uf){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "SELECT UF.id_uf, I.idindicator AS I_idindicator, I.ind_description, UF_I.metafisica, UM.um_description
				FROM indicator AS I, unidadfinanciera AS UF, UF_indicator AS UF_I, unidadmedida as UM
				WHERE (UF_I.idindicator = I.idindicator	AND
					UF_I.id_uf = UF.id_uf AND
                                        I.id_um = UM.id_um and
					UF.id_uf =".$id_uf.") ";


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_uf"][$i]= $row["id_uf"];
				$result["I_idindicator"][$i]= $row["I_idindicator"];
				$result["ind_description"][$i]=$row["ind_description"];
				$result["metafisica"][$i]=$row["metafisica"];
				$result["um_description"][$i]=$row["um_description"];
				$i++;
			}


			if(isset($result["id_uf"])){
				$result["Count"]=count($result["id_uf"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;


	}



function subcategory(){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "SELECT * FROM subcategory";


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$result["subcategory_description"][$i]= $row["subcategory_description"];

				$i++;
			}


			if(isset($result["idsubcategory"])){
				$result["Count"]=count($result["idsubcategory"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;

	}

	function selectActivity(){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "SELECT A.idactivity, A.activity_description, R.idresponsable, R.resp_nombre, A.activity_universo, A.activity_lb  FROM activity as A, responsable as R where (A.idresponsable=R.idresponsable)  order by idactivity ";


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idactivity"][$i]= $row["idactivity"];
				$result["activity_description"][$i]= $row["activity_description"];
				$result["idresponsable"][$i]=$row["idresponsable"];
				$result["resp_nombre"][$i]=$row["resp_nombre"];
				$result["activity_universo"][$i]= $row["activity_universo"];
				$result["activity_lb"][$i]= $row["activity_lb"];
				$i++;
			}


			if(isset($result["idactivity"])){
				$result["Count"]=count($result["idactivity"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;


	}

	function selectResponsable(){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		// if ($idresponsable!="") {
		// 	$sql = "SELECT I.idindicator, I.ind_description, U.um_description
		// 	FROM responsable AS R, activity as A
		// 	WHERE R.idresponsable = A.idresponsable";
		// }
		// else {
			$sql = "SELECT * FROM responsable";
		//}


		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idresponsable"][$i]= $row["idresponsable"];
				$result["resp_nombre"][$i]= $row["resp_nombre"];
				$i++;
			}


			if(isset($result["idresponsable"])){
				$result["Count"]=count($result["idresponsable"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;


	}

	function selectindicator_um($action){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		if ($action==2) {
			$sql = "SELECT I.idindicator, I.ind_description, U.id_um, U.um_description
			FROM indicator AS I, unidadmedida AS U
			WHERE I.id_um = U.id_um order by I.idindicator";
			}
		elseif($action==1) {
			$sql = "SELECT * FROM indicator order by idindicator";
			}
		else {
			$sql = "SELECT * FROM unidadmedida order by id_um";
			}

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idindicator"][$i]= $row["idindicator"];
				$result["ind_description"][$i]= $row["ind_description"];
				$result["id_um"][$i]= $row["id_um"];
				$result["um_description"][$i]=$row["um_description"];
				$i++;
			}


			if(isset($result["idindicator"])){
				$result["Count"]=count($result["idindicator"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;

		return $result;


	}

	function insertYearCat($form,$result_last){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO years_category(idyear,idcategory)  VALUES ";
			$cont = count($form["idyears"]);
			for ($i=0; $i <$cont ; $i++) {
				$sql.="('". $form["idyears"][$i]."',";
				$sql.="'".$result_last["idcategory"][0]."')";
				$sql .= ($cont!=($i+1)) ? ',' : ';';



			}

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	//insertar categoria(PPR)
	function insertCategory($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO category(category_description, category_enable) VALUES (";
		$sql.="'". $form["c_description"]."',";
		$sql.="'".$form["c_enable"]."');";


		//$sql="INSERT INTO subcategory( subcategory_description, subcategory_resumen, subcategory_universo, subcategory_um) VALUES ('titulo','resumen',777,'unidad medida')";


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}



	//insertar producto
	function insertProduct($formProduct){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO subcategory( subcategory_description, subcategory_resumen) VALUES (";
		$sql.="'". $formProduct["sc_titulo"]."',";
		$sql.="'".$formProduct["sc_detalle"]."');";


		//$sql="INSERT INTO subcategory( subcategory_description, subcategory_resumen, subcategory_universo, subcategory_um) VALUES ('titulo','resumen',777,'unidad medida')";


		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertYC_subcat($form,$result_last){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO YC_subcat(id_years_category,idsubcategory)  VALUES ";
			$cont = count($form["id_catyears"]);
			for ($i=0; $i <$cont ; $i++) {
				$sql.="('". $form["id_catyears"][$i]."',";
				$sql.="'".$result_last["idsubcategory"][0]."')";
				$sql .= ($cont!=($i+1)) ? ',' : ';';
			}

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertActivity($formActivity){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");


		$sql = "INSERT INTO activity( activity_description, idresponsable, activity_universo, activity_lb) VALUES (";
		$sql.="'". $formActivity["a_titulo"]."',";
		$sql.="'". $formActivity["a_responsable"]."',";
		$sql.="'". $formActivity["a_universo"]."',";
		$sql.="'".$formActivity["a_lineabase"]."');";
		//$result = selectResponsable($formActivity["id responsable"]);

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function insertResponsable($formResponsable){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO responsable(resp_nombre) VALUES (";

		$sql.="'".$formResponsable["resp_nombre"]."');";

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertIndicator($form){

		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");


		$sql = "INSERT INTO indicator( id_um, ind_description) VALUES (";
		$sql.="'". $form["i_UM"]."',";
		$sql.="'". $form["i_name"]."')";
		//$result = selectResponsable($formActivity["id responsable"]);

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function insertUM($formUM){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO unidadmedida(um_description) VALUES (";

		$sql.="'".$formUM["name_um"]."');";

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertCat_Subcat($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO cat_subcat(idcategory,idsubcategory) VALUES (";

		$sql.="'".$form["category_uf"]."',";
		$sql.="'".$form["subcategory_uf"]."');";

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertUF($form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO unidadfinanciera(id_cat_subcat,idactivity,costo_23,costo_26) VALUES (";

		$sql.="".$form["id_cat_subcat"].",";
		$sql.="".$form["activity_uf"].",";
		$sql.="'".$form["costo23_uf"]."',";
		$sql.="'".$form["costo26_uf"]."');";

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insertUpload($Lastinsertuf,$form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO upload(idupload,id_uf,nameupload,typeupload,sizeupload) VALUES (";

		$sql.="'".$form["file_1"]["idupload"]."',";
		$sql.="'".$Lastinsertuf["id_uf"][0]."'";
		$sql.="'".$form["file_1"]["nameupload"]."',";
		$sql.="'".$form["file_1"]["typeupload"]."',";
		$sql.="'".$form["file_1"]["sizeupload"]."');";


		if (move_uploaded_file($temp, "$uploads_dir")) {
	    	echo "<br> archivo subido correctamente";
	  	}

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function insert_UF_Indicator($Lastinsertuf,$form){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "INSERT INTO UF_indicator(id_uf,idindicator,metafisica) VALUES ";
			$cont = count($form["newUF"]);
			for ($i=0; $i < $cont ; $i++) {
				//$mf = "newUF_".$i;
				$sql.="('".$Lastinsertuf["id_uf"][0]."',";
				$sql.="'".$form["newUF"][$i]."',";
				$sql.="'".$form["newMF"][$i]."')";
				$sql .= ($cont!=($i+1)) ? ',' : ';';
			}

		// $sql.="'".$Lastinsertuf["id_uf"][0]."',";
		// $sql.="'".$form["newUF_0"]."',";
		// $sql.="'".$form["uf_metafisica"]."');";

		if($dbh->query($sql)){
			$result["Error"]=0;
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}
	function deleteYearsCategory($idyears,$idcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$resultcat = selectcategory($idcategory);
		if ($resultcat["category_enable"][0]==0) {
			$sql = "DELETE FROM category WHERE (idcategory=".$idcategory." AND category_enable = 0)";
		}
		else{
			$result["Error"]=1;
		}
		if($dbh->query($sql) ){

				$result["Error"]=0;

		}
		else{
			$result["Error"]=1;
		}

		// if(mysql_affected_rows($sql) == 0){
		// 			$result["registro"] = 0;
		// 		 }
		// 		 else {
		// 		 	$result["registro"] = 1;
		// 		 }

		$dbh = null;
		$result["Query"]=$sql;
		return $result;


	}
	function QueryCategoryHistory($idcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "SELECT * FROM category_history WHERE idcat = $idcategory";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id"][$i]= $row["id"];
				$result["idcat"][$i]= $row["idcat"];
				$result["cat"][$i]= $row["cat"];
				$i++;
			if(isset($result["id"])){
				$result["Count"]=count($result["id"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;
			}
		}
		else{
			$result["Error"] = 1;
		}
		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function deleteCategory($idcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		//$resultcat = selectcategory($idcategory);
		// if ($resultcat["category_enable"][0]==0) {
			$sql = "DELETE FROM category WHERE (idcategory=".$idcategory." AND category_enable = 1)";
		// }
		// else{
			//$result["Error"]=1;
		// }
		if($dbh->query($sql) ){

			$resulthistory = QueryCategoryHistory($idcategory);
			if ($resulthistory["Count"]==1) {
				$result["Error"] = 0;
			}
			else{
				$result["Error"] = 1;
			}
			// $result["filas_afectadas"] = mysql_affected_rows($sql);
			// if(mysql_affected_rows($sql) == 0){
			// 	$result["Error"] = 1;
			// }
			// else {
			// 	$result["Error"] = 0;
			// }
		}
		else{
			$result["Error"]=1;
		}


		$dbh = null;
		$result["Query"]=$sql;
		return $result;


	}

	function deleteSubcategory($idsubcategory){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM subcategory WHERE idsubcategory=".$idsubcategory."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;

	}

	function deleteActivity($idactivity){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM activity WHERE idactivity=".$idactivity."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteResponsible($idresponsable){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM responsable WHERE idresponsable=".$idresponsable."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteIndicator($idindicator){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM indicator WHERE idindicator=".$idindicator."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteInd_UF($id_uf_ind){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM UF_indicator WHERE id_uf_indicator=".$id_uf_ind."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteUnidFinanciera($id_uf){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE  FROM unidadfinanciera WHERE id_uf=".$id_uf;

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteCat_Subcat($id_cat_subcat){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM cat_subcat WHERE id_cat_subcat=".$id_cat_subcat;

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}

	function deleteUnidMed($id_um){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");

		$sql = "DELETE FROM unidadmedida WHERE id_um=".$id_um."";

		if($dbh->query($sql) ){
				if(mysql_affected_rows($sql) == 0){
					$result["Error"] = 1;
				}
				else {
					$result["Error"] = 0;
				}
		}
		else{
			$result["Error"]=1;
		}

		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
	function UF_UploadQuery($id_uf=0){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		// $sql = "SELECT *
		// 		   FROM unidadfinanciera as UF, upload as U
		// 		   WHERE (UF.id_uf=U.id_uf
		// 		    and U.id_uf = $id_uf)";
		$sql = "SELECT *
				   FROM unidadfinanciera as UF, upload as U, activity as A
				   WHERE (
				   	A.idactivity = UF.idactivity and
				   	UF.id_uf=U.id_uf and
				    U.id_uf = $id_uf)";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_uf"][$i]= $row["id_uf"];
				$result["idupload"][$i]= $row["idupload"];
				$result["data_upload"][$i]= $row["data_upload"];
				$result["activity_description"][$i]= $row["activity_description"];

				$i++;
			if(isset($result["id_uf"])){
				$result["Count"]=count($result["id_uf"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;
			}
		}
		else{
			$result["Error"] = 1;
		}
		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
	function YCSubcat_ActivityQuery($id_cat_subcat=0){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "SELECT *
				   FROM YC_subcat as YC_SC, activity as A, unidadfinanciera as UF
				   WHERE (A.idactivity = UF.idactivity and
	                     YC_SC.id_cat_subcat = UF.id_cat_subcat
				    and YC_SC.id_cat_subcat = $id_cat_subcat)";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_uf"][$i]= $row["id_uf"];
				$result["id_cat_subcat"][$i]= $row["id_cat_subcat"];
				$result["idactivity"][$i]= $row["idactivity"];
				$result["activity_description"][$i]= $row["activity_description"];

				$i++;
			if(isset($result["id_uf"])){
				$result["Count"]=count($result["id_uf"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;
			}
		}
		else{
			$result["Error"] = 1;
		}
		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
	function YearCat_SubcatQuery($id_year_category=0){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "SELECT *
				   FROM subcategory as SC, years_category as YC, YC_subcat as YC_SC
				   WHERE (SC.idsubcategory = YC_SC.idsubcategory and YC.id_years_category = YC_SC.id_years_category and YC.id_years_category = $id_year_category)";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_cat_subcat"][$i]= $row["id_cat_subcat"];
				$result["id_years_category"][$i]= $row["id_years_category"];
				$result["idsubcategory"][$i]= $row["idsubcategory"];
				$result["subcategory_description"][$i]= $row["subcategory_description"];

				$i++;
			if(isset($result["id_cat_subcat"])){
				$result["Count"]=count($result["id_cat_subcat"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;
			}
		}
		else{
			$result["Error"] = 1;
		}
		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
	function CategoryYearQuery($idyear=0){
		$dbh=conx("bdppr","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "SELECT YC.id_years_category, C.idcategory, C.category_description, C.category_enable, Y.idyear, Y.year_description, Y.year_enable
				   FROM years as Y, category as C, years_category as YC
				   WHERE (Y.idyear = YC.idyear and C.idcategory = YC.idcategory and Y.idyear = $idyear and Y.year_enable=1 )";
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["id_years_category"][$i]= $row["id_years_category"];
				$result["idcategory"][$i]= $row["idcategory"];
				$result["category_description"][$i]= $row["category_description"];
				$result["idyear"][$i]= $row["idyear"];
				$result["year_description"][$i]= $row["year_description"];
				$i++;
			if(isset($result["id_years_category"])){
				$result["Count"]=count($result["id_years_category"]);
			}
			else{
				$result["Count"]=0;
			}

			$result["Error"]=0;
			}
		}
		else{
			$result["Error"] = 1;
		}
		$dbh = null;
		$result["Query"]=$sql;
		return $result;
	}
// SELECT Y.year_description, C.idcategory, C.category_description,
//               SC.subcategory_description,
//               A.idactivity,
//               A.activity_description,
//               U.idupload,
//               U.data_upload,
//               U.id_uf
//                 FROM  years as Y, category as C, years_category as YC, subcategory as SC, YC_subcat as YC_SC, activity as A, unidadfinanciera as UF, indicator as I, UF_indicator as UF_I,  upload as U, unidadmedida as UM
//                 WHERE (
//                     Y.idyear = YC.idyear and
//                     C.idcategory = YC.idcategory and
//                     SC.idsubcategory = YC_SC.idsubcategory and
//                     YC.id_years_category = YC_SC.id_years_category and
//                     A.idactivity = UF.idactivity and
//                     YC_SC.id_cat_subcat = UF.id_cat_subcat and
//                     I.idindicator=UF_I.idindicator and
//                     UF.id_uf=UF_I.id_uf and
//                     UM.id_um = I.id_um and
//                     UF.id_uf=U.id_uf and
//                     Y.idyear = 3 and
//                     C.idcategory = 3 and
//                     SC.idsubcategory = 8 and
//                     A.idactivity = 27
//                     )
?>