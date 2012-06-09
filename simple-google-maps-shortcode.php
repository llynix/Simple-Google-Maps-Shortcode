<?php 
/*
Plugin Name: Simple Google Maps Shortcode
Plugin URI: http://www.fallsgeek.com
Description: Simple plugin for Wordpress to add a shortcode to put a specific Gmap to my liking. 
Version: 0.3
Author: Anthony 'Llynix' Taylor
Author URI: http://llynix.com
*/

/* Usage:
[put_google_map width="400px" height="350px" align="left" zoom="17" mlat="33.910859" mlon="-98.489586" clat="33.911499" clon="-98.489586" mtitle="Alley Cat Collective"]<strong>Alley Cat Collective</strong><br/>922 Indiana Ave<br/>Across from Wichita Theatre[/put_google_map]

Helpful Link: http://itouchmap.com/latlong.html 
*/
function sgms_script() {
  wp_register_script( 'gmaps', 'http://maps.googleapis.com/maps/api/js?sensor=false');
  wp_enqueue_script('gmaps');
  wp_enqueue_script('sgms-script', plugins_url('script.js', __FILE__),array(),'20120609-1',false);
}

add_action('wp_enqueue_scripts','sgms_script');

function sgms_style() {
  // Register the style like this for a plugin:  
  wp_register_style( 'sgms-style', plugins_url('/style.css', __FILE__ ), array(), '20120609', 'all' );  
      
  // For either a plugin or a theme, you can then enqueue the style:  
  wp_enqueue_style( 'sgms-style' );  
}  

add_action( 'wp_enqueue_scripts', 'sgms_style' );

function put_google_map($atts, $content=null){  
    global $add_my_script;
    $add_my_script = true;

    extract(shortcode_atts( array(
        'width' => '400px',
        'height' => '350px',
        'zoom' => '15',
        'align' => 'center',
        'mlat' => 33.913709,
        'mlon' => -98.493387,
        'clat' => 33.913709,
        'clon' => -98.493387,
        'mtitle' => ''
        ), $atts));  

    $corf = ($align == 'center') ? 'margin:0 auto;' : 'float:'.$align.';';

    $return = <<<EOF
<div style="width:$width;height:$height;$corf" id="map_canvas"></div>
<script 
type="text/javascript">initialize($mlat,$mlon,$clat,$clon,$zoom,'$content','$mtitle');</script>
EOF;

    return $return;
}  
add_shortcode('put_google_map', 'put_google_map'); 
