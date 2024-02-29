<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit User</h4>
			<?php if(isEqual($user->user_type, 'INSTRUCTOR')) :?>
				INSTRUCTOR
			<?php else :?>
				MEMBER
			<?php endif?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php echo $user_form->start()?>
			<?php
				__([
					$user_form->getRow('id'),
					$user_form->getRow('firstname'),
					$user_form->getRow('lastname'),
					$user_form->getRow('gender'),
					$user_form->getRow('username'),
					$user_form->getRow('password'),
					$user_form->getRow('profile'),
					$user_form->getRow('phone'),
					$user_form->getRow('email'),
					$user_form->getRow('address'),
				]);
			?>

			<?php if(isEqual($user->user_type, 'INSTRUCTOR')) :?>
				<?php __($user_form->getRow('specialization'))?>
			<?php endif?>

				<div class="row mt-5">
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