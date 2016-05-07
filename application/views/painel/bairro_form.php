<legend>
Manutenção de Bairros - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar Bairros" class="btn">Voltar</a>
	</div>
</legend>
<div class=" text-center">
<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_bairro" id="cod_bairro" value="{cod_bairro}">
	
	

<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">Digite o Bairro<span class="required"> * </span>:</label></span>
  <input type="text" class="form-control" id="nome_bairro"  
  value="{nome_bairro}" name="nome_bairro" aria-describedby="basic-addon3" required="required">
</div>
	
	
	
	<br>
	<br>

	<div class="control-group">
		 
	    <div class="form-control-lg">
	    	<select name="cod_cidade" id="cod_cidade" class="required form-control form-control-lg">
	    		<option value="">Selecione a Cidade</option>
	    		{BLC_CIDADE}
	    		<option value="{COD_CIDADE}" {sel_cod_cidade}>{NOME_CIDADE}</option>
	    		{/BLC_CIDADE}
	    	</select>
	    </div>
	</div>
 
		
	<br>
	<br>
	
	
  	<div class="well well-lg text-center">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
</div>