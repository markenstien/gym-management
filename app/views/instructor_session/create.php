<?php build('content') ?>
    <div class="card col-md-5">
        <div class="card-header">
            <h4 class="card-title">Create Session</h4>
            <?php Flash::show()?>
            <?php echo wLinkDefault(_route('instructor-session:index'), 'List of Sessions')?>
        </div>
        
        <div class="card-body">
            <?php echo $_form->getForm('col')?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>