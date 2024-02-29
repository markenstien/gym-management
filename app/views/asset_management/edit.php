<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add your assets</h4>
        </div>

        <div class="card-body">
            <?php Flash::show()?>
            <p>Upload your assets and include it on your sessions</p>
            <?php echo $form->start()?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                            if($form->checkExistKey('user_id')) {
                                echo $form->get('user_id');
                            }
                            __([
                                $form->getRow('title'),
                                $form->getRow('asset_category'),
                                $form->getRow('description'),
                             ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->getRow('file')?>
                            <img src="<?php echo $asset->att_full_url?>" alt="" style="width: 150px;">
                        </div>
                        <div class="form-group">
                            <?php echo $form->getRow('default_picture')?>
                            <img src="<?php echo $asset->atticon_full_url?>" alt="" style="width: 150px;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        Form::submit('', 'Save Asset');
                    ?>
                </div>
            <?php echo $form->end()?>
        </div>

        <?php if(!empty($assets)) :?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th style="width: 15%;">Title</th>
                            <th style="width: 30%;">Description</th>
                            <th>Type</th>
                            <th>Asset Type</th>
                            <th>Show</th>
                            <th>Delete</th>
                        </thead>

                        <tbody>
                            <?php foreach($assets as $key => $row) :?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->title?></td>
                                    <td><?php echo $row->description?></td>
                                    <td><?php echo wExtensionType($row->file_type)?></td>
                                    <td><?php echo $row->asset_category?></td>
                                    <td><?php echo wLinkDefault(_route('viewer:show', [
                                        'file' => seal($row->att_full_url)
                                    ]), 'View Asset', [
                                        'target' => '_blank'
                                    ])?></td>

                                    <td>
                                        <?php echo wLinkDefault(_route('asset-management:delete', $row->id), 'Delete', [
                                            'icon' => 'fa fa-trash'
                                        ])?> | 

                                        <?php echo wLinkDefault(_route('asset-management:edit', $row->id), 'Edit', [
                                            'icon' => 'fa fa-edit'
                                        ])?>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif?>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>