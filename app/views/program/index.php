<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Programs</h4>
        </div>

        <div class="card-body">
            <?php
                if(isAdmin()) {
                    echo wLinkDefault(_route('program:create'), 'Create Program');
                }
            ?>
            <div class="table-responsive">
                <?php if(isMember()) :?>
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Code</th>
                            <th>Program</th>
                            <th>Sessions</th>
                            <th>Start Date</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php foreach($programs as $key => $row) :?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->program_code?></td>
                                    <td><?php echo $row->program_name?></td>
                                    <td><?php echo $row->sessions_taken?>/<?php echo $row->program_session?></td>
                                    <td><?php echo $row->start_date?></td>
                                    <td><?php echo $row->instructor_firstname . ' ' .$row->instructor_lastname?></td>
                                    <td><?php echo wLinkDefault(_route('program:show', $row->program_id), 'Show')?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                <?php else:?>
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Code</th>
                            <th>Program</th>
                            <th>Members</th>
                            <th>Sessions</th>
                            <th>Start Date</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php foreach($programs as $key => $row) :?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->program_code?></td>
                                    <td><?php echo $row->package_name?></td>
                                    <td><?php echo $row->attendee_total?></td>
                                    <td><?php echo $row->sessions?></td>
                                    <td><?php echo $row->start_date?></td>
                                    <td><?php echo $row->instructor_name?></td>
                                    <td><?php echo wLinkDefault(_route('program:show', $row->id), 'Show')?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                <?php endif?>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>