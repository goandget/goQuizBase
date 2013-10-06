<?php $this->load->view('layout/header'); ?>
	<h1>Register</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="<?php echo site_url('user/manage');?>">Manage</a> &raquo; <a href="#">Bulk Upload</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div>
			<?php echo form_open_multipart('user/manage');?>
			<table>
				<tr><th colspan="3">Import Bulk Users</th></tr>
				<tr>
					<td colspan="3">
						<p class="instruction">At the moment we only accept a csv file.<br />Please ensure that the headings of each field are in the first line of the csv as shown on the template below:<br />
						<a href="import-template.csv">Import Template</a>.</p>
						<div class="example">
						Forename,Surname,Email,Username,Password,Class,Year,Form,School,title,type<br />
						A,teacher,ateacher@school.wigan.sch.uk,ateacher,password,IT1,,,School,Mrs,1<br />
						A,Pupil,apupil@school.com,apupil,password,IT1,7,7A,School,,2<br />
						</div>
					</td>
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
					<td>Upload File:</td>
					<td><?php echo form_upload('file'); ?></td>
					<td><?php echo form_submit('import', 'import'); ?></td>
				</tr>
			</table>
<?php $this->load->view('layout/footer'); ?>