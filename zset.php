<?php
include("lib/common.php");
echo "<pre>";
/*
    ZADD 将一个或多个 member 元素及其 score 值加入到有序集 key 当中
    ZCARD 返回有序集 key 的基数。
    ZCOUNT  返回有序集key中,score 值在 min 和 max 之间(默认包括 score 值等于 min 或 max )的成员的数量
    ZINCRBY  为有序集 key 的成员 member 的 score 值加上增量 increment 
    ZRANGE 返回有序集 key 中，指定区间内的成员 (从小到大排列)。
    ZRANGEBYSCORE 返回有序集 key 中，所有 score 值介于 min 和 max 之间(包括等于 min 或 max )的成员。有序集成员按 score 值递增(从小到大)次序排列
    ZRANK 返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递增(从小到大)顺序排列
    ZREM  移除有序集 key 中的一个或多个成员，不存在的成员将被忽略。
    ZREMRANGEBYRANK  移除有序集 key 中，指定排名(rank)区间内的所有成员
    ZREMRANGEBYSCORE  移除有序集 key 中，所有 score 值介于 min 和 max 之间(包括等于 min 或 max )的成员
    ZREVRANGE  返回有序集 key 中，指定区间内的成员。其中成员的位置按 score 值递减(从大到小)来排列。
    ZREVRANGEBYSCORE 返回有序集 key 中， score 值介于 max 和 min 之间(默认包括等于 max 或 min )的所有的成员。有序集成员按 score 值递减(从大到小)的次序排列。
    ZREVRANK  返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递减(从大到小)排序。
    ZSCORE 返回有序集 key 中，成员 member 的 score 值。
    ZUNIONSTORE 计算给定的一个或多个有序集的并集，其中给定 key 的数量必须以 numkeys 参数指定，并将该并集(结果集)储存到 destination, 默认情况下，结果集中某个成员的 score 值是所有给定集下该成员 score 值之 和 。
    ZINTERSTORE  计算给定的一个或多个有序集的交集，其中给定 key 的数量必须以 numkeys 参数指定，并将该交集(结果集)储存到 destination 。默认情况下，结果集中某个成员的 score 值是所有给定集下该成员 score 值之和.
    ZSCAN
    ZRANGEBYLEX
    ZLEXCOUNT
    ZREMRANGEBYLEX
 */
function get_all_zset_key_vals($key){
	global $redis;
	$all_key_vals = $redis->zRange($key, 0, -1, 'WITHSCORES');
	print_r($all_key_vals);
}

//从大到小取数据
function get_all_zset_key_vals_desc($key){
	global $redis;
	$all_key_vals = $redis->zReverseRange($key, 0, -1, 'WITHSCORES');
	print_r($all_key_vals);
}

// $redis->zAdd("zset_website", "10", "baidu", "9", "google");
// $redis->zAdd("zset_website", "10", "360", "9", "gougou");

get_all_zset_key_vals('zset_website');
// $redis->zAdd("zset_website", "10", "baidu", "9", "google");
// $redis->zAdd("zset_website", "8", "sou");
// get_all_zset_key_vals('zset_website');

// echo $redis->zCard("zset_website");
// $redis->zAdd("zset_website", "9", "tianmao");
//get_all_zset_key_vals('zset_website');

//print_r($redis->zCount("zset_website", 9, 10));

//print_r($redis->zIncrBy("zset_webiste", 2, "google"));
// print_r($redis->zIncrBy("zset_webiste", -1, "baidu"));
// get_all_zset_key_vals('zset_website');
// $redis->zAdd("zset_website", "7", "hao123");

// print_r($redis->zRangeByScore("zset_website", 8, 10));

// echo $redis->zScore("zset_website", "google");

// echo $redis->zRank("zset_website", "google");

// echo $redis->zRem("zset_website", "baidu");
// echo $redis->zRem("zset_website", "tianmao");
// get_all_zset_key_vals('zset_website');

//print_r($redis->zRemRangeByRank("zset_website", 2, 4));
//get_all_zset_key_vals("zset_website");

// print_r($redis->zRemRangeByScore("zset_website", 8, 9));
// get_all_zset_key_vals("zset_website");

//get_all_zset_key_vals_desc("zset_website");

//print_r($redis->zRevRangeByScore("zset_website", 10, 7));

//echo $redis->zRevRank("zset_website", "360");
//ZUNIONSTORE salary 2 programmer manager WEIGHTS 1 3   # 公司决定加薪。。。除了程序员。。。

$redis->zAdd("zset_like", "100", "orange", "90", "apple");

//??????
// $redis->zunionstore("sum_like_website", "zset_like", "zset_website"); 
//get_all_zset_key_vals("sum_like_website");

//$redis->zinterstore();
