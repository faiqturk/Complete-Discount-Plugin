<?php
/**
 * Meta Box in Project Page
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_Project_Meta_box' ) ) {

	/**
	 * Class WDP_Project_Meta_box.
	 */
	class WDP_Project_Meta_box {
      
      /**
		 *  Constructor.
		 */
		public function __construct() {
             add_action("add_meta_boxes",array( $this,"wdp_register_metabox"));
             add_action("save_post",array( $this,"wdp_save_values"),10,2);
        }

      /**
		*  Register meta-box of project
		*/
      public function wdp_register_metabox(){
             add_meta_box( "cpt-id", "Details",array( $this, "call_metabox"), "projects","side","high");
      }

      /**
		 *  getting data from metabox(custom field).
		*/
      public function wpd_call_metabox($post){ ?>
         <p>
         <label> Name </label>
         <?php  $name = get_post_meta($post->ID,"post_name",true) ?>
         <input type="text" value="<?php echo $name ?>" name="textName" placeholder="Name"/>
         </p>
         <p>
         <label> Email </label>
         <?php  $email = get_post_meta($post->ID,"post_email",true) ?>
         <input type="email" value="<?php echo $email ?>" name="textEmail" placeholder="Email"/>
         </p>
      <?php
      } 
      /**
		*  Save data of metabox and edit.
		*/
      public function wpd_save_values($post_id, $post){
         $textName = isset($_POST['textName'])?$_POST['textName']:"";
         if ( isset($_POST['textName']) ) {
            echo $_POST['textName'];
         } else {
            echo '';
         }
         $textEmail = isset($_POST['textEmail'])?$_POST['textEmail']:"";
         update_post_meta( $post_id,"post_name",$textName);
         update_post_meta( $post_id,"post_email",$textEmail);
      }
   }
}
new WDP_Project_Meta_box();

  