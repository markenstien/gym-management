<?php build('content') ?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Workout Builder</h4>
        </div>

        <div class="card-body">
            <?php echo $form->start()?>
                <div class="form-group">
                    <?php echo $form->getRow('set_name')?>
                </div>

                <div class="form-group">
                    <?php echo $form->getRow('set_tag')?>
                </div>

                <div class="form-group">
                    <?php echo $form->getRow('schedule')?>
                </div>

                <div class="form-group">
                    <?php echo $form->getRow('is_public')?>
                </div>

                <div class="form-group">
                    <?php echo $form->getRow('is_assigned_to')?>
                </div>
                
                <div class="form-group">
                    <?php Form::submit('', 'Save Workout')?>
                </div>
            <?php echo $form->end()?>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>
