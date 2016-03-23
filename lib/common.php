<?php
static $redis;
$redis_host = "127.0.0.1";
$redis_port = 6379;
$redis = get_redis_obj();

function get_redis_obj(){
	global $redis_host;
	global $redis_port;
	
	$redis = new Redis();
	$res = $redis->connect($redis_host, $redis_port);
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

	global $redis;
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