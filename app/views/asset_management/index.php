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
                        <div><h5><?php echo $row->title?></h5></div>
                            <a href="#" data-title="<?php echo $row->title?>" data-url="<?php echo $row->full_url?>" class="viewAsset">
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

    <div class="modal fade" id="modalAsset" tabindex="-1" role="dialog" aria-labelledby="modalAssetCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAssetCenterTitle"><span id="itemName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="modalIframe" frameborder="0" 
                style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:1000px;width:100%;" 
                height="100%" width="100%"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts') ?>
    <script>
        $(document).ready(function(){
            $('.viewAsset').click(function(){
                let assetSource = $(this).data('url');
                $('#modalIframe').attr('src', assetSource);
                $('#modalAsset').modal('show');
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo('tmp/nobs_auth')?>
