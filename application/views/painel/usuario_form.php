<legend>
	Manutenção de Usuários - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar usuários" class="btn"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</div>
</legend>

 

<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="codusuario" id="codusuario"
		value="{codusuario}">
	<div class="control-group">
		<label class="control-label" for="nomeusuario">Nome <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="nomeusuario" name="nomeusuario"  class="form-control"
				value="{nomeusuario}" required="required">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="emailusuario">Email <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="email" id="emailusuario" name="emailusuario"  class="form-control"
				value="{emailusuario}" required="required" placeholder="jane.doe@example.com">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="senhausuario">Senha <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="password" id="senhausuario" name="senhausuario" value="" class="form-control">
		</div>
	</div>
	<br>
	<div class="checkbox">
		<div class="controls">
			<label class="checkbox"> <input type="checkbox" name="ativadousuario"
				id="ativadousuario" value="S"{chk_ativousuario}> Usuário Ativo
			</label>
		</div>
	</div>
	
	<br>
	<br>
	
	
	<div class="well">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
 