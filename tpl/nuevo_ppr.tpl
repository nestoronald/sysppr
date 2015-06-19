

	Ingrese Nuevo PPR <input name="ppr" id="idppr" type="text"><br>

	<fieldset>
	<legend>Asignar Producto</legend>
			
		<!-- <select name="subcategory" id="subcategory" onclick="xajax_nuevoProduct(this.value)">
			<option value="1">zonas geográficas con gestión de información sísmica.</option>
			<option value="2">zonas costeras monitoreadas y alertadas ante peligro de tsunami</option>
			<option value="3">zonas costeras monitoreadas y alertadas ante peligro de tsunami</option>
			<option value="999">Nuevo producto</option>
		</select> -->
		<div class="producto" id="producto">
			<div id="nproducto">{$product}</div> 
			<a href="#" id="openProd" onclick="xajax_NewProduct()">(+) Nuevo producto</a>
			<!-- <a href="#"  onclick="xajax_select_activity()"> demo</a> -->
		</div>
		

		<div id="divNuevoProducto">
			
		</div>

	</fieldset>

	<fieldset>
		<legend>Actividades</legend>

		<div id="selectactivity">{$activity}</div>
		

	</fieldset>

	
	<div id="nuevo_UF">
		<form action="" id="formUF">
		<table>
			<tbody>
				<tr class="prog title">
					<td rowspan="2">Producto</td>
					<td rowspan="2">Meta Fisica</td>
					<td colspan="3">Presupuesto</td>
				</tr>
				<tr class="prog title">			
					<td>2,3</td>
					<td>2,6</td>
					
				</tr>
				<tr class="prog">
					<td id="Nprod">Nombre  de producto </td>
					<td class="Nmetafisica"><input type="text" name="Nmetafisica"></td>
					<td class="Ncosto_23"> </td>
					<td class="Ncosto_26"> </td>					
				</tr>
					
			
			</tbody>
			<tbody id="acti">
				<tr>
					<td id="div0">Actividades</td><td id="div1"></td><td></td>
				</tr>
				
			</tbody>
		</table>
		<input type="button" value="Guardar">
		<input type="button" value="Cancelar">
		</form>
	</div>

