<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genxml_asso extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->genxml_asso();
	}

	public function genxml_asso()
	{
		$this->load->helper(array('assets','url','xml'));
		$this->load->model(array('model_asso'));
		$resultat['query'] = $this->model_asso->lire_asso_all();
		$this->load->view('genxml_asso',$resultat);
	}

}

?>
