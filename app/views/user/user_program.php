<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Programs</h4>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>Member</th>
                        <th>Program</th>
                        <th>Instructor</th>
                        <th>Sessions</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php foreach($user_programs as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->member_name?></td>
                                <td><?php echo $row->program_name?></td>
                                <td><?php echo $row->instructor_name?></td>
                                <td><?php echo $row->sessions?></td>
                                <td><?php echo $row->created_at?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>