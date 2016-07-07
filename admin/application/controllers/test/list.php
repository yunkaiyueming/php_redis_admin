<?php
include("lib/common.php");
echo "<pre>";
/*	表(List)
 	BLPOP
	BRPOP
	BRPOPLPUSH(模式：安全队列 模式：循环列表)
	LINDEX 返回list_key中指定index的值
	LINSERT  将值value插入到列表key当中，位于指定值之前或之后(只写入一次)。
	LLEN  返回list_key的长度
	LPOP  表头弹出
	LPUSH 表头写入
	LPUSHX  将值value插入到列表key的表头，当且仅当key存在并且是一个列表。
	LRANGE 返回start_offset到end_offset值
	LREM 根据参数count的值，移除列表中与参数value相等的元素。
	LSET 设置指定index的值
	LTRIM 截取start_offset到end_offset的区间的值
	RPOP 表尾弹出
	RPOPLPUSH(模式： 安全的队列 模式：循环列表)
	RPUSH 表尾写入
	RPUSHX  将值value插入到列表key的表尾，当且仅当key存在并且是一个列表。
*/


// $redis->LPUSH('today_cost', 8);
// $redis->lPush('today_cost', 9, 7);
// $redis->lPushx('today_cost', 11);
//print_r(get_all_list_key_vals('today_cost'));
//echo $redis->lPop("today_cost");
//$redis->lInsert("today_cost", 'after', 9, 200);//将值value插入到列表key当中，位于指定值之前或之后(只写入一次)。
//print_r(get_all_list_key_vals('today_cost'));

// $redis->rPush('today_cost', '99', '100');
// $redis->rPushx('today_cost', 22);
// $redis->lPush('today_cost', 23);
// $redis->lPushx('today', 33);

// echo $redis->rPop('today_cost');echo "<br>";
// echo $redis->lPop('today_cost');echo "<br>";

//print_r(get_all_list_key_vals('today_cost'));
//echo $redis->lLen('today_cost');echo "<br>";

//lrange($list, $start_offset, $end_offset);
// print_r($redis->lrange('today_cost', 2, 2));echo "<br>";

//echo $redis->lrem('today_cost', 11, 0);//根据参数count的值，移除列表中与参数value相等的元素。
// echo $redis->lindex('today_cost', 2);
//print_r(get_all_list_key_vals('today_cost'));


//echo $redis->lSet("today_cost", 1, 100);
//echo $redis->lSize("today_cost");

// $redis->ltrim("today_cost", 1, 5);
// print_r(get_all_list_key_vals('today_cost'));

// echo $redis->lindex("today_cost", 1);

