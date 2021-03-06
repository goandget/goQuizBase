<?php $this->load->view('layout/header'); ?>
	<h1>Register</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="#">Register</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>

		<?=form_open('user/register')?>
			<table>
				<tr>
					<td>School: </td>
					<td><?=form_input('school', set_value('school'))?></td>
				</tr>
				<tr>
					<td>Title: </td>
					<td><?=form_dropdown('title', array('' => 'N/A','Mr' => 'Mr','Mrs' => 'Mrs','Miss' => 'Miss','Ms' => 'Ms'))?></td>
				</tr>
				<tr>
					<td>Forename: </td>
					<td><?php echo form_input('forename', set_value('forename'));?></td>
				</tr>
				<tr>
					<td>Surname: </td>
					<td><?php echo form_input('surname', set_value('surname'));?></td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><?=form_input('email', set_value('email'))?></td>
				</tr>
				<tr>
					<td>Type: </td>
					<td><?=form_dropdown('type', array(1 => 'Teacher',2 => 'Pupil'))?></td>
				</tr>
				<tr>
					<td>Username: </td>
					<td><?=form_input('username', set_value('username'))?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?=form_password('password', set_value('password'))?></td>
				</tr>
				<tr>
					<td>Confirm: </td>
					<td><?=form_password('confirm', set_value('confirm'))?></td>
				</tr>
			</table>

			<?=form_submit('register', 'Register')?>

		<?=form_close()?>

		<p>Already have an account? <a href="<?=site_url('user/login')?>">Login</a></div>
<?php $this->load->view('layout/footer'); ?>