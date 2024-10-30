<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Bsb_Plugin
 * @subpackage Bsb_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bsb_Plugin
 * @subpackage Bsb_Plugin/public
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Bsb_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bsb-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bsb-plugin-public.js', array( 'jquery' ), $this->version, false );

	}


	public function scroll_style(){
		$options = get_option('bsb_display_options');
		// var_dump($options['scroll_bar_width'] );
		if ($options['enable_bsb'] ==1 ) {
			echo " 
			<style>
			::-webkit-scrollbar {width: ".$options['scroll_bar_width']."px;} ::-webkit-scrollbar-button {width: ".$options['scrollbar_btn_width']."px; height: ".$options['scrollbar_btn_height']."px; background:".$options['scrollbar_btn_bg']."; } ::-webkit-scrollbar-track { background :".$options['scrollbar_track_bg']."; border: thin solid ".$options['scrollbar_track_border_color']."; box-shadow: 0px 0px 3px ".$options['scrollbar_track_border_color']." inset; border-radius:".$options['scrollbar_track_border_radius']."px; } ::-webkit-scrollbar-thumb { background:".$options['scrollbar_thumb_bg']."; border: thin solid ".$options['scrollbar_thumb_bg']."; border-radius: ".$options['scrollbar_thumb_border_radius']."px; } ::-webkit-scrollbar-thumb:hover { background:".$options['scrollbar_thumb_hover']."; }  
			</style>


			";
		}

	}

}
