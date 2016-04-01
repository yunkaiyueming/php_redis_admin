<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper("my_redis");
	}

	public function index(){
		$redis = get_redis_obj();
		$all_keys = $redis->keys("access_log:*");
		foreach($all_keys as $key){
			$type_value = $redis->type($key);
			if($type_value=='5'){
				$hash_keys[] = $key;
			}
		}
		
		
		
		//$key_type = $this->input->get_post('type');
		//$keys = $this->get_key_by_type($key_type);
		$view_data['keys'] = $hash_keys;
		return $this->load->view('index.php', $view_data);
	}
	
	public function get_key_by_type($key_type){
		switch ($key_type) {
			case 'string':
				return $this->get_all_string_keys();
			break;
			
			case 'list':
				return $this->get_all_list_keys();
			break;
			
			case 'set':
				return $this->get_all_set_keys();
			break;
				
			case 'zset':
				return $this->get_all_zset_keys();
			break;
					
			default:
				return $this->get_all_hash_keys();
			break;
		}
	}
	
	public function get_all_string_keys(){
		
	}
	
	public function get_all_set_keys(){
		
	}
	
	public function get_all_list_keys(){
		
	}
	
	public function get_all_hash_keys(){
		$redis = get_redis_obj();
		$all_keys = $redis->keys("access_log:*");
		foreach($all_keys as $key){
			if(get_key_type($key)=='hash'){
				$hash_keys[] = 	$key;
			}
		}
		return $hash_keys;
	}
}
