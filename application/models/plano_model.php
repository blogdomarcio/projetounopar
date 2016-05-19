<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plano_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('plano');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('cod_plano, nome_plano, valor_plano');
		$this->db->where($condicao);
		$this->db->from('plano');
		
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('plano', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_plano) {
		$this->db->where('cod_plano', $cod_plano, FALSE);
		$res = $this->db->update('plano', $itens);
		if ($res) {
			return $cod_plano;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_plano) {
		$this->db->where('cod_plano', $cod_plano, FALSE);
		return $this->db->delete('plano');
	}
}
