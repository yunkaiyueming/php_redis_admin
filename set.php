<?php
include("lib/common.php");
echo "<pre>";

/*	
	SADD
	SCARD 返回集合 key 的基数(集合中元素的数量)。
	SDIFF 返回一个集合的全部成员，该集合是所有给定集合之间的差集。
	SDIFFSTORE 这个命令的作用和 SDIFF 类似，但它将结果保存到 destination 集合，而不是简单地返回结果集。
	SINTER 返回一个集合的全部成员，该集合是所有给定集合的交集。
	SINTERSTORE 这个命令类似于 SINTER 命令，但它将结果保存到 destination 集合，而不是简单地返回结果集。
	SISMEMBER
	SMEMBERS
	SMOVE 将 member 元素从 source 集合移动到 destination 集合。
	SPOP 移除并返回集合中的一个随机元素
	SRANDMEMBER 如果命令执行时，只提供了 key 参数，那么返回集合中的一个随机元素。
	SREM 移除集合 key 中的一个或多个 member 元素，不存在的 member 元素会被忽略。
	SUNION 返回一个集合的全部成员，该集合是所有给定集合的并集。
	SUNIONSTORE 这个命令类似于 SUNION 命令，但它将结果保存到 destination 集合，而不是简单地返回结果集。
	SSCAN
 */

// $redis->sAdd('set_user', 'aa', 'bb');
// $set_user_members = $redis->sMembers("set_user");
// print_r($set_user_members);

// echo $redis->scard("set_user");

// $redis->sAdd('set_movie', 'aa', '2014', 'wom');
// print_r($redis->sDiff("set_user", "set_movie"));

// echo $redis->sDiffStore('user_diff_movie', 'set_user', 'set_movie');
// $user_diff_movie_members = $redis->sMembers("user_diff_movie");
// print_r($user_diff_movie_members);

// print_r($redis->sInter("set_user", "set_movie"));

// print_r($redis->sInterStore('user_inter_movie', "set_user", "set_movie"));
// $user_inter_movie_members = $redis->sMembers("user_inter_movie");
// print_r($user_inter_movie_members);

// var_dump($redis->sismember("set_user", 'aa'));

// $redis->sMove("set_user", "set_movie", "aa");

// $redis->sAdd("set_user", "cc", "dd");
// $redis->sPop("set_user");

// var_dump($redis->sUnion("set_user", 'set_movie'));

// $redis->sUnionStore("union_user_movie", "set_user", "set_movie");
// $union_user_movie_members = $redis->sMembers("union_user_movie");
// print_r($union_user_movie_members);

echo $redis->sRandMember('union_user_movie');

$redis->srem("union_user_movie", "wom");
$union_user_movie_members = $redis->sMembers("union_user_movie");
print_r($union_user_movie_members);

