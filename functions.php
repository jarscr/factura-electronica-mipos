<?php
require_once(MIPOS_PLUGIN_ROUTE.'helpers.php');

//Activate fe_plugin
function mipos_activate_fe_plugin() {
  mipos_AddMenuAdministrator();
  mipos_createTaxesHaciendaWoocommerce();
}
//Add item to menu
add_action('admin_menu', 'mipos_AddMenuAdministrator');
function mipos_AddMenuAdministrator() {
  add_menu_page('miPOS', 'miPOS', 'manage_options','mipos_facturaelectronica', 'mipos_admin_page_html', 'dashicons-welcome-add-page' , 5);
}

function mipos_createTaxesHaciendaWoocommerce() {
  //Create taxes in database
  global $wpdb;
  $table_prefix = $wpdb->prefix;
  //Store rate classes
    $rate_classes = array(
      array(
        'name' => 'iva-tarifa-0-exento',
        'slug' => 'iva-tarifa-0-exento'
      ),
      array(
        'name' => 'iva-tarifa-reducida-1',
        'slug' => 'iva-tarifa-reducida-1'
      ),
      array(
        'name' => 'iva-tarifa-reducida-2',
        'slug' => 'iva-tarifa-reducida-2'
      ),
      array(
        'name' => 'iva-tarifa-reducida-4',
        'slug' => 'iva-tarifa-reducida-4'
      ),
      array(
        'name' => 'iva-transitorio-0',
        'slug' => 'iva-transitorio-0'
      ),
      array(
        'name' => 'iva-transitorio-4',
        'slug' => 'iva-transitorio-4'
      ),
      array(
        'name' => 'iva-transitorio-8',
        'slug' => 'iva-transitorio-8'
      ),
      array(
        'name' => 'iva-tarifa-general-13',
        'slug' => 'iva-tarifa-general-13'
      )
    );
    foreach ($rate_classes as $rc) {
      $tax_class = \WC_Tax::get_tax_class_by('slug', $rc['slug']);
      if( ! $tax_class) {
          \WC_Tax::create_tax_class($rc['name'], $rc['slug']);
      }
    }
  //End store rate classes
  //Store tax classes
    


  //Store tax rates
  $tax_rates = array(
    array(
      'tax_rate'          => '0.0000',
      'tax_rate_name'     => 'Tarifa 0% (Exento)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-tarifa-0-exento'
    ),
    array(
      'tax_rate'          => '1.0000',
      'tax_rate_name'     => 'Tarifa reducida (1%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-tarifa-reducida-1'
    ),
    array(
      'tax_rate'          => '2.0000',
      'tax_rate_name'     => 'Tarifa reducida (2%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-tarifa-reducida-2'
    ),
    array(
      'tax_rate'          => '4.0000',
      'tax_rate_name'     => 'Tarifa reducida (4%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-tarifa-reducida-4'
    ),
    array(
      'tax_rate'          => '0.0000',
      'tax_rate_name'     => 'Transitorio (0%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-transitorio-0'
    ),
    array(
      'tax_rate'          => '4.0000',
      'tax_rate_name'     => 'Transitorio (4%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-transitorio-4'
    ),
    array(
      'tax_rate'          => '8.0000',
      'tax_rate_name'     => 'Transitorio (8%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-transitorio-8'
    ),
    array(
      'tax_rate'          => '13.0000',
      'tax_rate_name'     => 'Tarifa general (13%)',
      'tax_rate_priority' => 1,
      'tax_rate_compound' => 0,
      'tax_rate_shipping' => 0,
      'tax_rate_order'    => 0,
      'tax_rate_class'    => 'iva-tarifa-general-13'
    )
  );

  foreach ($tax_rates as $tr) {
    $tax_rate_class = $tr['tax_rate_class'];
      $tax_rate_name = $tr['tax_rate_name'];

      $tax_rate = WC_Tax_Rate::get_by_tax_rate_and_class(
          $tr['tax_rate'],
          $tax_rate_class
      );

      if (!$tax_rate) {
        \WC_Tax::create_tax_rate($tr);
      }
  }
  // Set the transient to indicate that the tax rates have been created
  set_transient('mipos_taxes_created', true, WEEK_IN_SECONDS);
}
//End create taxes

