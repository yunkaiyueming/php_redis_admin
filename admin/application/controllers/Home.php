<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper("my_redis");
	}

	public function index(){
		$key_type = $this->input->get_post('type');
		$key_type = $this->filter_key_type($key_type);
		$keys = $this->get_key_by_type($key_type);
		$view_data['keys'] = $keys;
		$view_data['key_type'] = $key_type;
		return $this->load->view('index.php', $view_data);
	}
	

	public function filter_key_type($key_type){
		$fitler_types = array('string', 'list', 'set', 'zset', 'hash');
		if(in_array($key_type, $fitler_types)){
			return $key_type;
		}else{
			return "";
		}
	}
	
	public function get_key_by_type($key_type){
		$redis = get_redis_obj();
		$all_keys = $redis->keys("*");
		
		$keys = array();
		foreach($all_keys as $key){
			if(!empty($key_type)){
				if($this->get_key_type($key)==$key_type){
					$keys[] = array(
						'key' => $key,
						'key_type' => $key_type,
					);
				}
			}else{
				$keys[] = array(
					'key' => $key,
					'key_type' => $this->get_key_type($key),
				);
			}
			
		}
		return $keys;
	}
	
	public function get_key_type($key){
		// 	none(key不存在) int(0)
		// 	string(字符串) int(1)
		// 	list(列表) int(3)
		// 	set(集合) int(2)
		// 	zset(有序集) int(4)
		// 	hash(哈希表) int(5)
	
		$redis = get_redis_obj();
		$type_value = $redis->type($key);
		switch($type_value){
			case 0:
				return "none";
				break;
	
			case 1:
				return "string";
				break;
	
			case 2:
				return "set";
				break;
					
			case 3:
				return "list";
				break;
	
			case 4:
				return "zset";
				break;
	
			default:
				return "hash";
		}
	}
}
