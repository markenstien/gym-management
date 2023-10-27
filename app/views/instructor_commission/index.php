<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Commissions</h4>
        </div>

        <div class="card-body">
            <?php Flash::show()?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <?php if(isAdmin()) :?>
                            <th>Instructor</th>
                        <?php endif?>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php foreach($commissions as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <?php if(isAdmin()) :?>
                                    <td><?php echo $row->instructor_name?></td>
                                <?php endif?>
                                <td><?php echo $row->amount?></td>
                                <td><?php echo $row->remarks?></td>
                                <td><?php echo time_since($row->created_at)?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>