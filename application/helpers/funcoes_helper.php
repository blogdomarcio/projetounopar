<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('setURL')) {
	function setURL(&$data, $controller) {
		$data['URLLISTAR']	= site_url("painel/{$controller}");
		$data['ACAOFORM']	= site_url("painel/{$controller}/salvar");
	}
}

if (!function_exists('modificaDinheiroBanco')) {
	
	/**
	 * Modifica o valor de moeda para de banco de dados
	 * @param string $valor
	 * @return numeric
	 */
	function modificaDinheiroBanco($valor) {
		$valor = str_replace('.', null, $valor);
		$valor = str_replace(',', '.', $valor);
		return $valor;
	}
}