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
function put_google_map($atts, $content=null){  
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
<script type="text/javascript" 
src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng($mlat,$mlon);
    var centerLatlng = new google.maps.LatLng($clat,$clon);
    var myOptions = {
      zoom: $zoom,
      center: centerLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var contentString = '$content';
        
    var infowindow = new google.maps.InfoWindow({
        disableAutoPan: true,
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: '$mtitle'
    });
    infowindow.open(map,marker);
  }
</script>
<div style="width:$width;height:$height;$corf" id="map_canvas"></div>
<script type="text/javascript">initialize();</script>
EOF;

    return $return;
}  
add_shortcode('put_google_map', 'put_google_map'); 

