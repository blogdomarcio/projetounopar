<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plano extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('Plano_Model', 'PlanoM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/plano/adicionar');
		$data['URLLISTAR']		= site_url('painel/plano');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']	= array();
		$data['BLC_PAGINAS']	= array();
		
		$pagina			= $this->input->get('pagina');
		
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
		
		$res	= $this->PlanoM->get(array(), FALSE, $pagina);

		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
					"NOME"		=> $r->nome_plano,
                                        "VALOR"		=> $r->valor_plano,
					"URLEDITAR"	=> site_url('painel/plano/editar/'.$r->cod_plano),
					"URLEXCLUIR"=> site_url('painel/plano/excluir/'.$r->cod_plano)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
		
		$totalItens		= $this->PlanoM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
		
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
		
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/plano?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
		
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/plano?pagina='.$pagina-1);
		}
		
		
		
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
				"LINK"		=> ($indicePg==$pagina)?'active':null,
				"INDICE"	=> $indicePg,
				"URLLINK"	=> site_url('painel/plano?pagina='.$indicePg)
			);
			
			$indicePg++;
		}
		
		$this->parser->parse('painel/plano_listar', $data);
	}
	
	public function adicionar() {
	
		$data						= array();
		$data['ACAO']				= 'Novo';
		$data['cod_plano']			= '';
		$data['nome_plano']                     = '';
                $data['valor_plano']                     = '';
		 
		
		$this->setURL($data);
		
		$this->parser->parse('painel/plano_form', $data);
	}
	
	public function editar($id) {
		$data						= array();
		$data['ACAO']				= 'Edição';
		
		$res	= $this->PlanoM->get(array("cod_plano" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
			
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
		
		$this->setURL($data);
		
		$this->parser->parse('painel/plano_form', $data);
	}
	
	public function salvar() {
		
		$cod_plano		= $this->input->post('cod_plano');
		$nome_plano		= $this->input->post('nome_plano');
                $valor_plano		= $this->input->post('valor_plano');
		
		
		$erros			= FALSE;
		$mensagem		= null;
		
		if (!$nome_plano) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome da Plano\n";
		}
		
		
		if (!$erros) {
			$itens	= array(
				"nome_plano"	=> $nome_plano,
                                "valor_plano"	=> $valor_plano
				 
			);
			
			if ($cod_plano) {
				$cod_plano = $this->PlanoM->update($itens, $cod_plano);
			} else {
				$cod_plano = $this->PlanoM->post($itens);
			}
			
			if ($cod_plano) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/plano');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
				
				if ($cod_plano) {
					redirect('painel/plano/editar/'.$cod_plano);
				} else {
					redirect('painel/plano/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_plano) {
				redirect('painel/plano/editar/'.$cod_plano);
			} else {
				redirect('painel/plano/adicionar');
			}
		}
		
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/plano');
		$data['ACAOFORM']	= site_url('painel/plano/salvar');
	}
	
	public function excluir($id) {
		$res = $this->PlanoM->delete($id);
		
		if ($res) {
			$this->session->set_flashdata('sucesso', 'Plano removida com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'Plano não pode ser removida.');
		}
		
		redirect('painel/plano');
	}
	
}