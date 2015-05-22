<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {

	private $CI;
	private $var = array();
	private $theme = 'default';

	/*
	 * Constructeur
	**/
	public function __construct()
	{
		$this->CI = get_instance();

		$this->var['output'] = '';
		$this->var['page'] = $this->CI->router->fetch_class();
		$this->var['title'] = ucfirst($this->CI->router->fetch_class()).' - Unapei : Une association près de chez vous';
		$this->var['charset'] = $this->CI->config->item('charset');
		$this->var['description'] = '';
		$this->var['keywords'] = '';
		$this->var['css'] = array();
		$this->var['js'] = array();
		$this->var['resultats'] = '';
	}

	/*
	 *===============================================================================
	 * Méthodes pour charger les vues
	 *	. view
	 *	. views
	 *===============================================================================
	 */
	public function view($name, $data = array())
	{
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		$this->CI->load->view('../themes/' . $this->theme, $this->var);
	}

	public function views($name, $data = array())
	{
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}
	/*
	 *===============================================================================
	 * Méthodes pour modifier les variables envoyées au layout
	 *	. set_titre
	 *	. set_charset
	 *===============================================================================
	 */
	public function set_title($title)
	{
		if(is_string($title) AND !empty($title))
		{
			$this->var['title'] = $title;
			return true;
		}
		return false;
	}

	public function set_charset($charset)
	{
		if(is_string($charset) AND !empty($charset))
		{
			$this->var['charset'] = $charset;
			return true;
		}
		return false;
	}

	public function set_description($description)
	{
		if(is_string($description) AND !empty($description))
		{
			$this->var['description'] = $description;
			return true;
		}
		return false;
	}

	public function set_keywords($keywords)
	{
		if(is_string($keywords) AND !empty($keywords))
		{
			$this->var['keywords'] = $keywords;
			return true;
		}
		return false;
	}

	/*
	 *===============================================================================
	 * Méthodes pour ajouter des feuilles de CSS et de JavaScript
	 *	. ajouter_css
	 *	. ajouter_js
	 *===============================================================================
	*/
	public function ajouter_css($css)
	{
		if(is_string($css) AND !empty($css) AND file_exists('./assets/css/' . $css . '.css'))
		{
			$this->var['css'][] = css_url($css);
			return true;
		}
		return false;
	}

	public function ajouter_js($js)
	{
		if(is_string($js) AND !empty($js) AND file_exists('./assets/javascript/' . $js . '.js'))
		{
			$this->var['js'][] = js_url($js);
			return true;
		}
		return false;
	}

	/*
	 *===============================================================================
	 * Méthodes pour générer le thème
	 *	. set_theme
	 *===============================================================================
	 */
	public function set_theme($theme)
	{
		if(is_string($theme) AND !empty($theme) AND file_exists('./application/themes/' . $theme . '.php'))
		{
			$this->theme = $theme;
			return true;
		}
		return false;
	}

}
