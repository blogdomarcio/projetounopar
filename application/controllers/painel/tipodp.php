<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoDP extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('TipoDP_Model', 'TipoDPM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/tipodp/adicionar');
		$data['URLLISTAR']		= site_url('painel/tipodp');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']	= array();
		$data['BLC_PAGINAS']	= array();
		
		$pagina			= $this->input->get('pagina');
		
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
		
		$res	= $this->TipoDPM->get(array(), FALSE, $pagina);

		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
					"NOME"		=> $r->nome_tipodp,
					"URLEDITAR"	=> site_url('painel/tipodp/editar/'.$r->cod_tipodp),
					"URLEXCLUIR"=> site_url('painel/tipodp/excluir/'.$r->cod_tipodp)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
		
		$totalItens		= $this->TipoDPM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
		
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
		
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/tipodp?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
		
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/tipodp?pagina='.$pagina-1);
		}
		
		
		
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
				"LINK"		=> ($indicePg==$pagina)?'active':null,
				"INDICE"	=> $indicePg,
				"URLLINK"	=> site_url('painel/tipodp?pagina='.$indicePg)
			);
			
			$indicePg++;
		}
		
		$this->parser->parse('painel/tipodp_listar', $data);
	}
	
	public function adicionar() {
	
		$data						= array();
		$data['ACAO']				= 'Novo';
		$data['cod_tipodp']			= '';
		$data['nome_tipodp']		= '';
		 
		
		$this->setURL($data);
		
		$this->parser->parse('painel/tipodp_form', $data);
	}
	
	public function editar($id) {
		$data						= array();
		$data['ACAO']				= 'Edição';
		
		$res	= $this->TipoDPM->get(array("cod_tipodp" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
			
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
		
		$this->setURL($data);
		
		$this->parser->parse('painel/tipodp_form', $data);
	}
	
	public function salvar() {
		
		$cod_tipodp		= $this->input->post('cod_tipodp');
		$nome_tipodp		= $this->input->post('nome_tipodp');
		
		
		$erros			= FALSE;
		$mensagem		= null;
		
		if (!$nome_tipodp) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome do Tipo de Dependência\n";
		}
		
		
		if (!$erros) {
			$itens	= array(
				"nome_tipodp"	=> $nome_tipodp,
				 
			);
			
			if ($cod_tipodp) {
				$cod_tipodp = $this->TipoDPM->update($itens, $cod_tipodp);
			} else {
				$cod_tipodp = $this->TipoDPM->post($itens);
			}
			
			if ($cod_tipodp) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/tipodp');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
				
				if ($cod_tipodp) {
					redirect('painel/tipodp/editar/'.$cod_tipodp);
				} else {
					redirect('painel/tipodp/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_tipodp) {
				redirect('painel/tipodp/editar/'.$cod_tipodp);
			} else {
				redirect('painel/tipodp/adicionar');
			}
		}
		
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/tipodp');
		$data['ACAOFORM']	= site_url('painel/tipodp/salvar');
	}
	
	public function excluir($id) {
		$res = $this->TipoDPM->delete($id);
		
		if ($res) {
			$this->session->set_flashdata('sucesso', 'TipoDP removida com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'TipoDP não pode ser removida.');
		}
		
		redirect('painel/tipodp');
	}
	
}