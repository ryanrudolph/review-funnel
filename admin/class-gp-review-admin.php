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
 * Top Level Menu
 */
function review_funnel_options_page() {
 // add top level menu page
 add_menu_page(
 'Review Funnel',
 'Review Funnel',
 'manage_options',
 'review_funnel',
 'review_funnel_options_page_html',
 plugins_url( 'gp-review/images/icon.png' )
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

?>

 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <h2>Directions</h2>
 <ol class="directions">
 	<li>Download import file.</li>
 	<li>Upload import file by going to <em>Forms</em> > <em>Import/Export</em> > <em>Import Forms</em>.</li>
 	<li>Update the new forms <em>Notification</em> settings.</li>
 </ol>
 <br>
 <a href="/wp-content/plugins/gp-review/import/" download="import.json" class="button"><button>Download Gravity Forms Import File</button></a>
 </div>
 <?php
}