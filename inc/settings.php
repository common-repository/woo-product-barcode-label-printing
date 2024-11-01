<?php
/**
 * @package 	WooCommerce Product Barcode Label Printing
 * @version 	1.5.1
 * 
 * Settings Page
 * 
**/


// Defaults
function wpblp_get_settings() {
	// Set defaults and check if empty
	$defaults = array(
		'wpblp_settings_checkbox_sku'					=> 1,
		'wpblp_settings_checkbox_title'					=> 1,
		'wpblp_settings_checkbox_price'					=> 1,
		'wpblp_settings_input_field_dpi'				=> 140,
		'wpblp_settings_input_field_width'				=> 45,
		'wpblp_settings_input_field_height'				=> 20,
		'wpblp_settings_input_field_bar_width'			=> 2,
		'wpblp_settings_input_field_bar_height'			=> 28,
		'wpblp_settings_input_field_offsetx'			=> '',
		'wpblp_settings_input_field_offsety'			=> '',
		'wpblp_settings_input_field_preview_sku'		=> '11579',
		'wpblp_settings_input_field_title_font_size'	=> 15,
		'wpblp_settings_input_field_code_font_size' 	=> 10,
		'wpblp_settings_input_field_price_font_size'	=> 30, 
		'wpblp_settings_radio_type'						=> 'code128'
	);
	
	return wp_parse_args(get_option('wpblp_settings'), $defaults);
}


// Presets
function wpblp_get_presets() {
	// Set defaults and check if empty
	$defaults = array(
		'wpblp_settings_checkbox_sku'					=> 1,
		'wpblp_settings_checkbox_title'					=> 1,
		'wpblp_settings_checkbox_price'					=> 1,
		'wpblp_settings_input_field_dpi'				=> 140,
		'wpblp_settings_input_field_width'				=> 45,
		'wpblp_settings_input_field_height'				=> 20,
		'wpblp_settings_input_field_bar_width'			=> 2,
		'wpblp_settings_input_field_bar_height'			=> 28,
		'wpblp_settings_input_field_offsetx'			=> '',
		'wpblp_settings_input_field_offsety'			=> '',
		'wpblp_settings_input_field_preview_sku'		=> '11579',
		'wpblp_settings_input_field_title_font_size'	=> 15,
		'wpblp_settings_input_field_code_font_size' 	=> 10,
		'wpblp_settings_input_field_price_font_size'	=> 30, 
		'wpblp_settings_radio_type'						=> 'code128'
	);
	
	$presets = array(
		'preset1' => array(
			'preset_name' 		=> __('45*20mm (default)', 'woo-product-barcode-label-printing'), 
			'preset_settings'	=> $defaults
		), 
		'preset2' => array(
			'preset_name' 		=> __('Preset 2', 'woo-product-barcode-label-printing'), 
			'preset_settings'	=> $defaults
		), 
		'preset3' => array(
			'preset_name' 		=> __('Preset 3', 'woo-product-barcode-label-printing'), 
			'preset_settings'	=> $defaults
		), 
	);
	
	return wp_parse_args(get_option('wpblp_presets'), $presets);
}


// AJAX
function wpblp_presets_action() {		
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // Sanitize POST
	
	if (!wp_verify_nonce($_POST['nonce'], 'wpblp_nonce')) {
        wp_die('Security check');
    }
	
	if (isset($_POST['wpblp_preset_value'])) {
		if (isset($_POST['preset_select']) && $_POST['preset_select'] != '') {
			$preset_select = $_POST['preset_select'];
		}
		
		if (isset($_POST['preset_name']) && $_POST['preset_name'] != '') {
			$preset_name = $_POST['preset_name'];
		}
		
		if (isset($_POST['wpblp_new_settings']) && $_POST['wpblp_new_settings'] != '') {
			$wpblp_new_settings = $_POST['wpblp_new_settings'];
		}
		
		
		$presets = wpblp_get_presets();
		
		
		// Options
		if ($_POST['wpblp_preset_value'] == 'save') {
			foreach($presets as $key => $value) {
				if ($key == $preset_select) {
					if ($preset_name != '') {
						$presets[$key]['preset_name'] = $preset_name;
					}
					
					$presets[$key]['preset_settings'] = $wpblp_new_settings;
				}
			}
			
			update_option('wpblp_presets', $presets);
			update_option('wpblp_settings', $wpblp_new_settings);
		} else {
			$wpblp_new_settings = $presets[$preset_select]['preset_settings'];
			
			update_option('wpblp_settings', $wpblp_new_settings);
		}
	}
	
	wp_die();
}

add_action('wp_ajax_presets_action', 'wpblp_presets_action');
add_action('wp_ajax_nopriv_presets_action', 'wpblp_presets_action');



