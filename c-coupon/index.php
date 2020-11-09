<?php
/**
 * @package C_coupon
 * @version 0.0.1
 */

/*
Plugin Name: C_coupon
Plugin URI: #
Description: 
Author: Ajil
Version: 0.0.1
Author URI:  #
*/

register_activation_hook( __FILE__, array('couponClass', 'plugin_activated' ));


class couponClass
{
    public static function plugin_activated(){
         // Check if woocommerce active
    if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the woocommerce to be installed and active. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
    }

    $coupon_code = '100OFF'; // Coupon Code
    $amount = '100'; // Coupon Amount
    $discount_type = 'fixed_cart'; // fixed product price

    $coupon = array(
    'post_title' => $coupon_code,
    'post_content' => '',
    'post_status' => 'publish',
    'post_author' => 1,
    'post_type' => 'shop_coupon');

    $new_coupon_id = wp_insert_post( $coupon );

    // Add meta values
    update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
    update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
    update_post_meta( $new_coupon_id, 'individual_use', 'no' );
    update_post_meta( $new_coupon_id, 'product_ids', '51' );
    update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
    update_post_meta( $new_coupon_id, 'usage_limit', '' );
    update_post_meta( $new_coupon_id, 'expiry_date', strtotime("+1 months") );
    update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
    update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
    update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );


    }
}