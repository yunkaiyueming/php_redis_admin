<?php
include("lib/common.php");
/*
键(Key)
	DEL
	KEYS
	RANDOMKEY
	TTL
	EXISTS
	MOVE
	RENAME
	RENAMENX
	TYPE
	EXPIRE
	EXPIREAT
	OBJECT
	PERSIST
	SORT
*/

// $redis->set('name', 'zs');
//$name = $redis->get('name');

// $option_info = $redis->getOption();
// var_dump($option_info);

// if($redis->exists('name')){
// echo $redis->get('name');
// $res = $redis->del('name');
// var_dump($res);
// }else{
// echo 'false';
// $res = $redis->del('name');
// var_dump($res);
// }

$array_mset = array(
	'first_key' => 'first_val',
	'second_key' => 'second_val',
	'third_key' => 'third_val'
);
//$redis->mset($array_mset); // MSET一次储存多个值

$array_mget = array('first_key','second_key','third_key');
//var_dump($redis->mget($array_mget));

//$redis->del($array_mget); #同时删除多个key
//var_dump($redis->mget($array_mget));

//$redis->set('name', 'aa');
//$redis->expire('name',100);//设置过期时间
//$redis->set('name', 'bb');
//echo $redis->get('name');
//echo $redis->ttl('name');

$keys_res = $redis->keys("*");
foreach($keys_res as $key){
	$key_val = $redis->get($key);
	$type = get_key_type($key);
	$encoding_type = $redis->object('ENCODING', $key);
	$ttl_time = $redis->ttl($key);
	
	echo "$key : $key_val : $type : $encoding_type : $ttl_time";
	echo "<br>";
}

?>