// Settings Page
function wpblp_settings_init() {
	register_setting('wpblp_settings_page', 'wpblp_settings');
	
	add_settings_section(
		'wpblp_page_section_1', 
		'', 
		'wpblp_settings_section_callback', 
		'wpblp_settings_page'
	);
	
	add_settings_field( 
		'wpblp_settings_checkbox_sku', 
		__('SKU', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_checkbox_sku_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_1' 
	);
	
	add_settings_field( 
		'wpblp_settings_checkbox_title', 
		__('Title', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_checkbox_title_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_1' 
	);
	
	add_settings_field( 
		'wpblp_settings_checkbox_price', 
		__('Price', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_checkbox_price_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_1'
	);
	
	
	add_settings_section(
		'wpblp_page_section_2',
		'',
		'wpblp_prefs_settings_section_callback',
		'wpblp_settings_page'
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_dpi', 
		__('Multiplier', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_dpi_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_width', 
		__('Label Width (mm)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_width_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_height', 
		__('Label Height (mm)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_height_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_bar_width', 
		__('Bar Width (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_bar_width_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_bar_height', 
		__('Bar Height (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_bar_height_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_title_font_size', 
		__('Title Font Size (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_title_font_size_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_code_font_size', 
		__('Code Font Size (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_code_font_size_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_price_font_size', 
		__('Price Font Size (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_price_font_size_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_offsetx', 
		__('Horizontal Offset (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_offsetx_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_offsety', 
		__('Vertical Offset (px)', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_offsety_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_radio_type', 
		__('Barcode Type', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_radio_type_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
	
	add_settings_field( 
		'wpblp_settings_input_field_preview_sku', 
		__('Preview SKU number', 'woo-product-barcode-label-printing'), 
		'wpblp_settings_input_field_preview_sku_render', 
		'wpblp_settings_page', 
		'wpblp_page_section_2' 
	);
}

add_action('admin_init', 'wpblp_settings_init');



function wpblp_settings_section_callback() {
	echo '<h3 class="wpblp_settings_sec_title">' . __('Settings for Generating:', 'woo-product-barcode-label-printing') . '</h3>';
}


function wpblp_prefs_settings_section_callback() {
	echo '<h4>' . __('Note: Not all barcodes allow letters. If you have a blank barcode at the print preview stage, try changing barcode type to another one (we recommend code 128) or remove letters from your products SKU by using an <a href="https://booster.io/features/woocommerce-sku/">Autogenerate SKU plugin</a> like Booster for example.', 'woo-product-barcode-label-printing') . '</h4>';
	
	
	echo '<h3 class="wpblp_settings_sec_title">' . __('Label Configuration:', 'woo-product-barcode-label-printing') . '</h3>';
}



// Triggers
function wpblp_settings_checkbox_function($field_name = '', $field_desc = '') {
	$settings = wpblp_get_settings();
	
	if (isset($settings['wpblp_settings_checkbox_' . esc_html($field_name)]) && $settings['wpblp_settings_checkbox_' . esc_html($field_name)] == 1) {	
		$checked = ' checked';
	} else {
		$checked = '';
	}
	
	echo "<input type='checkbox'  id='wpblp_settings_" . esc_attr($field_name) . "_input' name='wpblp_settings[wpblp_settings_checkbox_" . esc_attr($field_name) . "]' " . esc_attr($checked) . " value='1'>";
	
	if ($field_desc != '') {
		echo '<div class="wpblp_settings_description wpblp_settings_premium_desc">' . $field_desc . '</div>';
	}
}


function wpblp_settings_checkbox_sku_render() {
	wpblp_settings_checkbox_function('sku');
}


function wpblp_settings_checkbox_title_render() {
	wpblp_settings_checkbox_function('title');
}


function wpblp_settings_checkbox_price_render() {
	$desc = sprintf( __( 'You can change currency symbol in WooLabel premium. <a href="%s">Upgrade here..>>></a>', 'woo-product-barcode-label-printing' ), 
		'https://woolabel.com/?affiliate_id=woolabel_free'
	);
	wpblp_settings_checkbox_function('price', $desc);
}



// Label Configuration
function wpblp_settings_radio_type_render() {
	$settings = wpblp_get_settings();
	$value = $settings['wpblp_settings_radio_type'];
	
	echo '<select id="wpblp_settings_barcode_radio_types" name="wpblp_settings[wpblp_settings_radio_type]">' . 
		'<option ' . selected($value, 'codabar', 0) . ' value="codabar">' . __('Codabar', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'ean8', 0) . ' value="ean8">' . __('EAN8 (8 numbers in SKU required)', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'ean13', 0) . ' value="ean13">' . __('EAN13 (13 numbers in SKU required)', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'std25', 0) . ' value="std25">' . __('Standard 2 of 5 (industrial)', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'int25', 0) . ' value="int25">' . __('Interleaved 2 of 5', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'code39', 0) . ' value="code39">' . __('Code 39', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'code93', 0) . ' value="code93">' . __('Code 93', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'code128', 0) . ' value="code128">' . __('Code 128 (Default)', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'msi', 0) . ' value="msi">' . __('MSI', 'woo-product-barcode-label-printing') . '</option>' . 
		'<option ' . selected($value, 'datamatrix', 0) . ' value="datamatrix">' . __('Datamatrix (ASCII + extended)', 'woo-product-barcode-label-printing') . '</option>' . 
	'</select>' . 
	'<div class="wpblp_settings_description wpblp_settings_premium_desc">' . __('QR code is available in WooLabel Premium', 'woo-product-barcode-label-printing') . '</div>';
}



function wpblp_settings_input_field_function($field_name = '', $description = '', $conv = false, $type = 'number') {
	$settings = wpblp_get_settings();
	$value = $settings['wpblp_settings_input_field_' . esc_html($field_name)];
	
	echo "<input type='" . esc_attr($type) . "' min='1' id='wpblp_settings_" . esc_attr($field_name) . "_input' name='wpblp_settings[wpblp_settings_input_field_" . esc_attr($field_name) . "]' value='" . esc_attr($value) . "'>";
	
	if ($description != '' || $conv == true) {
		echo "<p id='wpblp_settings_" . esc_attr($field_name) . "_description' class='wpblp_settings_description'>";
			if ($conv == true) {
				echo "&#126;<span></span> px " . __('(based on multiplier value)', 'woo-product-barcode-label-printing');
			} else {
				echo esc_html($description);
			}
		echo "</p>";
	}
}


function wpblp_settings_input_field_dpi_render() {
	wpblp_settings_input_field_function('dpi', __('You can use the DPI value of your printer as a start point and adjust after the other settings are set', 'woo-product-barcode-label-printing'), false);
}

function wpblp_settings_input_field_width_render() {
	wpblp_settings_input_field_function('width', '', true);
}

function wpblp_settings_input_field_height_render() {
	wpblp_settings_input_field_function('height', '', true);
}

function wpblp_settings_input_field_bar_width_render() {
	wpblp_settings_input_field_function('bar_width', '', false);
}

function wpblp_settings_input_field_bar_height_render() {
	wpblp_settings_input_field_function('bar_height', '', false);
}

function wpblp_settings_input_field_title_font_size_render() {
	wpblp_settings_input_field_function('title_font_size', '', false);
}

function wpblp_settings_input_field_code_font_size_render() {
	wpblp_settings_input_field_function('code_font_size', '', false);
}

function wpblp_settings_input_field_price_font_size_render() {
	wpblp_settings_input_field_function('price_font_size', '', false);
}

function wpblp_settings_input_field_offsetx_render() {
	wpblp_settings_input_field_function('offsetx', __('Offset from left side (leave empty for auto align)', 'woo-product-barcode-label-printing'), false);
}

function wpblp_settings_input_field_offsety_render() {
	wpblp_settings_input_field_function('offsety', __('Offset from top side (leave empty for auto align)', 'woo-product-barcode-label-printing'), false);
}

function wpblp_settings_input_field_preview_sku_render() {
	wpblp_settings_input_field_function('preview_sku', '', false, 'text');
}



// Generate CSS from settings
function wpblp_settings_generate_front_css() {
	// Settings
	$settings = wpblp_get_settings();
	
	$setting_dpi = $settings['wpblp_settings_input_field_dpi'];
	$setting_width = $settings['wpblp_settings_input_field_width'];
	$setting_height = $settings['wpblp_settings_input_field_height'];
	$setting_title_font_size = $settings['wpblp_settings_input_field_title_font_size'] . 'px';
	$setting_price_font_size = $settings['wpblp_settings_input_field_price_font_size'] . 'px';
	
	
	if ($settings['wpblp_settings_input_field_offsetx'] != '') {
		$setting_offsetx = $settings['wpblp_settings_input_field_offsetx'] . 'px';
	} else {
		$setting_offsetx = '';
	}
	
	if ($settings['wpblp_settings_input_field_offsety'] != '') {
		$setting_offsety = $settings['wpblp_settings_input_field_offsety'] . 'px';
	} else {
		$setting_offsety = '';
	}
	
	
	// Convert mm to px
	$setting_width = intval($setting_width * $setting_dpi/25.4+.5) . 'px';
	$setting_height = intval($setting_height * $setting_dpi/25.4+.5) . 'px';
	
	
	// Label Configuration CSS
	echo '<style>' . 
		'body #label-list {' . 
			'width:' . esc_html($setting_width) . ';' . 
		'}' . 
		'body #label-list .label {' . 
			'width:' . esc_html($setting_width) . ';' . 
			'height:' . esc_html($setting_height) . ';' . 
		'}' . 
		'body #label-list .label .inner {' . 
			($setting_offsetx != '' ? 'padding-left:' . esc_html($setting_offsetx) . ';' : '') . 
			($setting_offsety != '' ? 'padding-top:' . esc_html($setting_offsety) . ';' : '') . 
		'}' .
		'body #label-list .label .name {' . 
			'font-size:' . esc_html($setting_title_font_size) . ';' . 
			'line-height:1.1em;' . 
		'}' . 
		'body #label-list .label .price {' . 
			'font-size:' . esc_html($setting_price_font_size) . ';' . 
			'line-height:1.1em;' . 
		'}' . 
		'@media print {' . 
			'body #label-list .label .inner {' . 
				'padding:2px;' . 
				($setting_offsetx != '' ? 'padding-left:' . esc_html($setting_offsetx) . ';' : '') . 
				($setting_offsety != '' ? 'padding-top:' . esc_html($setting_offsety) . ';' : '') . 
			'}' . 
			'body #label-list .label .name {' . 
				'font-size:' . esc_html($setting_title_font_size) . ';' . 
				'line-height:1.1em;' . 
			'}' . 
			'body #label-list .label .price {' . 
				'font-size:' . esc_html($setting_price_font_size) . ';' . 
				'line-height:1.1em;' . 
			'}' . 
		'}' . 
	'</style>';
}

add_action('admin_head', 'wpblp_settings_generate_front_css');



// Display
function wpblp_settings_page_callback() {
	$settings = wpblp_get_settings();
	$presets = wpblp_get_presets();
	
	
	// Presets
	$presets_options = '';
	
	if ($presets != '') {	
		foreach($presets as $key => $value) {
			if (isset($value['preset_name'])) {
				$presets_options .= '<option value="' . esc_attr($key) . '">' . esc_html($value['preset_name']) . '</option>';
			}
		}
	} else {
		$presets_options .= '<option value="preset1">' . __('45*20mm (default)', 'woo-product-barcode-label-printing') . '</option>' . 
			'<option value="preset2">' . __('Preset 2', 'woo-product-barcode-label-printing') . '</option>' . 
			'<option value="preset3">' . __('Preset 3', 'woo-product-barcode-label-printing') . '</option>';
	}
	
	
	settings_errors();
	?>
	
	<form id="wpblp_settings_form" name="wpblp_settings_form" action='options.php' method='POST'>
		<?php
		echo '<h2>' . __('Woolabel Settings Page', 'woo-product-barcode-label-printing') . '</h2>';
		
		settings_fields('wpblp_settings_page');
		do_settings_sections('wpblp_settings_page');
		
		echo '<a class="wpblp_submit_button" href="' . esc_js("javascript:document.wpblp_settings_form.submit()") . '">' . __('Save Changes', 'woo-product-barcode-label-printing') . '</a>';
		
		
		// Presets
		echo '<div class="wpblp_settings_presets">' . 
			'<h2>' . __('Choose Preset:', 'woo-product-barcode-label-printing') . '</h2>' . 
			'<select id="wpblp_settings_preset" name="wpblp_settings_preset[]">' . 
				$presets_options . 
			'</select>' . 
			'<input type="text" id="wpblp_settings_preset_name" name="wpblp_settings_preset_name" value="" placeholder="' . __('Enter custom name', 'woo-product-barcode-label-printing') . '">' . 
			'<a id="wpblp_submit_button_save_preset" class="wpblp_submit_button" href="' . esc_js("javascript:void(0)") . '">' . __('Save and Add as Preset', 'woo-product-barcode-label-printing') . '</a>' . 
			'<a id="wpblp_submit_button_load_preset" class="wpblp_submit_button red" href="' . esc_js("javascript:void(0)") . '">' . __('Load', 'woo-product-barcode-label-printing') . '</a>' . 
		'</div>';
		?>
	</form>
	
	<div class="wpblp_settings_description wpblp_settings_premium_desc" style="margin-top: 40px;"><?php echo sprintf( __( 'Need Help? Contact us here. <a href="%s">Woolabel.com/contact</a>', 'woo-product-barcode-label-printing' ), 
		'https://woolabel.com/contact/'
	); ?></div>
	
	<div class="wpblp_live_preview">
		<?php
		echo '<h3 class="wpblp_settings_sec_title">' . __('Live Preview', 'woo-product-barcode-label-printing') . '</h3>';
		?>
		<div id="label-list">
			<div class="label"> 
				<div class="inner">
					<div class="label_img"></div>
					<div class="name">Coral Linen Raw Jkt-Back in Stock!</div>
					<div class="price">$22.69</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>