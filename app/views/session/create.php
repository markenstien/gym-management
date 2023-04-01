<?php build('content') ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Session Payment</h4>
                <?php Flash::show()?>
                <?php echo wLinkDefault(_route('session:with-instructor'), 'Create With Instructor')?>
            </div>

            <div class="card-body">
                <?php 
                    Form::open(['method' => 'post']);
                ?>
                <div class="form-group">
                    <?php
                        Form::label('Customer Type');
                        Form::select('customer_type', [
                            'non_member' => 'NON Member',
                            'member' => 'Member'
                        ], $_POST['customer_type'] ?? 'Member', [
                            'class' => 'form-control',
                            'required' => true,
                            'id' => 'customerType'
                        ])
                    ?>
                </div>

                <div class="form-group">
                    <?php
                        Form::label('Member ID', 'user_key_word', ['id' => 'labelUserKeyword']);
                        Form::text('user_key_word', '', [
                            'class' => 'form-control',
                            'required' => true
                        ])
                    ?>
                </div>

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
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            const customerType = $("#customerType");
            applyAmount();
            $("#customerType").change(function(){
                applyAmount(amount);
            });

            function applyAmount() {
                switch(customerType.val()) {
                    case 'member':
                        $("#labelUserKeyword").html('Member ID');
                        $("#amount").val(80);
                    break;

                    default:
                        $("#labelUserKeyword").html('Customer Name');
                        $("#amount").val(100);
                    break;
                }
            }
        });
    </script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>