<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Profile</h4>
        </div>

        <div class="card-body">
            <h4>Programs</h4>
            <table class="table table-bordered">
                <thead>
                    <th>Program Name</th>
                    <th>Sessions</th>
                    <th>Start Date</th>
                    <th>Status</th>
                </thead>

                <tbody>
                    <?php foreach($programs as $key => $row) :?>
                        <tr>
                            <td><?php echo $row->program_name?></td>
                            <td><?php echo "{$row->sessions_taken}/{$row->package_session}"?></td>
                            <td><?php echo $row->program_start_date?></td>
                            <td><?php echo $row->program_status?></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <?php echo wDivider(10)?>
            <h4>Completed 1 program out of 15</h4>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>