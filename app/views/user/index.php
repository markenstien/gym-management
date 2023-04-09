<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $content_title?></h4>
		</div>
		
		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive" style="min-height: 30vh;">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Name</th>
						<th>ID Number</th>
						<th>Gender</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $users as $row) :?>
							<tr>
								<td><?php echo $row->lastname . ' , ' .$row->firstname?></td>
								<td><?php echo $row->user_identification?></td>
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