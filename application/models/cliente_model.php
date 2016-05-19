<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('cliente');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('b.cod_bairro, b.nome_bairro, b.cod_cidade');
                $this->db->select('p.cod_plano, p.nome_plano, p.valor_plano');
                
                $this->db->select('p.nome_plano as tituloplano');
                 
                $this->db->select('c.cod_cliente, c.nome_cliente, c.cpf_cliente, c.rg_cliente, c.dtnasc_cliente, c.sexo_cliente, c.end_cliente, c.dtcadastro_cliente, c.tel_cliente, c.cel_cliente, c.email_cliente, c.estcivil_cliente, c.situacao_cliente, c.bairro_cod_bairro, c.plano_cod_plano');
		$this->db->where($condicao);
                $this->db->from('bairro b');
		$this->db->from('cliente c');
               // $this->db->from('plano p');
                
                $this->db->join('plano p', 'p.cod_plano = c.plano_cod_plano', 'LEFT');
                
		
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('cliente', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_cliente) {
		$this->db->where('cod_cliente', $cod_cliente, FALSE);
		$res = $this->db->update('cliente', $itens);
		if ($res) {
			return $cod_cliente;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_cliente) {
		$this->db->where('cod_cliente', $cod_cliente, FALSE);
		return $this->db->delete('cliente');
	}
}