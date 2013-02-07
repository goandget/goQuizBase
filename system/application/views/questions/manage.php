<?php $this->load->view('layout/header'); ;?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		var type = '<?php echo set_value('type');?>';
	</script>
	<script src="<?php echo base_url();?>js/questions-admin.js"></script>

	<h1>Manage Questions</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url();?>/user">Home</a> &raquo; <a href="#">Manage Questions</a></p>
		<?php foreach($questions as $question): ?>
		<div class="grid12">
			<div class="question float-l">
				<div class="float-r">
					<img src="img/settings.png" alt="Settings Over" />
					<ul>
						<li><a href="<?php echo site_url();?>/question/edit">Edit</a></li>
						<li><a href="<?php echo site_url();?>/question/delete">Delete</a></li>
						<li class="sep">Updated: <?php echo $question->updated;?></li>
					</ul>
				</div>
				<?php echo $question->question;?>
			</div>
			<div class="float-l">
				<img src="img/level.png" alt="Question Level" />
				<?php echo $question->level;?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php $this->load->view('layout/footer'); ;?>