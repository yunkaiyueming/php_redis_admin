<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $layout = 'layout/main';
	
	protected $layout_data = array(
		'side_bar' => 'main',
		'title' => ' Game Package',
		'description' => 'Game Package Manager',
		'keywords' => 'none',
	);

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	protected function render($file, $content_data) {
		if(!is_null($file)) {
			$data['layout_data'] = $this->layout_data;
			$data['content'] = $this->load->view($file, $content_data, TRUE);
			//$data['content_data'] = $content_data;
			return $this->load->view($this->layout, $data);
		} 
	}
}
