<?php $this->load->view('layout/header'); ?>
	<h1>Results for: <? echo $school;?></h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<? echo site_url('user');?>">Home</a> &raquo; <a href="#">Results</a></p>

		<p style="color:red;font-weight:bold;"><?php echo $error;?></p>
		<div class="float-l">
			<table>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Class</th>
					<th>Year</th>
					<th>Best Result</th>
					<th>Last Time: Last Result</th>
					<th>Average Result</th>
					<th>Number Taken</th>
				</tr>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user->forename.' '.$user->surname;?></td>
					<td><?php echo $user->username;?></td>
					<td><?php echo $user->class; ?></td>
					<td><?php echo $user->year; ?></td>
					<td><?php if(isset($bests[$user->id])) { echo $bests[$user->id]->correct; } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($lasts[$user->id])) { echo $lasts[$user->id]->start_time; ?>: <?php echo $lasts[$user->id]->correct;  } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($averages[$user->id])) { echo (int) ($averages[$user->id]->correct/$averages[$user->id]->taken);  } else { ?>N/A<?php } ?></td>
					<td><?php if(isset($averages[$user->id])) { echo $averages[$user->id]->taken;  } else { ?>N/A<?php } ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
<?php $this->load->view('layout/footer'); ?>