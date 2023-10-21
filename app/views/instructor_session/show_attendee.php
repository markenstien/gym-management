<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Session</h4>
		</div>

		<div class="card-body">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>Title</td>
						<td><?php echo $attendee->session_name?></td>
					</tr>
					<tr>
						<td>Instructor</td>
						<td><?php echo $attendee->instructor_name?></td>
					</tr>
					<tr>
						<td>Program</td>
						<td><?php echo $attendee->package_name?></td>
					</tr>
					<tr>
						<td>Date</td>
						<td><?php echo $attendee->start_date . ' '.$attendee->start_time ?></td>
					</tr>
					<tr>
						<td>Invitation Accepted?</td>
						<td>
							<?php echo $attendee->is_accepted?> &nbsp;
							<?php if(isEqual($attendee->is_accepted,'pending')) :?>
								<?php echo wLinkDefault(_route('instructor-session:accept', $attendee->id), 'Accept') ?>
								|
								<?php echo wLinkDefault(_route('instructor-session:accept', $attendee->id), 'Decline') ?>
							<?php else:?>
								<span class="badge badge-success">Accepted</span>
							<?php endif?>
						</td>
					</tr>
				</tbody>
			</table>
			<?php echo wDivider(30)?>
			<section>
				<h3>Attendees</h3>

				<table class="table table-bordered">
					<thead>
						<th>Name</th>
						<th>Is Accepted</th>
					</thead>

					<tbody>
						<?php foreach($attendees as $key => $row) :?>
							<tr>
								<td><?php echo $row->member_name?></td>
								<td>
									<?php
										if(is_null($row->user_confirmation)) {
											$row->is_accepted;
										} else {
											?><span class="badge badge-success">Accepted</span><?php
										}
									?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</section>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>