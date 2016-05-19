<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dependente_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('dependente');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('d.cod_dependente, d.nome_dependente, d.cliente_cod_cliente, d.cod_tipodp');
		$this->db->select('c.nome_cliente as clientepai');
                
                $this->db->select('t.nome_tipodp as dependenciapai');
                
		$this->db->where($condicao);
		$this->db->from('dependente d');
              //  $this->db->from('cliente c');
		$this->db->join('tipo_dp t', 't.cod_tipodp = d.cod_tipodp', 'LEFT');
                $this->db->join('cliente c', 'c.cod_cliente = d.cliente_cod_cliente', 'LEFT');
               
                 
               
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('dependente', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_dependente) {
		$this->db->where('cod_dependente', $cod_dependente, FALSE);
		$res = $this->db->update('dependente', $itens);
		if ($res) {
			return $cod_dependente;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_dependente) {
		$this->db->where('cod_dependente', $cod_dependente, FALSE);
		return $this->db->delete('dependente');
	}
}