<div id="tabs">
<ul>
<li><a href="#tab-programas">Programas</a></li>
<li><a href="#tab-productos">Productos</a></li>
<li><a href="#tab-actividades">Actividades</a></li>
<li><a href="#tab-indicadores">Indicadores</a></li>
<li><a href="#tab-unidadfinanciera">Unidad Financiera</a></li>
<a id="preview" href="index.php" title="Click aqui para ver la Vista Pública " target="_blank">&nbsp;&nbsp;Vista Pública</a>
</ul>
<!--Tab Programas-->
<div id="tab-programas" class="tab">
	<div class="divselect">
	<label for="cate_p">Seleccione un Año: </label>
	{$selectyear_prog}
	</div>
	<!-- <a onclick="xajax_Listppr() class=">Actualizar</a> -->
	<table id="tablestructure" class="data">
	<thead>
		<tr>
		    <th id="th1">#</th>
		    <th id="th2" class="column">Nombre</th>
		    <th id="th2" class="column">Año</th>
		    <!-- <th id="th3" class="column">Estado</th> -->
		    <th id="th4" class="column">Accion</th>
		    
		</tr>
	</thead>
	<tbody id="tabsCategory">
		{$htmlcategory}
	<tbody>
	</table>
	<a href="#" id="openCat" class="mas" title="Nuevo PPR" onclick="xajax_NewCategory()">Nuevo</a>
	<!-- <button id="openCat" onclick="xajax_NewCategory()">Nuevo</button> -->
	<div id="divNewCat"></div>	


	<!--edit-->
	<div class="editCat new">
		<div id="updatecat"></div>
	</div>
	<!--fin edit-->

	<!-- eliminar categoria -->
	<div class="divDelCat new">
		
		<div id="deleteCategory"></div>
	</div>
	<div class="divYear"><a href="#" id="openYear_action" class="f-right" onclick="xajax_actionyear()">Año: Activar / Desactivar</a></div>
	<div class="clear"></div>

	
	<div class="editYear new">
		<div id="div_YearAction">
			
		</div>
	</div>

	<!-- <a class="UploadButton" id="UploadButton">UploadFile</a>
	<div id="InfoBox"></div>
	<div id="dem">
			<form id="test" action='ajax-upload.php' target='test'>
			<input type="text" name="nuevo_file" >
			<input type="file" name="file">
			<input type='submit'>
			</form>

			<iframe style='width: 150px; border: 1px solid #000000;' name='test'></iframe>  
	</div> -->

</div>
<!--Tab Productos-->
<div id="tab-productos" class="tab">
	<div class="divselect">
		<label for="cate_p">Seleccione un Año: </label>
		{$selectyear_p}
	</div><br>
	<div id="menuprogramas_p"></div>	
	<table id="tablestructure" class="data">
	<thead>
		<tr>
		    <th id="th1">#</th>
		    <th id="th2" class="column">Nombre</th>
		    <th id="th3" class="type">Resumen</th>		   
		    <th id="th4" class="action">Acción</th>
		</tr>
	</thead>
	<tbody id="tabsProducts">
		{$htmlsubcategory}
	<tbody>
	</table>

	<a href="#" id="openProd" class="mas" title="Nuevo Producto" onclick="xajax_NewProduct()">Nuevo</a>
	<div id="divNuevoProducto">	</div>
	<!-- editar category -->
	<div class="DivEditSubcat new">
		<div id="updatesubcat"></div>
	</div>

	<!-- eliminar subcategoria -->
	<div class="divDelSubcat new">		
		<div id="deleteSubcategory"></div>
	</div>
</div>
<!--Tab Actividades-->
<div id="tab-actividades" class="tab">
	<h2>Actividades</h2>
	<div class="divselect">
		<label for="cate_p">Seleccione un Año: </label>
		{$selectyear_a}
	</div><br>
	<div id="menuprogramas_a"></div>	
	<div id="divmenuSubcategory"></div>
	<table id="tablestructure" class="data">
	<thead>
		<tr>
		    <th id="th1">#</th>
		    <th id="th2" class="column">Nombre</th>
		    <th id="th3" class="column">Responsable</th>
		    <th id="th4" class="column">Universo</th>
		    <th id="th5" class="column">Linea Base</th>
		    <th id="th6" class="action">Acción</th>
		</tr>
	</thead>
	<tbody id="tabsActivitys">
		
	<tbody>
	</table>
	<a href="#" id="openAct" class="mas" onclick="xajax_NewActivity()">Nuevo</a>
	<div id="divNuevoActivity">	</div>

	<!-- update activity -->
	<div class="DivEditAct new">
		<div id="updateact"></div>
	</div>
	<!-- delete activity -->
	<div class="divDelAct new">
		
		<div id="deleteActivity"></div>
	</div>
	<!-- fin delete activity -->
	<div id="responsable">
		<h2 id="respTitle">Responsables</h2>
		<div class="conteResp">
			<table id="tablestructure" class="respTable data">
				<thead>
					<tr>
					    <th id="th1">#</th>
					    <th id="th2" class="column">Nombre</th>				   
					    <th id="th3" class="action">Acción</th>
					</tr>
				</thead>
				<tbody id="tabsResponsibles">
					
				<tbody>
			</table>
			<a href="#newresp" class="mas" onclick="xajax_nuevoresponsable()">Nuevo</a>
			<div id="newresp"></div>
			<!-- update responsabilidad -->
			<div class="DivEditResp new">
				<div id="updateresp"></div>
			</div>
			<!-- delete Responsable -->
			<div class="divDelResp new">				
				<div id="deleteResponsible"></div>
			</div>
		</div>
	</div>
	


