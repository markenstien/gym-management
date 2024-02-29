<?php build('content') ?>
<div class="col-md-5 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Use Session</h4>
        </div>

        <div class="card-body">
            <a href="<?php echo _route('session:index')?>" class="btn btn-primary mb-4">Sessions</a>
            <?php Flash::show()?>
            <?php
                Form::open([
                    'method' => 'post'
                ])
            ?>
                <div class="form-group">
                    <?php
                        Form::label('Username');
                        Form::text('username','', [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => 'Enter username'
                        ]);
                    ?>
                </div>

                <?php if(!isset($sessions)) :?>
                <div class="form-group">
                    <?php Form::submit('find_session', 'Find Session')?>
                </div>
                <?php else :?>
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Package</th>
                            <th>Sessions</th>
                            <th>Instructor</th>
                            <th>Expiry</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php foreach($sessions as $key => $row) :?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->package_name?></td>
                                    <td><?php echo $row->session_taken . '/'. $row->package_session?></td>
                                    <td><?php echo $row->instructor_firstname . ' ' . $row->instructor_lastname?></td>
                                    <td><?php echo $row->membership_expiry_date?></td>
                                    <td>
                                        <a href="<?php echo _route('session:use-package', $row->id)?>">Use Package</a>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                <?php endif?>
            <?php Form::close()?>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>