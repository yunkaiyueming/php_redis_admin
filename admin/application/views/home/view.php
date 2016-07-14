<h1 class="page-header">Redis</h1>
  
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="table-responsive" >
	<table class="table table-striped" id="example">
	   <CAPTION>Key信息</CAPTION>
	  <thead>
		<tr>
			<th>Key</th><th>值</th><th>类型</th><th>过期时间(s)</th><th>编码</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
			<td><?=$key_name?></td>
			<td><?=$val?></td>
			<td><?=$key_type?></td>
			<td><?=$ttl?></td>
			<td><?=$key_encoding?></td>
		</tr>
		<tr><td><a href="<?=site_url("home/add_key?key=$key_name")?>">add value</a></td></tr>
	  </tbody>
	</table>
  </div>
</div>