<?php $this->load->view('layout/header'); ;?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		var type = '<?php echo set_value('type');?>';
	</script>
	<script src="<?php echo base_url();?>js/questions-admin.js"></script>

	<h1>Add a Question</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url();?>">Home</a> &raquo; <a href="#">Manage Questions</a></p>

		<?php echo form_open('quiz/add_question/');?>
			<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
			<h3>Question:</h3>
			<table>
				<tr>
					<td colspan="2"><?php echo form_textarea('question', set_value('question'));?></td>
				</tr>
				<tr>
					<td>Image with Questions: </td>
					<td><?php echo form_upload('qimage'); ?></td>
				</tr>
				<tr>
					<td>Type: </td>
					<td><?php echo form_dropdown('type', $types, set_value('type'), 'onchange="add_fields()" class="type"');?></td>
				</tr>
			</table>

			<hr style="margin-top:30px;">

			<div <?php echo question_type('1');?> class="qtype">
				<p>Answer:</p>
				
				<?php echo form_textarea('free_response_answer', _value('free_response_answer'));?>
				
				<p style="font-style:italic;">If no answer is given, the students' answers will need to be manually checked.</p>
			</div>
			<div <?php echo question_type('2');?> class="qtype">
				<h3>Answers:</h3>
				Number of Answers:<?php echo form_input('no_answers', '4', 'onchange="add_answers()" class="no_answers"');?>
				<div class="multianswers">
					<table>
						<tr>
							<th></th>
							<th>Answer</th>
							<th>Answer Image</th>
							<th>Correct?</th>
						</tr>
						<tr>
							<td>a:</td>
							<td><?php echo form_input('answer1', '', 'onchange="add_answers()" class="no_answers"');?></td>
							<td><?php echo form_upload('aimage-1'); ?></td>
							<td>Yes <?php echo form_radio('correct-1','yes'); ?> No <?php echo form_radio('correct-1','no'); ?></td>
						</tr>
						<tr>
							<td>b:</td>
							<td><?php echo form_input('answer2', '', 'onchange="add_answers()" class="no_answers"');?></td>
							<td><?php echo form_upload('aimage-2'); ?></td>
							<td>Yes <?php echo form_radio('correct-2','yes'); ?> No <?php echo form_radio('correct-2','no'); ?></td>
						</tr>
						<tr>
							<td>c:</td>
							<td><?php echo form_input('answer3', '', 'onchange="add_answers()" class="no_answers"');?></td>
							<td><?php echo form_upload('aimage-3'); ?></td>
							<td>Yes <?php echo form_radio('correct-3','yes'); ?> No <?php echo form_radio('correct-3','no'); ?></td>
						</tr>
						<tr>
							<td>d:</td>
							<td><?php echo form_input('answer4', '', 'onchange="add_answers()" class="no_answers"');?></td>
							<td><?php echo form_upload('aimage-4'); ?></td>
							<td>Yes <?php echo form_radio('correct-4','yes'); ?> No <?php echo form_radio('correct-4','no'); ?></td>
						</tr>
					</table>
				</div>
			</div>

			<br />

			<?php echo form_submit('add', 'Add');?>
		<?php echo form_close();?>
	</div>
<?php $this->load->view('layout/footer'); ;?>