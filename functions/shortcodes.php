<?php
/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/


// Shortcode: [column]
function shortcode_column($atts, $content)
{
extract( shortcode_atts( array(
    	'class' => '',
	), $atts ) );

return ("<div class=\"". $class . "\">". do_shortcode($content) . "</div>");
}
add_shortcode('column', 'shortcode_column');
add_shortcode('col', 'shortcode_column');

?>