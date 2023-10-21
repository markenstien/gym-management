<?php

use function Complex\sec;

 build('content') ?>
    <div class="row">
        <div class="card col-md-5">
            <div class="card-header">
                <h4 class="card-title"><?php echo $session->package_name?> : <?php echo $session->session_name?></h4> 
                <?php Flash::show()?>
            </div>

            <div class="card-body">
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
                            <td><?php echo $session->package_name?></td>
                        </tr>

                        <tr>
                            <td>Date</td>
                            <td><?php echo $session->start_date . ' ' .$session->start_time?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td><?php echo $session->status?></td>
                        </tr>
                        <?php if(isInstructor() && isEqual($session->status, 'pending')) :?>
                        <tr>
                            <td>Action</td>
                            <td>
                                <a href="<?php echo _route('instructor-session:cancel', $session->id)?>" 
                                class="btn btn-sm btn-danger form-verify">Cancel</a>
                                <a href="<?php echo _route('instructor-session:complete', $session->id)?>" 
                                class="btn btn-sm btn-primary form-verify">Complete</a>
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
                        ]), 'Add Attendees');
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
                <h4 class="card-title">Assets</h4> 
            </div>

            <div class="card-body">
                <?php if(!isMember()) :?>
                    <?php Form::open([
                        'method' => 'post',
                        'action' => _route('instructor-session:addFile')
                    ]);
                        Form::hidden('id', $session->id);
                    ?>
                        <div class="form-group">
                            <?php
                                Form::label('Assets');
                                Form::select('asset_id', arr_layout_keypair($assets, ['id', 'title']), '', [
                                    'id' => 'asset_id'
                                ]);
                            ?>
                        </div>

                        <div class="form-group">
                            <?php Form::submit('', 'Add Asset to Sessions')?>
                        </div>
                    <?php Form::close()?>
                    <?php echo wDivider(15)?>
                <?php endif?>
            <div>
                <div id="file_description"></div>
                <div>
                    <img alt="" id="image_viewer" style="width: 100%;">
                </div>
                <div>
                    <iframe frameborder="0" 
                    style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;width:100%;"id="file_viewer"></iframe>
                </div>
            </div>
                <div style="display: flex; flex-direction:row">
                    <div>
                        <section>
                            <div style="display:flex; flex-direction:row">
                            <?php foreach($sessionAssets as $key => $asset) :?>
                                <?php $extensionType = wExtensionType($asset->file_type)?>
                                <?php if(isEqual($extensionType,'image')) :?>
                                    <div style="margin-right: 5px; flex:2">
                                        <img src="<?php echo $asset->full_url?>" alt="" style="width:100%">
                                        <div><?php echo $asset->title?> <?php
                                            if(!isMember()) {
                                                echo wLinkDefault(_route('instructor-session:deleteAsset', $asset->id,[
                                                    'sessionId' => $asset->session_id
                                                ]), 'Delete', [
                                                    'icon' => 'fa fa-trash'
                                                ]);
                                            }
                                        ?></div>
                                    </div>
                                <?php endif?>

                                <?php if(isEqual($extensionType, 'video')) :?>
                                    <div style="margin-right: 5px; flex:2">
                                        <video controls style="width: 100%;">
                                            <source src="<?php echo $asset->full_url?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div><?php echo $asset->title?> <?php 
                                            if(!isMember()) {
                                                echo wLinkDefault(_route('instructor-session:deleteAsset', $asset->id,[
                                                    'sessionId' => $asset->session_id
                                                ]), 'Delete', [
                                                    'icon' => 'fa fa-trash'
                                                ]);
                                            }
                                        ?></div>
                                    </div>
                                <?php endif?>
                            <?php endforeach?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-md-7">
            <div class="card-header">
                <h4 class="card-title">Galleries</h4> 
            </div>

            <div class="card-body">
                <?php
                    if(!isMember()) {
                        Flash::show('galleries');
                        Form::open([
                            'method' => 'post',
                            'enctype' => 'multipart/form-data'
                        ]);

                        Form::hidden('session_id', $session->id);
                            Form::file('images[]', ['multiple' => '']);

                        Form::submit('btn_image_upload');
                        Form::close();

                        echo wDivider(30);
                    }
                ?>
                <?php if($images) :?>
                    <div class="flex">
                        <?php foreach($images as $key => $row) :?>
                            <div style="margin-right: 10px;">
                                <div><a target="_blank" href="<?php echo $row->full_url?>"><img src="<?php echo $row->full_url?>" style="width:150px"></a></div>

                                <?php
                                    if(!isMember()) {
                                        echo wLinkDefault(_route('attachment:delete', $row->id, [
                                            'route' => seal(_route('instructor-session:show', $session->id))
                                        ]), 'Delete', ['icon' => 'fa fa-trash']);
                                    }
                                ?>
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

<?php build('scripts')?>
<script>
    $(document).ready(function(){
        $('#asset_id').change(function(){
            let value = $(this).val();
            
            if(value == '') {
                $("#file_description").html('');
                $("#image_viewer").hide();
                $("#file_viewer").hide();
            } else {
                $.ajax({
                    url : getURL('api/assetManagement/get'),
                    type: 'GET',
                    data: {
                        id: value
                    },
                    success:function(response) {
                        let responseData = JSON.parse(response);
                        $("#file_description").html(`<p>${responseData.description}</p>`);
                        console.log(responseData);
                        if(responseData.fileType == 'image') {
                            $('#image_viewer').attr('src', responseData.full_url);
                            $('#image_viewer').show();
                            $('#file_viewer').hide();
                        } else {
                            $("#file_viewer").attr('src', responseData.full_url);
                            $("#file_viewer").attr('style', 'height:100%;width:100%;');
                            $('#file_viewer').show();
                            $('#image_viewer').hide();
                        }
                        
                    }
                });
            }
        });
    });
</script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>