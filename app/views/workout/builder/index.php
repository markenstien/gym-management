<?php build('content') ?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Workout Sets</h4>
            <?php echo wLinkDefault(_route('workout-set-builder:create'), 'Create Set')?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Workout</th>
                        <th>Tag</th>
                        <th>User</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($workoutsets as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->set_name?></td>
                                <td><?php echo $row->set_tag?></td>
                                <td><?php echo $row->user_fullname?></td>
                                <td>
                                    <?php if(isEqual($row->schedule_text, 'Yes')) :?>
                                        <span class="badge badge-primary"><?php echo $row->schedule_text?></span>
                                    <?php else :?>
                                        <?php echo $row->schedule_text?>
                                    <?php endif?>
                                </td>
                                <td>
                                    <?php echo wLinkDefault(_route('workout-set-builder:show', $row->id), 'Show')?>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>
