<?php $this->load->view('layout/header'); ?>
	<h1>Welcome Back! <?php echo $forename;?> <?php echo $surname;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url('user')?>">Home</a> &raquo; <a href="#">Account</a></p>

		<p>Here you can manage your account, take and create quizzes.</p>

		<ul>
			<?php if ($type == 1) {?><li><a href="<?php echo site_url('user/manage'); ?>">Manage Account</a></li><?php } ?>
			<!--<li><a href="<?=site_url('quiz')?>">Manage My Quizzes</a></li>-->
			<?php if (strtolower($school) == 'admin') {?><li><a href="<?php echo site_url('quiz/questions'); ?>">Manage the Questions</a></li><?php } ?>
			<li><a href="<?php echo site_url('quiz/take'); ?>">Take a Quiz</a></li>
			<?php if ($type == 1) {?><li><a href="<?php echo site_url('result'); ?>">View Results</a></li><?php } ?>
			<li><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>
		</ul>
	</div>
<?php $this->load->view('layout/footer'); ?>