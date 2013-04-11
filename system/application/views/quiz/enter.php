<?php $this->load->view('layout/header'); ?>

	<h1>Take Quizz</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url()?>">Home</a> &raquo; <a href="<?php echo site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Take Quiz</a></p>

		<?php echo form_open('quiz/enter')?>
			<p style="color:red;font-weight:bold;"><?php echo $error?></p>

			<table>
				<tr>
					<td>Quiz ID: </td>
					<td><?php echo form_input('id', set_value('id'))?></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><?php echo form_password('password', set_value('password'))?></td>
				</tr>
			</table>

			<?php echo form_submit('enter', 'Enter')?>
		<?php echo form_close()?>
	</div>
<?php $this->load->view('layout/footer'); ?>
