<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ville extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->ville();
	}

	public function ville()
	{
		$this->load->model(array('model_ville'));
		$ville = $this->input->get_post('term');
		$resultat['query'] = $this->model_ville->liste_ville($ville);

		$this->load->view('ville',$resultat);
	}

}

?>
