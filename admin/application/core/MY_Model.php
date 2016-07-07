<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	protected $db;
	// 子类去填充
	protected $_table_name; // mysql table name
	protected $_keys; // key fields array
	protected $_fields; // array
	protected $_field_default_values;

	public function __construct() {
		parent::__construct();
		$this->db = $this->get_db();
	}

	public function __destruct() {
		$this->db->close();
	}

	public function get_db() {
		return $this->load->database('default', TRUE);
	}

	public function get_auth_db() {
		return $this->load->database('default', TRUE);
	}
	
	protected function _keys_prepared($data) {
		$wheres = array();
		foreach($this->_keys as $key_field) {
			if(!array_key_exists($key_field, $data)) {
				return false;
			}
			$wheres[$key_field] = $data[$key_field];
		}
		return $wheres;
	}
	
	// 子类可覆盖这几个方法，得到upsert/insert/update之前处理特殊数据或一些其他操作的机会
	// 注意这些类的$data前边的&符号不要丢了
	protected function _before_upsert(&$data) {
		return;
	}
	protected function _before_insert(&$data) {
		return;
	}
	protected function _before_update(&$data) {
		return;
	}
	
	public function upsert($data) {
		$wheres = $this->_keys_prepared($data);
		if($wheres === false)
			return false;
		
		$this->_before_upsert($data);
		
		$db = $this->get_db();
		$cnt = $db->from($this->_table_name)->where($wheres)->count_all_results();
		if($cnt === 1) {
			$this->_before_update($data);
			
			$filted_data = array();
			foreach($this->_fields as $field) {
				if(array_key_exists($field, $data)) {
					$filted_data[$field] = $data[$field];
				}
			}
			return $db->update($this->_table_name, $filted_data, $wheres);
		} else {
			$this->_before_insert($data);
			
			$filted_data = array();
			foreach($this->_field_default_values as $field=>$default_value) {
				$filted_data[$field] = array_key_exists($field, $data) ? $data[$field] : $default_value;
			}
			return $db->insert($this->_table_name, array_merge($wheres, $filted_data));
		}
	}
		
	public function upsert_batch($data, $only_update_keys='') {
		$filted = array();
		
		foreach($data as $row) {
			$keys = $this->_keys_prepared($row);
			if($keys === false) {
				return;
			}
			
			$filted_data = $keys;
			
			foreach($this->_field_default_values as $field=>$default_value) {
				$filted_data[$field] = array_key_exists($field, $row) ? $row[$field] : $default_value;
			}
			
			$filted[] = $filted_data;
		}
		
		if(empty($only_update_keys))
			$only_update_keys = $this->_fields;

		foreach($data as $row){
			$this->upsert($row);
		}
	}
}
