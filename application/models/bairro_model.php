<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bairro_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('bairro');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('b.cod_bairro, b.nome_bairro, b.cod_cidade');
		$this->db->select('c.nome_cidade as paicidade');
		$this->db->where($condicao);
		$this->db->from('bairro b');
		$this->db->join('cidade c', 'c.cod_cidade = b.cod_cidade', 'LEFT');
		
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('bairro', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_bairro) {
		$this->db->where('cod_bairro', $cod_bairro, FALSE);
		$res = $this->db->update('bairro', $itens);
		if ($res) {
			return $cod_bairro;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_bairro) {
		$this->db->where('cod_bairro', $cod_bairro, FALSE);
		return $this->db->delete('bairro');
	}
}