<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recherche extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->recherche();
	}

	public function recherche()
	{
		$this->load->helper(array('assets','form', 'url', 'text'));
		$this->load->library(array('layout','form_validation'));
		$this->load->model(array('model_asso','model_etab','model_proximite','model_ville','model_departement','model_region','model_mot','model_form','model_etendu'));
		$resultat['query'] = '';

		// Géolocalisation ...
		if($this->input->post('localisation'))
		{
			$localisation = str_replace(' ', '', $this->input->post('localisation'));
			list($lat, $lon) = explode(',', $localisation);
			$radius = $this->input->post('distance');
			$radius = preg_replace('/\D[^.,]/', '', $radius);
			$resultat['query'] = $this->model_proximite->lire_position($lat,$lon,$radius);
		}
		elseif($this->input->post('ville'))
		{
			$ville = $this->input->post('ville');
			$resultat['query'] = $this->model_ville->lire_ville($ville);
		}
		elseif($this->input->post('departement'))
		{
			$departement = $this->input->post('departement');
			$resultat['query'] = $this->model_departement->lire_departement($departement);
		}
		elseif($this->input->post('region'))
		{
			$region = $this->input->post('region');
			$resultat['query'] = $this->model_region->lire_region($region);
		}
		elseif($this->input->post('mot'))
		{
			$mot = $this->input->post('mot');
			$resultat['query'] = $this->model_mot->lire_mot($mot);
		}
		elseif($this->input->post('recherche_etendue'))
		{
			$departement = array();
			$region = array();
			$typeAsso = array();
			$typeEtab = array();
			$typeActivite = array();
			$typeAge = array();

			$envoi = $this->input->post();

			$localisation = str_replace(' ', '', $this->input->post('localisation_etendu'));
			if($localisation == '') $localisation = '0,0';
			list($lat, $lon) = explode(',', $localisation);
			$radius = $this->input->post('distance_etendu');
			$radius = preg_replace('/\D[^.,]/', '', $radius);
			$ville = $this->input->post('ville_etendu');
			$mot = $this->input->post('mot_etendu');

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

			$resultat['typeAsso'] = $typeAsso;
			$resultat['typeEtab'] = $typeEtab;
			$resultat['typeActivite'] = $typeActivite;
			$resultat['typeAge'] = $typeAge;
		}

		$resultat['query_activites'] = $this->model_etab->lire_activites();
		$resultat['query_region'] = $this->model_form->form_region();
		$resultat['query_departement'] = $this->model_form->form_departement();
		$resultat['query_typeAsso'] = $this->model_form->form_typeAsso();
		$resultat['query_typeEtab'] = $this->model_form->form_typeEtab();
		$resultat['query_typeActivite'] = $this->model_form->form_typeActivite();

		$this->layout->set_description('Touvez une association près de chez vous');
		$this->layout->set_keywords('Unapei');
		$this->layout->ajouter_css('jquery.fancybox');
		$this->layout->ajouter_css('common');
		$this->layout->ajouter_js('jquery-1.11.0.min');
		$this->layout->ajouter_js('jquery-ui.min');
		$this->layout->ajouter_js('jquery.fancybox.pack');
		$this->layout->ajouter_js('markerclusterer.pack');
		$this->layout->ajouter_js('recherche');

		$this->layout->view('recherche',$resultat);
	}

}

?>
