<?php $this->load->view('layout/header'); ?>
	<h1>Results for: <? echo $school;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="<?php echo site_url('result');?>">Results</a> &raquo; <a href="<?php echo site_url('result/overview');?>">Over View</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div>
			<h2>Overall View</h2>
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
			<hr>
		</div>
	</div>
<?php $this->load->view('layout/footer'); ?>