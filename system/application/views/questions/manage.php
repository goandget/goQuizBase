<?php $this->load->view('layout/header'); ;?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		var type = '<?php echo set_value('type');?>';
	</script>
	<script src="<?php echo base_url();?>js/questions-admin.js"></script>

	<h1>Manage Questions</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url();?>/user">Home</a> &raquo; <a href="#">Manage Questions</a></p>
		<?php foreach($questions as $question): ?>
		<div class="grid12">
			<div>
				<div class="level float-l">
					<?php echo $question->level;?>
				</div>
				<div class="question float-l">
					<?php 
						if ($questions['image'])	{
					?>
							<img src="<?php echo base_url();?>img/quiz/1/<?php echo $questions['image'];?>" class="float-l" />
					<?php
						}
					?>
					<?php echo $question->question;?>
				</div>
				<div class="settings float-r">
					<img src="<?php echo base_url();?>/img/settings_small.png" alt="Settings Over" />
					<ul>
						<li><a href="" onc>View</a></li>
						<li><a href="<?php echo site_url();?>/questions/edit">Edit</a></li>
						<li><a href="<?php echo site_url();?>/questions/delete">Delete</a></li>
						<li class="sep">Updated: <?php echo $question->updated;?></li>
					</ul>
				</div>
			</div>
			<div class="answers">
				<?php if($question->type == 1): ;?>

					

				<?php elseif($question->type == 2): ;?>
						<?php $id = 'a'; ?>
						<table>
						<?php foreach($question->answers as $answer): ;?>
							<tr>
								<td><?php echo $id; ?>)</td>
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
			<div class="clr-b"></div>
		</div>
		<?php endforeach; ?>
	</div>
<?php $this->load->view('layout/footer'); ;?>