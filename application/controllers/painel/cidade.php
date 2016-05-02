<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidade extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('Cidade_Model', 'CidadeM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/cidade/adicionar');
		$data['URLLISTAR']		= site_url('painel/cidade');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']	= array();
		$data['BLC_PAGINAS']	= array();
		
		$pagina			= $this->input->get('pagina');
		
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
		
		$res	= $this->CidadeM->get(array(), FALSE, $pagina);

		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
					"NOME"		=> $r->nome_cidade,
					"URLEDITAR"	=> site_url('painel/cidade/editar/'.$r->cod_cidade),
					"URLEXCLUIR"=> site_url('painel/cidade/excluir/'.$r->cod_cidade)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
		
		$totalItens		= $this->CidadeM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
		
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
		
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/cidade?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
		
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/cidade?pagina='.$pagina-1);
		}
		
		
		
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
				"LINK"		=> ($indicePg==$pagina)?'active':null,
				"INDICE"	=> $indicePg,
				"URLLINK"	=> site_url('painel/cidade?pagina='.$indicePg)
			);
			
			$indicePg++;
		}
		
		$this->parser->parse('painel/cidade_listar', $data);
	}
	
	public function adicionar() {
	
		$data						= array();
		$data['ACAO']				= 'Novo';
		$data['cod_cidade']			= '';
		$data['nome_cidade']		= '';
		 
		
		$this->setURL($data);
		
		$this->parser->parse('painel/cidade_form', $data);
	}
	
	public function editar($id) {
		$data						= array();
		$data['ACAO']				= 'Edição';
		
		$res	= $this->CidadeM->get(array("cod_cidade" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
			
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
		
		$this->setURL($data);
		
		$this->parser->parse('painel/cidade_form', $data);
	}
	
	public function salvar() {
		
		$cod_cidade		= $this->input->post('cod_cidade');
		$nome_cidade		= $this->input->post('nome_cidade');
		
		
		$erros			= FALSE;
		$mensagem		= null;
		
		if (!$nome_cidade) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome da Cidade\n";
		}
		
		
		if (!$erros) {
			$itens	= array(
				"nome_cidade"	=> $nome_cidade,
				 
			);
			
			if ($cod_cidade) {
				$cod_cidade = $this->CidadeM->update($itens, $cod_cidade);
			} else {
				$cod_cidade = $this->CidadeM->post($itens);
			}
			
			if ($cod_cidade) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/cidade');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
				
				if ($cod_cidade) {
					redirect('painel/cidade/editar/'.$cod_cidade);
				} else {
					redirect('painel/cidade/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_cidade) {
				redirect('painel/cidade/editar/'.$cod_cidade);
			} else {
				redirect('painel/cidade/adicionar');
			}
		}
		
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/cidade');
		$data['ACAOFORM']	= site_url('painel/cidade/salvar');
	}
	
	public function excluir($id) {
		$res = $this->CidadeM->delete($id);
		
		if ($res) {
			$this->session->set_flashdata('sucesso', 'Cidade removida com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'Cidade não pode ser removida.');
		}
		
		redirect('painel/cidade');
	}
	
}