<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mentions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->mentions();
	}

	public function mentions()
	{
		$this->load->helper('assets');
		$this->load->library('layout');
		$this->layout->set_description('Touvez une association près de chez vous');
		$this->layout->set_keywords('Unapei');
		$this->layout->ajouter_css('common');
		$this->layout->view('mentions');
	}

}

?>
