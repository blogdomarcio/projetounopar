  <legend>
	Manutenção de Clientes - {ACAO}
	<div class="pull-right">
		<a href="{URLLISTAR}" title="Listar Clientes" class="btn"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</div>
</legend>
    
    <p>
    
    <form action="{ACAOFORM}" method="post" class="form-horizontal">
	<input type="hidden" name="cod_cliente" id="cod_cliente"
		value="{cod_cliente}">
	<div class="control-group">
		<label class="control-label" for="nome_cliente">Nome <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="nome_cliente" name="nome_cliente"  class="form-control"
				value="{nome_cliente}" required="required">
		</div>
	</div>
        
        <div class="control-group">
		<label class="control-label" for="email_cliente">Email <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="email" id="email_cliente" name="email_cliente"  class="form-control"
				value="{email_cliente}" required="required" placeholder="jane.doe@example.com">
		</div>
	</div>
        
     
 
         
<br>

 
        
        <div class="control-group">
		<label class="control-label" for="cpf_cliente">CPF <span
			class="required">*</span>:
		</label>
		 
			<input type="text" id="cpf_cliente" name="cpf_cliente"  class="form-control"
                               value="{cpf_cliente}" required="required">
		 
		<label class="control-label" for="rg_cliente"> RG <span
			class="required">*</span>:
		</label>
		 
			<input type="text" id="rg_cliente" name="rg_cliente"  class="form-control"
				value="{rg_cliente}" required="required">
		 
                 
		<label class="control-label" for="dtnasc_cliente"> Data Nascimento <span
			class="required">*</span>:
		</label>
		
                    <input type="date" id="dtnasc_cliente" name="dtnasc_cliente"  class="form-control"
				value="{dtnasc_cliente}" required="required">       
                   
       
	</div>
          
 
	
        
        <div class="control-group">
		<label class="control-label" for="end_cliente">Endereço <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="end_cliente" name="end_cliente"  class="form-control"
				value="{end_cliente}" required="required" placeholder="Rua x, Numero xx">
		</div>
	</div>
        
        <label class="control-label" for="cod_bairro">Bairro <span
			class="required">*</span>: </label>
            <div class="form-control-lg">
	    	<select name="cod_bairro" id="cod_bairro" class="required form-control form-control-lg">
	    		<option value="">Selecione o Bairro</option>
	    		{BLC_BAIRRO}
	    		<option value="{COD_BAIRRO}" {sel_cod_bairro}>{NOME_BAIRRO}</option>
	    		{/BLC_BAIRRO}
	    	</select>   
		</div>
	        
        
        
        <div class="control-group">
		<label class="control-label" for="tel_cliente">Telefone <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="tel_cliente" name="tel_cliente"  class="form-control"
				value="{tel_cliente}" required="required" placeholder="XX-XXXX-XXXX">
		</div>
	</div>
        
           
        <div class="control-group">
		<label class="control-label" for="cel_cliente">Celular <span
			class="required">*</span>:
		</label>
		<div class="controls">
			<input type="text" id="cel_cliente" name="cel_cliente"  class="form-control"
				value="{cel_cliente}" required="required" placeholder="XX-X-XXXX-XXXX">
		</div>
	</div>
        
        
        
        
        
        
	<div class="checkbox">
		<div class="controls">
			<label class="checkbox"> <input type="checkbox" name="sexo_cliente"
				id="sexo_cliente" value="M"{chk_ativousuario}> MASCULINO
			</label>
		</div>
            
             <div class="controls">
			<label class="checkbox"> <input type="checkbox" name="sexo_cliente"
				id="sexo_cliente" value="F"{chk_ativousuario}> FEMININO
			</label>
		</div>
	</div>
	
	<br>
        
        <hr>
        
          <label class="control-label" for="cod_plano">Selecione o Plano <span
			class="required">*</span>: </label>
            <div class="form-control-lg">
	    	<select name="cod_plano" id="cod_plano" class="required form-control form-control-lg">
	    		<option value="">Selecione o Plano</option>
	    		{BLC_PLANO}
	    		<option value="{COD_PLANO}" {sel_cod_plano}>{NOME_PLANO}</option>
	    		{/BLC_PLANO}
	    	</select>   
		</div>
	
        <br>
        <br>
        
	<div class="well">
		<button type="submit" class="btn">Salvar</button>
	</div>
</form></p>
  </div>
    
   





 