<div id="tabs">
<ul>
<li><a href="#tabs-1">Resumen</a></li>
<li><a href="#tabs-2">Archivos</a></li>
</ul>

    
<div id="tabs-1">    
    <div id="divDataContent">
    
		<div style="text-align:left; padding: 5px 0px 5px 10px;">
            <form name="form{$idppr}" >
            	<input id="hiddenIdPpr" type="hidden" value="{$idppr}" >
				<div class="divtext">
					<table>
					<tr><td><label for="nombrePPR">Nombre del PPR:</label></td>
	                    <td><input name="nombrePPR" class="edit-text" type="text" value={$data.nombre} /></td>
					</tr>
					<tr>
	                    <td><label for="tipo">Tipo del diseño presupuestal:</label></td>		
	                    <td><input name="tipo" class="edit-text" type="text" value={$data.tipo} /></td>
					</tr>
					<tr>
	                    <td><label for="entidad">Entidad Rectora del PP:</label></td>
	                    <td><input name="entidad" class="edit-text" type="text" value={$data.entidad}></td>
					</tr>
					<tr>                    
	                    <td><label for="responsable">Responsable Técnico del PP:</label></td>
	                    <td><input name="responsable" class="edit-text" type="text" value={$data.responsable}></td>
					</tr>
					<tr>                    
	                    <td><label for="coordinador">Coordinador Territorial:</label></td>
	                    <td><input name="coordinador" class="edit-text" type="text" value={$data.coordinador}></td>
					</tr>
					<tr>                    
	                    <td><label for="actividades">Actividades:</label></td>
	                    <td><textarea name="actividades" style="border: 1px solid #CCCCCC; width:350px; height:60px">
	                        {$data.actividades}
	                    </textarea></td>
                    </tr>
					<tr>
	                    <td><label for="productos">Productos:</label></td>
	                    <td><textarea name="productos" style="border: 1px solid #CCCCCC; width:350px; height:60px">
	                        {$data.productos}
	                    </textarea></td>
                    </tr>
                    <tr>
                    	<td><label for="costo">Costo:</label></td>
                    	<td><input name="costo" class="edit-text" type="text" value={$data.costo}></td>
                    </tr>
                    <tr>
                    <tr>
                    	<td colspan="2"><hr></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    	<td><input onclick="xajax_cancelUpdate()"  class="" type="button" value="Cancelar">&nbsp;&nbsp;&nbsp;
                    	<input class="" type="button" value="Actualizar"></td>
                    </tr>                    
                    </table>
                </div>                
            </form>
		</div>
	</div>
</div>
<div id="tabs-2">		
		<div id="divFilesContent">
		<table>
			<tr>
		    	<td><div id="divListFiles" style="text-align:left; font-weight:bold;"></div>
		    	</td>
    			<td style="vertical-align:top">
				    <div style="text-align:left; font-weight:bold; float:right;">
						<form action="upload.php" method="post" enctype="multipart/form-data">
							<input type="file" name="userfile" class="fileUpload" multiple>&nbsp;&nbsp;
							<button id="px-submit" type="submit">Cargar</button>
							<button id="px-clear" type="reset">Borrar</button>
							<input type="hidden" value="{$idppr}" id="idppr" name="idppr">
						</form>
				    </div>
		    	<td>
		    </tr>    
		</table>				
		</div>
</div>    
    
</div>