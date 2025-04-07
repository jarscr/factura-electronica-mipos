<?php
/*
Plugin Name: Factura Electronica miPOS
Plugin URI: https://www.jascr.com/
Description: Sincroniza tus ventas a la plataforma de factura electronica en conjunto con woocommerce
Version: 1.1
Author: JARSCR
License: GPLv2
Text Domain: factura-electronica-mipos
*/
define('MIPOS_PLUGIN_ROUTE', plugin_dir_path(__FILE__));
require_once(MIPOS_PLUGIN_ROUTE.'helpers.php');
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//Styles
function mipos_scripts() {
  wp_register_style('mipos_cssselect2', plugin_dir_url( __FILE__ ).'assets/select2.min.css' );
  wp_enqueue_style('mipos_cssselect2');
  wp_register_script( 'mipos_jsselect2',  plugin_dir_url( __FILE__ ).'assets/select2.min.js', null, null, true);
  wp_enqueue_script('mipos_jsselect2');

  wp_register_style('mipos_styles', plugin_dir_url( __FILE__ ).'assets/styles.css', '', '1.0', 'all');
  wp_enqueue_style('mipos_styles');
  wp_register_script('mipos_code_js', plugin_dir_url( __FILE__ ).'assets/code.js', '', '1.0', 'all');
  wp_enqueue_script('mipos_code_js');
}
add_action('admin_enqueue_scripts', 'mipos_scripts');

function mipos_public_scripts() {
  wp_register_style('mipos_public_styles', plugin_dir_url( __FILE__ ).'assets/styles_public.css', '', '1.0', 'all');
  wp_enqueue_style('mipos_public_styles');
}
add_action('wp_enqueue_scripts', 'mipos_public_scripts');

//Add fields fe in checkout
//Add field checkout
add_action('woocommerce_before_checkout_billing_form', 'mipos_checkout_add_fields_fe');
function mipos_checkout_add_fields_fe($checkout) {
  $options = array(
    '01' => 'Cedula Fisica',
    '02' => 'Cedula Juridica',
    '03' => 'DIMEX',
    '04' => 'NITE',
    '05' => 'Extranjero'
  );

  woocommerce_form_field('mipos_billing_fe_required_fe', array(
      'type'          => 'checkbox',
      'required'      => false,
      'class'         => array('form-control'),
      'label'         => 'Requiere factura electronica de Costa Rica',
    ),
    $checkout->get_value('mipos_billing_fe_required_fe')
  );

  woocommerce_form_field('mipos_billing_fe_identification_type', array(
      'type'          => 'select',
      //'required'      => true,
      'class'         => array('form-control'),
      'label'         => 'Tipo identificación',
      'options'       => $options
    ),
    $checkout->get_value('mipos_billing_fe_identification_type')
  );

  woocommerce_form_field('mipos_billing_fe_identification_number', array(
      'type' => 'text',
      //'required' => true,
      'class' => array('mipos_disabled'),
      'label' => 'Número de identificación',
      'placeholder' => '',
    ),
    $checkout->get_value('mipos_billing_fe_identification_number')
  );
}

//Validate custom fields checkout
add_action('woocommerce_checkout_process', 'mipos_validate_custom_fields_checkout');
function mipos_validate_custom_fields_checkout() {
  // Check if set, if its not set add an error.

  

  if (isset($_POST['mipos_billing_fe_required_fe']) && !empty( $_POST['mipos_billing_fe_required_fe'] ) ) {
    $mipos_billing_fe_required_fe = sanitize_text_field(wp_unslash($_POST['mipos_billing_fe_required_fe']));
  } else {
    $mipos_billing_fe_required_fe = false;
  }

  if(isset($_POST['mipos_billing_fe_identification_number'])) {
    $mipos_billing_fe_identification_number = sanitize_text_field(wp_unslash($_POST['mipos_billing_fe_identification_number']));
  } else {
    $mipos_billing_fe_identification_number = null;
  }

  if ($mipos_billing_fe_required_fe && (is_null($mipos_billing_fe_identification_number) || empty($mipos_billing_fe_identification_number))) {
      wc_add_notice( __('Por favor ingrese un número de identificación válido.', 'factura-electronica-mipos'), 'error');
  }
}

//Save custom fields checkout
add_action('woocommerce_checkout_update_order_meta', 'mipos_wk_save_custom_field_data');
function mipos_wk_save_custom_field_data($order_id) {
  // Verify nonce
  $nonce = isset($_POST['_wpnonce']) ? sanitize_key(wp_unslash($_POST['_wpnonce'])) : '';
  if (!isset($nonce) || !wp_verify_nonce($nonce, 'woocommerce-process_checkout')) {
    wc_add_notice(__('Error de seguridad 111. Por favor, intente de nuevo.', 'factura-electronica-mipos'), 'error');
    return;
  }

  // Check if set, if its not set add an error.
  if(isset($_POST['mipos_billing_fe_identification_type'])) {
      $mipos_billing_fe_identification_type = sanitize_text_field(wp_unslash($_POST['mipos_billing_fe_identification_type']));
  } else {
    $mipos_billing_fe_identification_type = null;
  }

  if(!empty($mipos_billing_fe_identification_type) ) {
  update_post_meta($order_id, 'mipos_billing_fe_identification_type', $mipos_billing_fe_identification_type);
  }

  if(isset($_POST['mipos_billing_fe_identification_number'])) {
    $mipos_billing_fe_identification_number = sanitize_text_field(wp_unslash($_POST['mipos_billing_fe_identification_number']));
  } else {
    $mipos_billing_fe_identification_number = null;
  }

  if(!empty($mipos_billing_fe_identification_number) ) {
  update_post_meta($order_id, 'mipos_billing_fe_identification_number', $mipos_billing_fe_identification_number);
  }
  if(isset($_POST['mipos_billing_fe_required_fe'])) {
      $mipos_billing_fe_required_fe = sanitize_text_field(wp_unslash($_POST['mipos_billing_fe_required_fe']));
  } else {
      $mipos_billing_fe_required_fe = false;
  }
  if($mipos_billing_fe_required_fe) {
  update_post_meta($order_id, 'mipos_billing_fe_required_fe', $mipos_billing_fe_required_fe);
  }
}

