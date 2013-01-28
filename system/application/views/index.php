<?php $this->load->view('layout/header'); ?>
	<h1>Welcome to the Baseline Testing Site!</h1>

	<div id="body">
		<p>Welcome to the <strong>Baseline Testing Site</strong>.</p>

		<?php if( ! $this->account->logged_in()):?>
			<p><a href="<?=site_url('user/register')?>">Register</a> | <a href="<?=site_url('user/login')?>">Login</a></p>
		<?php else: ?>
			<p><a href="<?=site_url('user')?>">My Account</a> | <a href="<?=site_url('user/logout')?>">Logout</a></p>
		<?php endif; ?>
	</div>
<?php $this->load->view('layout/footer'); ?>