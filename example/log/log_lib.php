<?php
function get_access_log($log_path){
	$log_infos = array();
	$handle = @fopen($log_path, "r");
	
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
	    		'user_agent' => GetOs($log_info_arr['6'])." ".GetBrowser($log_info_arr['6']),
	    		'http_x_forwarded_for'=> $log_info_arr['7'],
	    	);
	    	
			$log_infos[] = $log_info;
	    }
	    fclose($handle);
	}
	
	return $log_infos;
}

function clear_access_log($log_path){
	file_put_contents($log_path, "");
}

function record_log_into_redis($log_infos){
	global $redis;
	$new_log_id = get_new_log_id();
	if(!empty($log_infos)){
		foreach($log_infos as $log_info){
			$redis->hMset("access_log:".$new_log_id, $log_info);
			$new_log_id++;
		}
	}
}

function get_new_log_key(){
	$new_log_id = get_new_log_id();
	return "access_log:".$new_log_id;
}

function get_new_log_id(){
	global $redis;
	$log_keys = $redis->keys("access_log:*");
	if(!empty($log_keys)){
		$last_log_key_name = $log_keys[count($log_keys)-1];
		$last_log_key_info = explode($last_log_key_name, ":");
		$new_log_id = $last_log_key_info[1]+1;
	}else{
		$new_log_id = 1;
	}
	
	return $new_log_id;
}

function get_redis_access_log(){
	global $redis;
	$log_infos = array();
	
	$log_keys = $redis->keys("access_log:*");
	foreach($log_keys as $log_key){
		$log_info = $redis->hGetAll($log_key);
		$log_infos[] = $log_info;
	}
	return $log_infos;
}

////获取访客操作系统
function GetOs($user_agent){
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

////获得访客浏览器类型
function GetBrowser($user_agent){
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