<?php $this->load->view('layout/header'); ?>
	<h1>Register</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="#">Manage</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>

		<div class="menu">
			<span class="button">Register User</span>
			<span class="button"><a href="<?php echo site_url('user/bulk_upload');?>">Bulk Import</a></span>
		</div>

		<div>
			<?php echo form_open_multipart('user/manage');?>
				<table>
					<tr>
						<th colspan="2">Register Single User</th>
					</tr>
					<tr>
						<td>School: </td>
					<?php if (is_array($school)) {?>
						<td><?php echo form_dropdown('school', $school); ?></td>	
					</tr>
					<tr>
						<td>New School:</td>
						<td><?php echo form_input('newschool', set_value('newschool'));?></td>
						<?php } else {
						echo form_hidden('school',$school); 
						echo '<td>'.$school.'</td>';
					}
					?>
					</tr>
					<tr>
						<td>Title: </td>
						<td><?php echo form_input('title', set_value('title'));?></td>
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
						<td><?php echo form_input('email', set_value('email'));?></td>
					</tr>
					<tr>
						<td>Class: </td>
						<td><?php echo form_input('class', set_value('class'));?></td>
					</tr>
					<tr>
						<td>Year: </td>
						<td><?php echo form_input('year', set_value('year'));?></td>
					</tr>
					<tr>
						<td>User Type: </td>
						<td><?php echo form_dropdown('type', array( 1 => 'Teacher',2 => 'Pupil'));?></td>
					</tr>
					<tr>
						<td>Username: </td>
						<td><?php echo form_input('username', set_value('username'));?></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><?php echo form_password('password', set_value('password'));?></td>
					</tr>
					<tr>
						<td>Confirm: </td>
						<td><?php echo form_password('confirm', set_value('confirm'));?></td>
					</tr>
				</table>

				<?php echo form_submit('register', 'Register');?>

			<?php echo form_close();?>
		</div>
		<div>
			<table>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Class</th>
					<th>&nbsp;</th>
				</tr>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user->forename.' '.$user->surname;?></td>
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->class; ?></td>
					<td>
						<a href="#<?php echo site_url('user/edit/'.$user->id); ?>" onclick="alert('This feature isn\'t available yet!')">edit</a>
						<a href="<?php echo site_url('user/delete/'.$user->id); ?>">del</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
<?php $this->load->view('layout/footer'); ?>