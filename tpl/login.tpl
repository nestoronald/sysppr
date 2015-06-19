<div>
	<div style="float:right; margin-left:100px;" >	
		<p><img src='img/igp-azul-trans.png'></p>
	</div>
	<div id="dialog-form" class="login_ppr" style="text-align:left; width:180px; float:right; margin-right:120px;">

	   	<p class="validateTips"></p>
		<div class="error" style="display:none"></div>
	    <form method="post" name="login_form">
	        <label for="name">Usuario</label>
	        <input class="text ui-widget-content ui-corner-all" id="user" name="user" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()">
	        <label for="password">Contraseña</label>
	        <input class="text ui-widget-content ui-corner-all" value="" id="password" name="password" type="password"  onkeydown="if (event.keyCode == 13) document.getElementById('btnLogin').click()">
	        <hr class="space">
			<input style="float: right; " value="Ingresar" onclick="formhash(this.form, this.form.password);" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="btnLogin" type="button">
	    </form>
	</div>
</div>