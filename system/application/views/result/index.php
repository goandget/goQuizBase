<?php $this->load->view('layout/header'); ?>
	<h1>Results for: <? echo $school;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="#">Results</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div>
			<h2>Last Assigned Quiz: Assign Details</h2>
			<?php
			if (is_array($users))
			{ ?>
			<table width="90%">
				<tr>
					<th>Name</th>
					<th>&nbsp;</th>
					<th>Result</th>
					<th>Attempts</th>
				</tr>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user[0]->forename.' '.$user[0]->surname;?></td><td>
					<table><tr>
					<?php
					$row1 = '';
					$row2 = '<tr>';
					for ($i=0;$i < count($user); $i++)
					{
						if (($i %20 == 0)&&($i != 0))
						{
							echo $row1.'</tr>';
							echo $row2.'</tr>';
							$row1 = '<tr>';
							$row2 = '<tr>';
						}
						$row1.= '<th>Q'.($i+1).'</th>';
						$row2.= '<td><img src="'.base_url().'img/correct'.$user[$i]->correct.'.png" /></td>';
					}
					echo $row1.'</tr>';
					echo $row2.'</tr>';
					$total = $i;
					while ($i % 21 == 0)
					{
						echo '<td>&nbsp;</td>';
						$i++;
					}
					echo '</tr>';
					?>
					</table>
					<?php
						echo '<td>'.$user[0]->total.' / '.$total.'</td><td>'.$user[0]->attempts.'</td>';
					?>
				</tr>
				<?php endforeach; ?>
			</table>
			Export these results: <a href="<?php echo site_url('result/export/'.$this->uri->segment(3)); ?>">export</a>
			<?php
			}
			else 
			{
			?>
				<p>There are no results stored.</p>
			<?php }?>
			<hr>
			<h2> Other Assigned Quizes: </h2>
			<table>
				<tr>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Type</th>
					<th>Assigned</th>
					<th>&nbsp;</th>
				</tr>
			<?php foreach($assign as $assigned): ?>
				<tr>
					<td><?php echo $assigned['start_date']; ?></td>
					<td><?php echo $assigned['end_date']; ?></td>
					<td><?php echo $assigned['type']; ?></td>
					<td><?php echo $assigned['assign']; ?></td>
					<td><a href="<?php echo site_url('result/view/'.$assigned['id']); ?>">View Results</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
<?php $this->load->view('layout/footer'); ?>