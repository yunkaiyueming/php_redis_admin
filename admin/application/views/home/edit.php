<h1 class="page-header">Redis</h1>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <div class="table-responsive" >
	<form action="" method="post">
	<table class="table table-striped" id="example">
		<CAPTION>Key信息</CAPTION>
		<tbody>
		  <tr><td>Key : </td><td><?=$key_name?></td></tr>
		  <tr>
			  <?php if($key_type!='hash'){?>
				  <td>Val ：</td>
				  <td><textarea name="vals" cols="100" rows="10"><?=  str_replace("<br>", " ", $val)?></textarea></td>
			  <?php }?>
		  </tr>
		  <tr><td><input type="submit" name="submit" value="submit"></td><td><input type="reset" name="reset" value="reset"></td></tr>
		</tbody>
	</table>
	</form>
  </div>
</div>