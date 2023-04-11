<?php build('content')?>
<div class="col-md-5 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add User as Member</h4>
        </div>

        <div class="card-body">
            <?php
                Form::open([
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]);
                Form::hidden('user_id', $user->id);
            ?>
                <div class="form-group">
                    <?php
                        Form::label('New Member Name:');
                        Form::text('', $user->firstname . ' '.$user->lastname, ['class' => 'form-control', 'readonly' => true]);
                    ?>
                </div>

                <div class="form-group">
                    <?php
                        Form::label('Months');
                        Form::select('months', ['month_6' => '6 Months', 'year_1' => '1 Year'],'', [
                            'class' => 'form-control',
                            'required' => true,
                            'id' => 'memPackage'
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php
                        Form::label('Amount To Pay');
                        Form::text('amount', '', [
                            'class' => 'form-control',
                            'readonly' => true,
                            'required' => true,
                            'id' => 'amount'
                        ])
                    ?>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <?php
                                Form::label('Payment Method');
                                Form::select('payment_method',['Online','Cash'],'', [
                                    'class' => 'form-control'
                                ])
                            ?>
                        </div>
                        <div class="col">
                            <?php
                                Form::label('Image proof');
                                Form::file('image', [
                                    'class' => 'form-control'
                                ])
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php Form::submit('', 'Add as Member')?>
                </div>
            <?php Form::close()?>
        </div>  
    </div>
</div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            $("#memPackage").change(function() {
                let value = $(this).val();
                let amount = $("#amount");

                switch(value) {
                    case 'month_6':
                        amount.val(200);
                    break;

                    case 'year_1':
                        amount.val(300);
                    break;
                }
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>