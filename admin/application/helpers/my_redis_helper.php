<?php
function get_redis_obj(){
	$redis_host = "127.0.0.1";
	$redis_port = 6379;
	
	$redis = new Redis();
	$res = $redis->connect($redis_host, $redis_port);
	//$redis->auth("admin");
	if(!$res){
		exit('redis connect failed');
	}
	return $redis;
}

function get_key_type($key){
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

function get_all_list_key_vals($list_key){
	$redis = get_redis_obj();
	
	$list_length = $redis->lLen($list_key);
	return $redis->lGetRange($list_key, 0, $list_length-1);
}

//从小到大取数据
function get_all_zset_key_vals($key){
	$redis = get_redis_obj();
	$all_key_vals = $redis->zRange($key, 0, -1, 'WITHSCORES');
	print_r($all_key_vals);
}

//从大到小取数据
function get_all_zset_key_vals_desc($key){
	$redis = get_redis_obj();
	$all_key_vals = $redis->zReverseRange($key, 0, -1, 'WITHSCORES');
	print_r($all_key_vals);
}