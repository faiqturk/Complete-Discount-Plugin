<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_Discount' ) ) {
    /**
	 * Class WDP_Discount.
	 */
	class WDP_Discount {

		/**
		 *  Constructor.
		 */
		public function __construct() {
        add_action( 'woocommerce_product_options_general_product_data', array($this, 'wdp_product_input' )); 
        add_action( 'woocommerce_process_product_meta', array($this, 'wdp_product_save' ));
        add_filter( 'woocommerce_get_price_html',array($this,'wdp_discount_calculation'));
        add_action( 'woocommerce_before_calculate_totals', array($this, 'wdp_add_to_cart_price' ));
        }
        
    /**
	*  Discount Input Box Function.
	*/
    public function wdp_product_input (){
       global $woocommerce;
       echo '<div class=" product_custom_field ">';
       woocommerce_wp_checkbox(
			array(
				'id'            => 'checkbox',
				'wrapper_class' => 'show_if_simple',
				'label'         => 'Check me! For Discount',
			)
		);
       woocommerce_wp_text_input(
           array(
               'id'            => 'collect_product_id',
               'placeholder'   => 'in %',
               'label'         => 'Discount',
               'desc_tip'      => 'true',
               'type'          => 'number',
               'custom_attributes' => array(
					'step'     => 'any',
					'min'      => '0',
					'max'      => '100',
					'required'  => true
				)
             )
           );
       echo '</div>';
    }
    /**
	*  Save Discount data Function.
	*/
    public function wdp_product_save($post_id){
        $inputBox = isset($_POST['collect_product_id'])?$_POST['collect_product_id']:"";
		$inputNull = '';
        $checkBox = isset($_POST['checkbox'])?$_POST['checkbox']:"";
            if ($_POST['checkbox'] == true){
                update_post_meta($post_id, 'collect_product_id', esc_attr($inputBox));
                update_post_meta($post_id, 'checkbox', esc_attr($checkBox));
            }
			elseif($_POST['checkbox'] == false){
				update_post_meta($post_id, 'collect_product_id', esc_attr($inputNull));
				update_post_meta($post_id, 'checkbox', esc_attr($checkBox));
			}
        return $post_id;
    }

    /**
	*  For fetch Discount pric in userside.
	*/
    public function wdp_discount_calculation($price){
        global $post;
        $product = wc_get_product($post->ID);
        $discount = $product->get_meta('collect_product_id');
        $regular_price = $product->get_regular_price();
        if(!$discount == null){
        	$price = $regular_price * ((100 - $discount)/ 100);
        }
        else{
            $price =$regular_price;
        }
        return 'Rs :'. $price;
    }

    /**
	*  For Add Pricing in add to cart.
	*/
    public function wdp_add_to_cart_price($cart_object){
        foreach($cart_object->get_cart() as $item => $values) { 
        	$product_id = $values['product_id'];
        	$product = wc_get_product($product_id);
        	$discount = get_post_meta($product_id, 'collect_product_id', true);
        	$regular_price = $product->get_regular_price();
			if(!$discount == null){
          		$new_price = $regular_price * ((100 - $discount)/ 100) ;
          		$values[ 'data' ]->set_price($new_price);
			}
			else{
				$new_price = $regular_price;
				$values[ 'data' ]->set_price($new_price);
			}
        }
    }
  }
}
new WDP_Discount();