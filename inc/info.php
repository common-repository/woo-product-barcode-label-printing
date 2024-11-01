<?php
/**
 * @package 	WooCommerce Product Barcode Label Printing
 * @version 	1.5.1
 * 
 * Information Page
 * 
**/


function wpblp_info_page_callback() {
	echo '<h2>' . __('Woolabel Information Page', 'woo-product-barcode-label-printing') . '</h2>';
	
	echo '<p>' . 
		__('This plugin works best if your SKU\'s are numbers only. Please download and use Boosters AUTO Generate Plugin feature to make your SKU\'s numbers only.', 'woo-product-barcode-label-printing') . 
	'</p>' . 
	
	'<p>' . 
		__('This plugin has been created for Zebra Direct Thermal Printers. Which is a continuous feed label printer. The labels I use are 45x20mm and have 3mm gaps between them on a continuous single roll. You can buy them on websites like amazon and office supply shops.', 'woo-product-barcode-label-printing') . 
	'</p>' . 
	
	'<p>' . 
		__('The plugins default settings are the same settings I use for my 45x20mm labels. If you use bigger or smaller labels. Start with adjusting the width and height settings only. Also remember to check the Zebra utilities settings are the same as the size of the labels you are using.', 'woo-product-barcode-label-printing') . 
	'</p>' . 
	
	'<p>' . 
		__('If you cannot get the print preview to show a barcode, or when you go to print the label it’s not formatted correctly. Your welcome to send a support email to us at <a href="https://woolabel.com/contact">woolabel.com/contact</a>', 'woo-product-barcode-label-printing') . 
	'</p>' . 
	
	'<br>' . 
	'<p>' . 
		__('Woolabel Premium Plugin is now available for purchase! Grab your copy today! Read what new features it has: <a href="https://woolabel.com/?affiliate_id=woolabel_free">WOOLABEL PREMIUM</a>', 'woo-product-barcode-label-printing') . 
	'</p>
	<iframe style="margin:40px 0;" width="560" height="315" src="https://www.youtube.com/embed/qeeb4V1f_-0?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>