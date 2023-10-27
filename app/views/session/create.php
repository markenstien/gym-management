<?php build('content') ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Program</h4>
                <?php Flash::show()?>
            </div>

            <div class="card-body">
                <?php 
                    Form::open(['method' => 'post']);
                ?>

                <div class="form-group">
                    <?php
                        Form::label('Members', '');
                        Form::select('member_id', $membersSelect ,'', [
                            'class' => 'form-control',
                            'id' => 'member_id',
                            'required' => true
                        ]);
                    ?>
                </div>
                

                <div class="form-group">
                    <?php echo $packageForm->getCol('is_instructed');?>
                </div>

                <div class="form-group">
                    <?php echo $packageForm->getCol('is_member');?>
                </div>

                <div class="form-group autohide" id="instructorIdContainer">
                    <?php
                        Form::label('Instructors', '');
                        Form::select('instructor_id', $instructorsSelect ,'', [
                            'class' => 'form-control',
                            'id' => 'instructor_id'
                        ]);
                    ?>
                </div>

                <div class="form-group">
                    <?php echo $programForm->getCol('package_id');?>
                </div>
                
                <section id="hiddenSection">
                    <div class="form-group">
                        <?php
                            Form::label('Amount', 'amount', ['id' => 'labelAmount']);
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
                            Form::label('Session', 'session');
                            Form::text('session', '', [
                                'class' => 'form-control',
                                'required' => true,
                                'readonly' => true,
                                'id' => 'session'
                            ])
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                            Form::label('Payment Method');
                            Form::select('payment_method',['Online','Cash'],'', [
                                'class' => 'form-control'
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

                    <div class="form-group">
                        <?php Form::submit('', 'Pay')?>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            const isMember = $('#is_member');
            const isInstructed = $('#is_instructed');
            const packageId = $('#package_id');
            const memberField = $('#memberIdFieldContainer');
            const customerField = $('#customerNameFieldContainer');
            const instructorField = $('#instructorIdContainer');
            const amount = $('#amount');
            const session = $('#session');
            let showHiddenFields = 0;

            initialLoadCheck(isMember, customerField, memberField,isInstructed,instructorField,packageId);

            isMember.add(isInstructed).on('change', function(e){
                fetchPrograms(isMember.val(), isInstructed.val(), packageId);
                checkRequireFieldIfEmpty(isMember, isInstructed, packageId);

                if(isInstructed.val() == 1) {
                    $("#instructorIdContainer").show();
                }
            });

            packageId.on('change', function(e){
                checkRequireFieldIfEmpty(isMember, isInstructed, packageId);
                $.ajax({
                    type: 'get',
                    url : getURL('api/InstructorPackage/get'),
                    data: {id : $(this).val()},
                    success: function(response){
                        let responseData = JSON.parse(response);
                        console.log([
                            responseData.price,
                            responseData.sessions
                        ]);
                        amount.val(responseData.price);
                        session.val(responseData.sessions);
                    }
                });
            });
        });

        function initialLoadCheck(isMember, customerField, memberField,isInstructed, instructorField, packageId) {
            if(isMember.val() != '') {
                if(isMember.val() == 1) {
                    memberField.show();
                    customerField.hide();
                } else {
                    customerField.show();
                    memberField.hide();
                }
            }

            if(isInstructed.val() != '') {
                if(isInstructed.val() == 1) {
                    instructorField.show();
                } else {
                    instructorField.hide();
                }
            }

            checkRequireFieldIfEmpty(isMember, isInstructed, packageId);
        }

        function checkRequireFieldIfEmpty(isMember, isInstructed, packageId) {
            let retVal = 0;

            if(isMember.val() != '') {
                retVal += 1;
            }

            if(isInstructed.val() != '') {
                retVal += 1;
            }

            if(packageId.val() != '') {
                retVal += 1;
            }
            console.log([
                isMember.val(),
                isInstructed.val(),
                packageId.val(),
                retVal
            ]);

            if(retVal > 2) {
                $('#hiddenSection').show();
            } else {
                $("#hiddenSection").hide();
            }
        }

        function fetchPrograms(isMember = '', isInstructed = '', packageId) {
            let data = {};

            if(!isMember.empty) {
                data.is_member = isMember;
            }

            if(!isInstructed.empty) {
                data.is_instructed = isInstructed;
            }

            $.ajax({
                type : 'get',
                url  : getURL('api/InstructorPackage/getAll'),
                data : data,
                success : function(response) {
                    let responseData = JSON.parse(response);

                    if(!responseData.empty) {
                        packageId.empty();

                        $.each(responseData, function(key, value){
                            if(key == 0) {
                                $(packageId).append($("<option> </option>").attr('value', '').text('--Select'));
                            }
                            $(packageId).append(
                                $("<option> </option>").
                                    attr('value', value.id).
                                    attr('data-amount', value.amount).
                                    text(value.package_name)
                            );
                        });
                    }
                }
            });
        }
    </script>
<?php endbuild()?>

<?php build('styles') ?>
    <style>
        .autohide{
            display: none;
        }

        #hiddenSection {
            display: none;
        }
    </style>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>