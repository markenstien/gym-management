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
							<?php if(!is_null($user->membership_expiry_date)) :?>
								<tr>
									<td>Membership</td>
									<td>
										<label for="#">
										(<?php echo date_difference($user->membership_expiry_date, today())?> Before expiry)
									</label>
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
							<?php if(isAdmin()) :?>
							<tr>
								<td colspan="2">
									<div>
										<?php echo wLinkDefault(_route('user:add-to-member', $user->id), 'Membership')?>
									</div>
								</td>
							</tr>
							<?php endif?>

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

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Sessions</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered dataTable">
							<thead>
								<th>#</th>
								<th>Instructor</th>
								<th>Program</th>
								<th>Date</th>
								<th>Is Accepted</th>
							</thead>

							<tbody>
								<?php foreach($sessions as $key => $row) :?>
									<tr>
										<td><?php echo ++$key?></td>
										<td><?php echo $row->instructor_name?></td>
										<td><?php echo $row->program_name?></td>
										<td><?php echo $row->start_date . ' : ' . $row->start_time ?></td>
										<td><?php echo $row->is_accepted?></td>
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
						<h4 class="card-title">User Programs</h4>
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
									<?php foreach($user_programs as $key => $row) :?>
										<tr>
											<td><?php echo ++$key?></td>
											<td><?php echo $row->program_name?></td>
											<td><?php echo $row->package_name?></td>
											<td><?php echo $row->sessions?></td>
											<td><?php echo $row->program_start_date?></td>
										</tr>
									<?php endforeach?>
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
	</div>

<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>