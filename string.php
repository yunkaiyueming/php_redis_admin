<?php 
include("lib/common.php");
echo "<pre>";
$rand_val = rand(1, 100);
//$old_val = $redis->getSet("name","cc".$rand_val);echo $old_val;


//$redis->set("test_num", 100);
//$redis->incr("test_num");
//echo $redis->get("test_num");

//$redis->decr("test_num");
//echo $redis->get("test_num");

//$redis->append("test_num", "_appid1000");
//echo $redis->get("test_num");

//echo $redis->getRange("test_num", 0, 4);
//echo $redis->strlen("test_num");

//echo $redis->bitcount("test_num");
//$redis->setBit("test_num", 2, 1);对 key 所储存的字符串值，获取指定偏移量上的位(bit)。
//echo $redis->bitcount("test_num");

// $redis->set("count", 100);
// echo $redis->get("count");

// $redis->decr("count");
// echo $redis->get("count");

// $redis->decrBy("count", 20);
// echo $redis->get("count");

// echo $redis->get("str_test");
// echo $redis->getRange("str_test", 2, -2);

//echo $redis->get("page_view");
//echo $redis->incr("page_view");

//$redis->expire("page_view", 1);设置过期时间

// $exist_keys = $redis->keys("*");
// print_r($exist_keys);

// $all_key_values = $redis->mget($exist_keys);
// print_r($all_key_values);

$mxi_arr = array('day'=>'100', 'weather'=>'cold', 'time'=>time());
echo $redis->mset($mxi_arr);

$mix_vals = $redis->mget(array_keys($mxi_arr));
print_r($mix_vals);
?>