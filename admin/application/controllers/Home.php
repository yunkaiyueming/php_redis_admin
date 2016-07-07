<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper("my_redis");
		$this->redis = get_redis_obj();
	}

	public function index(){
		$key_type = $this->input->get_post('type');
		$key_type = $this->filter_key_type($key_type);
		$keys = $this->get_key_by_type($key_type);
		
		$server_keys = array('redis_version', 'arch_bits', 'os', 'tcp_port', 'config_file','connected_clients','used_memory');
		$server_info = $this->get_server_info($server_keys);
		
		$view_data['keys'] = $keys;
		$view_data['key_type'] = $key_type;
		$view_data['server_info'] = $server_info;
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
	
	public function get_key_by_type($filter_key_type, $start_offset=0, $limit=500){
		$all_keys = $this->redis->keys("*");
		
		$keys = array();
		foreach($all_keys as $key){
			$key_type = $this->get_key_type($key);
			
			if(!empty($filter_key_type) && ($key_type!=$filter_key_type)){
				continue;
			}
			
			$keys[] = array(
				'key' => $key,
				'key_type' => $key_type,
				'encoding' => $this->get_key_encoding($key),
			);
		}
		
		return array_slice($keys, $start_offset, $limit);
	}
	
	public function get_key_type($key){
		// 	none(key不存在) int(0)
		// 	string(字符串) int(1)
		// 	list(列表) int(3)
		// 	set(集合) int(2)
		// 	zset(有序集) int(4)
		// 	hash(哈希表) int(5)
		$type_value = $this->redis->type($key);
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
	
	public function get_key_encoding($key){
		return $this->redis->object('ENCODING', $key);
	}
	
	public function get_server_info($filter_keys){
		$server_info = $this->redis->info();
		foreach($filter_keys as $key){
			if(array_key_exists($key, $server_info)){
				$filter_info[$key] = $server_info[$key];
			}
		}
		return $filter_info;
	}
	
	public function zset_info_by_key(){
		$key = $this->input->get_post('key');
		$z_infos = $this->redis->zRange($key, 0 , -1 ,'withscores');
		echo "<pre>";
		print_r($z_infos);
		
		foreach ($z_infos as $k=>$v)
		{
			if ($k %2 != 0)
			{
				if (isset($data[$v]))
					$data[$v] ++;
				else
					$data[$v] = 1;
			}
		}
		
		print_r($data);
	}
	
	public function delete_key(){
		$key_name = $this->input->get_post('key');
		try{
			$this->redis->del($key_name);
			redirect($_SERVER['HTTP_REFERER']);
		}catch (Exception $e) {
			log_message('info', 'Redis handle' . $e->getMessage());
		}
	}
}
