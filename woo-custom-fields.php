<?php
// The code for displaying WooCommerce Product Custom Fields
add_action( 'woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields' ); 
// Following code Saves  WooCommerce Product Custom Fields
add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save' );
//Custom Fields Function
function woocommerce_product_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_supplier_field',
            'placeholder' => 'Supplier',
            'label' => __('Supplier', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_pack_size_field',
            'placeholder' => 'Pack Size',
            'label' => __('Pack Size', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_hsn_field',
            'placeholder' => 'HSNASC Code ',
            'label' => __('HSNASC Code ', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    //Custom Product  Textarea
    /*woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
            'placeholder' => 'Custom Product Textarea',
            'label' => __('Custom Product Textarea', 'woocommerce')
        )
    );*/
    echo '</div>';
}
//Saving Data
function woocommerce_product_custom_fields_save($post_id)
{
    // Custom Product Text Field
    $woocommerce_custom_product_supplier_field = $_POST['_custom_product_supplier_field'];
    if (!empty($woocommerce_custom_product_supplier_field))
        update_post_meta($post_id, '_custom_product_supplier_field', esc_attr($woocommerce_custom_product_supplier_field));
// Custom Product Number Field
    $woocommerce_custom_product_pack_size_field = $_POST['_custom_product_pack_size_field'];
    if (!empty($woocommerce_custom_product_pack_size_field))
        update_post_meta($post_id, '_custom_product_pack_size_field', esc_attr($woocommerce_custom_product_pack_size_field));
// Custom Product Textarea Field
    $woocommerce_custom_product_hsn_field = $_POST['_custom_product_hsn_field'];
    if (!empty($woocommerce_custom_product_hsn_field))
        update_post_meta($post_id, '_custom_product_hsn_field', esc_html($woocommerce_custom_product_hsn_field));

}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_custom_fields_display', 5 );

function woocommerce_custom_fields_display()
{
  global $post;
  $product = wc_get_product($post->ID);
    $woocommerce_custom_product_pack_size_field = $product->get_meta('_custom_product_pack_size_field');
    $woocommerce_custom_product_supplier_field = $product->get_meta('_custom_product_supplier_field');
    $woocommerce_custom_product_hsn_field = $product->get_meta('_custom_product_hsn_field');

the_title( '<h2 class="product_title entry-title">', '</h2>' );
echo "<span>Company Name: </span>" . get_the_term_list( $product->get_id(), 'pwb-brand', '', ', ') . "<br>";

echo "Composition: " . get_the_term_list( $post->ID, 'composition', '', ', ')  ;

  if ($woocommerce_custom_product_pack_size_field) {
   // Display the value of custom product number field
    
     echo "<p><strong>Pack Size: </strong>".get_post_meta($post->ID, '_custom_product_pack_size_field', true)."</p>";

    // the_title( '<h3 class="product_title entry-title">'.get_post_meta($post->ID, '_custom_product_pack_size_field', true).'</h3>' );
  }

  if ($woocommerce_custom_product_supplier_field) {
      // Display the value of custom product text field
    echo "<p><strong>Supplier: </strong>".get_post_meta($post->ID, '_custom_product_supplier_field', true)."</p>";

    //the_title( '<h3 class="product_title entry-title">'.get_post_meta($post->ID, '_custom_product_supplier_field', true).'</h3>' );

  }

  
  if ($woocommerce_custom_product_hsn_field) {

// Display the value of custom product text area
    
     echo "<p><strong>HSNASC Code: </strong>".get_post_meta($post->ID, '_custom_product_hsn_field', true)."</p>";
  	//the_title( '<h3 class="product_title entry-title">'.get_post_meta($post->ID, '_custom_product_hsn_field', true).'</h3>' );
  }
}

add_action('woocommerce_single_product_summary', 'woocommerce_custom_fields_display',5 );
?>