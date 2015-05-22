<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_region extends CI_Model {

    function lire_region($region)
    {
        $this->db
            ->select('*')
            ->from('tblAsso')
            ->join('listeLocalisation','tblAsso.assoPrefixCP = listeLocalisation.codeDepartement','left')
            ->join('tblAssoType', 'tblAssoType.code = tblAsso.assoType', 'left');

        if(preg_match('/^[0-9]*$/', $region)) {
            $this->db->where('listeLocalisation.codeRegion', $region);
        }
        else {
            $this->db->like('listeLocalisation.nomRegion', $region);
        }

        $this->db
            ->where('assoRetrait !=', 1)
            ->where('assoLat !=', 0)
            ->where('assoLng !=', 0)
            ->order_by('tblAssoType.num_ordre', 'asc')
            ->order_by('assoNom', 'asc');

        $query = $this->db->get();
        return $query;
    }
}

/* End of file model_region.php */
/* Location: ./application/models/model_region.php */

?>
