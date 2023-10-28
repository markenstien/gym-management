<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit User</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php echo $user_form->start()?>
			<?php echo $user_form->getFormItems()?>
				<div class="row">
					<div class="col-md-6"><input type="submit" name="" class="btn btn-primary btn-sm" value="Edit User"></div>
					<?php if(isAdmin()) :?>
					<div class="col-md-6"><?php echo wLinkDefault(_route('user:deactivate', $user->id), 'Delete User', [
						'class' => 'btn btn-danger form-verify',
						'message' => 'Are you sure want to remove this user?'
					])?></div>
					<?php endif?>
				</div>
			<?php echo $user_form->end()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>