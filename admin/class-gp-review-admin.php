<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://getphound.com
 * @since      1.0.0
 *
 * @package    gp_review
 * @subpackage gp_review/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    gp_review
 * @subpackage gp_review/admin
 * @author     Ryan Rudolph <ryan@ryanrudolph.com>
 */
class gp_review_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in gp_review_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The gp_review_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gp-review-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in gp_review_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The gp_review_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gp-review-admin.js', array( 'jquery' ), $this->version, false );

	}

}

/* --------------------------------------------------------------------
Customize Login
-------------------------------------------------------------------- */
function gp_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('https://getphound.com/wp-content/themes/getphound/images/logo.png');
			height:59px;
			width:378px;
			background-size: 378px 59px;
			background-repeat: no-repeat;
        	padding-bottom: 30px;
        	margin-left: -30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'gp_login_logo' );

function gp_login_logo_url() {
    return 'https://getphound.com';
}
add_filter( 'login_headerurl', 'gp_login_logo_url' );

function gp_login_logo_url_title() {
    return 'GetPhound | Online Marketing Company';
}
add_filter( 'login_headertitle', 'gp_login_logo_url_title' );

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', plugin_dir_url( __FILE__ ) . 'css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/* --------------------------------------------------------------------
Add Settings Page
-------------------------------------------------------------------- */
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function review_funnel_settings_init() {
 // register a new setting for "review_funnel" page
 register_setting( 'review_funnel', 'review_funnel_options' );
 
 // register a new section in the "review_funnel" page
 add_settings_section(
 'review_funnel_section_developers',
 __( 'The Matrix has you.', 'review_funnel' ),
 'review_funnel_section_developers_cb',
 'review_funnel'
 );
 
 // register a new field in the "review_funnel_section_developers" section, inside the "review_funnel" page
 add_settings_field(
 'review_funnel_field_pill', // as of WP 4.6 this value is used only internally
 // use $args' label_for to populate the id inside the callback
 __( 'Pill', 'review_funnel' ),
 'review_funnel_field_pill_cb',
 'review_funnel',
 'review_funnel_section_developers',
 [
 'label_for' => 'review_funnel_field_pill',
 'class' => 'review_funnel_row',
 'review_funnel_custom_data' => 'custom',
 ]
 );
}
 
/**
 * register our review_funnel_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'review_funnel_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function review_funnel_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'review_funnel' ); ?></p>
 <?php
}
 
// pill field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function review_funnel_field_pill_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'review_funnel_options' );
 // output the field
 ?>
 <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['review_funnel_custom_data'] ); ?>"
 name="review_funnel_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'review_funnel' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'review_funnel' ); ?>
 </option>
 </select>
 <p class="description">
 <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'review_funnel' ); ?>
 </p>
 <p class="description">
 <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'review_funnel' ); ?>
 </p>
 <?php
}
 
/**
 * top level menu
 */
function review_funnel_options_page() {
 // add top level menu page
 add_menu_page(
 'Review Funnel',
 'Review Funnel',
 'manage_options',
 'review_funnel',
 'review_funnel_options_page_html'
 );
}
 
/**
 * register our review_funnel_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'review_funnel_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function review_funnel_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'review_funnel_messages', 'review_funnel_message', __( 'Settings Saved', 'review_funnel' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'review_funnel_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "review_funnel"
 settings_fields( 'review_funnel' );
 // output setting sections and their fields
 // (sections are registered for "review_funnel", each field is registered to a specific section)
 do_settings_sections( 'review_funnel' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}