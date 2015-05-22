<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_departement extends CI_Model {

	function lire_departement($departement)
	{
		if(preg_match('/^[0-9]*$/', $departement))
		{
			$assoPrefixCP = $departement[0].$departement[1];
			$this->db->distinct('*')
					->from('tblAsso')
					->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left')
					->where('assoPrefixCP', $assoPrefixCP)
					->where('assoRetrait !=', 1)
				    ->where('assoLat !=', 0)
				    ->where('assoLng !=', 0)
					->order_by('tblAssoType.num_ordre', 'asc')
					->order_by('assoNom', 'asc');
			$query = $this->db->get();
			return $query;
		}
		else
		{
			$this->db->distinct('*')
					->from('listeLocalisation')
					->where('nomDepartement', $departement)
					->join('tblAsso','assoPrefixCP = codeDepartement')
					->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left')
					->where('assoRetrait !=', 1)
					->where('assoLat !=', 0)
				    ->where('assoLng !=', 0)
					->order_by('tblAssoType.num_ordre', 'asc')
					->order_by('assoNom', 'asc');
			$query = $this->db->get();
			return $query;
		}
	}

}

/* End of file model_departement.php */
/* Location: ./application/models/model_departement.php */

?>
