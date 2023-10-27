<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sessions</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Program</th>
                        <th>Member</th>
                        <th>Instructor</th>
                        <th>Session</th>
                        <th>DateTime</th>
                    </thead>

                    <tbody>
                        <?php foreach($sessions as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->package_name?></td>
                                <td><?php echo strtoupper($row->member_firstname . ' '.$row->member_lastname)?></td>
                                <td>
                                    <?php
                                        if(isEqual($row->session_type, 'INSTRUCTED')) {
                                            echo strtoupper($row->instructor_firstname . ' '.$row->instructor_lastname);
                                        } else {
                                            echo "REGULAR SESSION";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row->session_taken?> / <?php echo $row->package_session?></td>
                                <td><?php echo time_since($row->last_update)?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>