<?php build('content') ?>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Workout Set Builder</h4>
            <?php echo wLinkDefault(_route('workout-set-builder:edit', $setBuilder->id), 'Edit')?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td><?php echo $form->getLabel('set_name')?></td>
                        <td><?php echo $setBuilder->set_name?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('schedule')?></td>
                        <td><?php echo $setBuilder->schedule?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->getLabel('set_tag')?></td>
                        <td><?php echo $setBuilder->set_tag?></td>
                    </tr>
                    <tr>
                        <td>Completion</td>
                        <td>
                            <?php if($setBuilder->is_set_complete && date('Y-m-d', strtotime($setBuilder->last_set_taken)) == today()) :?>
                                <span class="badge bg-success">Completed</span>
                            <?php else:?>
                                <span class="badge bg-warning">InComplete</span>
                            <?php endif?>
                        </td>
                    </tr>
                </table>
            </div>

            <section id="workSection">
                <h1 class="text-center" id="workoutName"></h1>
                <div class="row" id="workTimer">
                    <div class="col-md-4" id="repContainer"><h2>Reps<div><span id="reps"></span></div></h2></div>
                    <div class="col-md-4" id="workTimeContainer"><h2>Timer<div><span id="workMin"></span>:<span id="workSec"></span></div> </h2></div>
                    <div class="col-md-4" id="restTimeContainer"><h2>Rest<div><span id="restMin"></span>:<span id="restSec"></span></div> </h2></div>
                </div>
                <h1 class="text-center"><?php echo wLinkDefault(_route('workout-set-builder:show', $setBuilder->id), 'Stop Workout')?></h1>

                <div id="workoutImageContainer" class="row"></div>
            </section>

            <?php echo wDivider()?>

            <section>
                <h4>Workouts</h4>
                <?php echo wLinkDefault(_route('workout-set-builder:add-workout', $setBuilder->id), 'Add Item')?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Work Out</th>
                            <th>Time</th>
                            <th>Reps</th>
                            <th>Rest</th>
                            <th>Remark</th>
                            <th>Take Action</th>
                        </thead>

                        <tbody>
                            <?php foreach($setWorkouts as $key => $row) :?>
                                <tr>
                                    <td>
                                        <?php echo $row->workout_name?>
                                        <div><small>(<?php echo $row->workout_tag?>)</small></div>
                                        <div><?php echo wLinkDefault(_route('workout-set-builder:delete-workout', $row->id), 'Delete')?></div>
                                    </td>
                                    <td><?php echo "{$row->work_time_min}:{$row->work_time_sec}"?></td>
                                    <td><?php echo "{$row->rep_count}"?></td>
                                    <td><?php echo "{$row->rest_time_min}:{$row->rest_time_sec}"?></td>
                                    <td><?php echo $row->is_complete_text?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm workout_start" data-id="<?php echo $row->id?>">Start Workout</button>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php build('scripts') ?>
   <script src="<?php echo _path_public('js/workout/start_workout.js')?>"></script>
<?php endbuild()?>

<?php build('headers') ?>
 <style>
    #workTimer{
        color: #000 !important;
        box-sizing: border-box;
        padding: 20px;
        border: 1px solid black;
    }
    #workTimer > div{
        box-sizing: border-box;
        text-align: center;
        padding: 12px;
    }

    #workSection{
        display: none;
    }
 </style>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>