<div class="banner default">
  	<div class="wrap">
  	    <h1><?php print $registerinfotitle; ?></h1>
  	    <div class="clear"></div>
  	</div>
</div>
<div class="main">	
	<div class="project-wrapper">
		<div class="wrap">
			<div>
				<?php print $registerinfo; ?>
				<?php require 'errormsg.php'; ?>
				<div class="clear"></div>	
			</div>
			<!-- ui-dialog -->
			<div class="content-table content-top">			
				<div class="content-cell-img">
					&nbsp;
				</div>
				<div class="content-cell-form">
					<h5><?php print $registerregistertitle; ?></h5>
					<form id="formregister" method="post" action="">
					<div class="mandatory">
						<label for="username"><?php print $registerusername; ?></label>
						<input type="text" id="username" name="username" maxlength="100" size="25" value="<?php echo $input['username']; ?>" title="<?php print $registeremailqtip; ?>" />
                                        </div><div class="clear"></div>
					<div class="mandatory">
						 <label for="remail"><?php print $registeremail; ?></label>
						 <input type="text" id="remail" name="remail"  maxlength="100" size="25" value="<?php echo $input['remail']; ?>" title="<?php print $registerremailqtip; ?>"/>
					</div><div class="clear"></div>
					<div class="mandatory">
						 <label for="rpassword"><?php print $registerpassword; ?></label>
						 <input type="password" id="rpassword" name="rpassword"  maxlength="20" size="10" value="" title="<?php print $registerpasswordqtip; ?>"/>
					</div><div class="clear"></div>
					<div class="mandatory">
						 <label for="rrepeatpassword"><?php print $registerrepeatpassword; ?></label>
						 <input type="password" id="rrepeatpassword" name="rrepeatpassword"  maxlength="20" size="10" value="" title="<?php print $registerreapeatpasswordqtip; ?>" />
					</div><div class="clear"></div>					
					<div class="elements">
						 <label for="address"><?php print $registeraddress; ?></label>
						 <input type="text" id="address" name="address"  maxlength="100" size="25" value="<?php echo $input['address']; ?>" title="<?php print $registeraddressqtip; ?>" />
					</div><div class="clear"></div>
					<div class="elements">
						 <label for="zip"><?php print $registerzip; ?></label>
						 <input type="text" id="zip" name="zip"  maxlength="20" size="10" value="<?php echo $input['zip']; ?>" title="<?php print $registerzipqtip; ?>" />
					</div><div class="clear"></div>
					<div class="elements">
						 <label for="city"><?php print $registercity; ?></label>
						 <input type="text" id="city" name="city"  maxlength="100" size="25" value="<?php echo $input['city']; ?>" title="<?php print $registercityqtip; ?>" />
					</div><div class="clear"></div>
					<div class="elements">
						 <label for="country"><?php print $registercountry; ?></label>
						 <input type="text" id="country" name="country"  maxlength="100" size="25" value="<?php echo $input['country']; ?>" title="<?php print $registercountryqtip; ?>" />
					</div><div class="clear"></div><br/>
					<div>
						<div class="elements"><span><?php print $registerlanguage; ?></span><br/></div>
						 <?php
							$language = array();
							$language = $generic->getalllanguage($_SESSION['lang']);
							foreach ($language as $elem) {
						?>
							<input type="radio" class="regular-radio" id="site<?php print $elem[0]; ?>" name="site" value="<?php print $elem[0]; ?>" <?php if (isset($_POST['site']) && $elem[0] == $_POST['site']) { print 'checked'; } else { print ''; } ?> title="<?php print $registersiteqtip; ?>" /><label for="site<?php print $elem[0]; ?>"></label>&nbsp;<?php print $elem[1]; ?>&nbsp;
						<?php		
							}
						 ?>
					</div><div class="clear"></div>	
					<div>
						<div class="elements"><span><?php print $registerlanguagerent; ?></span><br/></div>
						<?php
							foreach ($language as $elem) {
								if ($elem[0] == 'pt')
								{
									if (isset($_POST['rentpt']))
										$status = 'checked';
									else {
										$status = '';
									}
								}
								if ($elem[0] == 'fr')
								{
									if (isset($_POST['rentfr']))
										$status = 'checked';
									else {
										$status = '';
									}
								}
								if ($elem[0] == 'en')
								{
									if (isset($_POST['renten']))
										$status = 'checked';
									else {
										$status = '';
									}
								}										
	
						?>
						<input type="checkbox" class="regular-checkbox" id="rent<?php print $elem[0]; ?>" name="rent<?php print $elem[0];  ?>" value="<?php print $elem[0]; ?>" <?php print $status; ?> title="<?php print $registerrentqtip; ?>" /><label for="rent<?php print $elem[0]; ?>"></label>&nbsp;<?php print $elem[1]; ?>&nbsp;
						<?php		
							}
						?>
					</div><div class="clear"></div>
					<br/><br/><br/>
					<div>	
						<!-- reCaptcha -->
						<script src='https://www.google.com/recaptcha/api.js'></script>
						<div class="g-recaptcha" data-sitekey="6Lft7AoUAAAAAPTzcZKmfFQ5Od__cL-GO_K3vbj3"></div>
						<div>
							<input class="btn1 btn-8 btn-8b" type="submit" id="subregister" name="subregister" value="<?php print $registerbtnregister; ?>"/>
						</div>
					</div>
					</form>
				</div>						
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

