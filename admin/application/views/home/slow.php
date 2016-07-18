<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header">Redis</h1>
	<div class="row placeholders">
		<div class="table-responsive" >
		  <table class="table table-striped">
			<tbody>
				<tr><th>慢日志条数</th><th><?=$slow_logs_nums?></th></tr>
				<tr><th>慢日志时间</th><th><?=$slowlog_time?>ms</th></tr>
				<tr><th>最多慢日志条数</th><th><?=$slowlog_max_num?></th></tr>
				<tr><th>清空日志</th><th><a href="<?=site_url("home/slow?action=reset")?>">清空日志</a></th></tr>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="table-responsive" >
	<table class="table table-striped" id="example">
	   <CAPTION>Key信息</CAPTION>
	  <thead>
		<tr>
			<th>int</th><th>int</th><th>int</th><th>sql</th>
		</tr>
	  </thead>
	  <tbody>	
		<?php foreach($slow_infos as $slow_log){?>
		  <tr>
			<td><?=$slow_log['0']?></td>
			<td><?=$slow_log['1']?></td>
			<td><?=$slow_log['2']?></td>
			<td><?=is_array($slow_log['3'])?implode(" ", $slow_log[3]):$slow_log[3]?></td>
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