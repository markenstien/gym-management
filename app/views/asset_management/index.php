<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tutorials</h4>
        </div>

        <div class="card-body">
            <?php if(!empty($assets)) :?>
                <div class="row">
                <?php foreach($assets as $key => $row) :?>
                    <div class="box col-md-2 text-center">
                        <div><h5><?php echo $row->title?></h5> * <?php echo wExtensionType($row->file_type)?></div>
                            <a href="<?php echo _route('viewer:show', [
                                    'file' => seal($row->full_url)
                                ])?>">
                                <div style="width: 100%; border:1px solid #000;">
                                    <?php if(isEqual(wExtensionType($row->file_type), 'image')) :?>
                                        <img src="<?php echo $row->full_url?>" 
                                            alt="" style="width: 100%; height:300px">
                                    <?php else:?>
                                        <img src="https://images.assetsdelivery.com/compings_v2/rahultiwari3190/rahultiwari31901905/rahultiwari3190190500234.jpg" 
                                            alt="" style="width: 100%; height:300px">
                                    <?php endif?>
                                </div>
                            </a>
                        <div><?php echo $row->description?></div>
                    </div>
                <?php endforeach?>
                </div>
            <?php endif?>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>