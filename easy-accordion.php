<?php
/*
Plugin Name: WordPress Accordion
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin uses Bootstrap and jQuery to add a very basic collapsable accordion to your theme. Use your own CSS for styling  
Version: 0.1.0
Author: Cresencio Cantu
Author URI: http://www.cresenciocantu.com 
License: GPL2
*/
?>
<?php

// add the shortcode handler for accordion wrapper
function addAccordionWrapper($atts, $content = null) {
        
        extract(shortcode_atts(array( 
        	"name" => '' 

        ), $atts));

        $name =  strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($name))));

			$accordion_wrapper ="<div class='panel-group' id='$name'>".do_shortcode( $content )."</div>";
	     
		return $accordion_wrapper;
}

add_shortcode('accordion_wrapper', 'addAccordionWrapper');

// add the shortcode handler for accordion section item
function addAccordionSection($atts, $content = null) {
        
        extract(shortcode_atts(array( 

        	"name" => '',
        	"title" => '',
          "count" => '',
        	"open" => 'no'

        ), $atts));

        $name =  strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($name))));

        $section =  strtolower(str_replace(array('  ', ' '), '-', preg_replace('/[^a-zA-Z0-9 s]/', '', trim($title))));

        ob_start();

	        ?> <HTML>
				<div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#<?php echo $name; ?>" href="#<?php echo $section."-".$count; ?>">
                   <?php echo $title; ?>
                  </a>    
              </h4>
				    </div>
				    <div id="<?php echo $section."-".$count; ?>" class="panel-collapse collapse <?php if($open == "yes"){echo "in";} ?> ">
				      <div class="panel-body">
				        <?php echo do_shortcode( $content ); ?>
				      </div>
				    </div>
				</div>
	        <?php

	        $accordion_content = ob_get_contents();

        ob_end_clean();

		return $accordion_content;
}

add_shortcode('accordion_section', 'addAccordionSection');

//add the button to the editor
function add_accordion_button() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_accordion_tinymce_plugin");
     add_filter('mce_buttons', 'register_accordion_button');
   }
}
 
function register_accordion_button($buttons) {
   array_push($buttons, "|", "youraccordion");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_accordion_tinymce_plugin($plugin_array) {
   $plugin_array['youraccordion'] = plugins_url( $path = 'wordpress-accordion/editor_plugin.js', $plugin = 'easy-accordion' );
   return $plugin_array;
}
 
function my_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

// init process for button control
add_filter( 'tiny_mce_version', 'my_refresh_mce');
add_action('init', 'add_accordion_button');

/**
 * Load CSS and Javascript for theme use
 */


if(!is_admin()){
  //register style
  wp_register_style( 'bootstrap-accordion-styles', plugins_url().'/wordpress-accordion/css/bootstrap-accordion.min.css' );

  //load style
  wp_enqueue_style('bootstrap-accordion-styles',plugins_url().'/wordpress-accordion/css/bootstrap-accordion.min.css');


  //load jquery
  wp_enqueue_script( 'jquery');

  //register script
  wp_register_script( 'bootstrap-accordion-scripts', plugins_url().'/wordpress-accordion/js/bootstrap-accordion.min.js', array(), '1.0', true);

  //load script
  wp_enqueue_script('bootstrap-accordion-scripts',plugins_url().'/wordpress-accordion/js/bootstrap-accordion.min.js');
}