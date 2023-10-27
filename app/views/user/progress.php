<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Progress</h4>
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
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>