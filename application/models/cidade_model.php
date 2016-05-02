<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidade_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('cidade');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('cod_cidade, nome_cidade');
		$this->db->where($condicao);
		$this->db->from('cidade');
		
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('cidade', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_cidade) {
		$this->db->where('cod_cidade', $cod_cidade, FALSE);
		$res = $this->db->update('cidade', $itens);
		if ($res) {
			return $cod_cidade;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_cidade) {
		$this->db->where('cod_cidade', $cod_cidade, FALSE);
		return $this->db->delete('cidade');
	}
}