<?php build('content') ?>
	<?php Flash::show()?>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">User Preview</h4>
					<a href="<?php echo _route('user:edit' , $user->id)?>">Edit</a>
				</div>

				<div class="card-body">
					<h4>Personal Information</h4>
					<div> <img src="<?php echo $user->profile?>" style="width: 150px;"> </div>
					<label for="#">
						<?php if(isEqual($user->user_type,'member')) :?>
							<?php echo $user->user_type?>(<?php echo $user->membership_status?>)
						<?php else:?>
							<?php echo $user->user_type?>
						<?php endif?>
					</label>

					<div class="table-responsive">
						<table class="table table-bordered">
							<?php if(isAdmin() || isMember()) :?>
							<tr>
								<td>Membership</td>
								<td>
									<label for="#">
										<?php
											$beforeExpiry = date_difference($user->membership_expiry_date, today());
											$number = preg_match_all('!\d+!', $beforeExpiry, $matches);
											$number = $matches[0][0];
										?>
										<?php
											if(is_null($user->membership_expiry_date)) {
												echo "Non Member";
											} else {
												echo date_difference($user->membership_expiry_date, today()) . ' Before expiry' ;
											}
										?>
									</label>
									
									<?php if(isAdmin() && $number <= 0 && isEqual($user->user_type, 'MEMBER')) :?>
										<?php echo wLinkDefault(_route('user:add-to-member', $user->id), 'Add Plan')?>
									<?php endif?>
								</td>
							</tr>
							<?php endif?>
							<tr>
								<td width="250px">User Identification</td>
								<td><?php echo $user->user_identification?></td>
							</tr>
							<tr>
								<td width="250px">Username</td>
								<td><?php echo $user->username?></td>
							</tr>
							<tr>
								<td width="250px">Name</td>
								<td><?php echo $user->lastname . ',' . $user->firstname?></td>
							</tr>
							<tr>
								<td width="250px">Gender</td>
								<td><?php echo $user->gender?></td>
							</tr>
							<tr>
								<td width="250px">Email And Mobile Number</td>
								<td>
									<p><?php echo $user->email?></p>
									<p><?php echo $user->phone?></p>
								</td>
							</tr>
							<tr>
								<td width="250px">Address</td>
								<td><?php echo $user->address?></td>
							</tr>

							<?php if(isMember($user)) :?>
								<tr>
									<td>Progress</td>
									<td>
										<?php echo wLinkDefault(_route('user:progress', $user->id), 'Show Progress')?>
									</td>
								</tr>
							<?php endif?>
						</table>
					</div>
				</div>
			</div>	
		</div>

		<?php if(isEqual($user->user_type, 'MEMBER')) :?>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Sessions</h4>
				</div>
				<div class="card-body">
					<?php $counter = 0?>
					<div class="table-responsive">
						<table class="table table-bordered dataTable">
							<thead>
								<th>#</th>
								<th>Program</th>
								<th>Sessions</th>
								<th>Start Date</th>
								<th>Last Updated</th>
								<th>Instructor</th>
							</thead>

							<tbody>
								<?php foreach($sessions as $key => $row) :?>
									<tr>
										<td><?php echo ++$counter?></td>
										<td><?php echo $row->package_name?></td>
										<td><?php echo $row->session_taken?>/<?php echo $row->package_session?></td>
										<td><?php echo $row->created_at?></td>
										<td><?php echo time_since($row->last_update)?></td>
										<td><?php
												if(isEqual($row->session_type, 'INSTRUCTED')) {
													echo strtoupper($row->instructor_firstname . ' '.$row->instructor_lastname);
												} else {
													echo "REGULAR SESSION";
												}
											?>
										</td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if(isMember($user)):?>
				<?php echo wDivider(30)?>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">User Progress</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered dataTable">
								<thead>
									<th>#</th>
									<th>Program</th>
									<th>Package</th>
									<th>Session</th>
									<th>Start Date</th>
								</thead>

								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php endif?>
			

			<?php echo wDivider(30)?>

			<?php if(isMember($user)):?>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Payments</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered dataTable">
								<thead>
									<th>#</th>
									<th>Reference</th>
									<th>Amount</th>
									<th>Payment Key</th>
									<th>Created At</th>
								</thead>

								<tbody>
									<?php foreach($payments as $key => $row) :?>
										<tr>
											<td><?php echo ++$key?></td>
											<td><?php echo $row->reference?></td>
											<td><?php echo $row->amount?></td>
											<td><?php echo $row->payment_key?></td>
											<td><?php echo $row->created_at?></td>
										</tr>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php endif?>
			
		</div>
		<?php endif?>

		<?php if(isEqual($user->user_type, 'INSTRUCTOR')) :?>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Students</h4>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered dataTable">
								<thead>
									<th>#</th>
									<th>Program</th>
									<th>Student</th>
									<th>Sessions</th>
									<th>Start Date</th>
									<th>Last Updated</th>
								</thead>

								<tbody>
									<?php foreach($students as $key => $row) :?>
										<tr>
											<td><?php echo ++$key?></td>
											<td><?php echo $row->package_name?></td>
											<td><?php echo $row->member_firstname . ' ' .$row->member_lastname?></td>
											<td><?php echo $row->session_taken?>/<?php echo $row->package_session?></td>
											<td><?php echo $row->created_at?></td>
											<td><?php echo time_since($row->last_update)?></td>
										</tr>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<?php endif?>
	</div>

<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>