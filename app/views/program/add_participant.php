<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Member</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('program:show', $program->id), 'Back to Program')?>
            <?php Flash::show()?>
            <?php
                Form::open([
                    'method' => 'post'
                ]);
                Form::hidden('program_id', $program->id);
            ?>
                <div class="form-group">
                    <?php 
                        Form::label('Members');
                        Form::select('member_id', arr_layout_keypair($members,['id', 'firstname@lastname']) ,'', [
                            'class' => 'form-control'
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        Form::label('Payment Method');
                        Form::select('payment_method', [
                            'cash', 'online'
                        ],'', [
                            'class' => 'form-control'
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        Form::label('Amount');
                        Form::text('payment_amount',$program->program_amount, [
                            'class' => 'form-control',
                            'readonly' => true
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        Form::label('Description');
                        Form::textarea('description','', [
                            'class' => 'form-control',
                            'rows' => 3
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php Form::submit('', 'Add Member')?>
                </div>
            <?php Form::close()?>
            <!-- Partcipant dropdown -->
            <!-- Payment Method -->
            <!-- Amount -->
            <!-- Description -->
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>