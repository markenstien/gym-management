<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $content_title?></h4>
			<?php 
				if(isAdmin() || isStaff()) {

					switch($content_title) {
						case 'Members':
							$userType = 'MEMBER';
							break;

						case 'Staffs':
							$userType = 'STAFF';
							break;

						case 'Instructors':
							$userType = 'INSTRUCTOR';
							break;
					}
					echo wLinkDefault(_route('user:create', null, [
						'user_type' => $userType
					]), 'Add '.$content_title);
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
						<th>Gender</th>
						<th>Type</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $users as $row) :?>
							<tr>
								<td><?php echo $row->lastname . ' , ' .$row->firstname?></td>
								<td><?php echo $row->user_identification?></td>
								<td><?php echo $row->gender ?></td>
								<td><?php echo $row->user_type ?> <?php echo $userType == 'MEMBER' ? "($row->membership_status)": ''?></td>
								<td>
									<?php 
										$anchor_items = [
											[
												'url' => _route('user:show' , $row->id),
												'text' => 'View',
												'icon' => 'eye'
											],

											[
												'url' => _route('user:edit' , $row->id),
												'text' => 'Edit',
												'icon' => 'edit'
											]
										];
									echo anchorList($anchor_items)?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>