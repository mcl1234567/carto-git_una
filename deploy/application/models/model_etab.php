<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_etab extends CI_Model {

	function lire_etablissements($assoNumero)
	{
		$this->db->distinct()
				->select('*')
				->from('tblEtab')
				->where('tblEtab.assoNumero', $assoNumero)
				->where('tblEtab.etabRetrait !=', 1)
				->where('tblEtab.etabLat !=', 0)
				->where('tblEtab.etabLng !=', 0)
				->order_by('etabNom', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_etablissements_all()
	{
		$this->db->distinct()
				->select('*')
				->from('tblEtab')
				->where('tblEtab.etabRetrait !=', 1)
				->where('tblEtab.etabLat !=', 0)
				->where('tblEtab.etabLng !=', 0);
		$query = $this->db->get();
		return $query;
	}

	function lire_etablissements_activites($etabCodeUnapei, $code)
	{
		$this->db->select('etabCodeUnapei')
				->from('tblEtabActivites')
				->where('etabCodeUnapei', $etabCodeUnapei)
				->like('etabActivite', $code, 'after')
				->limit(1);
		$query = $this->db->get();
		return $query;
	}

	function lire_etablissements_toutes_activites($etabCodeUnapei)
	{
		$this->db->select('etabActivite')
				->from('tblEtabActivites')
				->where('etabCodeUnapei', $etabCodeUnapei)
				->order_by('etabActivite', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_nom_activite($code)
	{
		$this->db->select('libelle')
				->from('tblActivite')
				->where('code', $code);
		$query = $this->db->get();
		return $query;
	}

	function lire_etablissements_code($etabCodeUnapei)
	{
		$this->db->select('*')
				->from('tblEtab')
				->where_in('etabCodeUnapei', $etabCodeUnapei)
				->where('etabRetrait !=', 1)
				->where('tblEtab.etabLat !=', 0)
				->where('tblEtab.etabLng !=', 0)
				->order_by('etabNom', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_etabType($etabType)
	{
		$this->db->select('libelle,description')
				->from('tblEtabType')
				->where('code', $etabType);
		$query = $this->db->get();
		return $query;
	}

	function lire_activites()
	{
		$this->db->select('*')
				->from('tblActiviteCategorie');
		$query = $this->db->get();
		return $query;
	}

}

/* End of file model_etab.php */
/* Location: ./application/models/model_etab.php */

?>
