<script type="text/javascript">
	jQuery(function($) {
		var table = $('.table-striped').dataTable({
			"bPaginate": false, //翻页功能
			"bLengthChange": false, //改变每页显示数据数量
			"bFilter": false, //过滤功能
			"bSort": true, //排序功能
			"bInfo": false,//页脚信息
			"bAutoWidth": false,//自动宽度
			"bProcessing":false,//是否显示“正在处理”这个提示信息
			"aaSorting": [<?php echo $sort;?>, "<?php echo $order_by;?>"],//默认排序列
			"columnDefs": [
						{ type: 'formatted-num', targets: '_all' }
					]
		});
//		var $floattable = $('.table-responsive');
//		$floattable.floatThead();
//		$('.am-scrollable-horizontal').on('scroll', function(e) {
//			$floattable.floatThead('reflow');
//		});
	});
</script>