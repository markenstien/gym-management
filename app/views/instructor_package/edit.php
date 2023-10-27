<?php build('content') ?>
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Program Package</h4>
            </div>

            <div class="card-body">
                <?php echo wLinkDefault(_route('package:index'), 'Back to packages')?>
                <?php echo $form->start() ?>
                    <?php echo $form->get('id')?>
                    <div class="form-group">
                        <?php echo $form->getRow('package_name')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getRow('sessions')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getRow('price')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getRow('is_instructed')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getRow('is_member')?>
                    </div>

                    <div class="form-group">
                        <?php Form::submit('', 'Update Package')?>
                    </div>
                <?php echo $form->end()?>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>