function mipos_getExchangeRate() {
  $options = [
    'headers' => [
      'Content-Type' => 'application/json',
      'Accept'       => 'application/json',
    ],
    'timeout'     => 60,
    'redirection' => 5,
    'blocking'    => true,
    'httpversion' => '1.0',
    'sslverify'   => false,
    'data_format' => 'body',
  ];
  
  $response = wp_remote_get('https://tipodecambio.mipos.co.cr/api', $options);
  $body = wp_remote_retrieve_body($response);
  $responceData = (!is_wp_error($response)) ? json_decode($body, true) : null;
  return $responceData ? $responceData['venta'] : 580;
}

//Execute new order
add_action('woocommerce_order_status_processing', function($order_id) {
  mipos_create_invoice_for_wc_order($order_id, null, 'processing');
},  10, 10);
//add_action('woocommerce_order_status_changed', 'mipos_create_invoice_for_wc_order', 10, 3);
add_action('woocommerce_order_status_completed', function($order_id) {
  // echo $order_id;
  // error_log("COMPLETED: $order_id", 0);
  mipos_create_invoice_for_wc_order($order_id, null, 'completed');
},  10, 10);


function mipos_create_invoice_for_wc_order($order_id, $old_status, $new_status) {
  try {
    
    global $woocommerce;
    $fe_status = get_option('mipos_when_send_fe');
    $new_status = strtolower($new_status);

    if($new_status != 'completed' && $fe_status != 'processing') {
      // error_log("NO PASO C: $fe_status", 0);
      return 0;
    }

    if($new_status == 'processing' && $fe_status != 'processing') {
      // error_log("NO PASO P: $fe_status", 0);
      return 0;
    }

    if($new_status == 'processing' && $fe_status != 'processing') {
    // error_log("NO PASO P: $fe_status", 0);
      return 0;
    }

    
    
    $order = wc_get_order($order_id);
    update_post_meta($order_id, 'mipos_hacienda_clave', null);


    //Comprobar si la orden ya tiene factura electronica
    $exists_key50digits = get_post_meta($order_id, 'mipos_hacienda_clave', true);

    if($exists_key50digits) {
      return 0;
    }
    //Fin comprobar si ya tiene factura electronica



    //Get items order
    $contador=1;
    $items = array();
    foreach($order->get_items() as $item_id => $item) {
      $product_id = $item['product_id'];
      $item = wc_get_product($product_id);

      //Unid hacienda
      $unid = get_post_meta($product_id, 'mipos_unid_hacienda', true);
      $unid = $unid ? $unid : 'Unid';

      //Cabys
      $cabys = get_post_meta($product_id, 'mipos_cabys', true);
      $cabys = explode('-', $cabys);
      $cabys = isset($cabys[0]) ? trim($cabys[0]) : '';

      //Product type
      $product_type = get_post_meta($product_id, 'mipos_product_type', true);

      // Coupons used in the order LOOP (as they can be multiple)
      foreach( $order->get_coupon_codes() as $coupon_code ) {
        $args = array(
          'post_type'      => 'shop_coupon',
          'post_status'    => 'publish',
          'posts_per_page' => 1, // Solo queremos un resultado
          'title'          => $coupon_code,
        );
        $coupon_query = new WP_Query( $args );
      
        if ( $coupon_query->have_posts() ) {
          $coupon_query->the_post();
          $coupon_id = get_the_ID();
          $coupon = new WC_Coupon( $coupon_id );
          //update_post_meta( $order_id, '_coupon_fe', $coupon->get_amount() );
        }
        wp_reset_postdata(); // Restablecer el loop para evitar conflictos
      }

      $order_total_discount = $order->get_total_discount();
      $order_subtotal = $order->get_subtotal();

      $discount = 0;
      if ($order_total_discount > 0) {
        $discount = ($order_total_discount * 100) / $order_subtotal;
      }

      $price = $item->get_price();
      $quantity = wc_get_order_item_meta($item_id, '_qty', true);

      $discount_amount = (($price * $quantity) * $discount) / 100;
      $discount_amount = number_format($discount_amount, 5, '.', '');


      //Tax
      $tax_class = $item->get_tax_class();
      $tax_array = array(
        'iva-tarifa-0-exento'   => '01',
        'iva-tarifa-reducida-1' => '02',
        'iva-tarifa-reducida-2' => '03',
        'iva-tarifa-reducida-4' => '04',
        'iva-transitorio-0'     => '05',
        'iva-transitorio-4'     => '06',
        'iva-transitorio-8'     => '07',
        'iva-tarifa-general-13' => '08'
      );
      $item_tax = '08';
      if (array_key_exists($tax_class, $tax_array)) {
        $item_tax = $tax_array[$tax_class];
      }

      $items[] = array(
        'codigoComercial' => array('tipo'=>'04', 'codigo'=>!$product_type ? 'servicio' : $product_type),
        'codigo' => $cabys,
        'detalle' => $item->get_name(),
        'cantidad' => $quantity,
        'unidadMedida' => $unid,
        'unidadMedidaComercial'=> $unid,
        'precioUnitario' => $item->get_price(),
        'descuento' => $discount_amount,
        'numeroLinea'=> $contador,
        'impuesto' => array (
          array (
            'tarifa' => '13',
            'codigoTarifa' => '08',
            'codigo'=>'01',
                
          )
        )
      );



      $contador++;
    }
    //End get items order


    //Agregar costo de envio a un item de la orden
    $shipping_total = $order->get_shipping_total();
    $shipping_tax = $order->get_shipping_tax();
    if(isset($shipping_tax) && $shipping_tax > 0) {
      $percentage_tax_shipping = ($shipping_tax * 100) / $shipping_total;
    } else {
      $percentage_tax_shipping = 0;
    }
   

    if($shipping_total > 0){
      $tax_array_shipping = array(
        '0'   => '01',
        '1' => '02',
        '2' => '03',
        '4' => '04',
        '8'     => '07',
        '13' => '08'
      );

      if($shipping_total > 0) {
        $item_tax_shipping = '08';
        if (array_key_exists($percentage_tax_shipping, $tax_array_shipping)) {
          $item_tax_shipping = $tax_array_shipping[$percentage_tax_shipping];
        }
        $items[] = array(
          'codigoComercial' => array('tipo'=>'04', 'codigo'=>'CRLC_01'),
          'codigo' => '6803000000000',
          'detalle' => 'Envio',
          'cantidad' => 1,
          'numeroLinea'=> $contador,
          'unidad' => 'Os',
          'unidadMedida'=>'Os',
          'precioUnitario' => $shipping_total,
          'descuento' => 0,
          'impuesto' => array (
              array (
                'codigo'=>'01',
                'tarifa' => '13',
                'codigoTarifa' => '08',
            )
          )
        );
      }
    }


  
    //Fin agregar costo de envio


    //options cedula
    //Get document type 01 or 04
    $required_fe = get_post_meta($order->get_id(), 'mipos_billing_fe_required_fe', true);
    if($required_fe) {
      $document_type = '01';
      //get identification
      $identification_type = get_post_meta($order->get_id(), 'mipos_billing_fe_identification_type', true);
      $identification_number = get_post_meta($order->get_id(), 'mipos_billing_fe_identification_number', true);
      
      if($identification_type == 'Cedula Fisica') {
        $identification_type = '01';
      } else if($identification_type == 'Cedula Juridica') {
        $identification_type = '02';
      } else if($identification_type == 'DIMEX') {
        $identification_type = '03';
      } else if($identification_type == 'NITE') {
        $identification_type = '04';
      } else if($identification_type == 'Extranjero') {
        $identification_type = '05';
      }
      //If extranger identification number is void
      if($identification_type == '05') {
        $identification_number = '';
      }
    } else {
      $document_type = '04';
      //get identification
      $identification_type = '';
      $identification_number = '';
    }

    //Get url modo hacienda test or production
    $modo_hacienda = get_option('mipos_modo_hacienda');
    $miPOSURL = get_option('mipos_url');
    $endpoint = mipos_getUrlApi($modo_hacienda, $miPOSURL);

    $economic_activity = get_option('mipos_economic_activity_hacienda');

    $sucursal = get_option('mipos_sucursal');
    $long = 3;
    $sucursal = $sucursal ? sprintf("%0".$long."d", "$sucursal") : '990';
    $receptor ='';
    if($document_type==1){
      $receptor = array(
        'identificacion'=>array(
          'tipo' => $identification_type, //Extranjero 99
          'numero' => $identification_number, //cuando extranjero 99 mande vacio
        ),
        'nombre' => $order->get_billing_first_name().' '.$order->get_billing_last_name(),
        'telefono'=> $order->get_billing_phone(),
        'correoElectronico' => $order->get_billing_email(),
      );
    }
    if($document_type==4 && $identification_type=='05'){
      $receptor = array(
        'identificacion'=>array(
          'tipo' => $identification_type, //Extranjero 99
          'numero' => $identification_number, //cuando extranjero 99 mande vacio
        ),
        'nombre' => $order->get_billing_first_name().' '.$order->get_billing_last_name(),
        'telefono'=> $order->get_billing_phone(),
        'correoElectronico' => $order->get_billing_email(),
      );
    }
  
      
    $body = array (
      'numeroSucursal' => $sucursal,
      'tipoDoc' => $document_type, //cuando se requiere factura 01 // no check no factura 04
      'numeroTerminal' => '13',
      'codigoActividad' => $economic_activity,
      'resumenFactura' => 
      array(
        'codigoTipoMoneda' => array("codigoMoneda"=>$order->get_currency()),
        'totalOtrosCargos'=>0,
        'notasDocumento'=>'Factura sobre la orden en tienda: #'.$order->get_id()
      ),
      'otrosCargos' => '0',
      'receptor'=>$receptor,
      'emisor'=> get_option('mipos_emisor'),
      'numeroReferencia' => $order->get_id(),
      'detalleServicio' => $items
    );

    

    $body = wp_json_encode($body);

    //error_log("$body", 0);

    $options = [
      'body'    => $body,
      'headers' => [
          'Content-Type' => 'application/json',
          'Accept'       => 'application/json',
          'Authorization'    => 'basic '.get_option('mipos_api_token')
      ],
      'timeout'     => 60,
      'redirection' => 5,
      'blocking'    => true,
      'httpversion' => '1.0',
      'sslverify'   => false,
      'data_format' => 'body',
    ];
    
    $response = wp_remote_post($endpoint, $options);
    // Response body.
    $body = wp_remote_retrieve_body( $response );
    $responceData = ( ! is_wp_error( $response ) ) ? json_decode( $body, true ) : null;
    //error_log(wp_json_encode($responceData ),0);

    
    if($responceData) {
      if(isset($responceData['status']['error'])) {
        update_post_meta($order_id, 'mipos_error', sanitize_text_field(wp_json_encode($responceData)));
      } else if(isset($responceData['message']) && strtolower($responceData['error_message']) =='Unauthorized.') {
        update_post_meta($order_id, 'mipos_error', sanitize_text_field(strtolower($responceData['error_description'])));
      } else {
        update_post_meta($order_id, 'mipos_hacienda_clave', sanitize_text_field($responceData['claveHacienda']));
      }
    } else {
      update_post_meta($order_id, 'mipos_error', sanitize_text_field(wp_json_encode($responceData))); 
    }

  } catch(Exception $e) {
    $errorMessage = $e->getMessage();
    $errorCode = $e->getCode();
    $error_message = sprintf('Error %1$s: %2$s', $errorCode, $errorMessage);
    // Log the error message
    wc_add_notice( $error_message,  'factura-electronica-mipos' );
  }

}

function mipos_admin_page_html() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
      return;
    }
  
    //Get the active tab from the $_GET param
    $default_tab = null;
    // Verificar el nonce (asumiendo que se pasa en la URL como 'nonce')
    $nonce = isset($_GET['nonce']) ? sanitize_key(wp_unslash($_GET['nonce'])) : '';
    if (empty($nonce) || ! wp_verify_nonce( $nonce, 'mipos_tab_action' ) ) {
      $tab = $default_tab; // Si el nonce falla, usa el valor por defecto
    } else {
      $tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : $default_tab;
    }
?>

    <!-- Here are our tabs -->
    <nav class="nav-tab-wrapper mipos_facturaelectronica_tabs">
      <a href="?page=mipos_facturaelectronica" class="nav-tab <?php if($tab === null) : ?>nav-tab-active<?php endif; ?>">CONFIGURACIÓN</a>
    </nav>

    <div class="tab-content">
    <?php switch($tab) :
      case 'other':
        echo "Other";
      default:
        include(MIPOS_PLUGIN_ROUTE.'admin/configuration.php');
        break;
    endswitch; ?>
    </div>
  </div>
  <?php
}

