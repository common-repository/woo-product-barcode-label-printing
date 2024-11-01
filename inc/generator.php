<?php
/**
 * @package 	WooCommerce Product Barcode Label Printing
 * @version 	1.5.1
 * 
 * Generator
 * 
**/


function wpblp_generator_callback() {
	// Check Settings
	$settings = wpblp_get_settings();
	
	$setting_bar_type = $settings['wpblp_settings_radio_type'];
	$setting_bar_width = $settings['wpblp_settings_input_field_bar_width'];
	$setting_bar_height = $settings['wpblp_settings_input_field_bar_height'];
	$setting_code_font_size = $settings['wpblp_settings_input_field_code_font_size'];
	
	
	if (isset($settings['wpblp_settings_checkbox_sku']) && $settings['wpblp_settings_checkbox_sku'] == 1) {
		$show_sku = 1;
	} else {
		$show_sku = 0;
	}
	
	if (isset($settings['wpblp_settings_checkbox_title']) && $settings['wpblp_settings_checkbox_title'] == 1) {
		$show_title = 1;
	} else {
		$show_title = 0;
	}
	
	if (isset($settings['wpblp_settings_checkbox_price']) && $settings['wpblp_settings_checkbox_price'] == 1) {
		$show_price = 1;
	} else {
		$show_price = 0;
	}
	
	
	echo '<h2>' . __('Woolabel Generator', 'woo-product-barcode-label-printing') . '</h2>';
	
	
	// Generation
	$wpblp_op = isset($_POST['wpblp_op']) ? sanitize_text_field($_POST['wpblp_op']) : '';
	
	if ($wpblp_op == 'generate') {
		// Get the nonce input value
		$wpblp_select_products_form_nonce = isset($_POST['wpblp_select_products_form_nonce'] ) ? sanitize_text_field($_POST['wpblp_select_products_form_nonce']) : '';
		
		// Verify the nonce is valid
		if (wp_verify_nonce($wpblp_select_products_form_nonce, 'wpblp_select_products_form_nonce')) {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // Sanitize POST
			
			// Get Selected Products
			if (isset($_POST['products']) && $_POST['products'] != '') {
				$selected_products = $_POST['products'];
				
				$query = new WP_Query;
				
				$args = array(
					'post__in' 			=> $selected_products, 
					'post_type'			=> 'product', 
					'posts_per_page' 	=> -1 
				);
				
				$products = $query->query($args);
				
				$products_source = $selected_products;
				
				
				?>
				<script>
					function popup_for_print() {
						var w = window.open('', '', "toolbar=no, location=no, directories=no, status=no, menubar=no, width=600, height=400, scrollbars=yes");
						w.document.body.innerHTML = jQuery("div#label-list").html();
					}
				</script>
				
				<input type="button" value="<?php _e('Popup for Printing', 'woo-product-barcode-label-printing'); ?>" onClick="window.print();" />
				<h3><?php _e('Labels for selected products:', 'woo-product-barcode-label-printing'); ?></h3>
				<div id="label-list">
				<?php					
					foreach($products_source as $id) {
						$product = 			wc_get_product($id);
						$title = 			$product->get_name();
						$sku = 				$product->get_sku();
						$value = 			strlen($sku) === 0 ? $id : $sku;
						$price = 			$product->get_regular_price();
						$sale_price = 		$product->get_sale_price();
						
						if ( isset( $sale_price ) && $sale_price != 0 && $sale_price != '' ) {
							$price = $sale_price;
						}
						
						// Count
						if (isset($_POST['product_count-' . $id]) && $_POST['product_count-' . $id] != '') {
							$count_for_label = sanitize_text_field($_POST['product_count-' . $id]);
						} else {
							$count_for_label = 1;
						}
						
						
						// Combine all
						for ($counter = 0; $counter < $count_for_label; $counter++) {
							echo '<div class="label">' . 
								'<div class="inner">';
									
									$product_id = 'product_img-'. esc_attr($id) . '-' . $counter;
									
									// Label
									echo '<div class="label_img" id="' . esc_html($product_id) . '"></div>';
									
									// Title
									if ($show_title == 1 && $title != '') {
										echo '<div class="name">' . esc_html($title) . '</div>';
									}
									
							        // Custom field filter
						        	echo apply_filters( 'wpblp_set_custom_label_fields', '', esc_attr( $id ) );


									// Price
									if ($show_price == 1 && $price != '') {
										echo '<div class="price">$' . esc_html($price) . '</div>';
									}
									
									
									// Label Script
									echo '<script>' . 
										'jQuery(function($){' . 
											'$("#' . esc_attr($product_id) . '").barcode("' . esc_attr($value) . '", "' . esc_attr($setting_bar_type) . '",{barWidth:' . esc_attr($setting_bar_width) . ', barHeight:' . esc_attr($setting_bar_height) . ', fontSize:' . esc_attr($setting_code_font_size) . ', showCode: ' . ($value != '' ? $show_sku : '') . '});' . 
										'});' . 
									'</script>' . 
								'</div>' . 
								'<div class="page-break"></div>' . 
							'</div>';
						}
					}
				?></div><?php
				
				exit; // Stop! Hammertime!
			} else {
				echo '<h3 class="wpblp_error">' . __('No products...', 'woo-product-barcode-label-printing') . '</h3>';
			}
		} else {
			echo '<h3 class="wpblp_error">' . __('Security error!', 'woo-product-barcode-label-printing') . '</h3>';
		}
	}
	
	
	echo '<h3>' . __('Select Products', 'woo-product-barcode-label-printing') . '</h3>';
	?>
	
	<form method="POST" action="" id="wpblp_select_products_form">
		<?php $wpblp_select_products_form_nonce = wp_create_nonce('wpblp_select_products_form_nonce'); // Add security nonce ?>
		
		<input type="hidden" name="wpblp_select_products_form_nonce" id="wpblp_select_products_form_nonce" value="<?php echo esc_attr($wpblp_select_products_form_nonce); ?>" />
		<input type="hidden" name="wpblp_op" value="generate" />
		<ul class="wpblp_select_list">
			<?php
			$query = new WP_Query;
			
			$products = $query->query(
				array(
					'post_type'			=> 'product', 
					'posts_per_page' 	=> -1, 
					'orderby' 			=> 'title', 
					'order' 			=> 'ASC'
				)
			);
			
			if ($query->have_posts()) {
				foreach($products as $product) {
					$product_id = $product->ID;
					$woo_product = wc_get_product($product_id);
					$stock = ($woo_product->get_stock_quantity() ? '(' . $woo_product->get_stock_quantity() . ') ' : '(0) ');
					?>
					
					<li class="wpblp_select_products_box">
						<input type="checkbox" id="product-<?php echo esc_attr($product_id); ?>" class="product_checkbox" name="products[]" value="<?php echo esc_attr($product_id); ?>" />
						<input type="number" id="product_count-<?php echo esc_attr($product_id); ?>" name="product_count-<?php echo esc_attr($product_id); ?>" min="1" max="5" value="1">
						<?php echo wp_kses_post($woo_product->get_image('thumbnail')); ?>
						<label for="product-<?php echo esc_attr($product_id); ?>"><?php echo esc_attr($stock) . esc_html(get_the_title($product_id)); ?></label>
					</li>
					<?php
				}
			} else {
				echo '<h3 class="wpblp_error">' . __('No products found!', 'woo-product-barcode-label-printing') . '</h3>';
			}
			?>
		</ul>		
		<div class="wpblp_settings_description wpblp_settings_premium_desc"><?php echo sprintf( __( 'Buy WooLabel Premium to unlock all features including search feature and print unlimited labels. Product variations in the sentence on WooLabel free. <a href="%s">Click Here</a>', 'woo-product-barcode-label-printing' ), 
			'https://woolabel.com/?affiliate_id=woolabel_free'
		); ?></div>
		<div class="wpblp_submits_wrap">
			<button class="wpblp_submit_button" type="submit"><?php _e('Generate selected products', 'woo-product-barcode-label-printing'); ?></button>
		</div>
	</form>
	<?php
}
?>