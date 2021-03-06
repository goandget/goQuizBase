<?php $this->load->view('layout/header'); ;?>

	<h1><?php echo $name;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="<?php echo site_url('quiz');?>">Quizzes</a> &raquo; <a href="#">Take Quiz</a></p>

		<?php echo form_open('quiz/take',array('id'=>'questionForm'));?>
			<p style="color:red;font-weight:bold;"><?php echo $error;?></p>

				<p style="font-weight:bold;"><?php echo $current;?>) <?php echo $questions['question'];?></p>
				<?php 
					if ($questions['image'])	{
				?>
						<img src="<?php echo base_url();?>img/quiz/1/<?php echo $questions['id'];?>/<?php echo $questions['image'];?>" />
				<?php
					}
				?>
				<div class="answer">
					<div class="answerreveal"><?php echo $questions['answerreveal']; ?></div>
					<?php echo form_hidden('question_id',$questions['id']); ?>
					<?php if($questions['type'] == 1): ;?>

						<?php echo form_textarea('answer', '', '');?>

					<?php elseif($questions['type']== 2): ;?>
							<?php $id = 'a'; ?>
							<table>
							<?php foreach($answers as $answer): ;?>
								<tr>
									<td><?php echo $id; ?>)</td>
									<td><input type="radio" name="answer" value="<?php echo $answer->id;?>"></td>
									<td>
										<?php echo $answer->answer;?>
										<?php 
											if ($answer->image)	{
										?>
												<img src="<?php echo base_url();?>img/quiz/1/<?php echo $questions['id'];?>/<?php echo $answer->image;?>" />
										<?php
											}
										?>
									</td>
								</tr>
							<?php $id++; ;?>
							<?php endforeach; ;?>
							</table>

					<?php elseif($questions['type']== 3): ;?>
							<?php $id = 'a'; ?>
							<table>
							<?php foreach($answers as $answer): ;?>
								<tr>
									<td><?php echo $id; ?>)</td>
									<td><input type="checkbox" name="answer[]" value="<?php echo $answer->id;?>"></td>
									<td>
										<?php echo $answer->answer;?>
										<?php 
											if ($answer->image)	{
										?>
												<img src="<?php echo base_url();?>img/quiz/1/<?php echo $answer->image;?>" />
										<?php
											}
										?>
									</td>
								</tr>
							<?php $id++; ;?>
							<?php endforeach; ;?>
							</table>

					<?php endif; ;?>
				</div>
				<hr>
			<?php if (isset($next))	{ echo form_hidden('start',$next); ?><?php echo form_submit('next', 'next'); } else {echo form_submit('finish', 'finish');}?>
			<div id="timeout"><?php echo $questions['questiontime']; ?></div>
		<?php echo form_close();?>
	</div>
	<script src="<?php echo base_url();?>/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url();?>/js/quiz.js"></script>
<?php $this->load->view('layout/footer'); ;?>
