<h1 class="page-header">Redis</h1>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="table-responsive" >
	<form method="post">
	<table class="table table-striped" id="example">
		<CAPTION>Key信息</CAPTION>
		<tbody>
		  <tr><td>Key : </td><td><?=$key_name?></td></tr>
		  <tr>
			  <?php if($key_type!='hash'){?>
				  <td>Val ：</td>
				  <td><?=str_replace("<br>", " ", $val)?></td>
			  <?php }?>
		  </tr>
		  <tr><td>add:</td><td><textarea name="field_val" cols="100" rows="10"></textarea></td></tr>
		  <tr><td><input type="submit" name="submit" value="submit"></td><td><input type="reset" name="reset" value="reset"></td></tr>
		</tbody>
		<input type="hidden" name="action" value="1">
	</table>
	</form>
  </div>
</div>