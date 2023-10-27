   <?php build('content')?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Payments</h4>
            <?php echo wLinkDefault('#', 'Advance Filter', [
                'class' => 'el-toggler',
                'data-target' => '#page_filter'
            ])?>
        </div>

        <div class="card-body">
            <div id="page_filter" <?php echo !isset($_GET['btn_filter']) ? 'class="hidden"' : '' ?> >
                <h2>Form Filter</h2>
                <?php
                    Form::open([
                        'method' => 'get'
                    ]);
                ?>
                    <div class="form-group">
                        <?php
                            Form::label('Date Duration');
                        ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    Form::label('Start Date');
                                    Form::date('start_date', '' , [
                                        'class' => 'form-control',
                                        'required' => 'true'
                                    ]);
                                ?>
                            </div>

                            <div class="col-md-6">
                                <?php
                                    Form::label('End Date');
                                    Form::date('end_date', '' , [
                                        'class' => 'form-control',
                                        'required' => 'true'
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                            Form::submit('btn_filter', 'Apply Filter');
                            echo wLinkDefault(_route('payment:index'), 'Remove Filter');
                        ?>
                    </div>
                <?php Form::close()?>
            </div>
            <?php $total = 0?>
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>Reference</th>
                        <th>Key</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Payer</th>
                        <th>Staff</th>
                        <th>Remarks</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php foreach($payments as $key => $row) :?>
                            <?php $total += $row->amount?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->reference?></td>
                                <td><?php echo $row->payment_key?></td>
                                <td><?php echo $row->amount?></td>
                                <td><?php echo $row->payment_method?></td>
                                <td><?php echo $row->member_name?></td>
                                <td><?php echo $row->staff_name?></td>
                                <td><?php echo $row->remarks?></td>
                                <td><?php echo $row->created_at?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
            <h4 class="mt-2">Total : <?php echo amountHTML($total)?> </h4>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>