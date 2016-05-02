<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bairro extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('Bairro_Model', 'BairroM');
		$this->load->model('Cidade_Model', 'CidadeM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/bairro/adicionar');
		$data['URLLISTAR']		= site_url('painel/bairro');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']	= array();
		$data['BLC_PAGINAS']	= array();
	
		$pagina			= $this->input->get('pagina');
	
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
	
		$res	= $this->BairroM->get(array(), FALSE, $pagina);
	
		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
						"NOME"		=> $r->nome_bairro,
						"NOME_CITY"	=> (empty($r->paicidade))?'-':$r->paicidade,
						"URLEDITAR"	=> site_url('painel/bairro/editar/'.$r->cod_bairro),
						"URLEXCLUIR"=> site_url('painel/bairro/excluir/'.$r->cod_bairro)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
	
		$totalItens		= $this->BairroM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
	
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
	
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/bairro?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
	
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/bairro?pagina='.$pagina-1);
		}
	
	
	
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
					"LINK"		=> ($indicePg==$pagina)?'active':null,
					"INDICE"	=> $indicePg,
					"URLLINK"	=> site_url('painel/bairro?pagina='.$indicePg)
			);
				
			$indicePg++;
		}
	
		$this->parser->parse('painel/bairro_listar', $data);
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/bairro');
		$data['ACAOFORM']	= site_url('painel/bairro/salvar');
	}
	
	public function adicionar() {
	
		$data							= array();
		$data['ACAO']					= 'Novo';
		$data['BLC_CIDADE']		= array();
		$data['cod_bairro']				= '';
		$data['nome_bairro']			= '';
	
	
		$tipo	= $this->CidadeM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_CIDADE'][] = array(
					"COD_CIDADE"		=> $t->cod_cidade,
					"NOME_CIDADE"		=> $t->nome_cidade,
					"sel_cod_cidade"		=> null
			);
		}
	
		$this->setURL($data);
	
		$this->parser->parse('painel/bairro_form', $data);
	}

	public function salvar() {
		$cod_bairro		= $this->input->post('cod_bairro');
		$nome_bairro	= $this->input->post('nome_bairro');
		$cod_cidade		= $this->input->post('cod_cidade');
	
		$erros			= FALSE;
		$mensagem		= null;
	
		if (!$nome_bairro) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome do bairro.\n";
		}
		if (!$cod_cidade) {
			$erros		= TRUE;
			$mensagem	.= "Informe a cidade de bairro.\n";
		}
		if (!$erros) {
			$itens	= array(
					"nome_bairro"		=> $nome_bairro,
					"cod_cidade"		=> $cod_cidade	
			);
				
				
			if ($cod_bairro) {
				$cod_bairro = $this->BairroM->update($itens, $cod_bairro);
			} else {
				$cod_bairro = $this->BairroM->post($itens);
			}
				
			if ($cod_bairro) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/bairro');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
	
				if ($cod_bairro) {
					redirect('painel/bairro/editar/'.$cod_bairro);
				} else {
					redirect('painel/bairro/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_bairro) {
				redirect('painel/bairro/editar/'.$cod_bairro);
			} else {
				redirect('painel/bairro/adicionar');
			}
		}
	}
	
	public function excluir($id) {
		$res = $this->BairroM->delete($id);
	
		if ($res) {
			$this->session->set_flashdata('sucesso', 'Bairro removido com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'Bairro não pode ser removido.');
		}
	
		redirect('painel/bairro');
	}

	public function editar($id) {		
		$data							= array();
		$data['ACAO']					= 'Edição';
		$data['BLC_CIDADE']		= array();

		//INFORMAÇÕES DO ATRIBUTO
		$res	= $this->BairroM->get(array("b.cod_bairro" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
	
		//TIPOS DO ATRIBUTO
		$tipo	= $this->CidadeM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_CIDADE'][] = array(
					"COD_CIDADE"		=> $t->cod_cidade,
					"NOME_CIDADE"		=> $t->nome_cidade,
					"sel_cod_cidade"	=> ($res->cod_cidade==$t->cod_cidade)?'selected="selected"':null
			);
		}
	
		$this->setURL($data);
	
		$this->parser->parse('painel/bairro_form', $data);
	}
}