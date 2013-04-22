		<div class="grid12">
			<div>
				<div class="settings float-r">
					<img src="<?php echo base_url();?>/img/settings_small.png" alt="Settings Over" />
					<ul>
						<li><a href="" onc>View</a></li>
						<li><a href="<?php echo site_url();?>/questions/edit">Edit</a></li>
						<li><a href="<?php echo site_url();?>/questions/delete">Delete</a></li>
						<li class="sep">Updated: <?php echo $q->updated;?></li>
					</ul>
				</div>
				<div class="level float-l editable" contentEditable="true">
					<?php echo $q->level;?>
					<button class="save level">Save</button>
				</div>
				<div class="question float-l">
					<?php 
						if (isset($q->image))	{
					?>
							<img src="<?php echo base_url();?>img/quiz/1/<?php echo $q->image;?>" class="float-l" />
					<?php
						}
					?>
					<div class="editable" contentEditable="true"><?php echo $q->question;?><button class="save question">Save</button></div>
				</div>
			</div>
			<div class="answers clr-b">
						<?php $id = 'a'; ?>
						<table>
						<?php foreach($answers as $answer): ;?>
							<tr>
								<td><?php echo $id; ?>)</td>
								<td>
									<?php echo $answer->answer;?>
									<?php 
										if (isset($answer->image))	{
									?>
											<img src="<?php echo base_url();?>img/quiz/1/<?php echo $answer->image;?>" />
									<?php
										}
									?>
								</td>
								<td><img src="<?php echo base_url();;?>img/correct<?php echo $answer->correct;?>.png" /></td>
							</tr>
						<?php $id++; ;?>
						<?php endforeach; ;?>
						</table>
			</div>
			<div class="clr-b"></div>
		</div>
		<hr>