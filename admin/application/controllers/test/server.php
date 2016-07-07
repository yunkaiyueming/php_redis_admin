<?php
include("lib/common.php");
echo "<pre>";

//echo $redis->dbSize(); echo "<br>";
// echo $redis->lastSave();
//print_r($redis->info());



print_r($redis->config("get", "*"));
// print_r($redis->config("get", "databases"));

// print_r($redis->time());

//echo $redis->flushAll();
//echo $redis->flushDB();

//echo $redis->config("set", "maxmemory", "200");
print_r($redis->config("get", "databases"));