</div>
<!--Tab Indicadores-->
<div id="tab-indicadores" class="tab">
	<h2>Indicadores</h2>
	<div class="divselect">
		<label for="cate_p">Seleccione un Año: </label>
		{$selectyear_i}
	</div><br>
	<div id="menuprogramas_i"></div>
	<div id="divmenuSubcategory_i"></div>
	<div id="divmenuData"></div>
	<div id="divactividadproducto"></div>
	<table id="tablestructure" class="data">
	<thead>
		<tr>
		    <th id="th1">#</th>
		    <th id="th2" class="column">Nombre de Indicador</th>
		    <th id="th3" class="column">Unidad de medida</th>
		    <th id="th4" class="action">Acción</th>
		</tr>
	</thead>
	<tbody id="tabsIndicator">
		{$htmlindicator}
	<tbody>
	</table>

	<a href="#" id="openIndicator" class="mas" onclick="xajax_NewIndicator()">Nuevo</a>
	<div id="newIndicator"  class="new">
		<div id="nIndicator"></div>
	</div>
	<div class="DivEditInd new">
			<div id="updateInd"></div>
	</div>

	<div class="divDelInd new">		
		<div id="deleteIndicator"></div>
	</div>

	<div id="unidadmedida">
		<h2 id="UMtitle">Unidad de Medida</h2>
		<div class="contUM">
			<table id="tablestructure" class="data">
				<thead>
					<tr>
					    <th id="th1">#</th>
					    <th id="th2" class="column">Nombre</th>				   
					    <th id="th3" class="action">Acción</th>
					</tr>
				</thead>
				<tbody id="tabsUM">
					
				<tbody>
			</table>
			<a href="#" id="openUM" class="mas" onclick="xajax_NuevoUM()">Nuevo</a>

			<div id="newUM" title="Basic dialog" class="new">		
			</div>
			<!-- update Unidad de Medida -->
			<div class="DivEditUM new">
				<div id="updateUM"></div>
			</div>
			<!-- delete  Unidad de Medida -->
			<div class="divDelUM new">
					<div id="deleteUM"></div>
			</div>
		</div>
	</div>	

</div>
<!--Tab Unidad Financiera-->
<div id="tab-unidadfinanciera" class="tab">
	

	<div class="divselect">
		<label for="cate_p">Seleccione un Año: </label>
		{$selectyear_uf}
	</div><br>
	<div id="menuprogramas_uf"></div>		
	<div id="divmenuSubcategory_uf" class="ddl-menu"></div>
	<div id="divactividadproducto_uf"></div>			  			
	<table id="tablestructure" class="data">
	<thead>
		<tr>
		    <th id="th1">#</th>
		    <th id="th2" class="column">Programa</th>
		    <th id="th3" class="column">Producto</th>
		    <th id="th4" class="action">Actividad</th>
		    <th id="th5" class="action">Indicador</th>
		    <th id="th6" class="action">Meta Física</th>
		    <th id="th7" class="action">23</th>
		    <th id="th8" class="action">26</th>
		    <th id="th9" class="action">Acción</th>
		</tr>
	</thead>
	<tbody id="tabsUF">		
		
	<tbody>
	</table>
	<div class="divnuevo">
		<a href="#"  title="Nueva Unidad Financiera" class="mas openUF" onclick="xajax_NuevoUF()">Nuevo</a>
	</div> 
	<div style="clear:both"></div>

	<div id='newUF' title='Basic dialog' class="new">
		
	</div>
	<div id="newUF_01"></div>
	<div id="result_demo"></div>
	<!-- update Unidad de Medida -->
	<div class="DivEditUF new">
		<div id="updateUF"></div>
	</div>
			<!-- delete  Unidad de Medida -->
	<div class="divDelUF new">
		<div id="deleteUF"></div>
	</div>
</div>
</div>