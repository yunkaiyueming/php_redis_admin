<?php
include_once("../../lib/common.php");
include_once("log_lib.php");

$log_path = "D:/phpStudy2016/nginx/logs/access.log";
$log_infos = get_access_log($log_path);
record_log_into_redis($log_infos);
clear_access_log($log_path);