<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $layout = 'layout/main';
	protected $layout_data = array(
		'title' => ' Game Package',
		'description' => 'Game Package Manager',
		'keywords' => 'none',
	);

	public function __construct() {	
		parent::__construct();
		$this->load->helper('url');
	}

	protected function render($file, $layout_data) {
		if(!is_null($file)) {
			$layout_data = empty($layout_data) ? $this->layout_data : $layout_data;
			$data['content'] = $this->load->view($file, $view_data, TRUE);
			$data['layout'] = $layout_data;
			return $this->load->view($this->layout, $data);
		} 
	}
}
