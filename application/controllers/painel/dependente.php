<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dependente extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('Dependente_Model', 'DependenteM');
		$this->load->model('TipoDP_Model', 'TipoDPM');
                $this->load->model('Cliente_Model', 'ClienteM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/dependente/adicionar');
		$data['URLLISTAR']		= site_url('painel/dependente');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']           = array();
		$data['BLC_PAGINAS']            = array();
	
		$pagina			= $this->input->get('pagina');
	
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
	
		$res	= $this->DependenteM->get(array(), FALSE, $pagina);
	
		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
						"NOME"		=> $r->nome_dependente,
                                                "NOMECLIENTEX"   => $r->cliente_cod_cliente,
						"NOME_CITY"	=> (empty($r->clientepai))?'-':$r->clientepai,
                                                "NOME_DP"	=> (empty($r->dependenciapai))?'-':$r->dependenciapai,
						"URLEDITAR"	=> site_url('painel/dependente/editar/'.$r->cod_dependente),
						"URLEXCLUIR"=> site_url('painel/dependente/excluir/'.$r->cod_dependente)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
	
		$totalItens		= $this->DependenteM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
	
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
	
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/dependente?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
	
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/dependente?pagina='.$pagina-1);
		}
	
	
	
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
					"LINK"		=> ($indicePg==$pagina)?'active':null,
					"INDICE"	=> $indicePg,
					"URLLINK"	=> site_url('painel/dependente?pagina='.$indicePg)
			);
				
			$indicePg++;
		}
	
		$this->parser->parse('painel/dependente_listar', $data);
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/dependente');
		$data['ACAOFORM']	= site_url('painel/dependente/salvar');
	}
	
	public function adicionar() {
	
		$data							= array();
		$data['ACAO']					= 'Novo';
		$data['BLC_TIPODP']                             = array();
                $data['BLC_CLIENTE']                             = array();
		$data['cod_dependente']				= '';
		$data['nome_dependente']			= '';
                $data['cliente_cod_cliente']			= '';
	
	
		$tipo	= $this->TipoDPM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_TIPODP'][] = array(
					"COD_TIPODP"		=> $t->cod_tipodp,
					"NOME_TIPODP"		=> $t->nome_tipodp,
					"sel_cod_tipodp"		=> null
			);
		}
                
                $tipoc	= $this->ClienteM->get(array(), FALSE, 0, FALSE);
                
                foreach($tipoc as $c){
			$data['BLC_CLIENTE'][] = array(
					"COD_CLIENTE"		=> $c->cod_cliente,
					"NOME_CLIENTE"		=> $c->nome_cliente,
					"sel_cod_cliente"	=> null
			);
		}
	
		$this->setURL($data);
	
		$this->parser->parse('painel/dependente_form', $data);
	}

	public function salvar() {
		$cod_dependente		= $this->input->post('cod_dependente');
		$nome_dependente	= $this->input->post('nome_dependente');
		$cod_tipodp		= $this->input->post('cod_tipodp');
                $cod_cliente            = $this->input->post('cliente_cod_cliente');
                
	
		$erros			= FALSE;
		$mensagem		= null;
	
		if (!$nome_dependente) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome do dependente.\n";
		}
		if (!$cod_tipodp) {
			$erros		= TRUE;
			$mensagem	.= "Informe a tipodp de dependente.\n";
		}
		if (!$erros) {
			$itens	= array(
					"nome_dependente"		=> $nome_dependente,
                                        "cliente_cod_cliente"           => $cod_cliente,
                                        "cod_tipodp"                    => $cod_tipodp
                                
			);
				
				
			if ($cod_dependente) {
				$cod_dependente = $this->DependenteM->update($itens, $cod_dependente);
			} else {
				$cod_dependente = $this->DependenteM->post($itens);
			}
				
			if ($cod_dependente) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/dependente');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
	
				if ($cod_dependente) {
					redirect('painel/dependente/editar/'.$cod_dependente);
				} else {
					redirect('painel/dependente/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_dependente) {
				redirect('painel/dependente/editar/'.$cod_dependente);
			} else {
				redirect('painel/dependente/adicionar');
			}
		}
	}
	
	public function excluir($id) {
		$res = $this->DependenteM->delete($id);
	
		if ($res) {
			$this->session->set_flashdata('sucesso', 'Dependente removido com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'Dependente não pode ser removido.');
		}
	
		redirect('painel/dependente');
	}

	public function editar($id) {		
		$data                                               = array();
		$data['ACAO']                                       = 'Edição';
		$data['BLC_TIPODP']                                 = array();
                $data['BLC_CLIENTE']                                = array();

		//INFORMAÇÕES DO ATRIBUTO
		$res	= $this->DependenteM->get(array("d.cod_dependente" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
	
		//TIPOS DO ATRIBUTO
		$tipo	= $this->TipoDPM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_TIPODP'][] = array(
					"COD_TIPODP"		=> $t->cod_tipodp,
					"NOME_TIPODP"		=> $t->nome_tipodp,
					"sel_cod_tipodp"	=> ($res->cod_tipodp==$t->cod_tipodp)?'selected="selected"':null
			);
		}
	
                
                $tipoc	= $this->ClienteM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipoc as $c){
			$data['BLC_CLIENTE'][] = array(
					"COD_CLIENTE"		=> $c->cod_cliente,
					"NOME_CLIENTE"		=> $c->nome_cliente,
					"sel_cod_cliente"	=> ($res->cliente_cod_cliente==$c->cod_cliente)?'selected="selected"':null
			);
		}
                
                
		$this->setURL($data);
	
		$this->parser->parse('painel/dependente_form', $data);
	}
}