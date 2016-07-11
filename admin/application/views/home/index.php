<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Redis</h1>
  <div class="row placeholders">
		Server概况
	  <div class="table-responsive" >
		<table class="table table-striped">
			<tbody>
				<?php foreach($server_info as $key=>$info){?>
					<tr><th><?=$key?></th><th><?=$info?></th></tr>
				<?php }?>
			</tbody>
		</table>
		</div>
  </div>
</div>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="table-responsive">
	<table class="table table-striped" id="example">
	   <CAPTION>Key信息</CAPTION>
	  <thead>
		<tr>
			<th>Key</th><th>类型</th><th>编码</th><th>过期时间(s)</th><th>引用次数</th><th>操作</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php foreach($keys as $key){?>
		<tr>
			<td><?=$key['key']?></td>
			<td><?=$key['key_type']?></td>
			<td><?=$key['encoding']?></td>
			<td><?=$key['ttl']?></td>
			<td><?=$key['refcount']?></td>
			<td>
				<a href="<?=site_url("home/view_key")."?key=".$key['key']?>">View</a>
				<a href="<?=site_url("home/Edit_key")."?key=".$key['key']?>">Edit</a>
				<a href="<?=site_url("home/Del_key")."?key=".$key['key']?>">Del</a>
			</td>
		</tr>
	  <?php }?>
	  </tbody>
	</table>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>