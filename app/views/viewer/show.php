<?php build('content') ?>
	<iframe src="<?php echo $file?>" frameborder="0" 
	style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:1000px;width:100%;" 
	height="100%" width="100%"></iframe>
<?php endbuild()?>
<?php loadTo('tmp/basic')?>