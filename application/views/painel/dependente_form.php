<legend>
Manutenção de Dependentes - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar Bairros" class="btn">Voltar</a>
	</div>
</legend>
<div class=" text-center">
<form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_bairro" id="cod_bairro" value="{cod_bairro}">
	
	

<div class="input-group">
  <span class="input-group-addon" id="basic-addon3">Digite o Nome<span class="required"> * </span>:</label></span>
  <input type="text" class="form-control" id="nome_dependente"  
  value="{nome_dependente}" name="nome_dependente" aria-describedby="basic-addon3" required="required">
</div>
	
	
	
	<br>
	<br>

	<div class="control-group">
		 
	    <div class="form-control-lg">
	    	<select name="cod_tipodp" id="cod_tipodp" class="required form-control form-control-lg">
	    		<option value="">Selecione o Tipo de Dependencia</option>
	    		{BLC_TIPODP}
	    		<option value="{COD_TIPODP}" {sel_cod_tipodp}> {NOME_TIPODP}</option>
	    		{/BLC_TIPODP}
	    	</select>
	    </div>
	</div>
 
		
	<br>
	<br>
	
        
        <div class="control-group">
		 
	    <div class="form-control-lg">
	    	<select name="cliente_cod_cliente" id="cliente_cod_cliente" class="required form-control form-control-lg">
	    		<option value="">Selecione o Resposável (CLIENTE) </option>
	    		{BLC_CLIENTE}
	    		<option value="{COD_CLIENTE}" {sel_cod_cliente}> {NOME_CLIENTE}</option>
	    		{/BLC_CLIENTE}
	    	</select>
	    </div>
	</div>
        
	
  	<div class="well well-lg text-center">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form>
</div>