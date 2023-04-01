<?php build('content')?>
	<div id="banner">
		<img src="https://www.shutterstock.com/image-illustration/energetic-fitness-training-banner-ad-260nw-1896542266.jpg"
		style="width:100%">
	</div>

	<?php echo wDivider()?>
	<div class="flex">
		<div class="flex-container" style="flex:3">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<?php echo wDivider('20')?>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/5BDR5L0LYAo?start=120" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
		</div>
	</div>
	<?php echo wDivider()?>
	<div id="content">
		<div class="flex">
			

			<div style="flex:1" class="flex-container">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure 
				<?php echo wLinkDefault(_route('auth:login'), 'Explore Our Gym(360 Panorama)')?></p>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo('tmp/nobs_public')?>