		<div class="grid12">
			<div class="hidden id"><?php echo $q->id;?></div>
			<div class="hidden type">3</div>
			<div>
				<div class="settings float-r">
					<img src="<?php echo base_url();?>/img/settings_small.png" alt="Settings Over" />
					<ul>
						<li><a href="#" class="setting">View</a></li>
						<!--<li><a href="<?php echo site_url();?>/questions/edit">Edit</a></li>-->
						<li><a href="#" class="setting">Delete</a></li>
						<li class="sep">Updated: <?php echo $q->updated;?></li>
					</ul>
				</div>
				<div class="editable level float-l" contentEditable="true">
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
								<td><div class="ansid hidden"><?php echo $answer->id;?></div>
									<div class="editable" contentEditable="true">
										<?php echo $answer->answer;?>
										<button class="save answer">Save</button>
									</div>
									<?php 
										if (isset($answer->image))	{
									?>
											<img src="<?php echo base_url();?>img/quiz/1/<?php echo $answer->image;?>" />
									<?php
										}
									?>
								</td>
								<td><img src="<?php echo base_url();?>img/correct<?php echo $answer->correct;?>.png" class="correct" /></td>
							</tr>
						<?php $id++; ;?>
						<?php endforeach; ;?>
						</table>
			</div>
			<div class="clr-b"></div>
		</div>
		<hr>
