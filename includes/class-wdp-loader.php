<?php
/**
 * Main Loader.
 *
 * @package plugin-customization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WDP_Loader' ) ) {

	/**
	 * Class WDP_Loader.
	 */
	class WDP_Loader {

		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action('wp_enqueue_scripts', array($this, 'wdp_enqueue_scripts'));
			add_action('admin_enqueue_scripts', array( $this,'wdp_admin_enqueue_scripts'));
			add_action('wp_ajax_data_fetch' , array( $this, 'wdp_data_search'));
			add_action('wp_ajax_nopriv_data_fetch', array( $this,'wdp_data_search'));
			add_action('wp_ajax_data_drop' , array( $this, 'wdp_data_sorting'));
			add_action('wp_ajax_nopriv_data_drop' , array( $this, 'wdp_data_sorting'));
		}

		/**
		 * Include Files depend on platform.
		*/
		public function includes() {
			
			// include_once 'class-wdp-project-post-type.php';
			// include_once 'class-wdp-meta-box.php';
			include_once 'class-wdp-discount.php';
			// include_once 'class-wdp-shortcode.php';
		}

		/**
		 * Enqueue Files.
		 */
		public function wdp_enqueue_scripts() {
			wp_enqueue_script( 'wpd_script', plugin_dir_url( __DIR__ ) . 'assets/js/script.js', array('jquery'), wp_rand() );
    		wp_localize_script('wpd_script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
			wp_enqueue_style('wpd_style', plugin_dir_url( __DIR__ ) . 'assets/css/style.css');
		}

		/**
		 * Enqueue File For Admin.
		 */
		public function wdp_admin_enqueue_scripts() {
			wp_enqueue_style('wpd_admin_style', plugin_dir_url( __DIR__ ) . 'assets/css/style.css');
			wp_enqueue_script( 'wpd_admin_script', plugin_dir_url( __DIR__ ) . 'assets/js/script.js', array('jquery'), wp_rand() );
		}

		/**
		 * Search bar for project page.
		 */
		public function wdp_data_search(){

			$args = array( 
				'posts_per_page' => 3, 
				's' => esc_attr( $_POST['keyword'] ), 
				'post_type' => 'project' 
			);
			$the_query = new WP_Query( $args );
			if( $the_query->have_posts() ) :?>
				<?php while( $the_query->have_posts() ): $the_query->the_post();  ?>
						<div style="background-color: lightblue; border: 1px solid black; float:left; width: 500px;margin: 5px;height: 300px;"> 
    					<h1 style="text-align: center;"> <a style="align-items: center;" href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2></h1>
    					<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
    					<p style="text-align: center;" ><?php the_content(); ?></p> 
						</div> 
				<?php endwhile; 
			endif;
			die();
			
		}

		/**
		 * Sorting for project page.
		 */
		public function wdp_data_sorting() {
			$curentpage = get_query_var('paged');
			$args= array( 
				'paged' => $curentpage,
				'posts_per_page' => 4, 
				'orderby' => 'title',
				'order' => 'ASC',
				'post_type' => array('project') );
			if ('asc' == $_POST['keyword']) {
				$args['order'] = 'ASC';
			}
			elseif ($_POST['keyword'] == 'desc') {
				$args['order'] = 'DESC';
			}
			if ($_POST['keyword'] == 'old') {
				$args['orderby'] = 'date';$args['order'] = 'ASC';
			}
			elseif ($_POST['keyword'] == 'new') {
				   $args['orderby'] = 'date';$args['order'] = 'DESC';
			}
			$the_query = new WP_Query($args);
			if( $the_query->have_posts() ) :
				ob_start();
				while( $the_query->have_posts() ): $the_query->the_post();  ?>
					<div style="background-color: lightblue; border: 1px solid black; float:left; width: 500px;margin: 5px;height: 300px;"> 
						<h1 style="text-align: center;">
							<a style="align-items: center;" href=" <?php the_permalink(); ?> "><?php the_title(); ?></a>
						</h1>
						<a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
						<p style="text-align: center;" ><?php the_content(); ?></p> 
					</div>
				<?php endwhile; 
				$output_string = ob_get_contents();
				ob_end_clean();
				wp_die($output_string); 
				wp_reset_postdata(); 
				echo paginate_links(array(
					'total' => $query->max_num_pages
				));
		endif;
		die();
		}
	}
}

new WDP_Loader();