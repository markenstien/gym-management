<?php build('content') ?>
    <div class="row">
        <div class="card col-md-5">
            <div class="card-header">
                <h4 class="card-title">Instructor Session</h4> 
                <?php Flash::show()?>
            </div>

            <div class="card-body">
                <?php if(isMember()) :?>
                    <?php dd($session)?>
                    <?php echo wLinkDefault(_route('instructor-session:accept', $session->id , [
                        'user_id' => $session->member_id
                    ]),'Accept', [
                        'class' => 'btn btn-primary'
                    ])?>
                <?php endif?>
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Session Name</td>
                            <td><?php echo $session->session_name?></td>
                        </tr>
                        <tr>
                            <td>Instructor</td>
                            <td><?php echo $session->instructor_name?></td>
                        </tr>
                        <tr>
                            <td>Program</td>
                            <td><?php echo $session->program_name?></td>
                        </tr>

                        <tr>
                            <td>Date</td>
                            <td><?php echo $session->start_date . ' ' .$session->start_time?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td><?php echo $session->status?></td>
                        </tr>
                        <?php if(isInstructor()) :?>
                        <tr>
                            <td>Action</td>
                            <td>
                                <a href="<?php echo _route('instructor-session:cancel', $session->id)?>" class="btn btn-sm btn-danger form-verify">Cancel</a>
                                <a href="<?php echo _route('instructor-session:complete', $session->id)?>" class="btn btn-sm btn-primary form-verify">Complete</a>
                            </td>
                        </tr>
                        <?php endif?>
                    </table>
                </div>
            </div>
        </div>

        <div class="card col-md-7">
            <div class="card-header">
                <h4 class="card-title">Attendees</h4> 
                <?php 
                    if(isInstructor() || isAdmin()) {
                        echo wLinkDefault(_route('instructor-session:add-attendee', $session->id, [
                            'instructorID' => seal($session->instructor_id)
                        ]), 'Members Assigned to you');
                    }
                ?>
            </div>

            <div class="card-body">
                <?php Flash::show('attendees')?>
                <div class="table table-responsive">
                    <table class="table table-bordered">
                       <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Is Accepted</th>
                        <?php if(isInstructor()):?>
                        <th>Action</th>
                        <?php endif?>
                       </thead>

                       <tbody>
                            <?php foreach($attendees as $key => $row):?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->member_name?></td>
                                    <td><?php echo $row->is_accepted?></td>
                                    <?php if(isInstructor()):?>
                                        <td>
                                            <?php echo wLinkDefault(_route('instructor-session:remove-attendee', $row->id, [
                                                'sessionID' => seal($row->instructor_session_id)
                                            ]),'Remove')?> 
                                        </td>
                                    <?php endif?>
                                </tr>
                            <?php endforeach?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card col-md-7">
            <div class="card-header">
                <h4 class="card-title">Galleries</h4> 
            </div>

            <div class="card-body">
                <?php Flash::show('galleries')?>
                <?php
                    Form::open([
                        'method' => 'post',
                        'enctype' => 'multipart/form-data'
                    ]);

                    Form::hidden('session_id', $session->id);
                        Form::file('images[]', ['multiple' => '']);

                    Form::submit('btn_image_upload');
                    Form::close();
                ?>

                <?php echo wDivider(30)?>
                <?php if($images) :?>
                    <div class="flex">
                        <?php foreach($images as $key => $row) :?>
                            <div style="margin-right: 10px;">
                                <div><a target="_blank" href="<?php echo $row->full_url?>"><img src="<?php echo $row->full_url?>" style="width:150px"></a></div>

                                <?php echo wLinkDefault(_route('attachment:delete', $row->id, [
                                    'route' => seal(_route('instructor-session:show', $session->id))
                                ]), 'Delete', ['icon' => 'fa fa-trash'])?>
                            </div>
                        <?php endforeach?>
                    </div>
                <?php else:?>
                    <p>No upload images.</p>
                <?php endif?>
            </div>
        </div>
    </div>
    
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>