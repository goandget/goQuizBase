<?php $this->load->view('layout/header'); ?>
	<h1>Register</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<? echo site_url('user');?>">Home</a> &raquo; <a href="#">Manage</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div>
			<?php echo form_open_multipart('user/manage');?>
			<table>
				<tr><th colspan="3">Import Bulk Users</th></tr>
				<tr>
					<td colspan="3"><p class="instruction">At the moment we only accept a csv file.<br />Please ensure that the headings of each field are in the first line of the csv. </p></td>
				</tr>
				<tr>
					<td>Upload File:</td>
					<td><?php echo form_upload('file'); ?></td>
					<td><?php echo form_submit('import', 'import'); ?></td>
				</tr>
			</table>
			<p>&nbsp;</p>
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
						<a href="#<? echo site_url('user/edit/'.$user->id); ?>" onclick="alert('This feature isn\'t available yet!')">edit</a>
						<a href="<? echo site_url('user/delete/'.$user->id); ?>">del</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
<?php $this->load->view('layout/footer'); ?>