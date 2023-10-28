<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Program Package</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('package:create'), 'Add Package')?>
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th><?php echo $form->getLabel('package_name')?></th>
                        <th><?php echo $form->getLabel('price')?></th>
                        <th><?php echo $form->getLabel('consume_type')?></th>
                        <th><?php echo $form->getLabel('sessions')?></th>
                        <th><?php echo $form->getLabel('is_member')?></th>
                        <th><?php echo $form->getLabel('is_instructed')?></th>
                        <th>Auto Update</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($packages as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->package_name?></td>
                                <td><?php echo $row->price?></td>
                                <td><?php echo $row->consume_type_text?></td>
                                <td><?php echo $row->sessions?></td>
                                <td><?php echo $row->is_member_text?></td>
                                <td><?php echo $row->is_instructed_text?></td>
                                <td><?php echo $row->auto_last_update?></td>
                                <td><?php echo wLinkDefault(_route('package:edit', $row->id), 'Edit')?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>