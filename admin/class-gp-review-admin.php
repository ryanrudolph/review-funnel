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
Customize Dashboard
-------------------------------------------------------------------- */
function gp_welcome_panel() {

	echo '<div class="gp-dash-credit">';
		if (get_header_image()) {
			echo '<img src="' . esc_url( get_header_image() ). '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '" />';
		}
		echo '<h3>Welcome to <strong>' . esc_attr( get_bloginfo( 'title' ) ) . '</strong> Content Management System</h3>';
		echo 'Designed and Developed by';
		echo '<a href="https://getphound.com/" target="_blank" class="gp-logo"><img src="https://getphound.com/wp-content/themes/getphound/images/logo.png" alt="GetPhound" /></a>';
		echo 'For questions or technical support call (610) 897 8127 or email <a href="mailto:josh@getphound.com">josh@getphound.com</a>';
	echo '</div>';

}

remove_action('welcome_panel','wp_welcome_panel');
add_action('welcome_panel','gp_welcome_panel'); 

/* --------------------------------------------------------------------
Remove Widgets on Dashboard
-------------------------------------------------------------------- */
function gp_remove_dashboard_widgets() {

	//Remove WordPress default dashboard widgets
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side');
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side');
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

	//Remove additional plugin widgets
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal'); // Yoast

}

add_action('wp_dashboard_setup', 'gp_remove_dashboard_widgets' );

/* --------------------------------------------------------------------
Add Widget On Dashboard
-------------------------------------------------------------------- */
function example_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'general_help_widget',         // Widget slug.
                 'Looking For General Help Editing Your Site?',         // Title.
                 'general_help_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function general_help_widget_function() {

	// Display whatever it is you want to show.
	echo '<p><a href="https://codex.wordpress.org/Writing_Posts">Guide To Writing Posts</a></p>';
}

/* --------------------------------------------------------------------
Remove Unwanted Menu Items from WordPress Admin
-------------------------------------------------------------------- */
function gp_remove_admin_menus (){ 
	/* Remove unwanted menu items by passing their slug to the remove_menu_item() function.
	You can comment out the items you want to keep. */
	remove_menu_page('link-manager.php'); // Links
	remove_menu_page('edit-comments.php'); // Comments
	remove_menu_page('plugins.php'); // Plugins
	remove_submenu_page( 'themes.php', 'customize.php' ); // Doesn't work for some reason
	remove_submenu_page( 'themes.php', 'themes.php' );
	remove_submenu_page( 'themes.php', 'theme-editor.php'); // Doesn't work for some reason
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_menu_page('tools.php'); // Tools
	remove_menu_page('options-general.php'); // Settings

	// Third-Party Plugins
	remove_menu_page('edit.php?post_type=acf-field-group'); // ACF
	remove_menu_page('/admin.php?page=cptui_manage_post_types'); // CPT UI
	remove_menu_page('admin.php?page=wpseo_dashboard'); // Yoast
}

// Add our function to the admin_menu action
add_action('admin_init', 'gp_remove_admin_menus');

// Remove WordPress Admin Bar Menu Items
function wpcustom_admin_bar() {

    global $wp_admin_bar;
	// To remove WordPress logo and related submenu items
   $wp_admin_bar->remove_menu('wp-logo');
   $wp_admin_bar->remove_menu('about');
   $wp_admin_bar->remove_menu('wporg');
   $wp_admin_bar->remove_menu('documentation');
   $wp_admin_bar->remove_menu('support-forums');
   $wp_admin_bar->remove_menu('feedback');
	// To remove Update Icon/Menu
   $wp_admin_bar->remove_menu('updates');
	// To remove Comments Icon/Menu
   $wp_admin_bar->remove_menu('comments');

}
add_action( 'wp_before_admin_bar_render', 'wpcustom_admin_bar' );


// Hide Admin Notications
function hide_update_notice() {

    remove_all_actions( 'admin_notices' );

}
add_action( 'admin_head', 'hide_update_notice', 1 );

// Add GetPhound color scheme
function gp_admin_color_schemes() {
	
	$plugins_url = plugin_dir_url( __FILE__ );

	wp_admin_css_color( 
		'getphound', __( 'GetPhound' ),
		$plugins_url . 'css/getphound/colors.css',
		array( '#333333', '#555555', '#9e2916', '#CCC' )
	);
	
}
add_action('admin_init', 'gp_admin_color_schemes');
add_filter( 'get_user_option_admin_color', function( $color_scheme ) {
$color_scheme = 'getphound';
return $color_scheme;
}, 5 );

// Admin footer modification
function remove_footer_admin() {
    echo '<span id="footer-thankyou">Thank you for using <a href="https://www.getphound.com" target="_blank">GetPhound</a>.</span>';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');
