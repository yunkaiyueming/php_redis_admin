<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Redis</h1>
  <div class="row placeholders">
		Server服务器
	  <div class="table-responsive" >
		<table class="table table-striped">
			<tbody>
				<?php foreach($server_info as $key=>$info){?>
					<tr><th><?=$key?></th><th><?php if($key=='rdb_last_save_time'){echo date("Y-m-d H:i:s", $info);}else{echo $info;}?></th></tr>
				<?php }?>
					<tr><th>重写AOF</th><th><a href="<?=site_url("home/server_manage")."?action=aof"?>">重写AOF</a></th></tr>
					<tr><th>后台保存</th><th><a href="<?=site_url("home/server_manage")."?action=bgsave"?>">后台保存</a></th></tr>
					
					<tr><th>从服务器</th><th><a href="<?=site_url("")?>">从服务器</a></th></tr>
					<tr><th>主服务器</th><th><a href="<?=site_url("")?>">主服务器</a></th></tr>
					<tr><th>关闭服务器</th><th><a href="<?=site_url("")?>">关闭服务器</a></th></tr>
					
					<tr><th>备份服务器</th><th><a href="<?=site_url("")?>">备份服务器</a></th></tr>
					
					<tr><th>清空当前库</th><th><a href="<?=site_url("")?>">清空当前库</a></th></tr>
					<tr><th>清空整个库</th><th><a href="<?=site_url("")?>">清空整个库</a></th></tr>
			</tbody>
		</table>
		</div>
  </div>
</div>

