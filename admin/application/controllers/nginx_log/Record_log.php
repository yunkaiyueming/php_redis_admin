<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Record_log extends MY_Controller {
	public static $LOG_PATH = "D:/phpStudy2016/nginx/logs/bk/access.log.bk";
	public $redis;
	
	public function __construct() {
		parent::__construct();
		error_reporting(E_ALL);
		$this->load->helper("my_redis");
		$this->redis = get_redis_obj();
	}
	
	public function get_access_log(){
		$log_infos = array();
		$handle = fopen(self::$LOG_PATH, "r");

		if($handle){
			while(($buffer = fgets($handle, 4096)) !== false) {
				$buffer = substr($buffer, 1, -3);
				$log_info_arr = explode('] - [', $buffer);

				$log_info = array(
					'client_ip' => $log_info_arr['0'],
					'request_time' => $log_info_arr['1'],
					'request_url' => $log_info_arr['2'],
					'status' => $log_info_arr['3'],
					'body_bytes_sent' => $log_info_arr['4'],
					'http_referer' => $log_info_arr['5'],
					'user_agent' => $this->GetOs($log_info_arr['6'])." ".$this->GetBrowser($log_info_arr['6']),
					'http_x_forwarded_for'=> $log_info_arr['7'],
				);

				$log_infos[] = $log_info;
			}
			fclose($handle);
		}

		return $log_infos;
	}

	public function clear_access_log(){
		file_put_contents(self::$LOG_PATH, "");
	}

	public function record_log_into_redis(){
		$log_infos = $this->get_access_log();
		$new_log_id = $this->get_new_log_id();
		if(!empty($log_infos)){
			foreach($log_infos as $log_info){
				$this->redis->hMset("access_log:".$new_log_id, $log_info);
				$new_log_id++;
			}
		}
	}

	public function get_new_log_key(){
		$new_log_id = $this->get_new_log_id();
		return "access_log:".$new_log_id;
	}

	public function get_new_log_id(){
		$log_keys = $this->redis->keys("access_log:*");
		if(!empty($log_keys)){
			$last_log_key_name = $log_keys[count($log_keys)-1];
			$last_log_key_info = explode($last_log_key_name, ":");
			$new_log_id = $last_log_key_info[1]+1;
		}else{
			$new_log_id = 1;
		}

		return $new_log_id;
	}

	public function get_redis_access_log(){
		$log_infos = array();

		$log_keys = $this->redis->keys("access_log:*");
		foreach($log_keys as $log_key){
			$log_info = $this->redis->hGetAll($log_key);
			$log_infos[] = $log_info;
			if(count($log_infos)>200) break; 
		}
		
		$item_descs = array('client_ip','request_time' ,'request_url','status' ,'body_bytes_sent' ,'http_referer' ,'user_agent' ,'http_x_forwarded_for');
		$view_data['log_infos'] = $log_infos;
		$view_data['item_descs'] = $item_descs;
		$this->load->view("nginx_log/index", $view_data);
	}

	//获取访客操作系统
	public function GetOs($user_agent){
		if(!empty($user_agent)){
			$OS = $user_agent;
			if (preg_match('/win/i',$OS)) {
				$OS = 'Windows';
			}elseif (preg_match('/mac/i',$OS)) {
				$OS = 'MAC';
			}elseif (preg_match('/linux/i',$OS)) {
				$OS = 'Linux';
			}elseif (preg_match('/unix/i',$OS)) {
				$OS = 'Unix';
			}elseif (preg_match('/bsd/i',$OS)) {
				$OS = 'BSD';
			}else {
				$OS = 'Other';
			}
			return $OS;
		}else{return "获取访客操作系统信息失败！";}
	}

	//获得访客浏览器类型
	public function GetBrowser($user_agent){
		if(!empty($user_agent)){
			$br = $user_agent;
			if (preg_match('/MSIE/i',$br)) {
				$br = 'MSIE';
			}elseif(preg_match('/Firefox/i',$br)) {
				$br = 'Firefox';
			}elseif (preg_match('/Chrome/i',$br)) {
				$br = 'Chrome';
			}elseif (preg_match('/Safari/i',$br)) {
				$br = 'Safari';
			}elseif (preg_match('/Opera/i',$br)) {
				$br = 'Opera';
			}else {
				$br = 'Other';
			}
			return $br;
		}else{return "获取浏览器信息失败！";}
	}
}