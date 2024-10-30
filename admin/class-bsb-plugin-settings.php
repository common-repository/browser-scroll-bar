<?php

/**
 * The settings of the plugin.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Bsb_Plugin
 * @subpackage Bsb_Plugin/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class Bsb_Admin_Settings {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * This function introduces the theme options into the 'Appearance' menu and into a top-level
	 * 'WPPB Demo' menu.
	 */
	public function setup_plugin_options_menu() {

		//Add the menu to the Plugins set of menu items

		add_options_page(
			'Browser Scroll Bar', 
			'Browser Scroll Bar',
			'manage_options',
			'bsb_options',
			array( $this, 'render_settings_page_content')
		);

	}

	/**
	 * Provides default values for the Display Options.
	 *
	 * @return array
	 */
	public function default_display_options() {

		$defaults = array(
			'enable_bsb'		=>	'',
			'scroll_bar_width'		=>	'',
			'scrollbar_button'		=>	'',
		);

		return $defaults;

	}



	public function render_settings_page_content( $active_tab = '' ) {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php _e( 'Browser Scroll bar Option', 'bsb-plugin' ); ?></h2>
			<?php settings_errors(); ?>

			<?php if( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];
			} else if( $active_tab == 'about_options' ) {
				$active_tab = 'about_options';
			} else {
				$active_tab = 'display_options';
			} // end if/else ?>

			<h2 class="nav-tab-wrapper">
				<a href="?page=bsb_options&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Display Options', 'bsb-plugin' ); ?></a>
				<a href="?page=bsb_options&tab=about_options" class="nav-tab <?php echo $active_tab == 'about_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'About', 'bsb-plugin' ); ?></a>
				<!-- <a href="?page=bsb_options&tab=input_examples" class="nav-tab <?php echo $active_tab == 'input_examples' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Input Examples', 'bsb-plugin' ); ?></a> -->
			</h2>

			<form method="post" action="options.php">
				<?php

				if( $active_tab == 'display_options' ) {

					settings_fields( 'bsb_display_options' );
					do_settings_sections( 'bsb_display_options' );
					submit_button();

				} elseif( $active_tab == 'about_options' ) {

					settings_fields( 'bsb_about_options' );
					do_settings_sections( 'bsb_about_options' );

				} else {

					// settings_fields( 'bsb_input_examples' );
					// do_settings_sections( 'bsb_input_examples' );

				} // end if/else

				// submit_button();

				?>
			</form>

		</div><!-- /.wrap -->
		<?php
	}



	public function general_options_callback() {
		$options = get_option('bsb_display_options');
		// var_dump($options);
		echo '<p>' . __( 'Customize setting you want to on Scroll Bar to display.', 'bsb-plugin' ) . '</p>';
	} // end general_options_callback


	public function about_options_callback() {
		$options = get_option('bsb_about_options');
		echo '
		<p> <a href="https://wordpress.org/plugins/widget-youtube-subscribtion/" target="_blank">Easy Subscribe Button Widget >></a></p>
		<p> <a href="https://wordpress.org/plugins/popup-notification-news-alert/" target="_blank">Toast Popup Notification News Alert >></a></p>
		<p> <a href="https://wordpress.org/plugins/embed-page-facebook/" target="_blank">Easy Embed Page Widget >></a></p>

		';
	} 


	public function initialize_display_options() {

		if( false == get_option( 'bsb_display_options' ) ) {
			$default_array = $this->default_display_options();
			add_option( 'bsb_display_options', $default_array );
		}


		add_settings_section(
			'general_settings_section',
			__( 'Display Options', 'bsb-plugin' ),	
			array( $this, 'general_options_callback'),	
			'bsb_display_options'
		);


		add_settings_field(
			'enable_bsb',		
			__( 'Enable', 'bsb-plugin' ),
			array( $this, 'bsb_enable_callback'),
			'bsb_display_options',	
			'general_settings_section',	
			array(
				__( 'Activate this setting to display the style of Browser scroll bar.', 'bsb-plugin' ),
			)
		);

		add_settings_field(
			'show_content',
			__( 'Scroll bar width', 'bsb-plugin' ),
			array( $this, 'scroll_bar_width_callback'),
			'bsb_display_options',
			'general_settings_section'
		);

		add_settings_field(
			'scrollbar_button',
			__( 'Scrollbar button', 'bsb-plugin' ),
			array( $this, 'scrollbar_button_callback'),
			'bsb_display_options',
			'general_settings_section',
			array(
				__( 'Activate this setting to display the footer.', 'bsb-plugin' ),
			)
		);

		add_settings_field(
			'scrollbar_track',
			__( 'Scrollbar track', 'bsb-plugin' ),
			array( $this, 'scrollbar_track_callback'),
			'bsb_display_options',
			'general_settings_section',
			array(
				__( 'Activate this setting to display the footer.', 'bsb-plugin' ),
			)
		);		

		add_settings_field(
			'scrollbar_thumb',
			__( 'Scrollbar thumb', 'bsb-plugin' ),
			array( $this, 'scrollbar_thumb_callback'),
			'bsb_display_options',
			'general_settings_section',
			array(
				__( 'Activate this setting to display the footer.', 'bsb-plugin' ),
			)
		);


		// Finally, we register the fields with WordPress
		register_setting(
			'bsb_display_options',
			'bsb_display_options'
		);

	} // end bsb_initialize_theme_options



	public function initialize_about_options() {
		// delete_option('bsb_about_options');
		if( false == get_option( 'bsb_about_options' ) ) {
			$default_array = $this->default_about_options();
			update_option( 'bsb_about_options', $default_array );
		} // end if

		add_settings_section(
			'social_settings_section',			// ID used to identify this section and with which to register options
			__( 'You may also like this plugin', 'bsb-plugin' ),		// Title to be displayed on the administration page
			array( $this, 'about_options_callback'),	// Callback used to render the description of the section
			'bsb_about_options'		// Page on which to add this section of options
		);

	}



	public function bsb_enable_callback($args) {

		// First, we read the options collection
		$options = get_option('bsb_display_options');

		// Next, we update the name attribute to access this element's ID in the context of the display options array
		// We also access the enable_bsb element of the options collection in the call to the checked() helper function
		$html = '<input type="checkbox" id="enable_bsb" name="bsb_display_options[enable_bsb]" value="1" ' . checked( 1, isset( $options['enable_bsb'] ) ? $options['enable_bsb'] : 0, false ) . '/>';

		// Here, we'll take the first argument of the array and add it to a label next to the checkbox
		$html .= '<label for="enable_bsb">&nbsp;'  . $args[0] . '</label>';

		echo $html;

	} 

	public function scroll_bar_width_callback($args) {

		$options = get_option('bsb_display_options');

		echo '<input type="number" id="scroll_bar_width" min="1" max="20" name="bsb_display_options[scroll_bar_width]" value="' . $options['scroll_bar_width'] . '" />';

	} 

	public function scrollbar_button_callback($args) {

		$options = get_option('bsb_display_options');

		echo '
		<div><p><input type="number" id="scrollbar_btn_width" min="1" max="20" name="bsb_display_options[scrollbar_btn_width]"   placeholder="width" value="' . $options['scrollbar_btn_width'] . '"/> <small>Scroll bar top bottom button  width</small></p></div><div><p><input type="number" id="scrollbar_btn_height" min="1" max="20" name="bsb_display_options[scrollbar_btn_height]"   placeholder="height" value="' . $options['scrollbar_btn_height'] . '"/> <small>Scroll bar  top bottom button height</small></p></div><div><p><input type="text"  id="scrollbar_btn_bg" name="bsb_display_options[scrollbar_btn_bg]" class="my-color-field" data-default-color="#1e73be" value="' . $options['scrollbar_btn_bg'] . '" /><small>Scroll bar top bottom button color</small></p></div>
		';

	} 

	public function scrollbar_track_callback($args) {

		$options = get_option('bsb_display_options');

		echo '
		<div><input type="text"  id="scrollbar_track_bg" name="bsb_display_options[scrollbar_track_bg]" class="my-color-field" data-default-color="#dd3333" value="' . $options['scrollbar_track_bg'] . '" /> <small>Scroll bar track background color</small></div><div><input type="text"  id="scrollbar_track_border_color" name="bsb_display_options[scrollbar_track_border_color]" class="my-color-field" data-default-color="#8224e3" value="' . $options['scrollbar_track_border_color'] . '" /> <small>Scroll bar track border color</small></div><input type="number" id="scrollbar_track_border_radius" min="1" max="20" name="bsb_display_options[scrollbar_track_border_radius]"   placeholder="Border radius" value="' . $options['scrollbar_track_border_radius'] . '"/> <small>Scroll bar track border radius</small>
		
		';

	} 

	public function scrollbar_thumb_callback($args) {

		$options = get_option('bsb_display_options');

		echo '
		<div><input type="text"  id="scrollbar_thumb_bg" name="bsb_display_options[scrollbar_thumb_bg]" class="my-color-field" data-default-color="#dd9933" value="' . $options['scrollbar_thumb_bg'] . '" /> <small>Scroll bar track background color</small></div><div><input type="text"  id="scrollbar_thumb_hover" name="bsb_display_options[scrollbar_thumb_hover]" class="my-color-field" data-default-color="#81d742" value="' . $options['scrollbar_thumb_hover'] . '" /> <small>Scroll bar track background color</small></div><input type="number" id="scrollbar_thumb_border_radius" min="1" max="20" name="bsb_display_options[scrollbar_thumb_border_radius]"   placeholder="Border radius" value="' . $options['scrollbar_thumb_border_radius'] . '"/> <small>Scroll bar track border radius</small>
		
		';

	} 


	/**
	 * Sanitization callback for the social options. Since each of the social options are text inputs,
	 * this function loops through the incoming option and strips all tags and slashes from the value
	 * before serializing it.
	 *
	 * @params	$input	The unsanitized collection of options.
	 *
	 * @returns			The collection of sanitized values.
	 */
	public function sanitize_about_options( $input ) {

		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach( $input as $key => $val ) {

			if( isset ( $input[$key] ) ) {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			} // end if

		} // end foreach

		// Return the new collection
		return apply_filters( 'sanitize_about_options', $output, $input );

	} // end sanitize_about_options






}