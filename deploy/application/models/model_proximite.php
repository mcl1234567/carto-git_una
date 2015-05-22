<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_proximite extends CI_Model {

	function lire_position($lat, $lon, $radius)
	{
		$lat = $this->db->escape($lat);
		$lon = $this->db->escape($lon);
		$radius = $this->db->escape($radius);

		$this->db->select('*')
			->from('tblAsso')
			->where('6371*2*ATAN2(SQRT((SIN(RADIANS(assoLat-'.$lat.')/2)*SIN(RADIANS(assoLat-'.$lat.')/2)+COS(RADIANS('.$lat.'))*COS(RADIANS(assoLat))*SIN(RADIANS(assoLng-'.$lon.')/2)*SIN(RADIANS(assoLng-'.$lon.')/2))),SQRT(1-(SIN(RADIANS(assoLat-'.$lat.')/2)*SIN(RADIANS(assoLat-'.$lat.')/2)+COS(RADIANS('.$lat.'))*COS(RADIANS(assoLat))*SIN(RADIANS(assoLng-'.$lon.')/2)*SIN(RADIANS(assoLng-'.$lon.')/2))))<'.$radius)
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

/* End of file model_proximite.php */
/* Location: ./application/models/model_proximite.php */

?>
