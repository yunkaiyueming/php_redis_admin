<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper("my_redis");
		$this->redis = get_redis_obj();
		$this->select_db();
	}

	public function index(){
		$key_type = $this->input->get_post('type');
		$key_type = $this->filter_key_type($key_type);
		$keys = $this->get_key_by_type($key_type, 0, 100);
		
		$server_keys = array('redis_version', 'arch_bits', 'os', 'tcp_port', 'config_file','connected_clients','used_memory');
		$server_info = $this->get_server_info($server_keys);
		
		$view_data['keys'] = $keys;
		$view_data['key_type'] = $key_type;
		$view_data['server_info'] = $server_info;
		$view_data['database_num'] = $this->get_config_info('databases');
		$view_data['dbsize'] = $this->redis->dbSize();
		return $this->render("home/index.php", $view_data);
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
				'ttl' => $this->get_key_ttl($key),
				'encoding' => $this->get_key_encoding($key),
				'refcount' => $this->get_key_refcount($key),
				'size' => $this->file_size_convert($this->get_key_size($key)),
			);
			
			if(count($keys)>=$limit) break;
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
		return $this->get_key_object($key, 'ENCODING');
	}
	
	public function get_key_refcount($key){
		return $this->get_key_object($key, 'REFCOUNT');
	}
	
	private function get_key_object($key, $object_name){
		return $this->redis->object($object_name, $key);
	}
	
	public function get_server_info($filter_keys){
		$server_info = $this->redis->info();
		foreach($filter_keys as $key){
			if(array_key_exists($key, $server_info)){
				$filter_info[$key] = $key=='used_memory'? $this->file_size_convert($server_info[$key]):$server_info[$key];
			}
		}
		return $filter_info;
	}
	
	public function file_size_convert($bytes){
		$bytes = floatval($bytes);
		$arBytes = array(
			0 => array(
				"UNIT" => "TB",
				"VALUE" => pow(1024, 4)
			),
			1 => array(
				"UNIT" => "GB",
				"VALUE" => pow(1024, 3)
			),
			2 => array(
				"UNIT" => "MB",
				"VALUE" => pow(1024, 2)
			),
			3 => array(
				"UNIT" => "KB",
				"VALUE" => 1024
			),
			4 => array(
				"UNIT" => "B",
				"VALUE" => 1
			),
		);
		
		if($bytes == 0){
			return "0 B";
		}
		foreach($arBytes as $arItem){
			if($bytes >= $arItem["VALUE"]){
				$result = $bytes / $arItem["VALUE"];
				$result = strval(round($result, 2))." ".$arItem["UNIT"];
				break;
			}
		}
		return $result;
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
	
	public function edit_key(){
		$key_name = $this->input->get_post('key');
		$vals = $this->input->get_post('vals');
		$field = $this->input->get_post('field');
		$field_val = $this->input->get_post('field_val');
		$action = $this->input->get_post('submit');
		if(!empty($key_name) && empty($action)){
			$view_data = array(
				'key_name' => $key_name,
				'val' => $this->get_key_vals($key_name),
				'key_type' => get_key_type($key_name),
				'ttl' => $this->get_key_ttl($key_name),
				'key_encoding' => $this->get_key_encoding($key_name),
			);
			return $this->render("home/edit", $view_data);
		}
		
		try{
			$param = array('vals'=>$vals, $field=>$field_val);
			$this->update_key_by_type($key_name, $param);
			redirect("home/view_key?key=$key_name");
		}catch (Exception $e) {
			log_message('info', 'Redis handle' . $e->getMessage());
			return $this->render("home/msg", $view_data);
		}
	}
	
	public function add_key(){
		$action = $this->input->get_post('action');
		$key_name = $this->input->get_post('key');
		$key_type = get_key_type($key_name);
		if(empty($action)){
			$view_data = array(
				'key_name' => $key_name,
				'val' => $this->get_key_vals($key_name),
				'key_type' => $key_type,
				'ttl' => $this->get_key_ttl($key_name),
				'key_encoding' => $this->get_key_encoding($key_name),
			);
			return $this->render("home/add", $view_data);
		}
		
		$field = $this->input->get_post("field");
		$field_val = $this->input->get_post("field_val");
		try{
			$param = array('value'=>$field_val, 'field'=>$field);
			$this->_add_key_val_by_type($key_name, $param);
			redirect($_SERVER['HTTPREFERER']);
		}catch (Exception $e) {
			log_message('info', 'Redis handle' . $e->getMessage());
			$view_data['error'] = "get redis key wrong";
			return $this->render("home/msg", $view_data);
		}
	}
	
	private function _add_key_val_by_type($key_name, $param){
		$key_type = get_key_type($key_name);
		switch($key_type) {
			case 'list':
				$this->redis->lPush($key_name, $param['value']);
				break;
			
			case 'set':
				$this->redis->sadd($key_name, $param['value']);
				break;
			
			case 'zset':
				$this->redis->zadd($key_name, $param['value']);
				break;
			
			case 'hash':
				$this->redis->hset($key_name, $param['field'], $param['value']);
				break;
		}
	}
	
	public function view_key(){
		$key_name = $this->input->get_post('key');
		try{
			$view_data = array(
				'key_name' => $key_name,
				'val' => $this->get_key_vals($key_name),
				'key_type' => get_key_type($key_name),
				'ttl' => $this->get_key_ttl($key_name),
				'key_encoding' => $this->get_key_encoding($key_name),
			);
			return $this->render("home/view", $view_data);
		}catch (Exception $e) {
			log_message('info', 'Redis handle' . $e->getMessage());
			$view_data['error'] = "get redis key wrong";
			return $this->render("home/msg", $view_data);
		}
	}
	
	public function get_key_vals($key_name){
		$key_type = get_key_type($key_name);
		switch($key_type){
			case 'string':
				$val = $this->redis->get($key_name);break;
			case 'list':
				$llen = $this->redis->llen($key_name);
				$val = $this->redis->lrange($key_name,0, $llen);break;
			case 'set':
				$val = $this->redis->SMEMBERS($key_name);break;
			case 'zset':
				$val = $this->redis->ZRANGE($key_name, 0, -1, 'WITHSCORES');
				foreach($val as $key=>&$value){
					$value = $key."($value)";
				}
				break;
			case 'hash':
				$val = $this->redis->HGETAll($key_name);
				foreach($val as $key=>&$value){
					$value = $key.":".$value;
				}
				break;
			default:
				break;
		}

		return is_array($val) ? implode("<br>", $val) : $val;
	}
	
	public function update_key_by_type($key_name, $param){
		$key_type = get_key_type($key_name);
		try {
			switch($key_type){
				case 'string':
					$this->redis->set($key_name, $param['vals']);
				case 'list':
					$this->redis->lset($key_name, $param['field'], $param['field_val']);
				case 'set':
					$this->redis->srem($key_name, $param['field_val']);
					$this->redis->sadd($key_name, $param['field_val']);
				case 'zset':
					$this->redis->zrem($key_name, $param['field_val']);
					$this->redis->zadd($key_name, $param['field_val']);
				case 'hash':
					$this->redis->hset($key_name, $param['field'], $param['field_val']);
			}
		} catch (Exception $e) {
			log_message('info', 'Redis handle' . $e->getMessage());
			return $this->render("home/msg");
		}
	}
	
	public function get_key_ttl($key_name){
		return $this->redis->ttl($key_name);
	}
	
	public function get_formate_key_size(){
		$patterns = array(
			'foo:.+',
			'bar:.+',
		);

		$this->redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);
		$result = array_fill_keys($patterns, 0);
		while($keys = $this->redis->scan($it, $match = '*', $count = 1000)) {
			foreach($keys as $key) {
				foreach($patterns as $pattern) {
					if(preg_match("/^{$pattern}$/", $key)) {
						if ($v = $this->redis->debug($key)) {
							$result[$pattern] += $v['serializedlength'];
						}

						break;
					}
				}
			}
		}

		return $result;
	}
	
	public function get_key_size($key_name){
		$v = $this->redis->debug($key_name);
		return $v['serializedlength'];//key_size = strlen(key) + serializedlength + 7
	}
	
	public function get_config_info($field){
		$info = $this->redis->config("get", "*");
		return $info[$field];
	}
	
	private function select_db(){
		$db_num = $this->input->get_post('db');
		$db_num = empty($db_num) ? 0:$db_num;
		$db_num = intval($db_num);
		$this->redis->select($db_num);
	}
}
