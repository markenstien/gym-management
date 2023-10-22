<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Program</h4>
        </div>

        <div class="card-body">
            <?php echo $form->start()?>
                <?php __($form->getRow('program_name'))?>
                <?php __($form->getRow('start_date'))?>
                <?php __($form->getRow('package_id'))?>
                <?php __($form->getRow('instructor_id'))?>
                <?php __($form->getRow('description'))?>

                <?php echo Form::submit('', 'Create New Program')?>
            <?php echo $form->end()?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>