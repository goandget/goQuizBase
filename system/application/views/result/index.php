<?php $this->load->view('layout/header'); ?>
	<h1>Results for: <? echo $school;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="#">Results</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div>
			<!--<h2>Overall View</h2>
			<table>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Class</th>
					<th>Year</th>
					<th>Best Result</th>
					<th>Last Result</th>
					<th>Average Result</th>
					<th>Attempts</th>
					<th>Last Time</th>
				</tr>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user->forename.' '.$user->surname;?></td>
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->class; ?></td>
					<td><?php echo $user->year; ?></td>
					<td><?php if(isset($bests[$user->id])) { echo $bests[$user->id]->correct; } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($lasts[$user->id])) { echo $lasts[$user->id]->correct;  } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($averages[$user->id])) { echo (int) ($averages[$user->id]->correct/$averages[$user->id]->taken);  } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($averages[$user->id])) { echo $averages[$user->id]->taken;  } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($lasts[$user->id])) { echo $lasts[$user->id]->start_time; } else { ?>N/A<?php } ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
			<hr>-->
			<h2>Last Assigned Quiz: Assign Details</h2>
			<?php
			if (isset($user))
			{ ?>
			<table>
				<tr>
					<th>Name</th>
					<?php
					for ($i=1;$i <= count($user); $i++)
					{
						echo '<th>Q'.$i.'</th>';
					}?>
					<th>Total</th>
					<th>Attempts</th>
				</tr>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user[0]->forename.' '.$user[0]->surname;?></td>
					<?php
					for ($i=0;$i < count($user); $i++)
					{
						echo '<td><img src="'.base_url().'img/correct'.$user[$i]->correct.'.png" /></td>';
					}
					echo '<td>'.$user[0]->total.'</td>';
					echo '<td>'.$user[0]->attempts.'</td>';
					?>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php
			}
			else 
			{
				?>
				<p>There are no results stored</p>
				<?php
			}?>
			<hr>
			<h2> Other Assigned Quizes: </h2>
		</div>
	</div>
<?php $this->load->view('layout/footer'); ?>