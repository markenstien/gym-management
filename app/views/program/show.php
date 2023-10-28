<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Program : <?php echo $program->program_name?></h4>
        </div>

        <div class="card-body">
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Reference</td>
                        <td>#<?php echo $program->program_code?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('program_name')?></td>
                        <td><?php echo $program->program_name?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('package_id')?></td>
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
            <h4>Members</h4>
            <?php
                if(isAdmin()) {
                    echo wLinkDefault(_route('program:add-participant', $program->id), 'Add Member');
                }
            ?>
            <?php echo wDivider(10)?>
            <?php if(empty($participants)) :?>
                <?php echo wDivider()?>
                <p class="text-center">No program members found.</p>
            <?php else:?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Member Code</th>
                            <th>Member</th>
                            <th>Sessions</th>
                            <th>Date Joined</th>
                        </thead>

                        <tbody>
                            <?php foreach($participants as $key => $row) :?>
                                <tr>
                                    <td><?php echo $row->user_identification?></td>
                                    <td><?php echo $row->member_firstname . ' '. $row->member_lastname?></td>
                                    <td><?php echo $row->sessions_taken?> / <?php echo $row->program_session?></td>
                                    <td><?php echo $row->start_date?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <?php echo wDivider(10)?>
                <?php echo "Program Members Total: " . count($participants)?>
            <?php endif?>
        </div>
        <?php echo wDivider(30)?>
        <div class="card-body">
            <h4>Sessions</h4>
            <?php if(empty($sessions)) :?>
                <?php echo wDivider()?>
                <p class="text-center">No Sessions found.</p>
            <?php else:?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Start Date</th>
                            <th>Status</th>
                            <?php if(!isMember()) :?>
                            <th>Action</th>
                            <?php endif?>
                        </thead>

                        <tbody>
                            <?php foreach($sessions as $key => $row) :?>
                                <tr>
                                    <td><?php echo $row->session_date?></td>
                                    <td><?php echo $row->status?></td>
                                    <?php if(!isMember()) :?>
                                        <td><?php 
                                            if(isEqual($row->status,'completed')) {
                                                echo wLinkDefault(_route('program:show-session',$row->id), 'Show Session');
                                            } else {
                                                echo wLinkDefault(_route('program:start-session',[
                                                    'session_id' => seal($row->id)
                                                ]), 'Start Session');
                                            } 
                                        ?></td>
                                    <?php endif?>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <?php echo wDivider(10)?>
                <?php echo " Total Sessions : ".count($sessions)?>
            <?php endif?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>