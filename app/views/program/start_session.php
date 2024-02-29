<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $program->program_name?> >> <?php echo $program->package_name?></h4>
            <?php echo wLinkDefault(_route('program:show', $program->id), 'Back')?>
        </div>

        <div class="card-body">
            <p>Uncheck members which not present on the session</p>
            <?php echo wDivider(5)?>
            <h4>Session Status : <span class="badge badge-primary"><?php echo $session->status?></span></h4>
            <?php echo wDivider(20)?>
            <form action="" method="post">
                <?php echo Form::hidden('id', $session->id)?>
                <?php echo Form::hidden('program_id', $program->id)?>
                <table>
                    <?php foreach($participants as $key => $row) :?>
                        <tr>
                            <td style="width: 200px;"><label for="<?php echo 'name'.$row->id?>">
                                <?php echo $row->member_firstname . ' ' .$row->member_lastname?></label>
                            </td>
                            <td><input id="<?php echo 'name'.$row->id?>"
                                type="checkbox"
                                name="member_id[]"
                                value="<?php echo $row->member_id?>" checked>
                            </td>
                        </tr>
                    <?php endforeach?>
                </table>
                <div class="form-group">
                    <?php
                        Form::label('Session Remarks');
                        Form::textarea('remarks','', [
                            'class' => 'form-control',
                            'rows' => 5
                        ]);
                    ?>
                </div>
                <?php 
                if(isEqual($session->status, 'ongoing') && isInstructor()) {
                        Form::submit('', 'Complete Session');
                    }
                ?>
            </form>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>