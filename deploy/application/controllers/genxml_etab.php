<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genxml_etab extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->genxml_etab();
	}

	public function genxml_etab()
	{
		$this->load->helper(array('assets','url','xml'));
		$this->load->model(array('model_asso','model_etab'));
		$resultat['query'] = $this->model_asso->lire_asso_all();
		$this->load->view('genxml_etab',$resultat);
	}

}

?>
