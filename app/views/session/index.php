<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sessions</h4>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <a href="<?php echo _route('session:use-session')?>" class="btn btn-success">New Session</a>
                <a href="<?php echo _route('session:index', [
                    'display' => 'today'
                ])?>" class="btn btn-primary">Sessions Today</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Filter
                </button>

                <?php if(!empty($req['display']) || !empty($req['advance_filter'])) :?>
                    <a href="<?php echo _route('session:index')?>" class="btn btn-warning"><i class="fa fa-times"></i></a>
                <?php endif?>
            </div>
            
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Program</th>
                        <th>Member</th>
                        <th>Instructor</th>
                        <th>Session</th>
                        <th>Type</th>
                        <th>Last Update</th>
                    </thead>

                    <tbody>
                        <?php foreach($sessions as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->package_name?></td>
                                <td><?php echo strtoupper($row->member_firstname . ' '.$row->member_lastname)?></td>
                                <td>
                                    <?php
                                        if(isEqual($row->session_type, 'INSTRUCTED')) {
                                            echo strtoupper($row->instructor_firstname . ' '.$row->instructor_lastname);
                                        } else {
                                            echo "REGULAR SESSION";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row->session_taken?> / <?php echo $row->package_session?></td>
                                <td><?php echo $row->consume_type?></td>
                                <td><?php echo time_since($row->last_update)?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Date Filter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <?php
                    Form::open([
                        'method' => 'get'
                    ])
                ?>
                    <div class="form-group">
                        <?php
                            Form::label('Start Date');
                            Form::date('start_date', '', [
                                'class' => 'form-control',
                                'required' => true
                            ])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                            Form::label('End Date');
                            Form::date('end_date', '', [
                                'class' => 'form-control',
                                'required' => true
                            ])
                        ?>
                    </div>

                    <input type="submit" name="advance_filter" class="btn btn-primary btn-sm" value="Apply Filter">
                <?php Form::close() ?>
            </div>
        </div>
    </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>