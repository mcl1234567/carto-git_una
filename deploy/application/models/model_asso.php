<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_asso extends CI_Model {

	function lire_asso_all()
	{
		$this->db->select('*')
				->from('tblAsso')
				->where('assoRetrait !=', 1);
		$query = $this->db->get();
		return $query;
	}

	function lire_region($region)
	{
		$this->db->select('*')
				->from('tblAsso')
				->from('listeLocalisation')
				->where('tblAsso.assoRetrait !=', 1)
				->where('listeLocalisation.codeRegion =', $region)
				->where('listeLocalisation.codeDepartement = tblAsso.assoPrefixCP')
				->order_by('assoNumero', 'asc')
				->order_by('tblAsso.assoNom', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_departement($departement)
	{
		$this->db->select('*')
				->from('tblAsso')
				->from('listeLocalisation')
				->where('tblAsso.assoRetrait !=', 1)
				->where('tblAsso.assoPrefixCP =', $departement)
				->order_by('assoNumero', 'asc')
				->order_by('tblAsso.assoNom', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_assotype($assotype)
	{
		$this->db->select('*')
				->from('tblAssoType')
				->where('code', $assotype);
		$query = $this->db->get();
		return $query;
	}
}

/* End of file model_asso.php */
/* Location: ./application/models/model_asso.php */

?>
