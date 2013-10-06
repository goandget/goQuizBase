<?php $this->load->view('layout/header'); ?>

	
	
	<h1>Create a Quizz</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?php echo site_url('user');?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Assign</a></p>
		<p>Assign Quiz: <?php echo $quiz[0]->name;?></p>
		<p>Number of Attempts: <span class='editable attempts' contentEditable="true">1</span></p>
		<p>Start Date: <input type="text" id="startDate"  readonly/></p>
		<p>End Date: <input type="text" id="endDate" readonly /></p>
		<p class="clr-b instruction">Click on either the User or the Class to assign this Quiz.</p>
		<p>Quick Find: <input type="text" id="quickfind"><a id="cleanfilters">Clear Filters</a></p>
		<table id="users" width="90%">
			<thead>
				<tr>
					<th>Name</th>
					<th>Class</th>
				<?php if ($admin) { ?>
					<th>School</th>
				<?php } ?>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<td><a class="assign" alt="<?php echo $user->id;?>"><?php echo $user->forename.' '.$user->surname;?></a></td>
				<td><a class="assign"><?php echo $user->class; ?></a></td>
				<?php if ($admin) { ?>
				<td><?php echo $user->school; ?></td>
				<?php } ?>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		var base_url = '<?php echo base_url();?>';
	</script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
  	<script src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/picnet.table.filter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/assign-admin.js"></script>
  	<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<?php $this->load->view('layout/footer'); ?>