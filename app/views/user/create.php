<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create User</h4>
			<?php echo wLinkDefault(_route('user:members'), 'members')?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $user_form->start() ?>
				<?php
					__([
						$user_form->getRow('user_type'),
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

				<?php if(isEqual($req['user_type'], 'INSTRUCTOR')) :?>
					<?php __($user_form->getRow('specialization'))?>
				<?php endif?>

				<?php echo $user_form->get('submit')?>
			<?php echo $user_form->end()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>