//Add field custom register product
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
function woocommerce_product_custom_fields()
{
  global $post;
  $unid = get_post_meta($post->ID, 'mipos_unid_hacienda', true);
  woocommerce_wp_select(
    array(
      'id'      => 'mipos_unid_hacienda',
      'label'   => 'Unidad Hacienda',
      'options' =>  mipos_getUnidsHacienda(),
      'value'   => $unid ? $unid : 'Unid',
    )
  );

  $cabys = get_post_meta($post->ID, 'mipos_cabys', true);

?>
    <p class="form-field">
    <label for="">Código cabys</label>
      <select id="mipos_select2" name="mipos_cabys" style="width: 450px" required>
        <?php 
          if($cabys) {
        ?>
          <option selected="selected" id="<?php echo esc_attr($cabys); ?>"><?php echo esc_html($cabys); ?></option>
        <?php } ?>
      </select>
    </p>
  <?php
  //Add the fields in the database
  if ( !get_post_meta($post->ID, 'mipos_unid_hacienda', true) ) {
    add_post_meta($post->ID, 'mipos_unid_hacienda', 'Unid');
  }
  if (!get_post_meta($post->ID, 'mipos_cabys', true)) {
      add_post_meta($post->ID, 'mipos_cabys', '');
  }
}

// Save custom Fields
add_action('woocommerce_process_product_meta', 'mipos_save_woocommerce_product_custom_fields');

function mipos_save_woocommerce_product_custom_fields($post_id)
{

  $fe_unid_hacienda = isset($_POST['mipos_unid_hacienda'] ) ? sanitize_text_field(wp_unslash($_POST['mipos_unid_hacienda'])) :'Unid';
  $cabys = isset( $_POST[ 'mipos_cabys' ] ) ? sanitize_text_field(wp_unslash($_POST['mipos_cabys'])) : '';
  $product = wc_get_product($post_id);
  $product->update_meta_data('mipos_unid_hacienda', $fe_unid_hacienda);
  $product->update_meta_data('mipos_cabys', $cabys);
  $product->save();
}
//End save custom fields

add_action( 'woocommerce_admin_order_data_after_billing_address', 'mipos_show_fe_hacienda_clave' );
function mipos_show_fe_hacienda_clave($order) {
  $order_id = $order->get_id();
  $key50digits = get_post_meta($order_id, 'mipos_hacienda_clave', true );
  $mipos_error = get_post_meta($order_id, 'mipos_error', true );
?>
  <div class="order_data_column">
    <h4>HACIENDA</h4>
    <?php if($key50digits) {?>
    <div class="address">
      <p><strong>Clave: </strong> <?php echo esc_html($key50digits); ?></p>
    </div>
    <?php } else if ($mipos_error && !($key50digits)) { ?>
    <p><strong>Ocurrio un problema: </strong><?php echo esc_html($mipos_error); ?></p>
    <?php } ?>
  </div>
<?php
}


function mipos_add_checkout_script() { 
  
echo '<script type="text/javascript">

(function ($) {

  $("#mipos_billing_fe_identification_number").addClass("mipos_disabled");
  $("#mipos_billing_fe_identification_type" ).prop( "disabled", true );
  $("#mipos_billing_fe_identification_number" ).prop( "disabled", true );
  
	$("#mipos_billing_fe_required_fe").change(function () {
    let fe_checked = $("#mipos_billing_fe_required_fe").is(":checked");

    let identificationTypeLabel = $(\'label[for="mipos_billing_fe_identification_type"]\');
    let identificationNumberLabel = $(\'label[for="mipos_billing_fe_identification_number"]\');
    console.log(identificationTypeLabel, identificationNumberLabel)
    
    if(fe_checked) {
      $("#mipos_billing_fe_identification_number").removeClass("mipos_disabled");
      $("#mipos_billing_fe_identification_type" ).prop( "disabled", false );
      $("#mipos_billing_fe_identification_number" ).prop( "disabled", false );
      identificationTypeLabel.html(\'Tipo de identificación <abbr class="required" title="obligatorio">*</abbr>\');
      identificationNumberLabel.html(\'Número de identificación <abbr class="required" title="obligatorio">*</abbr>\');

    } else {
      $("#mipos_billing_fe_identification_number").addClass("mipos_disabled");
      $("#mipos_billing_fe_identification_type" ).prop( "disabled", true );
      $("#mipos_billing_fe_identification_number" ).prop( "disabled", true );
      identificationTypeLabel.text(\'Tipo de identificación (opcional\');
      identificationNumberLabel.text(\'Número de identificación (opcional)\');
    }
  
	})
})(jQuery)       

  </script>';

}
add_action( 'woocommerce_after_checkout_form', 'mipos_add_checkout_script' );




//Inicialization plugin
include(MIPOS_PLUGIN_ROUTE.'functions.php');
register_activation_hook(__FILE__, 'mipos_activate_fe_plugin');
