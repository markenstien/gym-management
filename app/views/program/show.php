<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Program : <?php echo $program->package_name?></h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Reference</td>
                        <td>#<?php echo $program->program_code?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('program_name')?></td>
                        <td><?php echo $program->package_name?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('start_date')?></td>
                        <td><?php echo $program->start_date?></td>
                    </tr>
                    <tr>
                        <td>Program Amount</td>
                        <td><?php echo $program->program_amount?></td>
                    </tr>
                    <tr>
                        <td>Sessions</td>
                        <td><?php echo $program->sessions?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('instructor_id')?></td>
                        <td><?php echo $program->instructor_name?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php echo wDivider(30)?>

        <div class="card-body">
            <h4>Participants</h4>
            <?php echo wLinkDefault(_route('program:add-participant'), 'Add Participant');?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>