<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>Nginx Log</title>
		<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
		<script src="<?=base_url();?>assets/js/jquery-1.9.1.min.js"></script>
		<script src="<?=base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="<?=base_url();?>assets/js/jquery.dataTables.js"></script>
		<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="panel panel-default">
		<div class="panel-body">
			<table id="example" class="table">
				<thead>
					<tr role="row">
					<?php foreach($item_descs as $desc){?>
						<th><?php echo $desc;?></th>
					<?php }?>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($log_infos as $access_log_info){?>
						<tr><?php foreach($item_descs as $key){?>
							<td><?php echo $access_log_info[$key];?></td>
						<?php }?></tr>
					<?php }?>
				</tbody>
			</table>
		</div>
		</div>
	</body>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
</html>