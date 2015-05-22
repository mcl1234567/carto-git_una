<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_form extends CI_Model {

	function form_region()
	{
		$this->db->select('codeRegion, nomRegion')
				->distinct('codeRegion')
				->from('listeLocalisation')
				->order_by('nomRegion', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_region($codeRegion)
	{
		$this->db->select('nomRegion')
				->from('listeLocalisation')
				->where('codeRegion', $codeRegion);
		$query = $this->db->get();
		return $query;
	}

	function form_departement()
	{
		$this->db->select('codeDepartement, nomDepartement')
				->from('listeLocalisation')
				->order_by('nomDepartement', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_departement($codeDepartement)
	{
		$this->db->select('nomDepartement')
				->from('listeLocalisation')
				->where('codeDepartement', $codeDepartement);
		$query = $this->db->get();
		return $query;
	}

	function form_typeAsso()
	{
		// Les codes 3,4,6,8 et 9 correspondent au libellé "association"
		$liste_codes = array('098','099','1','2','3','5','7');
		$this->db->select('*')
				->from('tblAssoType')
				->where_in('code', $liste_codes)
				->order_by('num_ordre', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_typeAsso($code)
	{
		$this->db->select('*')
				->from('tblAssoType')
				->where('code', $code);
		$query = $this->db->get();
		return $query;
	}

	function form_typeEtab()
	{
		$this->db->select('*')
				->from('tblEtabType')
				->where('actif', 1)
				//->join('tblFinessEtabCategorie','tblEtabType.id = tblFinessEtabCategorie.id','left')
				->order_by('libelle', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_typeEtab($code)
	{
		$this->db->select('*')
				->from('tblEtabType')
				->where('actif', 1)
				->where('code', $code);
		$query = $this->db->get();
		return $query;
	}

	function form_typeActivite()
	{
		$this->db->select('*')
				->from('tblActiviteCategorie')
				->order_by('libelle', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function lire_typeActivite($code)
	{
		$this->db->select('*')
				->from('tblActiviteCategorie')
				->where('code', $code);
		$query = $this->db->get();
		return $query;
	}

	function form_typeGroupe()
	{
		$this->db->select('*')
				->from('tblEtabTypeGroupe')
				->order_by('libelle', 'asc');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file model_form.php */
/* Location: ./application/models/model_form.php */

?>
