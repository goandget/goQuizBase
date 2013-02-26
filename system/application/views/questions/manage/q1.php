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
				<div class="level float-l">
					<?php echo $q->level;?>
				</div>
				<div class="question float-l">
					<?php 
						if (isset($q->image))	{
					?>
							<img src="<?php echo base_url();?>img/quiz/1/<?php echo $q->image;?>" class="float-l" />
					<?php
						}
					?>
					<?php echo $q->question;?>
				</div>
			</div>
			<div class="answers clr-b">
				This type question must be manually marked.
			</div>
			<div class="clr-b"></div>
		</div>
