<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper("my_redis");
	}
	
	public function log_string(){
		$redis = get_redis_obj();
		for($i=1; $i<1000; $i++){
			echo $redis->set("city_".$i, "china_".$i);
		}
	}
	
	public function log_list(){
		$redis = get_redis_obj();
		for($day=0; $day<10; $day++){
			for($i=1; $i<20; $i++){
				echo $redis->lPush($day."_day_cost", $i);
			}
		}
	}
	
	public function log_set(){
		$redis = get_redis_obj();
		for($day=0; $day<10; $day++){
			for($i=1; $i<20; $i++){
				echo $redis->sAdd("like_$day", $i);
			}
		}
	}
	
	public function log_zset(){
		
	}
	
	public function log_hash(){
		$redis = get_redis_obj();
		for($j=1; $j<500; $j++){
			$user_info = array('id'=>$j, "name"=>'tony_$i', 'age'=>rand(1, 100));
			echo $redis->hMset("user:".$j, $user_info);
		}
	}
	
}