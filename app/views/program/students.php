<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Program Students</h4>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Program</th>
                        <th>Instructor</th>
                        <th>Member</th>
                        <th>Membership Expiry</th>
                        <th>Session</th>
                        <th>Program Date</th>
                    </thead>

                    <tbody>
                        <?php foreach($students as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->program_name?></td>
                                <td><?php echo $row->instructor_firstname . ' ' .$row->instructor_lastname?></td>
                                <td><?php echo $row->member_firstname. ' ' .$row->member_lastname?></td>
                                <td><?php echo $row->membership_expiry_date?> (<?php echo date_difference($row->membership_expiry_date, nowMilitary())?>)</td>
                                <td><?php echo $row->sessions_taken?> / <?php echo $row->program_session?></td>
                                <td><?php echo $row->start_date?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>