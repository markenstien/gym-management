<?php build('content') ?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Workout</h4>
            <?php echo wLinkDefault(_route('workout-set-builder:show', $setBuilder->id), 'Back to Set')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <section class="mb-4">
                <h4>Set Name : <?php echo $setBuilder->set_name?></h4>
                <h4>Tags : <?php echo $setBuilder->set_tag?></h4>
            </section>

            <div class="table-responsive">
                <?php echo $formSetItem->start()?>
                    <?php echo Form::hidden('workout_set_id', $setBuilder->id)?>
                    <div class="form-group">
                        <?php echo $formSetItem->getRow('workout_id')?>
                        <small>Related Workouts will be on the first lists.</small>
                    </div>

                    <div class="form-group">
                        <?php echo $formSetItem->getRow('rep_count')?>
                    </div>

                    <div class="form-group">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class=" col-form-label col-form-label">Work Time</label>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col">
                                        <?php Form::text('work_time_min', '', ['placeholder' => 'Minute', 'class' => 'form-control'])?>
                                    </div>

                                    <div class="col">
                                        <?php Form::text('work_time_sec', '', ['placeholder' => 'Seconds', 'class' => 'form-control'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class=" col-form-label col-form-label">Rest Time</label>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col">
                                        <?php Form::text('rest_time_min', '', ['placeholder' => 'Minute', 'class' => 'form-control'])?>
                                    </div>

                                    <div class="col">
                                        <?php Form::text('rest_time_sec', '', ['placeholder' => 'Seconds', 'class' => 'form-control'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <?php Form::submit('', 'Add Workout')?>
                    </div>
                <?php echo $formSetItem->end()?>
            </div>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>
