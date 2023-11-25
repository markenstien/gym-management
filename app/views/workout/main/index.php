<?php build('content') ?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Workouts</h4>
            <?php echo wLinkDefault(_route('workout:create'), 'Create Workout')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Workout</th>
                        <th>Tag</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($workouts as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->workout_name?></td>
                                <td><?php echo $row->workout_tag?></td>
                                <td><?php echo wLinkDefault(_route('workout:delete', $row->id), 'Delete')?></td>
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
