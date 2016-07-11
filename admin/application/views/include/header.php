<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>PHP REDIS Admin</title>
    <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/dashboard.css" rel="stylesheet">
	<script src="<?=base_url();?>assets/js/jquery-1.9.1.min.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.dataTables.js"></script>
	<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
  </head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">PHP REDIS Admin</a>
	  </div>
		
	  <div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#">Dashboard</a></li>
		  <li><a href="#">Settings</a></li>
		  <li><a href="#">Profile</a></li>
		  <li><a href="#">Help</a></li>
		</ul>
		<form class="navbar-form navbar-right">
		  <input type="text" class="form-control" placeholder="Search...">
		</form>
	  </div>
		
	</div>
  </nav>