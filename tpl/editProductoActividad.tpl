
<table>	
	<tr class="cab-act">
		<td>Categoria</td>
		<td><div class="txt-box-600"><input name="categoria" type=text value="{if !is_array($actividad.categoria)}{$actividad.categoria}{/if}"></div></td>
	</tr>
	<tr class="cab-act">
		<td>Producto/Actividad</td>
		<td><div class="txt-box-600"><input name="nombreactividad" type=text value="{if !is_array($actividad.nombreactividad)}{$actividad.nombreactividad}{/if}"></div></td>
	</tr>
	<tr class="cab-act">
		<td>Universo / Linea Base</td>
		<td><div class="txt-box-600"><input name="universo" type=text value="{if !is_array($actividad.universo)}{$actividad.universo}{/if}"></div></td>
	</tr>
	<tr class="cab-act">
		<td>Unidad de medida</td>
		<td><div class="txt-box-600"><input name="unidadmedida" type=text value="{if !is_array($actividad.unidadmedida)}{$actividad.unidadmedida}{/if}"></div></td>
	</tr>

</table>
<table>
	<tr class="prog">
		<td rowspan=2>&nbsp;</td>
		<td rowspan=2>Meta Fisica</td>
		<td colspan=3>Presupuesto</td>

	</tr>
	<tr class="prog">
		<td>C Total</td>
		<td>2,3</td>
		<td>2,6</td>
	</tr>
	<tr class="prog">
		<td><div class="txt-box">Programación<input name="periodo1" type=text value="{if !is_array($actividad.programacion.0.periodo)}{$actividad.programacion.0.periodo}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="metafisica1" value="{if !is_array($actividad.programacion.0.metafisica)}{$actividad.programacion.0.metafisica}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="total1" value="{if !is_array($actividad.programacion.0.presupuesto.total)}{$actividad.programacion.0.presupuesto.total}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial231" value="{if !is_array($actividad.programacion.0.presupuesto.parcial23)}{$actividad.programacion.0.presupuesto.parcial23}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial261" value="{if !is_array($actividad.programacion.0.presupuesto.parcial26)}{$actividad.programacion.0.presupuesto.parcial26}{/if}"></div></td>
	</tr>	
	<tr class="prog">
		<td><div class="txt-box">Programación<input name="periodo2" type=text value="{if !is_array($actividad.programacion.1.periodo)}{$actividad.programacion.1.periodo}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="metafisica2" value="{if !is_array($actividad.programacion.1.metafisica)}{$actividad.programacion.1.metafisica}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="total2" value="{if !is_array($actividad.programacion.1.presupuesto.total)}{$actividad.programacion.1.presupuesto.total}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial232" value="{if !is_array($actividad.programacion.1.presupuesto.parcial23)}{$actividad.programacion.1.presupuesto.parcial23}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial262"value="{if !is_array($actividad.programacion.1.presupuesto.parcial26)}{$actividad.programacion.1.presupuesto.parcial26}{/if}"></div></td>
	</tr>
	<tr class="prog">
		<td><div class="txt-box">Programación<input name="periodo3" type=text value="{if !is_array($actividad.programacion.2.periodo)}{$actividad.programacion.2.periodo}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="metafisica3" value="{if !is_array($actividad.programacion.2.metafisica)}{$actividad.programacion.2.metafisica}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="total3" value="{if !is_array($actividad.programacion.2.presupuesto.total)}{$actividad.programacion.2.presupuesto.total}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial233" value="{if !is_array($actividad.programacion.2.presupuesto.parcial23)}{$actividad.programacion.2.presupuesto.parcial23}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial263"value="{if !is_array($actividad.programacion.2.presupuesto.parcial26)}{$actividad.programacion.2.presupuesto.parcial26}{/if}"></div></td>
	</tr>		
	<tr class="prog">
		<td><div class="txt-box">Programación<input name="periodo4" type=text value="{if !is_array($actividad.programacion.3.periodo)}{$actividad.programacion.3.periodo}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="metafisica4" value="{if !is_array($actividad.programacion.3.metafisica)}{$actividad.programacion.3.metafisica}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="total4" value="{if !is_array($actividad.programacion.3.presupuesto.total)}{$actividad.programacion.3.presupuesto.total}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial234" value="{if !is_array($actividad.programacion.3.presupuesto.parcial23)}{$actividad.programacion.3.presupuesto.parcial23}{/if}"></div></td>
		<td><div class="txt-box"><input type=text name="parcial264" value="{if !is_array($actividad.programacion.3.presupuesto.parcial26)}{$actividad.programacion.3.presupuesto.parcial26}{/if}"></div></td>
	</tr>		
		
</table>
<span style="float:right;"><input type=button value="Actualizar" onclick="xajax_dataUpdate(xajax.getFormValues('formUpdate'))">&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value="Cancelar" onclick="xajax_menuAdmin();"></span>
sfsdfsdfsdf