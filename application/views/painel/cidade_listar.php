<legend>
Cidades
	<div class="pull-right">
 		<a href="{URLLISTAR}" title="Listar Cidades" class="btn"> <span class="glyphicon glyphicon-list-alt"></span> Listar</a> 
 		<a href="{URLADICIONAR}" title="Adicionar Cidades" class="btn"><span class="glyphicon glyphicon-plus"></span></em> Adicionar</a>
	</div>
</legend>
<table class="table table-bordered table-condensed">
	<tr>
		<th style="width: 25px;" class="coluna-acao text-center"></th>
                <th >Cidade</th>
		<th style="width: 25px;" class="coluna-acao text-center"></th>
	</tr>
	{BLC_DADOS}
	<tr>
		<td class="alinha-centro menos text-center"><a href="{URLEDITAR}" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>{NOME}</td>
		<td class="alinha-centro text-center"><a href="{URLEXCLUIR}" title="Excluir" class="link-excluir"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	{/BLC_DADOS}
	{BLC_SEMDADOS}
	<tr>
		<td colspan="4" class="alinha-centro">Não há dados</td>
	</tr>
	{/BLC_SEMDADOS}
</table>
<div class="pagination pull-right">
	<ul class="pagination">
		<li class="{HABANTERIOR}"><a href="{URLANTERIOR}">&laquo;</a>
		{BLC_PAGINAS}
		<li class="{LINK}"><a href="{URLLINK}">{INDICE}</a>
		{/BLC_PAGINAS}
		<li class="{HABPROX}"><a href="{URLPROXIMO}">&raquo;</a>
	</ul>
</div>