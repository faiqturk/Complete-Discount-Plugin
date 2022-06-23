<?php
/**
 * Shortcode of Project Page
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_Shortcode' ) ) {

	/**
	 * Class WDP_Shortcode.
	 */
	class WDP_Shortcode {

        /**
		 *  Constructor.
		 */
        public function __construct() {
             add_shortcode( 'list', array( $this,'wpd_shortcode_project_post') ); 
        }

        /**
		 *  Shortcode for display project page code.
		 */
        public function wdp_shortcode_project_post()
        {
            $curentpage = get_query_var('paged');
            $args = array(
                'post_type'      => 'project',
                'posts_per_page' => '3',
                'publish_status' => 'published',
                'paged'          => $curentpage
            );
            $query = new WP_Query($args);
            $result = '';
            if($query->have_posts()) :
                while($query->have_posts()) :
                    $query->the_post();
                    $result = $result . "<h2>" . get_the_title() . "</h2>";
                    $result = $result . get_the_post_thumbnail();
                    $result = $result . "<p>" . get_the_content() . "</p>";
                endwhile;
                
                wp_reset_postdata();       
                echo paginate_links(array(
                 'total' => $query->max_num_pages
                )); 
            endif;
            return $result;         
        }
    }
}
new WDP_Shortcode();