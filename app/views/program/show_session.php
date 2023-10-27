<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Total Session Attendees</h4>
        </div>

        <div class="card-body">
            <?php echo wLinkDefault(_route('program:show', $session->program_id), 'Back To Program')?>
            <?php echo wDivider(15)?>
            
            <h4>Attendees (<?php echo count($session->attendees)?>)</h4>
            <?php echo wDivider(5)?>
            <ul>
                <?php foreach($session->attendees as $key => $row) :?>
                    <li>(<?php echo $row['user_identification']?>) - <?php echo $row['name']?></li>
                <?php endforeach?>
            </ul>
            <?php echo wDivider(15)?>
            <div>
                <label for="#">Remarks</label>
                <p><?php echo $session->remarks?></p>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>