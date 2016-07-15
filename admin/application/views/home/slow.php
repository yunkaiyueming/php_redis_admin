<h1 class="page-header">Redis</h1>
  
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