<legend>
	Manutenção de Usuários - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar Cidades" class="btn"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</div>
</legend>

 

<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_cidade" id="cod_cidade"
		value="{cod_cidade}">
	<div class="control-group">
		<label class="control-label" for="nome_cidade">Cidade <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="nome_cidade" name="nome_cidade"
				value="{nome_cidade}" required="required" class="form-control">
		</div>
	</div>
	 <br>
	 <br>
		 
	<div class="well">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
 