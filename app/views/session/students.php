<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Students</h4>
        </div>

        <div class="card-body">
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Program</th>
                        <th>Session</th>
                        <th>Last Session</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach($students as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->member_firstname . ' '.$row->member_lastname?></td>
                                <td><?php echo $row->package_name?></td>
                                <td><?php echo $row->session_taken?> / <?php echo $row->package_session?></td>
                                <td><?php echo $row->last_update?></td>
                                <td><?php echo wLinkDefault(_route('session:add-transaction', [
                                    'sessionId' => seal($row->id)
                                ]), 'Add Session')?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>