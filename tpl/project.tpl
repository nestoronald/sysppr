<table>	
	
	<tr class="prog">
		<th>
			Categoria	
		</th>
		<th>
			Actividad /producto	
		</th>
		<th>
			Universo / Linea Base	
		</th>
		<th>
			Unidad de medida
		</th>
	</tr>
	<tr class="prog">
		<td>&nbsp;{$actividad.categoria}</td>
		<td>&nbsp;{if !is_array($actividad.nombreactividad)} {$actividad.nombreactividad} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.universo)} {$actividad.universo} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.unidadmedida)} {$actividad.unidadmedida} {/if}</td>
	</tr>	
</table>
<table>
	<tr class="prog">
		<td rowspan=2>Programacion</td>
		<td rowspan=2>Meta Fisica</td>
		<td colspan=3>Presupuesto</td>

	</tr>
	<tr class="prog">
		<td>C Total</td>
		<td>2,3</td>
		<td>2,6</td>
	</tr>
	<tr class="prog">
		<td> {if !is_array($actividad.programacion.0.periodo)}{$actividad.programacion.0.periodo}{/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.0.metafisica)}{$actividad.programacion.0.metafisica}{/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.0.presupuesto.total)} {$actividad.programacion.0.presupuesto.total} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.0.presupuesto.parcial23)} {$actividad.programacion.0.presupuesto.parcial23} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.0.presupuesto.parcial26)} {$actividad.programacion.0.presupuesto.parcial26} {/if}</td>
	</tr>	
	<tr class="prog">
		<td> {if !is_array($actividad.programacion.1.periodo)}{$actividad.programacion.1.periodo}{/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.1.metafisica)} {$actividad.programacion.1.metafisica} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.1.presupuesto.total)} {$actividad.programacion.1.presupuesto.total} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.1.presupuesto.parcial23)} {$actividad.programacion.1.presupuesto.parcial23} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.1.presupuesto.parcial26)} {$actividad.programacion.1.presupuesto.parcial26} {/if}</td>
	</tr>
	<tr class="prog">
		<td>{if !is_array($actividad.programacion.2.periodo)}{$actividad.programacion.2.periodo}{/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.2.metafisica)} {$actividad.programacion.2.metafisica} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.2.presupuesto.total)} {$actividad.programacion.2.presupuesto.total} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.2.presupuesto.parcial23)} {$actividad.programacion.2.presupuesto.parcial23} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.2.presupuesto.parcial26)} {$actividad.programacion.2.presupuesto.parcial26} {/if}</td>
	</tr>
	{if !is_array($actividad.programacion.3.periodo)}
	<tr class="prog">
		<td>{$actividad.programacion.3.periodo}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.3.metafisica)} {$actividad.programacion.3.metafisica} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.3.presupuesto.total)} {$actividad.programacion.3.presupuesto.total} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.3.presupuesto.parcial23)} {$actividad.programacion.3.presupuesto.parcial23} {/if}</td>
		<td>&nbsp;{if !is_array($actividad.programacion.3.presupuesto.parcial26)} {$actividad.programacion.3.presupuesto.parcial26} {/if}</td>
	</tr>
	{/if}
			
</table>
<p>&nbsp;</p>



<div class="demo"></div>