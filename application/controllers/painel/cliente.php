<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->layout	= LAYOUT_DASHBOARD;
		$this->load->model('Cliente_Model', 'ClienteM');
                $this->load->model('Bairro_Model', 'BairroM');
                $this->load->model('Plano_Model', 'PlanoM');
	}
	
	public function index() {
		$data					= array();
		$data['URLADICIONAR']	= site_url('painel/cliente/adicionar');
		$data['URLLISTAR']		= site_url('painel/cliente');
		$data['BLC_DADOS']		= array();
		$data['BLC_SEMDADOS']	= array();
		$data['BLC_PAGINAS']	= array();
               

		
		$pagina			= $this->input->get('pagina');
		
		if (!$pagina) {
			$pagina = 0;
		} else {
			$pagina = ($pagina-1) * LINHAS_PESQUISA_DASHBOARD;
		}
		
		$res	= $this->ClienteM->get(array(), FALSE, $pagina);

		if ($res) {
			foreach($res as $r) {
				$data['BLC_DADOS'][] = array(
					"NOME"		=> $r->nome_cliente,
                                        "EMAIL"		=> $r->email_cliente,
                                        "CPF"		=> $r->cpf_cliente,
                                        "RG"		=> $r->rg_cliente,
                                        "END"		=> $r->end_cliente,
                                        "TEL"		=> $r->tel_cliente,
                                        "CEL"		=> $r->cel_cliente,
                                        "SEXO"		=> $r->sexo_cliente,
                                    //    "PLANO"		=> $r->plano_cod_plano,
                                        "PLANO"	=> (empty($r->tituloplano))?'-':$r->tituloplano,
                                       	"URLEDITAR"	=> site_url('painel/cliente/editar/'.$r->cod_cliente),
					"URLEXCLUIR"=> site_url('painel/cliente/excluir/'.$r->cod_cliente)
				);
			}
		} else {
			$data['BLC_SEMDADOS'][] = array();
		}
		
		$totalItens		= $this->ClienteM->getTotal();
		$totalPaginas	= ceil($totalItens/LINHAS_PESQUISA_DASHBOARD);
		
		$indicePg		= 1;
		$pagina			= ($pagina==0)?1:$pagina;
		
		if ($totalPaginas > $pagina) {
			$data['HABPROX']	= null;
			$data['URLPROXIMO']	= site_url('painel/cliente?pagina='.$pagina+1);
		} else {
			$data['HABPROX']	= 'disabled';
			$data['URLPROXIMO']	= '#';
		}
		
		if ($pagina <= 1) {
			$data['HABANTERIOR']= 'disabled';
			$data['URLANTERIOR']= '#';
		} else {
			$data['HABANTERIOR']= null;
			$data['URLANTERIOR']= site_url('painel/cliente?pagina='.$pagina-1);
		}
		
		
		
		while ($indicePg <= $totalPaginas) {
			$data['BLC_PAGINAS'][] = array(
				"LINK"		=> ($indicePg==$pagina)?'active':null,
				"INDICE"	=> $indicePg,
				"URLLINK"	=> site_url('painel/cliente?pagina='.$indicePg)
			);
			
			$indicePg++;
		}
		
		$this->parser->parse('painel/cliente_listar', $data);
	}
	
	public function adicionar() {
	
		$data				= array();
		$data['ACAO']			= 'Novo';
		$data['cod_cliente']		= '';
		$data['nome_cliente']		= '';
		$data['cpf_cliente']		= '';
		$data['rg_cliente']             = '';
                $data['dtnasc_cliente']         = '';
                $data['sexo_cliente']           = '';
                $data['end_cliente']             = '';
                $data['dtcadastro_cliente']     = '';
                $data['tel_cliente']            = '';
                $data['cel_cliente']            = '';
                $data['email_cliente']          = '';
                $data['estcivil_cliente']       = '';
                $data['situacao_cliente']       = '';
                $data['bairro_cod_bairro']      = '';
                $data['plano_cod_plano']        = '';
                
                
                 $data['BLC_BAIRRO']     = array();
                 $data['BLC_PLANO']     = array();
                 
                 $tipo	= $this->BairroM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_BAIRRO'][] = array(
					"COD_BAIRRO"		=> $t->cod_bairro,
					"NOME_BAIRRO"		=> $t->nome_bairro,
					"sel_cod_bairro"	=> null
			);
		}
                
                 $tipoP	= $this->PlanoM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipoP as $p){
			$data['BLC_PLANO'][] = array(
					"COD_PLANO"		=> $p->cod_plano,
					"NOME_PLANO"		=> $p->nome_plano,
					"sel_cod_plano"	=> null
			);
		}
               		
		$this->setURL($data);
		
		$this->parser->parse('painel/cliente_form', $data);
	}
	
	public function editar($id) {
		$data						= array();
		$data['ACAO']				= 'Edição';
		
		$res	= $this->ClienteM->get(array("cod_cliente" => $id), TRUE);
		
		if ($res) {
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
                                
                                
			}
			
			 
			
		} else {
			show_error('Não foram encontrados dados.', 500, 'Ops, erro encontrado.');
		}
		
                //TIPOS DO ATRIBUTO
		$tipo	= $this->BairroM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $t){
			$data['BLC_BAIRRO'][] = array(
					"COD_BAIRRO"		=> $t->cod_bairro,
					"NOME_BAIRRO"		=> $t->nome_bairro,
                                        "sel_cod_bairro"	=> ($res->bairro_cod_bairro==$t->cod_bairro)?'selected="selected"':null
                                       
                            
                            );
		}
                
                $tipo	= $this->PlanoM->get(array(), FALSE, 0, FALSE);
	
		foreach($tipo as $p){
			$data['BLC_PLANO'][] = array(
					"COD_PLANO"		=> $p->cod_plano,
					"NOME_PLANO"		=> $p->nome_plano,
                                        "sel_cod_plano"	=> ($res->plano_cod_plano==$p->cod_plano)?'selected="selected"':null
                                       
                            
                            );
		}
                
		$this->setURL($data);
		
		$this->parser->parse('painel/cliente_form', $data);
	}
	
	public function salvar() {
		
		$cod_cliente            = $this->input->post('cod_cliente');
		$nome_cliente           = $this->input->post('nome_cliente');
		$cpf_cliente            = $this->input->post('cpf_cliente');
		$rg_cliente             = $this->input->post('rg_cliente');
		$dtnasc_cliente         = $this->input->post('dtnasc_cliente');
                $sexo_cliente           = $this->input->post('sexo_cliente');
                $end_cliente            = $this->input->post('end_cliente');
                $dtcadastro_cliente	= $this->input->post('dtcadastro_cliente');
                $tel_cliente            = $this->input->post('tel_cliente');
                $cel_cliente            = $this->input->post('cel_cliente');
                $email_cliente          = $this->input->post('email_cliente');
                $estcivil_cliente	= $this->input->post('estcivil_cliente');
                $situacao_cliente	= $this->input->post('situacao_cliente');
                $bairro_cod_bairro      = $this->input->post('cod_bairro');
                $plano_cod_plano        = $this->input->post('cod_plano');
             		
		$erros			= FALSE;
		$mensagem		= null;
		
		if (!$nome_cliente) {
			$erros		= TRUE;
			$mensagem	.= "Informe nome do usuário\n";
		}
		if (!$email_cliente) {
			$erros		= TRUE;
			$mensagem	.= "Informe email do usuário\n";
		}
		 
		
		if (!$erros) {
			$itens	= array(
				"nome_cliente"       => $nome_cliente,
				"email_cliente"      => $email_cliente,
                                "bairro_cod_bairro"  => $bairro_cod_bairro,
                                "plano_cod_plano"    => $plano_cod_plano,
                                "cpf_cliente"        => $cpf_cliente,
                                "rg_cliente"         => $rg_cliente,
                                "dtnasc_cliente"     => $dtnasc_cliente,
                                "sexo_cliente"       => $sexo_cliente,
                                "end_cliente"        => $end_cliente,
                                "dtcadastro_cliente" => $dtcadastro_cliente,
                                "tel_cliente"        => $tel_cliente,
                                "cel_cliente"        => $cel_cliente,
                                "estcivil_cliente"   => $estcivil_cliente,
                                "situacao_cliente"   => $situacao_cliente,
				
			);
					
			if ($cod_cliente) {
				$cod_cliente = $this->ClienteM->update($itens, $cod_cliente);
			} else {
				$cod_cliente = $this->ClienteM->post($itens);
			}
			
			if ($cod_cliente) {
				$this->session->set_flashdata('sucesso', 'Dados inseridos com sucesso.');
				redirect('painel/cliente');
			} else {
				$this->session->set_flashdata('erro', 'Ocorreu um erro ao realizar a operação.');
				
				if ($cod_cliente) {
					redirect('painel/cliente/editar/'.$cod_cliente);
				} else {
					redirect('painel/cliente/adicionar');
				}
			}
		} else {
			$this->session->set_flashdata('erro', nl2br($mensagem));
			if ($cod_cliente) {
				redirect('painel/cliente/editar/'.$cod_cliente);
			} else {
				redirect('painel/cliente/adicionar');
			}
		}
		
	}
	
	private function setURL(&$data) {
		$data['URLLISTAR']	= site_url('painel/cliente');
		$data['ACAOFORM']	= site_url('painel/cliente/salvar');
	}
	
	public function excluir($id) {
		$res = $this->ClienteM->delete($id);
		
		if ($res) {
			$this->session->set_flashdata('sucesso', 'Cliente removido com sucesso.');
		} else {
			$this->session->set_flashdata('erro', 'Cliente não pode ser removido.');
		}
		
		redirect('painel/cliente');
	}
	
}