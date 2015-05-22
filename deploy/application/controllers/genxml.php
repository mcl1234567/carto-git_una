<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genxml extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->genxml();
	}

	public function genxml()
	{
		$this->load->helper(array('assets','url','xml'));
		$this->load->model(array('model_asso','model_etab','model_proximite','model_ville','model_departement','model_region','model_mot','model_etendu'));
		$resultat['query'] = '';

		if($this->input->get_post('localisation'))
		{
			$localisation = $this->input->get_post('localisation');
			list($lat, $lon) = explode(', ', $localisation);
			$radius = $this->input->get_post('distance');
			$radius = preg_replace('/\D[^.,]/', '', $radius);
			$resultat['query'] = $this->model_proximite->lire_position($lat,$lon,$radius);
		}
		elseif($this->input->get_post('ville'))
		{
			$ville = $this->input->get_post('ville');
			$resultat['query'] = $this->model_ville->lire_ville($ville);
		}
		elseif($this->input->get('departement'))
		{
			$departement = $this->input->get('departement');
			$resultat['query'] = $this->model_departement->lire_departement($departement);
		}
		elseif($this->input->get('region'))
		{
			$region = $this->input->get('region');
			$resultat['query'] = $this->model_region->lire_region($region);
		}
		elseif($this->input->get('recherche_etendue'))
		{
			$departement = array();
			$region = array();
			$typeAsso = array();
			$typeEtab = array();
			$typeActivite = array();
			$typeAge = array();

			$envoi = $this->input->get();

			$localisation = str_replace(' ', '', $this->input->get('localisation_etendu'));
			if($localisation == '') $localisation = '0,0';
			list($lat, $lon) = explode(',', $localisation);
			$radius = $this->input->get('distance_etendu');
			$radius = preg_replace('/\D[^.,]/', '', $radius);
			$ville = $this->input->get('ville_etendu');
			$mot = $this->input->get('mot_etendu');

			foreach($envoi as $key => $value)
			{
				if($value != 'plus')
				{
					if(preg_match('/departement/', $key)) $departement[] = str_replace('departement_', '', $key);
					if(preg_match('/region/', $key)) $region[] = str_replace('region_', '', $key);
					if(preg_match('/typeAsso/', $key))
					{
						$typeAsso[] = str_replace('typeAsso_', '', $key);
						if(str_replace('typeAsso_', '', $key) == '3')
						{
							/* Les codes 3,4,6,8 et 9 correspondent au libellé "association"
							Seul '3' est envoyé par le formulaire. On ajoute les références manquantes */
							$typeAsso[] = '4';
							$typeAsso[] = '6';
							$typeAsso[] = '8';
							$typeAsso[] = '9';
						}
					}
					if(preg_match('/typeEtab/', $key)) $typeEtab[] = str_replace('typeEtab_', '', $key);
					if(preg_match('/typeActivite/', $key)) $typeActivite[] = str_replace('typeActivite_', '', $key);
					if(preg_match('/etabPlaces/', $key)) $typeAge[] = str_replace('typeAge_', '', $key);
				}
			}
			$resultat['query'] = $this->model_etendu->lire_etendu($radius, $lon, $lat, $ville, $departement, $region, $typeAsso, $typeEtab, $typeActivite, $typeAge, $mot);
		}
		elseif($this->input->get('mot'))
		{
			$mot = $this->input->get('mot');
			$resultat['query'] = $this->model_mot->lire_mot($mot);
		}
		elseif($this->input->get('chiffres'))
		{
			$resultat['query'] = $this->model_asso->lire_asso_all();
		}

		$this->load->view('genxml',$resultat);
	}

}

?>
