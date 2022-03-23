<?php
/**
 *
 * Class used as base to create modules that can be attached to layouts 
 *
 * @package   IvanFramework
 */

class Ivan_Module_Login_Ajax extends Ivan_Module {

	// Module slug used as parameters to actions and filters
	public $slug = '_login_ajax';

	/**
	 * Calls the respective template part or markup that must be displayed
	 *
	 * @since     1.0.0
	 */
	public static function display( $classes = '' ) {
		if( function_exists('login_with_ajax') ) {
		?>

		<div class="iv-module login-ajax <?php echo esc_attr($classes); ?>">
			<div class="centered">
				<a href="#" class="trigger"><i class="fa fa-user"></i></a>
				<div class="inner-wrapper">
					<div class="inner-form">
					 	<?php login_with_ajax( array( 'profile_link' => 1 ) ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		} // endif to login_with_ajax conditional
	}

}

