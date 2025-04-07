<?php
namespace MIPOS;

if (!current_user_can('manage_options')) {
    wp_die(esc_html__('No tienes suficientes permisos para acceder a esta página.', 'factura-electronica-mipos'));
}

require_once(MIPOS_PLUGIN_ROUTE . 'helpers.php');

// If method is post
$errors = [];
$test = false;
$test_success = false;
$save_success = false;

// Check if $_SERVER['REQUEST_METHOD'] is set before using it
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
   // Verify the nonce
    // Unslash and sanitize the nonce before verifying
    $nonce = isset($_POST['mipos_configuration_nonce']) ? sanitize_key(wp_unslash($_POST['mipos_configuration_nonce'])) : '';
    if (empty($nonce) || !wp_verify_nonce($nonce, 'mipos_configuration_action')) {
        wp_die(esc_html__('¡Lo siento! La verificación de seguridad ha fallado.', 'factura-electronica-mipos'));
    }

    if (isset($_POST['mipos_access_api_test'])) {
        $modo_hacienda = get_option('mipos_modo_hacienda');
        $miPOSURL = get_option('mipos_url');
        $endpoint = mipos_getUrlApi($modo_hacienda, $miPOSURL);

        $body = array(
            'sucursal' => '004',
            'punto' => '00001',
            'actividad' => '014002',
            'comentarios' => 'Pago sin descuento'
        );

        $body = wp_json_encode($body);
        $options = [
            'body' => $body,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'authorization' => 'Basic ' . get_option('mipos_api_token'),
            ],
            'timeout' => 60,
            'redirection' => 5,
            'blocking' => true,
            'httpversion' => '1.0',
            'sslverify' => false,
            'data_format' => 'body',
        ];

        $response = wp_remote_post($endpoint, $options);
        $body = wp_remote_retrieve_body($response);
        $responceData = (!is_wp_error($response)) ? json_decode($body, true) : null;
        $test = true;
        if ($responceData && isset($responceData['errors']['medio_pago'])) {
            $test_success = true;
        } else {
            $test_success = false;
        }
    } else { // If Not test
         // Fields
         $mipos_api_token = isset($_POST['mipos_api_token']) ? sanitize_text_field(wp_unslash($_POST['mipos_api_token'])) : '';
         $mipos_url = isset($_POST['mipos_url']) ? sanitize_text_field(wp_unslash($_POST['mipos_url'])) : '';
         $mipos_emisor = isset($_POST['mipos_emisor']) ? sanitize_text_field(wp_unslash($_POST['mipos_emisor'])) : '';
         $mipos_economic_activity_hacienda = isset($_POST['mipos_economic_activity_hacienda']) ? sanitize_text_field(wp_unslash($_POST['mipos_economic_activity_hacienda'])) : '';
         $mipos_modo_hacienda = isset($_POST['mipos_modo_hacienda']) ? sanitize_text_field(wp_unslash($_POST['mipos_modo_hacienda'])) : null;
         $mipos_when_send_fe = isset($_POST['mipos_when_send_fe']) ? sanitize_text_field(wp_unslash($_POST['mipos_when_send_fe'])) : null;
         $mipos_sucursal = isset($_POST['mipos_sucursal']) ? sanitize_text_field(wp_unslash($_POST['mipos_sucursal'])) : '';
         // Validate inputs
         $errors = mipos_validate_field('mipos_api_token', $mipos_api_token, ['required'], $errors);
         $errors = mipos_validate_field('mipos_url', $mipos_url, ['required'], $errors);
         $errors = mipos_validate_field('mipos_emisor', $mipos_emisor, ['required'], $errors);
         $errors = mipos_validate_field('mipos_economic_activity_hacienda', $mipos_economic_activity_hacienda, ['required'], $errors);
         $errors = mipos_validate_field('mipos_modo_hacienda', $mipos_modo_hacienda, ['required'], $errors);
         $errors = mipos_validate_field('mipos_when_send_fe', $mipos_when_send_fe, ['required'], $errors);
         $errors = mipos_validate_field('mipos_sucursal', $mipos_sucursal, ['sucursal_max'], $errors);
 
         // End validate inputs

        // If not errors
        if (!count($errors)) {
            // Store info
            update_option('mipos_api_token', $mipos_api_token);
            update_option('mipos_url', $mipos_url);
            update_option('mipos_emisor', $mipos_emisor);
            update_option('mipos_economic_activity_hacienda', $mipos_economic_activity_hacienda);
            update_option('mipos_modo_hacienda', $mipos_modo_hacienda);
            update_option('mipos_when_send_fe', $mipos_when_send_fe);
            update_option('mipos_sucursal', $mipos_sucursal ? $mipos_sucursal : null);
            $save_success = true;
        }
    }
}
?>
<div style="position:relative;" class="wrap">
  <div style="display: flex; width: 100%;justify-content: space-between">
    <p style="padding-left: 20px;font-size: 14px">Ingresa tus datos de acceso y comienza a facturar</p>
    
    <?php if(get_option('mipos_access_token') && get_option('mipos_url')) {?>
    <form method="post">
        <?php wp_nonce_field('mipos_configuration_action', 'mipos_configuration_nonce'); ?>
      <input type="hidden" name="mipos_access_api_test" value="test">
      <button type="submit" class="mipos_btn_access_test">
        <span class="dashicons dashicons-update"></span>
        Probar datos de acceso
      </button>
    </form>
    <?php } ?>

  </div>

  
  <!-- Alert save success -->
  <?php if($save_success) { ?>
    <div class="mipos_alert_success" id="mipos-alert">
      <p><span class="dashicons dashicons-yes-alt"></span> Los datos de acceso se guardarón correctamente</p>
      <span class="dashicons dashicons-no" id="mipos-close-alert"></span>
    </div>
  <?php } ?>

  <!-- Alert test -->
  <?php if($test) { ?>
    <div class="<?php echo ($test_success ? 'mipos_alert_success' : 'mipos_alert_error') ?>" id="mipos-alert-test">
    <?php if ($test_success) { ?>
      <p><span class="dashicons dashicons-yes-alt"></span>Datos de acceso correctos, conexión exitosa</p>
    <?php } else { ?>
      <p><span class="dashicons dashicons-warning"></span>Datos de acceso incorrectos, conexión fallida</p>
    <?php } ?>
    <span class="dashicons dashicons-no" id="mipos-close-alert-test"></span>
    </div>
  <?php } ?>

  <div>
    <div>
    <form method="post">
        <?php wp_nonce_field('mipos_configuration_action', 'mipos_configuration_nonce'); ?>
      <div class="mipos_item_form">
        <label>KEY</label>
        <input type="text" name="mipos_api_token" value="<?php echo esc_attr(get_option('mipos_api_token')); ?>" />
        <?php if (isset($errors['mipos_api_token'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_api_token']); ?>
          </div>
        <?php } ?>
      </div>

      <div class="mipos_item_form">
        <label>miPOS URL</label>
        <input type="text" name="mipos_url" value="<?php echo esc_attr(get_option('mipos_url')); ?>" />
        <?php if (isset($errors['mipos_url'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_url']); ?>
          </div>
        <?php } ?>
      </div>

      <div class="mipos_item_form">
        <label>miPOS Emisor (Cédula)</label>
        <input type="text" name="mipos_emisor" value="<?php echo esc_attr(get_option('mipos_emisor')); ?>" />
        <?php if (isset($errors['mipos_emisor'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_emisor']); ?>
          </div>
        <?php } ?>
      </div>


      <div class="mipos_item_form">
        <label>ACTIVIDAD ECONÓMICA</label>

        <select name="mipos_economic_activity_hacienda">
          <?php 
            foreach(mipos_getEconomicActivitiesHacienda() as $eah) {
          ?>
          <option <?php if(get_option('mipos_economic_activity_hacienda') === $eah['codigo']) { ?> selected <?php } ?> value="<?php echo esc_attr($eah['codigo']) ?>"><?php echo esc_html($eah['codigo'].' - '.$eah['actividad']) ?></option>

          <?php } ?>
        </select>
        
        <?php if (isset($errors['mipos_economic_activity_hacienda'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_economic_activity_hacienda']); ?>
          </div>
        <?php } ?>
      </div>
      <!-- Opciones avanzadas -->
      <div style="padding: 20px;padding-bottom: 10px" id="mipos_btn_advance_options">
        <span style="cursor: pointer;font-size: 15px;font-weight: bold">OPCIONES AVANZADAS <span class="dashicons dashicons-arrow-down-alt2" style="margin-left:5px"></span></span>
      </div>
      <div id="mipos_advance_options">
      <div class="mipos_item_form">
        <label>ENVIAR FACTURA CUANDO EL ESTADO DE LA ORDEN SEA</label>

        <select name="mipos_when_send_fe">
          <option value="completed" <?php if(get_option('mipos_when_send_fe') === 'completed') echo 'selected' ?>>Completado</option>
          <option value="processing" <?php if(get_option('mipos_when_send_fe') === 'processing') echo 'selected' ?>>Procesando</option>
        </select>
        
        <?php if (isset($errors['mipos_when_send_fe'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_when_send_fe']); ?>
          </div>
        <?php } ?>
      </div>



      <div class="mipos_item_form">
        <label>AMBIENTE</label>
        <label class="input_radio">
          PRUEBAS
          <input type="radio" name="mipos_modo_hacienda" value="test" <?php echo (get_option('mipos_modo_hacienda') == 'test') ?  "checked" : "";?>>
        </label>

        <label class="input_radio">
          PRODUCCIÓN
          <input type="radio" name="mipos_modo_hacienda" value="production" <?php echo (get_option('mipos_modo_hacienda') == 'production' || !get_option('mipos_modo_hacienda')) ?  "checked" : "";?>>
        </label>
        <?php if (isset($errors['mipos_modo_hacienda'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_modo_hacienda']); ?>
          </div>
        <?php } ?>
      </div>


      <div class="mipos_item_form">
        <label>Sucursal</label>
        <small>La sucursal puede estar entre 1 y 999, si dejas este campo vacio se usara sucursal 999</small>
        <input type="text" name="mipos_sucursal" value="<?php echo esc_attr(get_option('mipos_sucursal')); ?>" />
        <?php if (isset($errors['mipos_sucursal'])) { ?> 
          <div class="mipos_text_danger">
            <?php echo esc_html($errors['mipos_sucursal']); ?>
          </div>
        <?php } ?>
      </div>

      </div>
      
      <div class="mipos_item_form">
        <button type="submit" class="mipos_btn_success">
        <svg style="width:18px;margin-right: 5px;fill:#ffffff" id="Layer_1" style="enable-background:new 0 0 30 30;" version="1.1" viewBox="0 0 30 30" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M22,4h-2v6c0,0.552-0.448,1-1,1h-9c-0.552,0-1-0.448-1-1V4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18  c1.105,0,2-0.895,2-2V8L22,4z M22,24H8v-6c0-1.105,0.895-2,2-2h10c1.105,0,2,0.895,2,2V24z"/><rect height="5" width="2" x="16" y="4"/></svg>
          Guardar
        </button>
      </div>
    </form>
    </div>
  </div>
</div>
