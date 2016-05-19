<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoDP_Model extends CI_Model {
	
	public function getTotal($condicao = array()) {
		$this->db->where($condicao);
		$this->db->from('tipo_dp');
		return $this->db->count_all_results();
	}
	
	public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0) {
		$this->db->select('cod_tipodp, nome_tipodp');
		$this->db->where($condicao);
		$this->db->from('tipo_dp');
		
		if ($primeiraLinha) {
			return $this->db->get()->first_row();
		} else {
			$this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina);
			return $this->db->get()->result();
		}
	}
	
	public function post($itens) {
		$res = $this->db->insert('tipo_dp', $itens);
		if ($res) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	public function update($itens, $cod_tipodp) {
		$this->db->where('cod_tipodp', $cod_tipodp, FALSE);
		$res = $this->db->update('tipo_dp', $itens);
		if ($res) {
			return $cod_tipodp;
		} else {
			return FALSE;
		}
	}
	
	public function delete($cod_tipodp) {
		$this->db->where('cod_tipodp', $cod_tipodp, FALSE);
		return $this->db->delete('tipo_dp');
	}
}
