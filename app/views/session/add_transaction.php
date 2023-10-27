<?php build('content') ?>
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Session Entry</h4>
                <?php echo wLinkDefault(_route('session:students'), 'Back')?>
            </div>

            <div class="card-body">
                <?php Flash::show()?>
                <?php 
                    Form::open([
                        'method' => 'post'
                    ]);

                    Form::hidden('session_id', $session->id);
                ?>
                    <div class="form-group">
                        <?php
                            $autoFill = trim("1.Weight :\n 2.Work out hours :\n 3.Program :");
                            Form::label('Remarks');
                            Form::textarea('remarks',$autoFill, [
                                'class' => 'form-control',
                                'rows'  => 5
                            ]);
                        ?>
                    </div>

                    <div class="form-group">
                        <?php Form::submit('', 'Save');?>
                    </div>
                <?php Form::close()?>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Remarks</th>
                        </thead>

                        <tbody>
                            <?php foreach($sessionRemarks as $key => $row) :?>
                                <tr>
                                    <td><?php echo $row->remarks?></td>
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