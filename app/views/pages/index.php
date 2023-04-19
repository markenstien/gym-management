<?php build('content')?>
	<div id="banner">
		<section id="image_slider">
			<img src="" id="imageSliderImage" style="width:100%">
		</section>
	</div>

	<?php echo wDivider()?>
	<div class="flex">
		<div class="flex-container" style="flex:3">
			<p>
				We, at GNG Fitness Gym actively encourage people of all ages to live life to the fullest by having proper exercise and workout 
			</p>
			<?php echo wDivider('20')?>

			<?php
				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_1.jpg',
					'IMAGE ONE', 'abcd-efgh');

				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_2.jpg',
					'IMAGE TWO', 'abcd-efgh');

				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_3.jpg',
					'IMAGE THREE', 'abcd-efgh');

				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_4.jpg',
					'IMAGE FOUR', 'abcd-efgh');

				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_5.jpg',
					'IMAGE FIVE', 'abcd-efgh');

				echo wTmpimageCard(URL.'/'.'public/uploads/gallery/img_6.jpg',
					'IMAGE SIX', 'abcd-efgh');
			?>
			<hr>
			<?php echo wDivider('100')?>
			<div>
				<h4>Checkout our Virtual Tour</h4>
				<?php echo wLinkDefault('https://panorama.gymmgmt.online/', 'Click here for better tour')?>
			<embed src="http://localhost/thesis/gym_management_panorama" style="width:100%; height: 30vh;"></embed>
			</div>
		</div>	

		<div class="flex-container" style="flex:1">
			<?php Flash::show()?>
	        <div class="card">
	        	<h4 class="card-title">Login Here</h4>
	        	<div class="card-body">
	        		<?php  __( $form->start() ); ?>
	        		  <i>for existing customers only</i>
		              <div class="mb-3">
		                <?php __( $form->getCol('username' , ['required' => true]) ); ?>
		              </div>
		              <div class="mb-3">
		                <?php __( $form->getCol('password') ); ?>
		              </div>
		              <!-- <div class="form-check mb-3">
		                <input type="checkbox" class="form-check-input" id="authCheck">
		                <label class="form-check-label" for="authCheck">
		                  Remember me
		                </label>
		              </div> -->
		              <div class="mb-3">
		                <?php __($form->get('submit', ['value' => 'Login'])) ?>
		              </div>
		              <a href="<?php echo _route('auth:register')?>" class="d-blocktext-muted">Not a user? Sign up</a>
		            <?php __( $form->end() )?>
	        	</div>
	        </div>

	        <iframe height="315" src="https://www.youtube.com/embed/5BDR5L0LYAo?start=120" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
		</div>
	</div>
	<?php echo wDivider()?>
	<div id="content">
		<div class="flex">
			<div style="flex:1">
				<p><i class="fa fa-building"></i> 3F JMT Bldg. ML Quezon Ext., Antipolo, Philippines, 1870</p>
				<p><i class="fa fa-phone"></i>  0915 667 3716</p>
				<p><i class="fa fa-envelope"></i> <a href="mailto:gngfitnessgym@gmail.com">gngfitnessgym@gmail.comgm</a> </p>
			</div>
			<div style="flex:1">
				<h4>Opening Hours</h4>
				<dl>
					<dd>Mon:7:00am–7:00pm</dd>
					<dd>Tue:7:00am–9:00pm</dd>
					<dd>Wed:7:00am–9:00pm</dd>
					<dd>Thu:7:00am–9:00pm</dd>
					<dd>Fri:7:00am–9:00pm</dd>
					<dd>Sat:7:00am–9:00pm</dd>
					<dd>Sun:7:00am–9:00pm</dd>
				</dl>
			</div>
		</div>
		<div class="flex">
			<div style="flex:1" class="flex-container">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure 
				<?php echo wLinkDefault("https://panorama.gymmgmt.online/", 'Explore Our Gym(360 Panorama)')?></p>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php build('scripts') ?>
	<script type="text/javascript">
		$(document).ready(function(){
			const imageSliderImage = $("#imageSliderImage");
			let imageCurrent = 0;
			let imageSets = [
				'https://www.shutterstock.com/image-illustration/energetic-fitness-training-banner-ad-260nw-1896542266.jpg',
				'https://i.ytimg.com/vi/NqwXYtrVyqg/maxresdefault.jpg',
				'https://img.freepik.com/premium-psd/gym-fitness-web-banner-template_106176-655.jpg',
				'https://i.pinimg.com/736x/5b/d5/54/5bd554c69a70b50334f2c8da7c6e3383.jpg'
			];
			imageSliderImage.attr('src', imageSets[imageCurrent]);
			setInterval(function()
			{
				if(imageCurrent >= imageSets.length) {
					imageCurrent=0;
				} else {
					imageCurrent++;
				}
				imageSliderImage.attr('src', imageSets[imageCurrent]);
			}, 2000);
		});
	</script>
<?php endbuild() ?>

<?php build('styles') ?>
<style>
	div.gallery {
	  margin: 5px;
	  border: 1px solid #ccc;
	  float: left;
	  width: 180px;
	}

	div.gallery:hover {
	  border: 1px solid #777;
	}

	div.gallery img {
	  width: 100%;
	  height: auto;
	}

	div.desc {
	  padding: 15px;
	  text-align: center;
	}
</style>
<?php endbuild()?>
<?php 
	function wTmpimageCard($src,$description,$alt) {
		return <<<EOF
		<div class="gallery">
		  <a target="_blank" href="{$src}">
		    <img src="{$src}" alt="{$alt}" width="600" height="400">
		  </a>
		  <div class="desc">{$description}</div>
		</div>
		EOF;
	}
?>
<?php loadTo('tmp/nobs_public')?>