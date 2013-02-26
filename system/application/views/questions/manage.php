<?php $this->load->view('layout/header'); ;?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		var type = '<?php echo set_value('type');?>';
	</script>
	<script src="<?php echo base_url();?>js/questions-admin.js"></script>

	<h1>Manage Questions</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url();?>/user">Home</a> &raquo; <a href="#">Manage Questions</a></p>
		
	</div>
<?php $this->load->view('layout/footer'); ;?>
