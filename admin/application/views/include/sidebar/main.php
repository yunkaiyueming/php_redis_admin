<?php
$db = $this->input->get_post('db');
$db = empty($db)?0:$db;
$sidebar_data = array(
	array('url' =>'home/index?type=string&db='.$db, 'desc'=>'String'),
	array('url' =>'home/index?type=list&db='.$db, 'desc'=>'List'),
	array('url' =>'home/index?type=set&db='.$db, 'desc'=>'Set'),
	array('url' =>'home/index?type=zset&db='.$db, 'desc'=>'Zset'),
	array('url' =>'home/index?type=hash&db='.$db, 'desc'=>'Hash'),
);
?>

<div class="container-fluid">
  <div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">选择库：</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<?php for($i=0;$i<$database_num;$i++){?>
			<li <?php if($i==$this->input->get_post('db')){echo "class='selected'";}?>><a href="<?=site_url("home/index")."?db=$i"?>"><?="db".$i?></a></li>
			<?php } ?>
		</ul>
	</div>
		
	<ul class="nav nav-sidebar">
		<li <?php $type = $this->input->get_post('type');if(empty($type)){echo 'class="active"';}?>><a href="<?=site_url("home/index")?>">Dashboard</a></li>
	</ul>
	
	<ul class="nav nav-sidebar">
		<?php foreach($sidebar_data as $sidebar_info){?>
		  <li <?php if($this->input->get_post('type')==strtolower($sidebar_info['desc'])){echo "class='active'";}?> ><a href="<?=site_url($sidebar_info['url'])?>"><?=$sidebar_info['desc']?></a></li>
		<?php }?>
	</ul>
	</div>
	  
<script type="text/javascript">
	$(function(){
		$("select[name='db']").change(function(){
			window.location.href="<?=site_url("home/index")?>"+"?db="+this.value;
		})
	});
</script>