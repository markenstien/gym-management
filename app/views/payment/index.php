<?php build('content')?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Payments</h4>
        </div>

        <div class="card-body">
            <?php $total = 0?>
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                        <th>#</th>
                        <th>Reference</th>
                        <th>Key</th>
                        <th>Amount</th>
                        <th>Payer</th>
                        <th>Staff</th>
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
                                <td><?php echo $row->payer_name?></td>
                                <td><?php echo $row->staff_name?></td>
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