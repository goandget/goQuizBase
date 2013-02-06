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
			<div class="question float-l"><?php echo $question->question;?></div>
			<td><?php echo $user->username;?></td>
			<td><?php echo $user->class; ?></td>
			<td>
				<div class="float-r">
					
					<a href="#<? echo site_url('user/edit/'.$user->id); ?>" onclick="alert('This feature isn\'t available yet!')">edit</a>
					<a href="<? echo site_url('user/delete/'.$user->id); ?>">del</a>
				</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php $this->load->view('layout/footer'); ;?>