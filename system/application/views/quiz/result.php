<?php $this->load->view('layout/header'); ;?>

	<h1><?php echo $name;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="<?php echo site_url('quiz');?>">Quizzes</a> &raquo; <a href="#">Take Quiz</a></p>

		<?php echo form_open('quiz/take');?>
			<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
			<?php $total = 0; $correct = 0; ?>
			<table>
			<?php $i = $start; ?>
			<?php foreach($results as $result): ;?>
				<tr>
					<td>
						<p style="font-weight:bold;"><?php echo $i;?>) <?php echo $result->question;?></p>
						<?php 
							if ($result->image)	{
						?>
							<img src="<?php echo base_url();?>img/quiz/1/<?php echo $result->image;?>" />
						<?php
							}
						?>
					</td>
					<td><?php
						if (!is_null($result->correct))
						{?>
							<img src="<?php echo base_url();?>img/correct<?php echo $result->correct;?>.png" /></br>
							Question Completed in 
							<?php
							// Calculate Total
							if ($result->correct) {
								$correct++;
							}
							$total++;
							// Caluculate Time Taken
							if (!isset($lasttime)) {
								$lasttime = strtotime($result->start_time);
							}
							echo secs_to_h(strtotime($result->recorded)-$lasttime);
							$lasttime = strtotime($result->recorded);
							
						}
						else
						{
							echo "- - -";
							$total++;
						}?>
						
					</td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ;?>
				<tr>
					<td colspan="2">
					<?php
						// Calculate Total
						if (isset($finish)) {
							echo 'Total: ';
						}
						else {
							echo 'Result of Last 10: ';
						}
						?>
					<?php echo $correct;?>/<?php echo $total;?></td>
				</tr>
			</table>
				<hr><?php if (isset($finish)) {?>
						<a href="<?php echo site_url('user');?>">Finish Test</a> 
						<?php } else { ?>
							echo 'Result of Last 10: ';
						<?php } ?>
		<?php echo form_close();?>
	</div>
<?php $this->load->view('layout/footer'); ;?>