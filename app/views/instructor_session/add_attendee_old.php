<?php build('content')?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Members Assigned To You</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>IDs</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($members as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->user_identification?></td>
                                <td><?php echo $row->member_name?></td>
                                <td>
                                    <?php echo wLinkDefault(_route('instructor-session:add-attendee', $sessionID, [
                                        'instructorID' => seal($instructorID),
                                        'action' => 'addUser',
                                        'memberID' => seal($row->member_id),
                                        'csrf' => token_make()
                                    ]), 'Add User')?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>