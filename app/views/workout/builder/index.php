<?php build('content') ?>
<div class="mx-auto">
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
                        <th>Day</th>
                        <th>Completion</th>
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
                                <td><?php echo $row->schedule?></td>
                                <td>
                                    <?php
                                        if($row->is_set_complete) {
                                            echo "<span class='badge bg-success' style='color:#fff'>{$row->is_complete_text}</span>";
                                        } else {
                                            echo "<span class='badge bg-warning' style='color:#fff'>{$row->is_complete_text}</span>";
                                        }
                                    ?>
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
