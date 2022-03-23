<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<div class="lwa lwa-divs-only">
	<span class="lwa-status"></span>
	<div class="lwa-login-form">
		<form name="lwa-form" class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">

			<div class="lwa-title"><span><?php esc_html_e("Login",'bomby'); ?></span></div>

			<div class="lwa-field lwa-username">
				<i class="fa fa-user"></i>
				<?php $msg = esc_html__('Username','bomby'); ?>
				<input type="text" name="log" id="lwa_user_login" class="input" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
			</div>

			<div class="lwa-field lwa-password">
				<i class="fa fa-lock"></i>
				<?php $msg = esc_html__('Password','bomby'); ?>
				<input type="password" name="pwd" id="lwa_user_pass" class="input" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
			</div>
			
			<div class="lwa-login_form">
				<?php do_action('login_form'); ?>
			</div>
	   
			<div class="lwa-submit-button">
				<input type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php esc_attr_e('Log In','bomby'); ?>" tabindex="100" />
				<input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
				<input type="hidden" name="login-with-ajax" value="login" />
			</div>
			
			<div class="lwa-links">
	        	<?php if( !empty($lwa_data['remember']) ): ?>
				<a class="lwa-links-remember" href="<?php echo esc_url(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found','bomby') ?>"><?php esc_attr_e('Lost your password?','bomby') ?></a>
				<?php endif; ?>
				<?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>
				<br />  
				<a href="<?php echo esc_url(LoginWithAjax::$url_register); ?>" class="lwa-links-register-inline"><?php esc_html_e('Register','bomby'); ?></a>
				<?php endif; ?>
			</div>
		</form>
	</div><!-- .lwa-login-form -->
	<?php if( !empty($lwa_data['remember']) ): ?>
	<form name="lwa-remember" class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" method="post" style="display:none;">

		<div class="lwa-title"><span><?php esc_html_e("Forgotten Password",'bomby'); ?></span></div>

		<div class="lwa-field lwa-remember-email"> 
			<i class="fa fa-user"></i>
			<?php $msg = esc_html__("Enter username or email",'bomby'); ?>
			<input type="text" name="user_login" id="lwa_user_remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
			<?php do_action('lostpassword_form'); ?>
		</div>
		<div class="lwa-submit-button">
			<input type="submit" value="<?php esc_attr_e("Get New Password", 'bomby'); ?>" />
			<a href="#" class="lwa-links-remember-cancel"><?php esc_attr_e("Cancel", 'bomby'); ?></a>
			<input type="hidden" name="login-with-ajax" value="remember" />         
		</div>
	</form>
	<?php endif; ?>
	<?php if ( $lwa_data['registration'] == true ) : ?>
	<div class="lwa-register" style="display:none;" >
		<form name="registerform" id="registerform" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">

			<div class="lwa-title"><span><?php esc_html_e('Register For This Site','bomby'); ?></span></div>  

			<div class="lwa-field lwa-username">
				<i class="fa fa-user"></i>
				<?php $msg = esc_html__('Username','bomby'); ?>
				<input type="text" name="user_login" id="user_login"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />   
		  	</div>
		  	<div class="lwa-field lwa-email">
		  		<i class="fa fa-envelope"></i>
		  		<?php $msg = esc_html__('E-mail','bomby'); ?>
				<input type="text" name="user_email" id="user_email"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}"/>   
			</div>
			<?php
				//If you want other plugins to play nice, you need this: 
				do_action('register_form'); 
			?>
			<p class="lwa-submit-button">
				<?php esc_html_e('A password will be e-mailed to you.','bomby') ?>
				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register', 'bomby'); ?>" tabindex="100" />
				<a href="#" class="lwa-links-register-inline-cancel"><?php esc_html_e("Cancel", 'bomby'); ?></a>
				<input type="hidden" name="login-with-ajax" value="register" />
			</p>
		</form>
	</div>
	<?php endif; ?>
</div>