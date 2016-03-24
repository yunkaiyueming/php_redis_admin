<?php 
include("lib/common.php");
echo "<pre>";

// $user_arr = array('name'=>'aa', 'age'=>20, 'pwd'=>'ccc');
// $redis->hMset('user:3', $user_arr);

// $all_keys_vals = $redis->hMget('user:3', array_keys($user_arr));
//print_r($all_keys_vals);

// $keys_res = $redis->keys("*");
// foreach($keys_res as $key){
//	$key_val = $redis->get($key);
// 	$type = get_key_type($key);
// 	$encoding_type = $redis->object('ENCODING', $key);
// 	$ttl_time = $redis->ttl($key);
	
// 	if($type=='hash'){
// 		echo $key." : ";
// 		$redis->hGet($key, $field);
// 		$key_hvals = $redis->hVals($key);//返回哈希表 key 中所有域的值。
// 		print_r($key_hvals);
// 	}
// }

// $keys_and_values = $redis->hGetAll('user:2');//返回哈希表 key 中，所有的域和值。
// print_r($keys_and_values);
// echo $redis->hLen("user:2");//返回哈希表 key 中域的数量。

// echo $redis->hExists("user:3", "age");
// echo $redis->hDel("user:3", "age");
// echo $redis->hGet("user:3", "age");

// $all_hkeys = $redis->hKeys("user:2");
// print_r($all_hkeys);

// $redis->hSet("user:2", "page_view", 100);
// $redis->hIncrBy("user:2", "page_view", 20);
// echo $redis->hGet("user:2", "page_view");

//hash hscan
