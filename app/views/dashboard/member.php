<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Invites</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Program</th>
						<th>Instructor</th>
						<th>Number of Attendees</th>
						<th>Date</th>
						<th>Are you Attending?</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($sessionInvites as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->program_name?></td>
								<td><?php echo $row->instructor_name?></td>
								<td>N/A</td>
								<td><?php echo $row->start_date?></td>
								<td><?php echo $row->is_accepted?></td>
								<td><?php echo wLinkDefault(_route('instructor-session:show', $row->id),'Show')?></td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>