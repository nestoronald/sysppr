<div id="divproyectos">
{section name=sec1 loop=$data}
    <div class="span-15" style="text-align:left; font-weight:bold;">{$smarty.section.sec1.rownum}. {$data[sec1].nombre}</div>
	<div class="span-15">
		<table>
		<tr>
			<td>Nombre del PPR:</td>
            <td>{$data[sec1].nombre}</td>
         	<td><a href="#" onclick="xajax_pprEdit('{$idppr}');">Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Borrar</a></td>
		</tr>
		<tr>
            <td>Tipo del diseño presupuestal:</td>		
            <td>{$data[sec1].tipo}</td>
            <td>&nbsp;</td>
		</tr>
		<tr>
            <td>Entidad Rectora del PP:</td>
            <td>{$data[sec1].entidad}</td>
            <td>&nbsp;</td>
		</tr>
		<tr>                    
            <td>Responsable Técnico del PP:</td>
            <td>{$data[sec1].responsable}</td>
            <td>&nbsp;</td>
		</tr>
		<tr>                    
             <td>Coordinador Territorial:</td>
             <td>{$data[sec1].coordinador}</td>
             <td>&nbsp;</td>
		</tr>
		<tr>                    
             <td>Actividades:</td>
             <td>{$data[sec1].actividades}</td>
             <td>&nbsp;</td>
            </tr>
		<tr>
          <td>Productos:</td>
          <td>{$data[sec1].productos}</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
         	<td>Costo:</td>
         	<td>{$data[sec1].costo}</td>
         	<td>&nbsp;</td>
		</tr>
        </table>
	</div>
{/section}

</div>
<div id="divedit">

</div>
