<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sessions</h4>
            <?php 
                if(!isMember()) 
                echo wLinkDefault(_route('instructor-session:create'), 'Create Session');
            ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>Session Name</th>
                        <th>Date</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($sessions as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->session_name?></td>
                                <td><?php echo $row->start_date?></td>
                                <td><?php echo $row->program_name?></td>
                                <td><?php echo $row->status?></td>
                                <td>
                                    <?php echo wLinkDefault(_route('instructor-session:show', $row->id), 'Show')?>
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