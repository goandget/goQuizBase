<?php $this->load->view('layout/header'); ?>
	<h1>Login</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url(); ?>">Home</a> &raquo; <a href="#">Login</a></p>
		<p style="color:red;font-weight:bold;"><?php echo $error; ?></p>

		<?php echo form_open('user/login'); ?>
			<table>
				<tr>
					<td>School: </td>
				<?php if (is_array($school)) {?>
					<td><?php echo form_dropdown('school', $school); ?></td>
				</tr><?php } else {
					echo form_hidden('school',$school); 
					echo '<td>'.$school.'</td>';
				}
				?>
				<tr>
					<td>Username: </td>
					<td><?php echo form_input('username', set_value('username')); ?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?php echo form_password('password', set_value('password')); ?></td>
				</tr>
			</table>

			<?php echo form_submit('login', 'Login'); ?>

		<?php echo form_close()?>

		<!--<p>Don't have an account? <a href="<?php echo site_url('user/register'); ?>">Register</a></p>-->
	</div>
<?php $this->load->view('layout/footer'); ?>