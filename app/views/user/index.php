<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">User</h4>
			<?php 
				if(isEqual($content_title,'members')){
					echo wLinkDefault(_route('user:create', null, [
						'user_type' => 'MEMBER'
					]), 'Create New Member', );
				}

				if(isEqual($content_title,'instructors')){
					echo wLinkDefault(_route('user:create', null, [
						'user_type' => 'INSTRUCTOR'
					]), 'Create New Instructor', );
				}
			?>
		</div>
		
		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive" style="min-height: 30vh;">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Name</th>
						<th>ID Number</th>
						<th>Username</th>
						<th>Type</th>
						<th>Gender</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $users as $row) :?>
							<tr>
								<td><?php echo $row->lastname . ' , ' .$row->firstname?></td>
								<td><?php echo $row->user_identification?></td>
								<td><?php echo $row->username?></td>
								<td><?php echo $row->user_type?></td>
								<td><?php echo $row->gender ?></td>
								<td><?php echo wLinkDefault(_route('user:show', $row->id), 'Show User'); ?></td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>