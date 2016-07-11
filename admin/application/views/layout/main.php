<?php $this->load->view("include/header", $layout_data);?>

	<?php $this->load->view("include/sidebar/".$layout_data['side_bar'], $content);?>
	<?php echo $content;?>

<?php $this->load->view("include/footer");?>