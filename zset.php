<?php
include("lib/common.php");
echo "<pre>";
/*
    ZADD 将一个或多个 member 元素及其 score 值加入到有序集 key 当中
    ZCARD 返回有序集 key 的基数。
    ZCOUNT  返回有序集key中,score 值在 min 和 max 之间(默认包括 score 值等于 min 或 max )的成员的数量
    ZINCRBY  
    ZRANGE 返回有序集 key 中，指定区间内的成员。
    ZRANGEBYSCORE
    ZRANK 返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递增(从小到大)顺序排列
    ZREM
    ZREMRANGEBYRANK
    ZREMRANGEBYSCORE
    ZREVRANGE
    ZREVRANGEBYSCORE
    ZREVRANK
    ZSCORE
    ZUNIONSTORE
    ZINTERSTORE
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

get_all_list_key_vals('zset_website');
$redis->zAdd("zset_website", "10", "baidu", "9", "google");
$redis->zAdd("zset_website", "8", "sou");
get_all_list_key_vals('zset_website');

echo $redis->zCard("zset_website");
get_all_list_key_vals('zset_website');

// print_r($redis->zCount("zset_website", 9, 10));

// print_r($redis->zIncrBy());
// print_r($redis->zIncrBy());

// $redis->zRange();
// $redis->zRank();
