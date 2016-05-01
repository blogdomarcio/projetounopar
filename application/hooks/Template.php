<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	public function init() {
		$CI		= &get_instance();
		
		$output = $CI->output->get_output();
        
        if (isset($CI->layout)) {
			
			if ($CI->layout) {
				
				if($CI->layout == LAYOUT_DASHBOARD) {
					$erroDash	= $CI->session->flashdata('erro');
					$sucessoDash= $CI->session->flashdata('sucesso');
				}
				
				if (!preg_match('/(.+).php$/', $CI->layout)) {
					$CI->layout .= '.php';
				}
				
				$template = APPPATH . 'templates/'.$CI->layout;
				
				if (file_exists($template)){
					$layout = $CI->load->file($template, TRUE);
				} else {
					die('Template inv�lida.');
				}
				
				$html	= str_replace("{CONTEUDO}", $output, $layout);
				
				if ($erroDash) {
					$erroDash = $this->criaAlerta($erroDash, 'alert-error', 'Ops');
					$html	= str_replace("{MENSAGEM_SISTEMA_ERRO}", $erroDash, $html);
				} else {
					$html	= str_replace("{MENSAGEM_SISTEMA_ERRO}", null, $html);
				}
				
				if ($sucessoDash) {
					$sucessoDash = $this->criaAlerta($sucessoDash, 'alert-success', 'OK');
					$html	= str_replace("{MENSAGEM_SISTEMA_SUCESSO}", $sucessoDash, $html);
				} else {
					$html	= str_replace("{MENSAGEM_SISTEMA_SUCESSO}", null, $html);
				}
			} else {
				$html = $output;
			}
		} else {
			$html = $output;
		}
		
		$CI->output->_display($html);
	}
	
	private function criaAlerta($mensagem, $tipo, $titulo) {
		$html	= "<div class=\"alert {$tipo}\">\n";
		$html	.="\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n";
		$html	.="\t<strong>{$titulo}!</strong> {$mensagem}\n";
		$html	.="</div>";
		return $html;
	}
}