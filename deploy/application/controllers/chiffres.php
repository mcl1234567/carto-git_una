<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chiffres extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->chiffres();
	}

	public function chiffres()
	{
		$this->load->helper(array('url', 'text', 'form'));
		$this->load->view('chiffres');
	}

}

?>
