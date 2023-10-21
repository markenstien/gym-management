<?php build('content') ?>
    <div class="card col-md-6">
        <div class="card-header">
            <h4 class="card-title">Create Session With Instructor</h4>
            <?php if(isAdmin()) echo wLinkDefault(_route('session:create'), 'ADHOC Session')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <?php
                Form::open([
                    'method' => 'post'
                ]);
            ?>
                <div class="form-group">
                    <?php
                        Form::label('User Identification *');
                        Form::text('user_identification', '', [
                            'class' => 'form-control',
                            'required' => true
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php
                        Form::label('Package *');
                        Form::select('package_id', arr_layout_keypair($packages,['id','package_name']),'' ,[
                            'class' => 'form-control',
                            'id' => 'package_id',
                            'required' => true
                        ]);
                    ?>

                    <div>
                        <small>Package Details</small>
                        <ul class="list-unstyled">
                            <li>Price : <span id="package_price"></span></li>
                            <li>Sessions : <span id="package_session"></span></li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <?php
                        Form::label('Instructor *');
                        Form::select('instructor_id', arr_layout_keypair($instructors, ['id', 'firstname@lastname']),'', [
                            'class' => 'form-control',
                            'required' => true
                        ]);
                    ?>
                </div>
                
                <?php echo wDivider('50')?>
                <section>
                    <h4>Payment</h4>
                    <div class="form-group">
                        <?php
                            Form::label('Amount *', 'amount', ['id' => 'labelAmount']);
                            Form::text('amount', '', [
                                'class' => 'form-control',
                                'required' => true,
                                'readonly' => true,
                                'id' => 'amount'
                            ])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                            Form::label('Payment Method *');
                            Form::select('payment_method',['Online','Cash'],'', [
                                'class' => 'form-control',
                                'required' => true
                            ])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                            Form::label('Description');
                            Form::textarea('description', '', [
                                'class' => 'form-control',
                            ])
                        ?>
                    </div>
                </section>

                <div class="form-group">
                    <?php Form::submit('', 'Save Session')?>
                </div>
            <?php Form::close()?>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            let packageCallURL = getURL('api/InstructorPackage/get_package');
            $("#package_id").change(function(e){

                let val = $(this).val();

                if(val == '') {
                    $('#package_price').html('');
                    $('#package_session').html('');
                } else {
                    $.get(packageCallURL, {packageID: $(this).val()}, function(response) {
                        response = JSON.parse(response);
                        $("#package_price").html(response.price);
                        $("#package_session").html(response.sessions);
                        $("#amount").val(response.price);
                    });
                }
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>