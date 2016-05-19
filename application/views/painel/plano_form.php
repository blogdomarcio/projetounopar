<legend>
	Manutenção de Usuários - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar Planos" class="btn"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</div>
</legend>

 

<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_plano" id="cod_plano"
		value="{cod_plano}">
	<div class="control-group">
		<label class="control-label" for="nome_plano">Plano <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="nome_plano" name="nome_plano"
				value="{nome_plano}" required="required" class="form-control">
		</div>
	</div>
	 <br>
         <div class="control-group">
		<label class="control-label" for="valor_plano">Valor <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="valor_plano" name="valor_plano"
				value="{valor_plano}" required="required" class="form-control">
		</div>
	</div>
	 <br>
		 
	<div class="well">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
 