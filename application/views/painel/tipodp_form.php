<legend>
	Manutenção de Usuários - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar TipoDPs" class="btn"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</div>
</legend>

 

<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_tipodp" id="cod_tipodp"
		value="{cod_tipodp}">
	<div class="control-group">
		<label class="control-label" for="nome_tipodp">TipoDP <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="nome_tipodp" name="nome_tipodp"
				value="{nome_tipodp}" required="required" class="form-control">
		</div>
	</div>
	 <br>
	 <br>
		 
	<div class="well">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
 