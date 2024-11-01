<?php
/**
 * Plugin Name:     WooCommerce Product Barcode Label Printing - Woolabel
 * Plugin URI:      https://woolabel.com/
 * Description:     Woolabel enables you to generate & print physical product labels for your WooCommerce products. Options for each label includes having a scannable barcode on it, SKU number, price and the product title. It allows you to use self-adhesive label stickers to help physically identify products for your customers.
 * Version:         2.2.0
 * Author:          wekekaha
 * Author URI:      https://woolabel.com/
 * License:         GPLv3 or later
 * Text Domain:     woo-product-barcode-label-printing
 * Domain Path:     /languages/
 *
 * Requires at least:       4.1
 * Tested up to:            6.0.2
 *
 * WC requires at least:    4.5
 * WC tested up to:         6.9.3
 **/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}


// This version can't be activate if premium version is active
if ( defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_PREMIUM_INIT' ) ) {
	function wpblp_install_free_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( 'You can\'t activate the free version of WooCommerce Product Barcode Label Printing while you are using the premium one. Visit <a href="https://woolabel.com/?affiliate_id=woolabel_free">woolabel.com</a>', 'woo-product-barcode-label-printing' ); ?></p>
		</div>
		<?php
	}

	add_action( 'admin_notices', 'wpblp_install_free_admin_notice' );

	deactivate_plugins( plugin_basename( __FILE__ ) );

	return;
}


