<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ville extends CI_Model {

	function lire_ville($ville)
	{
		$this->db->select('*');
		$this->db->from('tblAsso');
		$this->db->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left');
		$this->db->join('tblEtab','tblAsso.assoNumero = tblEtab.assoNumero','left');

		if(preg_match('/^[0-9]*$/', $ville)) {
			$assoPrefixCP = $ville[0];
			$assoSuffixCP = '';
			if(strlen($ville) > 1) $assoPrefixCP .= $ville[1];
			if(strlen($ville) > 2) $assoSuffixCP .= $ville[2];
			if(strlen($ville) > 3) $assoSuffixCP .= $ville[3];
			if(strlen($ville) > 4) $assoSuffixCP .= $ville[4];
			$assoCP = $assoPrefixCP.$assoSuffixCP;

			if(preg_match('/^[0-9]$/', $assoCP) AND strlen($ville) > 2)	{
				$this->db->where('tblAsso.assoPrefixCP', $assoPrefixCP);
				$this->db->where('tblEtab.etabPrefixCP', $assoPrefixCP);
				$this->db->like('tblAsso.assoSuffixCP', $assoSuffixCP, 'after');
				$this->db->or_like('tblEtab.etabSuffixCP', $assoSuffixCP, 'after');
			}
			else {
				$this->db->like('tblAsso.assoPrefixCP', $assoPrefixCP, 'after');
				$this->db->or_like('tblEtab.etabPrefixCP', $assoPrefixCP, 'after');
			}
		}
		else {
			$this->db->like('tblAsso.assoVille', $ville);
			$this->db->or_like('tblEtab.etabVille', $ville);
		}

		$this->db->where('tblAsso.assoRetrait !=', 1);
		$this->db->where('tblEtab.etabRetrait !=', 1)
				->where('tblEtab.etabLat !=', 0)
				->where('tblEtab.etabLng !=', 0);
		$this->db->order_by('tblAssoType.num_ordre', 'asc');
		$this->db->order_by('tblAsso.assoNom', 'asc');
		$query = $this->db->get();

		if($query->num_rows() == 0) {
			$this->db->select('longitude_deg, latitude_deg')
					->from('commune_geoloc')
					->like('nom', $ville)
					->or_like('nom_simple', $ville)
					->or_like('nom_reel', $ville)
					->or_like('code_postal', $ville)
					->limit(1);
			$position = $this->db->get();
			foreach ($position->result() as $row)
			{
				$lat = $row->latitude_deg;
				$lon = $row->longitude_deg;
			}
			$radius = 5;

			$this->db->select('*')
					->from('tblAsso')
					->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left')
					->join('tblEtab','tblAsso.assoNumero = tblEtab.assoNumero','left')
					->where('6371*2*ATAN2(SQRT((SIN(RADIANS(assoLat-'.$lat.')/2)*SIN(RADIANS(assoLat-'.$lat.')/2)+COS(RADIANS('.$lat.'))*COS(RADIANS(assoLat))*SIN(RADIANS(assoLng-'.$lon.')/2)*SIN(RADIANS(assoLng-'.$lon.')/2))),SQRT(1-(SIN(RADIANS(assoLat-'.$lat.')/2)*SIN(RADIANS(assoLat-'.$lat.')/2)+COS(RADIANS('.$lat.'))*COS(RADIANS(assoLat))*SIN(RADIANS(assoLng-'.$lon.')/2)*SIN(RADIANS(assoLng-'.$lon.')/2))))<'.$radius)
					->where('tblAsso.assoRetrait !=', 1)
					->where('tblEtab.etabRetrait !=', 1)
					->order_by('tblAssoType.num_ordre', 'asc')
					->order_by('tblAsso.assoNom', 'asc');
			$query = $this->db->get();
		}
		return $query;
	}

	function liste_ville($ville) {
		$this->db->select('nom_reel, code_postal')
				->from('commune_geoloc')
				->like('nom_reel', $ville, 'after')
				->or_like('code_postal', $ville)
				->limit(10);
		$query = $this->db->get();
		return $query;
	}

}

/* End of file model_ville.php */
/* Location: ./application/models/model_ville.php */

?>
