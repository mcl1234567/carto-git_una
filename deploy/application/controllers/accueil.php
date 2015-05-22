<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$this->load->helper(array('assets', 'text'));
		$this->load->library('layout');
		$this->layout->set_title('Unapei - Une association près de chez vous');
		$this->layout->set_description('Touvez une association près de chez vous');
		$this->layout->set_keywords('Unapei');
		$this->layout->ajouter_css('common');
		$this->layout->view('accueil', array());
	}

}

?>
