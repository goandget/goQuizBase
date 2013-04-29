<?php $this->load->view('layout/header'); ?>

	
	
	<h1>Create a Quizz</h1>

	<div id="body">
		<p class="breadcrumbs"><a href="<?=site_url()?>">Home</a> &raquo; <a href="<?=site_url('quiz')?>">Quizzes</a> &raquo; <a href="#">Assign</a></p>
		<p class="float-l">Assign Quiz: <?php echo $quiz[0]->name;?></p>
		<p class="float-l">Number of Attempts: <span class='editable attempts' contentEditable="true">2</span></p>
		<p class="clr-b instruction">Click on either the User or the Class to assign this Quiz.</p>
		<p>Quick Find: <input type="text" id="quickfind"><a id="cleanfilters">Clear Filters</a></p>
		<table id="users">
			<thead>
				<tr>
					<th>Name</th>
					<th>Class</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<td><a class="assign" alt="<?php echo $user->id;?>"><?php echo $user->forename.' '.$user->surname;?></a></td>
				<td><a class="assign"><?php echo $user->class; ?></a></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		var base_url = '<?php echo base_url();?>';
	</script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/picnet.table.filter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/assign-admin.js"></script>
<?php $this->load->view('layout/footer'); ?>