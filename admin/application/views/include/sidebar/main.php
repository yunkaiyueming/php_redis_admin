<?php
$sidebar_data = array(
	array('url' =>'home/index?type=string', 'desc'=>'String'),
	array('url' =>'home/index?type=list', 'desc'=>'List'),
	array('url' =>'home/index?type=set', 'desc'=>'Set'),
	array('url' =>'home/index?type=zset', 'desc'=>'Zset'),
	array('url' =>'home/index?type=hash', 'desc'=>'Hash'),
);
?>

<div class="container-fluid">
  <div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	  <ul class="nav nav-sidebar">
		<li <?php $type = $this->input->get_post('type');if(empty($type)){echo 'class="active"';}?>><a href="<?=site_url("home/index")?>">Dashboard<span class="sr-only">(current)</span></a></li>
	  </ul>
	  <ul class="nav nav-sidebar">
		<?php foreach($sidebar_data as $sidebar_info){?>
		  <li <?php if($this->input->get_post('type')==strtolower($sidebar_info['desc'])){echo "class='active'";}?> ><a href="<?=site_url($sidebar_info['url'])?>"><?=$sidebar_info['desc']?></a></li>
		<?php }?>
	  </ul>
	</div>