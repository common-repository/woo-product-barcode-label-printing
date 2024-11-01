<?php
/**
 * @package 	WooCommerce Product Barcode Label Printing
 * @version 	1.5.1
 * 
 * Functions Page
 * 
**/



// Notices
function wpblp_free_notices() {	
	global $pagenow, $plugin_page;
	$page_url = add_query_arg('page', $plugin_page, admin_url($pagenow));
	$user_id = get_current_user_id();
	$screen = get_current_screen();
	
	if (
		$screen->id == 'toplevel_page_wpblp_select_products' || 
		$screen->id == 'woolabel_page_wpblp_settings_page' || 
		$screen->id == 'woolabel_page_wpblp_info_page'
	) {
		if (!get_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1_date')) {
			update_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1_date', date('d.m.Y'));
		} else {
			$current_date = strtotime(date('d.m.Y'));
			$wpblp_plugin_notices_dismissed_1_date = strtotime("+1 week", strtotime(get_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1_date', true)));
			
			if ($current_date > $wpblp_plugin_notices_dismissed_1_date) {
				update_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1_date', date('d.m.Y'));
				delete_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1');
			}
		}
		
		if (!get_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1')) {
			$page_url1 = add_query_arg('wpblp-dismissed1', 'true', $page_url);
			
			echo '<div class="notice notice-info wpblp_admin_notice_info">' . 
				'<p>' . __('Woolabel Premium Plugin is now available for purchase! Grab your copy today! Read what new features it has, <a href="https://woolabel.com/?affiliate_id=woolabel_free">click here</a>', 'woo-product-barcode-label-printing') . '</p>' . 
				'<a class="notice-dismiss" href="' . esc_url($page_url1) . '"><span>' . __('Dismiss', 'woo-product-barcode-label-printing') . '</span></a>' . 
			'</div>';
		}
		
		if (!get_user_meta($user_id, 'wpblp_plugin_notices_dismissed_2')) {
			$page_url2 = add_query_arg('wpblp-dismissed2', 'true', $page_url);
			
			echo '<div class="notice notice-info wpblp_admin_notice_info">' . 
				'<p>' . __('If you like our plugin please leave a <a href="https://wordpress.org/support/plugin/woo-product-barcode-label-printing/reviews/#new-post">feedback</a>', 'woo-product-barcode-label-printing') . '</p>' . 
				'<a class="notice-dismiss" href="' . esc_url($page_url2) . '"><span>' . __('Dismiss', 'woo-product-barcode-label-printing') . '</span></a>' . 
			'</div>';
		}
	}
}
add_action('admin_notices', 'wpblp_free_notices');


function wpblp_free_notices_dismissed() {
    $user_id = get_current_user_id();
	
    if (isset($_GET['wpblp-dismissed1'])) {
        update_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1', 'true');
		update_user_meta($user_id, 'wpblp_plugin_notices_dismissed_1_date', date('d.m.Y'));
	}
	
    if (isset($_GET['wpblp-dismissed2'])) {
        update_user_meta($user_id, 'wpblp_plugin_notices_dismissed_2', 'true');
	}
}
add_action('admin_init', 'wpblp_free_notices_dismissed');
?>