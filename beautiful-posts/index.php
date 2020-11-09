<?php
/**
 * @package Beautifull_posts
 * @version 0.0.1
 */

/*
Plugin Name: Beautifull Posts
Plugin URI: #
Description: 
Author: Ajil
Version: 0.0.1
Author URI:  #
*/

register_activation_hook( __FILE__, 'wc_plugin_activate' );
function wc_plugin_activate(){

    // Require post type
    if ( post_type_exists( 'post' ) == 'false') {
        // Stop activation, redirect and show error
        wp_die('Sorry, but the post type should be active');
    }
}


// Shortcode to List Post based on Parameters
add_shortcode( 'listblog', 'post_list' );
function post_list( $atts ) {
 ob_start();
 // Define attributes and their defaults
 extract( shortcode_atts( array (
 'type' => 'post',
 'order' => 'ASC',
 'orderby' => 'title',
 'limit' => -1,
 'category' => '',
 ), $atts ) );
 
 // Define query parameters based on attributes
 $options = array(
 'post_type' => $type,
 'order' => $order,
 'orderby' => $orderby,
 'posts_per_page' => $limit,
 'category_name' => $category,
 );
 $query = new WP_Query( $options );
 if ( $query->have_posts() ) { ?>
    <ul class="post-list">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </ul>
 <?php
 $result = ob_get_clean();//Returns the contents of the output buffer
 return $result;
 }
}
?>