// Constants
if ( ! defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_VERSION' ) ) {
	define( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_VERSION', '2.2.0' );
}

if ( ! defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE' ) ) {
	define( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE', __FILE__ );
}

if ( ! defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_FREE_INIT' ) ) {
	define( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_FREE_INIT', plugin_basename( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE ) );
}

if ( ! defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH' ) ) {
	define( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH', plugin_dir_path( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE ) );
}

if ( ! defined( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_URL' ) ) {
	define( 'WOO_PRODUCT_BARCODE_LABEL_PRINTING_URL', plugin_dir_url( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE ) );
}


// Hooks
register_activation_hook( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE, array( 'Woo_Product_Barcode_Label_Printing', 'wpblp_activate' ) );
register_deactivation_hook( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE, array( 'Woo_Product_Barcode_Label_Printing', 'wpblp_deactivate' ) );
register_uninstall_hook( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE, array( 'Woo_Product_Barcode_Label_Printing', 'wpblp_uninstall' ) );


class Woo_Product_Barcode_Label_Printing {
	protected static $instance;

	static function wpblp_init() {
		is_null( self::$instance ) and self::$instance = new self();
		return self::$instance;
	}


	// Construct
	function __construct() {
		// Checking if Current User has rights and load parts
		if ( current_user_can( 'edit_pages' ) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			// Load Parts
			require_once WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH . 'inc/generator.php'; // Generator
			require_once WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH . 'inc/settings.php'; // Settings Page
			require_once WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH . 'inc/info.php'; // Information Page
			require_once WOO_PRODUCT_BARCODE_LABEL_PRINTING_PATH . 'inc/functions.php'; // Functions Page

			// Scripts & Styles
			add_action( 'admin_enqueue_scripts', array( $this, 'wpblp_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'wpblp_scripts' ) );

			// Service
			add_filter( 'plugin_row_meta', array( $this, 'wpblp_plugin_row_meta' ), 10, 2 );

			// Add Pages to Admin Panel
			add_action( 'admin_menu', array( $this, 'wpblp_register_pages' ) );

			// Translations
			load_plugin_textdomain( 'woo-product-barcode-label-printing', false, dirname( plugin_basename( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FILE ) ) . '/languages/' );
		} else {
			return false;
		}
	}



	// Callbacks
	// Hooks
	static function wpblp_activate() {
		do_action( 'wpblp_activate' );
	}

	static function wpblp_deactivate() {
		do_action( 'wpblp_deactivate' );
	}

	static function wpblp_uninstall() {
		do_action( 'wpblp_uninstall' );

		// Remove all from database
		delete_option( 'wpblp_settings' );
		delete_option( 'wpblp_presets' );
	}


	// Enqueue Styles & Scripts
	function wpblp_scripts() {
		wp_register_style( 'woo-product-barcode-label-printing_styles', WOO_PRODUCT_BARCODE_LABEL_PRINTING_URL . 'css/styles.css', array(), WOO_PRODUCT_BARCODE_LABEL_PRINTING_VERSION );

		wp_register_script( 'woo-product-barcode-label-printing_scripts', WOO_PRODUCT_BARCODE_LABEL_PRINTING_URL . 'js/scripts.js', array(), WOO_PRODUCT_BARCODE_LABEL_PRINTING_VERSION );

		wp_enqueue_style( 'woo-product-barcode-label-printing_styles' );
		wp_enqueue_script( 'woo-product-barcode-label-printing_scripts' );

		wp_localize_script(
			'woo-product-barcode-label-printing_scripts',
			'wpblp',
			array(
				'nonce' => wp_create_nonce( 'wpblp_nonce' ),
			)
		);
	}


	// Service
	function wpblp_plugin_row_meta( $links, $file ) {
		if ( WOO_PRODUCT_BARCODE_LABEL_PRINTING_FREE_INIT === $file ) {
			$row_meta1 = array(
				'support' => '<a href="' . esc_url( 'https://woolabel.com/contact' ) . '" aria-label="' . esc_attr__( 'Please submit a ticket if you cannot get Woolabel plugin working for you.', 'woo-product-barcode-label-printing' ) . '">' . esc_html__( 'Get Support', 'woo-product-barcode-label-printing' ) . '</a>',
			);
			$row_meta2 = array(
				'premium_demo' => '<a href="' . esc_url( 'https://demo.woolabel.com' ) . '" aria-label="' . esc_attr__( 'Click here to try our premium demo.', 'woo-product-barcode-label-printing' ) . '">' . esc_html__( 'FREE Premium Demo', 'woo-product-barcode-label-printing' ) . '</a>',
			);
			$row_meta3 = array(
				'premium' => '<a style="color:#b8649a; font-weight: bold;" href="' . esc_url( 'https://woolabel.com/?affiliate_id=woolabel_free' ) . '" aria-label="' . esc_attr__( 'Get Premium.', 'woo-product-barcode-label-printing' ) . '">' . esc_html__( 'Get Premium', 'woo-product-barcode-label-printing' ) . '</a>',
			);

			return array_merge( $links, $row_meta1, $row_meta2, $row_meta3 );
		}

		return (array) $links;
	}


	// Register Admin Pages
	function wpblp_register_pages() {
		// Main Page
		add_menu_page( __( 'Woolabel', 'woo-product-barcode-label-printing' ), __( 'Woolabel', 'woo-product-barcode-label-printing' ), 'manage_options', 'wpblp_select_products', 'wpblp_generator_callback', 'dashicons-tag', 64 );

		// Settings Page
		add_submenu_page( 'wpblp_select_products', __( 'Settings', 'woo-product-barcode-label-printing' ), __( 'Settings', 'woo-product-barcode-label-printing' ), 'manage_options', 'wpblp_settings_page', 'wpblp_settings_page_callback' );

		// Info Page
		add_submenu_page( 'wpblp_select_products', __( 'Information', 'woo-product-barcode-label-printing' ), __( 'Information', 'woo-product-barcode-label-printing' ), 'manage_options', 'wpblp_info_page', 'wpblp_info_page_callback' );

		// Support Page Link
		function wpblp_add_support_link_to_menu() {
			global $submenu;

			if ( isset( $submenu['wpblp_select_products'] ) && ! isset( $submenu['wpblp_select_products']['link'] ) ) {
				$submenu['wpblp_select_products']['link'] = array(
					sprintf( '%s%s%s', '<span id="wpblp_support_link">', __( 'Support Page', 'woo-product-barcode-label-printing' ), '</span>' ),
					'manage_options',
					esc_url( 'https://woolabel.com/contact/' ),
					__( 'Support Page', 'woo-product-barcode-label-printing' ),
				);
			}
			
			if ( isset( $submenu['wpblp_select_products'] ) && ! isset( $submenu['wpblp_select_products']['demo'] ) ) {
				$submenu['wpblp_select_products']['demo'] = array(
					sprintf( '%s%s%s', '<span id="wpblp_support_link">', __( 'FREE Premium Demo', 'woo-product-barcode-label-printing' ), '</span>' ),
					'manage_options',
					esc_url( 'https://demo.woolabel.com' ),
					__( 'FREE Premium Demo', 'woo-product-barcode-label-printing' ),
				);
			}
			
			if ( isset( $submenu['wpblp_select_products'] ) && ! isset( $submenu['wpblp_select_products']['premium'] ) ) {
				$submenu['wpblp_select_products']['premium'] = array(
					sprintf( '%s%s%s', '<span id="wpblp_support_link">', __( 'Get Premium', 'woo-product-barcode-label-printing' ), '</span>' ),
					'manage_options',
					esc_url( 'https://woolabel.com/?affiliate_id=woolabel_free' ),
					__( 'Get Premium', 'woo-product-barcode-label-printing' ),
				);
			}
		}

		add_action( 'admin_menu', 'wpblp_add_support_link_to_menu', 100 );
	}
}

add_action( 'plugins_loaded', array( 'Woo_Product_Barcode_Label_Printing', 'wpblp_init' ) );
