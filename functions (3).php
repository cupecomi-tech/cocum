<?php
session_start();
//header('Set-Cookie: nombre_cookie=valor; SameSite=None; Secure');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
setcookie( 'PHPSESSID', '', time() - 86400, '/folder/');
date_default_timezone_set("America/Mexico_City");

/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 * test
 */

 if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
  }

if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Add styles inline.
		wp_add_inline_style( 'twentytwentytwo-style', twentytwentytwo_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

if ( ! function_exists( 'twentytwentytwo_editor_styles' ) ) :

	/**
	 * Enqueue editor styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_editor_styles() {

		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', twentytwentytwo_get_font_face_styles() );

	}

endif;

add_action( 'admin_init', 'twentytwentytwo_editor_styles' );


if ( ! function_exists( 'twentytwentytwo_get_font_face_styles' ) ) :

	/**
	 * Get font face styles.
	 * Called by functions twentytwentytwo_styles() and twentytwentytwo_editor_styles() above.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return string
	 */
	function twentytwentytwo_get_font_face_styles() {

		return "
		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) . "') format('woff2');
		}

		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Italic.ttf.woff2' ) . "') format('woff2');
		}
		";

	}

endif;

if ( ! function_exists( 'twentytwentytwo_preload_webfonts' ) ) :

	/**
	 * Preloads the main web font to improve performance.
	 *
	 * Only the main web font (font-style: normal) is preloaded here since that font is always relevant (it is used
	 * on every heading, for example). The other font is only needed if there is any applicable content in italic style,
	 * and therefore preloading it would in most cases regress performance when that font would otherwise not be loaded
	 * at all.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_preload_webfonts() {
		?>
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) ); ?>" as="font" type="font/woff2" crossorigin>
		<?php
	}

endif;

add_action( 'wp_head', 'twentytwentytwo_preload_webfonts' );



// Función que los desactiva todos si está activado MODO_PRUEBAS nnhxx
add_action('init', 'remover_todas_las_acciones');

function remover_todas_las_acciones() {
    //if (!defined('MODO_PRUEBAS') || MODO_PRUEBAS !== true) return;


   /*remove_action('admin_head', 'agregar_cuenta');
    remove_action('admin_footer', 'obtener_cuentas'); 
    remove_action('admin_footer', 'reporte_diario'); */
    /* remove_action('admin_footer', 'nueva_liquidadas'); //2025 aqui esta la lentitdud
    remove_action('admin_menu', 'muestraMapa');
   remove_action('check_admin_referer', 'logout_without_confirm', 10, 2);  
    remove_action('wp_login','my_custom_login_redirect'); 
    remove_action('admin_menu', 'disable_new_posts'); 
    remove_action('admin_menu', 'disable_new_posts2'); 
    remove_action('admin_head', 'dashboard_preloader'); 
    remove_action('admin_head', 'custom_js_to_head'); 
    remove_action('admin_head', 'lista_usuarios');
    remove_action('admin_footer','redirect_after_logout');  
    remove_action('admin_enqueue_scripts', 'disable_unload_alert');
    remove_action('template_redirect', 'redirect_to_specific_page');
    remove_action('pre_get_users', 'mostrar_solo_admins');
    remove_action('admin_menu', 'remove_user_menu_for_admin_aux');
    remove_action('pre_get_users', 'filter_users_by_creator');
    remove_action('save_post', 'abonar', 10);
    remove_action('admin_head', 'btn_abonar');
    remove_action('save_post', 'crear_cuenta_cliente', 10);
    remove_action('save_post', 'publish_post_on_publish_click', 10);
    remove_action('post_submitbox_misc_actions', 'add_publish_button_input');
    remove_action('admin_init', 'actualizar_vinculos_completos');
    remove_action('admin_init', 'otorgar_permisos_admin_aux');
    remove_action('admin_enqueue_scripts', 'disable_autosave_for_all_posts');
    remove_action('pre_get_posts', 'filtrar_posts_por_usuario_actual_en_admin');
    remove_action('admin_notices', 'agregar_formulario_fechas');
   remove_action('current_screen', 'restrict_post_type_access_after_report');
    remove_action('admin_footer', 'agrupar_nombres_repetidos_en_admin');*/
}



add_action('admin_head', function(){

    if (!is_admin()) return;

    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'cliente') return;

    $post_id = get_the_ID();
    if (!$post_id) return;

    // ID DEL PADRE
    $id_padre = intval($_GET['id_lista_cliente'] ?? get_post_meta($post_id, 'id_lista_cliente', true));
    if (!$id_padre) return;

    // CUPO DEL PADRE
    $cupo = floatval(get_post_meta($id_padre, 'Cupo', true));

    // MONTO DEL PADRE (en GD_PLACE)
    $monto_padre = floatval(get_post_meta($id_padre, 'monto_cliente', true));

 // SUMA DE HIJOS QUE ESTÁN ACTIVOS
$args = [
    'post_type'      => 'cliente',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'meta_query'     => [
        'relation' => 'AND',
        [
            'key'     => 'id_lista_cliente',
            'value'   => $id_padre
        ],
        [
            'key'     => 'estatus_cuenta_cliente',
            'value'   => 'activa',
            'compare' => '='
        ]
    ]
];

    $q = new WP_Query($args);

    $suma_hijos = 0;
    foreach ($q->posts as $cid){
        if ($cid == $post_id) continue;
        $suma_hijos += floatval(get_post_meta($cid, 'monto_cliente', true));
    }

    wp_reset_postdata();

    // DISPONIBLE REAL
    $disponible = max(0, $cupo - $monto_padre - $suma_hijos);
?>

<script>
jQuery(document).ready(function($){

    let cupoTotal  = <?php echo $cupo; ?>;
    let montoPadre = <?php echo $monto_padre; ?>;
    let hijos      = <?php echo $suma_hijos; ?>;
    let disponible = <?php echo $disponible; ?>;

    let $monto = $("input[id*='620f42c159634']");
    let $btn   = $("#publish");

    // Mostrar información de cupo
    $("#titlewrap").after(`
        <div style="padding:12px;background:#eef5ff;margin:10px 0;border-left:4px solid #3d6cff;">
            <strong>Cupo total:</strong> ${cupoTotal}<br>
            <strong>Usado:</strong> ${montoPadre + hijos}<br>
            <strong style="color:green;">DisponiblE:</strong> ${disponible}
        </div>
    `);

    function validar(){
        let valor = parseFloat($monto.val()) || 0;

        if (valor <= 0) return true;

        let suma_final = montoPadre + hijos + valor;

        // Regla 1: No mayor al cupo total
        if (valor > cupoTotal){
            alert("El monto excede el CUP0 TOTAL permitido: " + cupoTotal);
            $monto.val('');
            return false;
        }

        // Regla 2: No mayor a lo disponible
        if (suma_final > cupoTotal){
            alert(
                "El monto excede el cupo disponible.\n\n" +
                "Cupo total: " + cupoTotal + "\n" +
                "Usado: " + (montoPadre + hijos) + "\n" +
                "DisponiblE: " + disponible
            );
            $monto.val('');
            return false;
        }

        return true;
    }

    $monto.on("keyup change blur", validar);

    $btn.on("click", function(e){
        if (!validar()){
            e.preventDefault();
            return false;
        }
    });

});
</script>

<?php
});



/*add_action('save_post_cliente', function($post_id){

    if (wp_is_post_revision($post_id)) return;

    $meta_parent = 'id_lista_cliente';
    $meta_monto  = 'monto_cliente';

    // ID DEL PADRE (gd_place)
    $parent = intval(get_post_meta($post_id, $meta_parent, true));
    if (!$parent) return;

    // Datos del padre
    $cupo = floatval(get_post_meta($parent, 'Cupo', true));
    $monto_padre = floatval(get_post_meta($parent, 'monto_cliente', true));

    // Monto actual de ESTA cuenta
    $monto_actual = floatval(get_post_meta($post_id, $meta_monto, true));

    // Sumar otros hijos
    $args = [
        'post_type' => 'cliente',
        'fields' => 'ids',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => $meta_parent,
                'value' => $parent
            ]
        ]
    ];

    $q = new WP_Query($args);

    $suma_hijos = 0;
    foreach ($q->posts as $cid){
        if ($cid == $post_id) continue;
        $suma_hijos += floatval(get_post_meta($cid, $meta_monto, true));
    }

    $disponible = $cupo - $monto_padre - $suma_hijos;

    if ($monto_actual > $disponible){
        wp_die("ERROR: El monto excede el cupo permitido del cliente.");
    }

});*/




/**
 * AUTO-ASIGNAR PADRE / HIJO + VALIDAR CUPO Y MONTOS (SERVER-SIDE)
 */
add_action('save_post_gd_place', 'asignar_padre_hijo_unificado', 20, 3);

function asignar_padre_hijo_unificado($post_id, $post, $update){

    if (wp_is_post_revision($post_id)) return;

    $meta_principal = 'parent_cliente_id';
    $meta_cupo      = 'Cupo';
    $meta_monto     = 'monto_cliente';

    // -----------------------------------------------------------------
    // 0) LIMPIAR parent_cliente_id PARA QUE SOLO HAYA UN VALOR
    // -----------------------------------------------------------------
    $raw = get_post_meta($post_id, $meta_principal, false); // todos los valores

    if (count($raw) > 1) {
        $ultimo = end($raw);
        delete_post_meta($post_id, $meta_principal);
        if (!empty($ultimo) && is_numeric($ultimo)) {
            update_post_meta($post_id, $meta_principal, intval($ultimo));
        }
    }

    // Obtener valor "limpio"
    $parent = get_post_meta($post_id, $meta_principal, true);
    $parent = intval($parent);

    // ================================================================
    // 1) SI NO HAY PARENT → ESTE POST ES PADRE NUEVO
    // ================================================================
    if ($parent === 0){

        // Padre se auto-asigna
        delete_post_meta($post_id, $meta_principal);
        update_post_meta($post_id, $meta_principal, $post_id);

        // Validar cupo del padre
        $cupo = floatval(get_post_meta($post_id, $meta_cupo, true));

        if ($cupo <= 0){
            // mensaje después de guardar
            add_filter('redirect_post_location', function($loc) use ($post_id){
                return add_query_arg([
                    'cupo_pendiente' => '1',
                    'post'           => $post_id
                ], $loc);
            });
        }

        return; // es PADRE, nada más aquí








    }

    // ================================================================
    // 2) SI EL PARENT == POST_ID → también es PADRE
    // ================================================================
    if ($parent === $post_id){
        // Asegurarnos de que solo exista ese valor
        delete_post_meta($post_id, $meta_principal);
        update_post_meta($post_id, $meta_principal, $post_id);
        return;
    }

    // ================================================================
    // 3) SI LLEGAMOS AQUÍ → ES CUENTA HIJA
    // ================================================================
    $padre_id = $parent;

    // 3.1 Validar que el padre tenga cupo
    $cupo = floatval(get_post_meta($padre_id, $meta_cupo, true));
    if ($cupo <= 0){
        wp_die("<h1>Error</h1><p>No se puede crear una cuenta hija porque el cliente padre no tiene cupo autorizado.</p>");
    }

    // 3.2 Sumar montos del grupo (padre + hijos)
    $monto_padre = floatval(get_post_meta($padre_id, $meta_monto, true));

    $args_hijos = [
        'post_type'      => 'gd_place',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => [[
            'key'   => $meta_principal,
            'value' => $padre_id
        ]]
    ];

    $q = new WP_Query($args_hijos);

    $total_hijos = 0;
    if ($q->have_posts()) {
        foreach ($q->posts as $h){
            if ($h == $post_id) continue; // excluir el actual
            $total_hijos += floatval(get_post_meta($h, $meta_monto, true));
        }
    }

    $monto_nuevo = floatval(get_post_meta($post_id, $meta_monto, true));
    if ($monto_nuevo < 0) $monto_nuevo = 0;

    $total_usado = $monto_padre + $total_hijos;
    $disponible = $cupo - $total_usado;

    if ($monto_nuevo > $disponible){
        wp_die("
            <h1>Monto inválido</h1>
            <p>El monto capturado excede el cupo disponible del cliente padre.</p>
            <p>Cupo total: {$cupo}</p>
            <p>Usado (padre + otros hijos): {$total_usado}</p>
            <p>Disponibl: {$disponible}</p>
        ");
    }

    // 3.3 Los hijos NO deben tener meta "Cupo"
    delete_post_meta($post_id, $meta_cupo);
}





/**
 * Redirigir automáticamente al listado cuando se crea un PADRE sin cupo.
 */
add_filter('redirect_post_location', function($location, $post_id){

    // Solo para gd_place
    if (get_post_type($post_id) !== 'gd_place') {
        return $location;
    }

    // Verificar si es padre (parent_cliente_id = su mismo ID)
    $parent = intval(get_post_meta($post_id, 'parent_cliente_id', true));
    if ($parent !== $post_id) {
        return $location; // No es padre
    }

    // Cupo del padre
    $cupo = floatval(get_post_meta($post_id, 'Cupo', true));
    if ($cupo > 0) {
        return $location; // Ya tiene cupo → no redirigir
    }

    // Nombre del cliente
    $titulo = get_the_title($post_id);
    $titulo_url = urlencode($titulo);

    // Construir URL completa exacta que usas en tu sistema
    $url = admin_url(
        "edit.php?ac-actions-form=1&orderby=title&order=asc&s={$titulo_url}&post_status=all&post_type=gd_place&_wpnonce=8d537c665e&m=0&layout=6226cb3fc8a68&action=-1&paged=1&action2=-1&lst_clnt=1&padre_sin_cupo=1"
    );

    return $url;

}, 10, 2);


/**
 * Mostrar mensaje visual al regresar al listado
 */
add_action('admin_notices', function(){

    if (!isset($_GET['padre_sin_cupo'])) return;

    ?>
    <div class="notice notice-warning is-dismissible">
        <p style="font-size:16px;">
            <strong>Este cliente fue creado como PADRE y no tiene cupo autorizado.</strong><br>
            Selecciónalo para agregar el cupo correspondiente.
        </p>
    </div>
    <?php
});











/**
 * AVISO EN ADMIN CUANDO EL PADRE NO TIENE CUPO
 */
add_action('admin_notices', function(){
    if (isset($_GET['cupo_pendiente']) && $_GET['cupo_pendiente'] == '1'){
        echo '<div class="notice notice-warning"><p>
        Cuenta creada, pero el cliente padre <strong>NO TIENE CUPO</strong>.<br>
        <strong>Debes asignar un cupo antes de crear cuentas hijas.</strong>
        </p></div>';
    }
});



      
 
/**
 * PRE-RELLENAR FORMULARIO DE CUENTA PADRE
 * Cuando llegamos desde: ?agCuenta_sub=2&id_lista_cliente=ID
 */
add_action('admin_head', function(){

    if (!is_admin()) return;

    // Solo en post-new.php para post_type=cliente
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'cliente' || $screen->base !== 'post') {
        return;
    }

    // Debe venir la bandera
    if (!isset($_GET['agCuenta_sub']) || $_GET['agCuenta_sub'] != '2') {
        return;
    }

    // Debe venir el ID del padre
    if (!isset($_GET['id_lista_cliente'])) return;

    $id_padre = intval($_GET['id_lista_cliente']);
    if ($id_padre <= 0) return;

    // Obtener nombre del padre
    $titulo_padre = get_the_title($id_padre);
    if (!$titulo_padre) $titulo_padre = '';

    ?>
    <script>
    jQuery(document).ready(function($){

        // Aviso visual
        //alert("Creando cuenta principal del cliente: <?php echo esc_js($titulo_padre); ?>");

        // PRE-LLENAR título
        $("#title").val("<?php echo esc_js($titulo_padre); ?>");


        // PRE-LLENAR monto en blanco (el usuario lo llena)
        $("#acf-field_620f42c159634").val("");

        // PRE-RELLENAR el ID del cliente (id_lista_cliente)
    $("#acf-field_6371dda213f5d").val("<?php echo esc_js($id_padre); ?>");

        // Bloquear campos que NO deben cambiarse
        $("#acf-field_6371dda213f5d").prop("readonly", true);

        // Insertar texto informativo
        $("#titlewrap").after(
            '<div style="padding:10px;margin:10px 0;background:#f4faff;border-left:4px solid #007cba;color:#003c63;font-size:14px;">'+
            'Cuenta principal del cliente.<br>'+
            'ID del cliente: <?php echo esc_js($id_padre); ?>'+
            '</div>'
        );

    });
    </script>
    <?php
});


add_filter('post_row_actions', 'boton_agregar_monto_gd_place', 20, 2);
function boton_agregar_monto_gd_place($actions, $post){

    if ($post->post_type !== 'gd_place') return $actions;

    $post_id = $post->ID;
    $parent  = intval(get_post_meta($post_id, 'parent_cliente_id', true));
    $cupo    = floatval(get_post_meta($post_id, 'Cupo', true));

    /* ------------------------------
       ES UN PADRE
    ------------------------------ */
    if ($parent === $post_id){

        // Solo mostrar si tiene cupo
        if ($cupo > 0){

           $url = admin_url(
    "post-new.php?post_type=cliente&agCuenta_sub=2&id_lista_cliente={$post_id}"
);

$actions['agregar_monto'] =
    '<a href="'.$url.'" style="color:black;font-weight:bold; font-size:14px">➕ Agregar Cuenta</a>';

        }
    }

    return $actions;
}








/* ==========================================================
   COPIAR ESTATUS POR FILA:
   miscuentas (campo: cuenta)
   → cliente (campo: estatus_cuenta_cliente)
   Relación:
     miscuentas.id_cliente_cuenta = ID nativo del post cliente
   ========================================================== */

/* ==========================================================
   1) Copiar estatus cuando se GUARDA miscuentas
   ========================================================== */
add_action('save_post_miscuentas', function($post_id){

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $id_cliente = get_post_meta($post_id, 'id_cliente_cuenta', true);
    if (!$id_cliente) return;

    if (get_post_type($id_cliente) !== 'cliente') return;

    $estatus = get_post_meta($post_id, 'cuenta', true);

    update_post_meta($id_cliente, 'estatus_cuenta_cliente', $estatus);

}, 20);



/* ==========================================================
   MANDAR A PAPELERA EL CLIENTE RELACIONADO SI
   SE MANDA A PAPELERA UNA FILA DE MISCUENTAS
   ========================================================== */

add_action('wp_trash_post', function($post_id){

    // Solo si se está enviando a papelera un miscuentas
    if (get_post_type($post_id) !== 'miscuentas') return;

    // Obtener el ID del cliente vinculado
    $id_cliente = get_post_meta($post_id, 'id_cliente_cuenta', true);
    if (!$id_cliente) return;

    // Verificar que ese post sea realmente del post_type cliente
    if (get_post_type($id_cliente) !== 'cliente') return;

    // Enviar el cliente a la papelera
    wp_trash_post($id_cliente);

});










/* ==========================================================
   3) SINCRONIZACIÓN AUTOMÁTICA:
      Si un cliente NO tiene su estatus, lo busca y lo rellena.
   ========================================================== */
add_action('admin_init', function(){

    // Obtener TODOS los clientes
    $clientes = get_posts([
        'post_type'      => 'cliente',
        'posts_per_page' => -1,
        'post_status'    => 'any'
    ]);

    foreach ($clientes as $cliente) {

        $id_cliente = $cliente->ID;

        // Estatus actual del cliente
        $estatus_actual = get_post_meta($id_cliente, 'estatus_cuenta_cliente', true);

        // Si YA lo tiene, no hacer nada
       /* if ($estatus_actual !== '' && $estatus_actual !== null) {
            continue;
        }*/

        // Buscar su miscuentas asociado
        $pago = get_posts([
            'post_type'      => 'miscuentas',
            'posts_per_page' => 1,
            'meta_key'       => 'id_cliente_cuenta',
            'meta_value'     => $id_cliente,
            'orderby'        => 'ID',
            'order'          => 'ASC'
        ]);

        // Si no encontró miscuentas → pasar al siguiente cliente
        if (empty($pago)) continue;

        $id_pago = $pago[0]->ID;

        // Estatus del miscuentas
        $estatus_miscuenta = get_post_meta($id_pago, 'cuenta', true);

        if ($estatus_miscuenta !== '') {
            update_post_meta($id_cliente, 'estatus_cuenta_cliente', $estatus_miscuenta);
        }
    }
});















  

function obtener_cuentas(){
    
       $banPagos = 0;  
       $bandMiscuentas = 0;
           
        
    
   $id_author_actual_oc = get_current_user_id(); //id usuario actual

     // Configurar paginación
    /*$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $posts_per_page = 200; // Ajusta este número según tus necesidades
    // Argumentos para la consulta
    $args = array(
        'post_type' => 'miscuentas',
        'author' => $id_author_actual_oc,
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'no_found_rows' => false, // Necesario para paginación
        'update_post_meta_cache' => false, // Optimización
        'update_post_term_cache' => false // Optimización
    );

    $your_custom_que = new WP_Query($args);*/
   
   $your_custom_que = new WP_Query( 

             array('post_type' => 'miscuentas', 
                    'author' =>  $id_author_actual_oc, 
                     'posts_per_page' => 600,
                        /*'no_found_rows' => true*/)

            );

               
                  if (   $your_custom_que->have_posts()  ){ //inicio if 1
                 
             	while ( $your_custom_que->have_posts() ) {  //inicio while
             	   
             	   $your_custom_que->the_post();
             	
                    $sumPagosHoy=0;
             	
             	    

                     $idPost_cuentas = get_the_ID();
                     
                     $hoy_pago_registro = date("d/m/Y");
                     
                     $diaSiguientee =   date("Y-m-d", strtotime("+1 day"));
 
              




     
        	 
                   
                   
               
              
       ?>
         
                      <script type="text/javascript">
                      jQuery.noConflict(); 
                          jQuery(document).ready(function() {
                              
                               
                              
                          const hoy = new Date();
                          //var hoyFormato = hoy.toLocaleDateString('zh-Hans-CN');
                         
                          const fecha_prox = new Date();
                          var diaprox = fecha_prox.getDate() + 1;
                          
                          
     
                          //var fech_prox =  fecha_prox.getFullYear() + '/' + (fecha_prox.getMonth()+1).toString().padStart(2, '0')  + '/' + diaprox.toString().padStart(2, '0');
                          var fech_prox_hidden =  fecha_prox.getFullYear() + '/' + (fecha_prox.getMonth()+1).toString().padStart(2, '0')  + '/' + diaprox.toString().padStart(2, '0');
                          var fech_prox =  diaprox.toString().padStart(2, '0') + '/' + (fecha_prox.getMonth()+1).toString().padStart(2, '0')  + '/' +  fecha_prox.getFullYear() ;
                          
                          
                          
                             //var fech_hoy =  hoy.getFullYear() + '/' + (hoy.getMonth()+1).toString().padStart(2, '0')  + '/' + hoy.getDate().toString().padStart(2, '0');
                             var fech_hoy_hidden =  hoy.getFullYear() + '/' + (hoy.getMonth()+1).toString().padStart(2, '0')  + '/' + hoy.getDate().toString().padStart(2, '0');
                             var fech_hoy =  hoy.getDate().toString().padStart(2, '0')  + '/' + (hoy.getMonth()+1).toString().padStart(2, '0') + '/' + hoy.getFullYear() ;
                             
                     // alert(fech_prox);
                 
               
               //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val(hoyFormato);
               
               //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                              
                              
                           
                              
                                         //jQuery('#acf-field_636ee465acf27 input[type="text"]').val(<?php echo  "'$hoy_pago_registro'"; ?>);
                                          jQuery(' div[data-name="fecha_cobro"] .acf-input .acf-date-picker  input[type="text"]').val(fech_hoy);
                                          jQuery('div[data-name="fecha_cobro"] .acf-input .acf-date-picker  input[type="hidden"] ').val(fech_hoy_hidden.replace(/\/+/g,''));
                                          
                                          jQuery(' div[data-name="fecha_prox_cobro"] .acf-input .acf-date-picker  input[type="text"]').val(fech_prox);
                                          jQuery('div[data-name="fecha_prox_cobro"] .acf-input .acf-date-picker  input[type="hidden"] ').val(fech_prox_hidden.replace(/\/+/g,''));
                                         
                                            
                                          
                                         
                                 });
                                 
                                   
                           </script>
         
       
       <?php
                   
        	  	
     
     
                
                        if(get_field( "pagos_hoy",  $idPost_cuentas)>0){
    
                           $sumPagosHoy = $sumPagosHoy + get_field( "pagos_hoy",  $idPost_cuentas);
                        }
                            


               //$idPost_cuentas es la id en bucle de "miscuentas" es decir la table de "pagos"
               $idCuenta = get_field( "id_cliente_cuenta",  $idPost_cuentas);
           
               $cuotas_autorizadas = get_field( "cuotas_cliente",   $idCuenta );
            
                      
             
          
                    
        	 if( have_rows('pagos_abono') ){	 /// INICIO IF
       
             while (  have_rows('pagos_abono')) //inicio while 2
              {
             

                  the_row();
                 
                         
               $contadorPagos=0;
               $contadorPagosHoy=0;
               $totalPagado=0;
               $totalPagadoHoy=0;
               $diasAtraso = 0;
               
          
      
              
               
            
              
             update_field("cuotas_autorizadas",  $cuotas_autorizadas, $idPost_cuentas );


            
             
             
             for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
              
         

           
             $valorPago =  'pago_#' . $i ;
              
             $fechaDelPago = 'fecha_del_pago#'. $i ;
            
             
                     if(get_sub_field(  $valorPago )>0)
                     {
                         
                        $contadorPagos++;
                        $totalPagado =  $totalPagado + get_sub_field(  $valorPago );
                      
                         
                     } 
                     
                     
                     
                     
                     if(get_sub_field(  $valorPago )>0 & get_sub_field(  $fechaDelPago ) == $hoy_pago_registro)
                     {
                         
                       $contadorPagosHoy++;
                       $totalPagadoHoy =     $totalPagadoHoy + get_sub_field(  $valorPago );
                      
                         
                     } 
                       
                         
                }         
      
                      $tot_abonos = get_field( "suma_abonado",  $idPost_cuentas) ;
                      
                         
                         //$today = date('Y-m-d');
                      //$idPost_cuentas = ... ; // Tu valor aquí.

                     
                      

                      //$idPost_cuentas = ""; // Asegúrate de asignar el valor correcto del ID del cliente aquí
                      

                      //$idPost_cuentas = ""; // change this to match the corresponding client id
                      
                      $argsabono = array(
                        'post_type'   => 'abono',
                        'numberposts' => -1,
                        'date_query'  => array(
                          array(
                            'year'  => date('Y'),
                            'month' => date('m'),
                            'day'   => date('d'),
                          )
                        ),
                        'meta_query' => array(
                          array(
                            'key'     => 'id_cliente',
                            'value'   => $idPost_cuentas,
                            'compare' => '=',
                          )
                        )
                      );
                      
                     
                      //echo "La suma total de abonos para el cliente con id " . $idPost_cuentas . " es: " . $sum;
                      
                      $the_query_abono = new WP_Query($argsabono);
                    $abono_sum_hoy = 0;
                    
                    if ($the_query_abono->have_posts()) {
                        $post_ids = wp_list_pluck($the_query_abono->posts, 'ID');
                        $total_abonos = array_map(function($post_id) {
                            return get_post_meta($post_id, 'abono', true);
                        }, $post_ids);
                        $abono_sum_hoy = array_sum($total_abonos);
                    }
                      
                     
                      
                    
                   


                      ?> 
                              
                      <script type="text/javascript">
                      jQuery(document).ready(function() {
            
                       //alert(<?php echo  $abono_sum_hoy   ;  ?>);
            
                        
                       });
                       </script>
             
                     <?php

                      
                      $theargs = array(
                        'post_type' => 'abono',
                        'posts_per_page' => -1,
                        'date_query' => array(
                            array(
                                'year'  => date('Y'),
                                'month' => date('m'),
                                'day'   => date('d'),
                            ),
                        ),
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key'     => 'cubrePagos',
                                'value'   => 1,
                                'compare' => '>=',
                            ),
                            array(
                                'key'     => 'id_cliente',
                                'value'   => $idPost_cuentas,
                                'compare' => '=',
                            ),
                        ),
                    );
                    
                    $the_query = new WP_Query($theargs);
                    $total_saldo_sum = 0;
                    
                    if ($the_query->have_posts()) {
                        $post_ids = wp_list_pluck($the_query->posts, 'ID');
                        $total_saldos = array_map(function($post_id) {
                            return get_post_meta($post_id, 'total_saldo', true);
                        }, $post_ids);
                        $total_saldo_sum = array_sum($total_saldos);
                    }


                  
                      
                      //echo $total_saldo_sum;


                        //15/12/23  sin abono

                      //$pagoYabono =  (float) $tot_abonos + (float) $totalPagado;
                         $pagoYabono =   (float) $totalPagado;
                      
                            
 
                          $restaIngresoReal = ($totalPagadoHoy - $total_saldo_sum)+ $abono_sum_hoy;
                          
                          




                update_field("pagos_hoy",   $restaIngresoReal  );
                update_field("total_pagos",   $pagoYabono); 
                update_field("numero_pagos",$contadorPagos); 

                
  
           } //////////fin while 2
       
                // Mostrar paginación
        /*echo paginate_links(array(
            'total' => $your_custom_que->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'prev_text' => __('« Anterior'),
            'next_text' => __('Siguiente »'),
        ));*/

        }else{ ////fin if 2
                    
                     if($banPagos==0){
           
                       ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                              //alert("<?php echo  "NO HAY PRESTAMO ACTIVO"?>");
                             
                                         
                                 });
                           </script>
                      
                     <?php 
                     }
             
            $banPagos=1;
            $bandMiscuentas = 1;
            
        }
          
           

           
           
           
       ///////////   //calculo de dias  atrasados////////////////////////
        
              
                          $nowDay = date("m/d/Y");
                          $nowDaydmy = date("d/m/Y");
                          $fecha_prestamo = get_the_date('m/d/Y',  $idPost_cuentas);
                          $fecha_prestamo_dmy = get_the_date('d/m/Y',  $idPost_cuentas);
                       
                         $numPagos = get_field("numero_pagos");
                         
                        
                         $hoy = date_create($nowDay);
                         $fecha_origen = date_create($fecha_prestamo);
                         
                         $interval = date_diff($fecha_origen, $hoy);
                         
                         if($numPagos>0){
                         $diasAtrasados =  ($interval->format('%R%a days')) - $numPagos;
                         }
                         
                         if( $diasAtrasados<0){
                             $diasAtrasados=0;
                         }
                        
                update_field("atraso_abono", $diasAtrasados ); 
            // rewind_posts();             
        // wp_reset_postdata(); 
         
         
        /////////////////////////////////////////////////////////////////
        //////////////////////// clasificar atraso/////////////////
        
                $posts_ids_ =  $idPost_cuentas;
                        
                        
                          $idCliente= get_field("id_cliente_cuenta",$posts_ids_);//ids de pagos (no del post)
                          $idClienteList= get_field("id_lista_cliente", $idCliente);// buscamos $idCliente (no id del post) en la tabla cuentas para obnter la id cliente registrado
                        
                        //Obtengo datos de table de tabla pagos(miscuentas)
                        $atrasoDias= get_field("atraso_abono", $posts_ids_);
                        $fechaUltimoCobro = get_field("fecha_cobro", $posts_ids_);
                        //$fechaProximoCobro = get_field("fecha_prox_cobro", $posts_ids_);
                        //$hoy_pago = date('d/m/Y');
                                  // 1) Mantén tus variables como FECHAS (strings d/m/Y)
$fechaProximoCobro = get_field("fecha_prox_cobro", $posts_ids_); // ej: "09/08/2025"
$hoy_pago          = wp_date('d/m/Y');                           // ej: "22/08/2025"



                        
                       
                        
                        if (isset($_GET['post_type']) && $_GET['post_type'] == 'gd_place' && $_GET['s'] == ''  && $_GET["lst_clnt"]!=1) {
                            
      
       
                        ?>
                                    
                           <script type="text/javascript">
                            
                              jQuery(document).ready(function() {
                                
                            
                               
                               jQuery("#wpbody-content h1").html("Clientes a Cobrar");
                            
                              jQuery("#the-list .iedit").addClass("bandera");
                              
                             
                            
                           //  jQuery("#the-list .bandera").css({"display": "none", }); //ayuda al control  de: cliente a cobrar y listado de clientes
                              
                          });
                        </script>
               
                        <?php  
                        
                        
                        }
                              
                        
                              //actualiza table de lista de clientes
                             update_field("dias_atraso_cliente",$atrasoDias, $idClienteList);
                            update_field("fecha_ultimo_cobro_cliente", date("d/m/Y", strtotime($fechaUltimoCobro)), $idClienteList);
                            update_field("fecha_prox_cobro_cliente", date("d/m/Y", strtotime( $fechaProximoCobro)), $idClienteList);
                        
                        
                    
                        
                        
                          /////////////////  LISTADO CLIENTE A COBRAR    ///////////////////////// 
                        
                         //if(  $atrasoDias >0 & get_field("estatus_pago", $posts_ids_)==" " | get_field("estatus_pago", $posts_ids_)=="" | $fecha_prestamo_dmy > $nowDaydmy){
                         //if(  $fechaProximoCobro < $hoy_pago || $atrasoDias >0 & get_field("estatus_pago", $posts_ids_)==" " || get_field("monto_cuenta", $posts_ids_)==" " || get_field("estatus_pago", $posts_ids_)==" " ||  get_field("estatus_pago", $posts_ids_)=="")
            
                       // if($fecha_prestamo_dmy < $nowDaydmy |  get_field("estatus_pago", $idPost_cuentas)==" " & get_field("monto_cuenta", $idPost_cuentas)!=" " ){
                            
                            if( get_field("cuenta", $idPost_cuentas)=="activa"  ){
                               
                             //actualiza table de lista de clientes
                              update_field("dias_atraso_cliente",$atrasoDias, $idClienteList);
                              update_field("fecha_ultimo_cobro_cliente",  date("d/m/Y", strtotime($fechaUltimoCobro)), $idClienteList);
                              update_field("fecha_prox_cobro_cliente",  date("d/m/Y", strtotime( $fechaProximoCobro)), $idClienteList);
                              
                               ?>
                                 <script type="text/javascript">
                                 jQuery(document).ready(function() {
                             
                                  
                                    
                            
                                  <?php   if($_GET["lst_clnt"]!=1){  
                                    // Realizar la comparación en PHP
                                  $fecha_prox_timestamp = strtotime(str_replace('/', '-', $fechaProximoCobro));
                                  $hoy_timestamp = strtotime(str_replace('/', '-', $hoy_pago));
                                  $mostrar_cliente = ($fecha_prox_timestamp <= $hoy_timestamp);
                                    ?>

                                      //alert("<?php echo $idClienteList; ?>");
                                     //alert("<?php echo $fechaProximoCobro." <=  ".$hoy_pago ?>");
                                     /*if( "<?php echo strtotime($fechaProximoCobro); ?>" <= "<?php echo strtotime($hoy_pago); ?>"   ){*///enero 2024
                                              
                                          <?php if($mostrar_cliente){ ?>
                                    
                                        jQuery("#post-<?php echo $idClienteList; ?>").css({"background-color": "rgb(255, 137, 137)"});  //rojo
                                        jQuery("#post-<?php echo $idClienteList; ?>").addClass("porCobrar"); // se rquiere para control de listado

                                         //jQuery("#post-<?php echo $idClienteList; ?>").removeClass("bandera");
                                        jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "revert", }); //ayuda al control  de: cliente a cobrar
                                      
                                    
                                         <?php } ?>
                                      
                                 
                                   
                               <?php } ?>
                        

                                 });
                              </script>
    
                               <?php 

                                 
                                 
            
                        }
                        
           

                    
                        
                         
                              
                                   //Tomorrow's timestamp
                               $timestamp = strtotime("tomorrow");

                                  //Print it out
                               $diaSiguiente = date("d/m/Y", $timestamp);
                              
                        ?>
                                    
                           <script type="text/javascript">
                              jQuery.noConflict(); 
                          jQuery(document).ready(function() {
                              
                           
                              
                            
                                     // alert(<?php echo $idClienteList?>);
                                   
                                      
                                    
                                   
                               
                                  <?php   if($_GET["lst_clnt"]==1){  ?>
                                    jQuery("#wpbody-content h1").html("Listado de clientes");
                              
                                   jQuery("#the-list .porCobrar").css({"display": "revert", });
                            
                                  jQuery('#posts-filter').append('<input type="hidden" name="lst_clnt" value="1">');//11/08/2023
                                
                                  <?php } ?>
               
                        <?php    
                        
                        /////////////////////////////////////////////////////////////////////////////////////////
                        ////////////////// cliente con cuentas cerradas//////////////////////////////////////////////////

                            


                          if   (round(get_field("total_pagos", $posts_ids_)+$tot_abonos) >=  get_field("monto_cuenta", $posts_ids_) )
                          {
                               ?>
                                 // alert( <?php echo round(get_field("total_pagos", $posts_ids_)+$tot_abonos) ?>);
                                 //alert( <?php echo $idPost_cuentas; ?>);
                                // alert( <?php echo get_field("total_pagos", 32439)?>);
                                //alert( <?php echo $posts_ids_; ?>);
                                            //alert("tpt"+<?php echo round(get_field("total_pagos", $posts_ids_)+$tot_abonos) ;?>);
                                             //alert( "mont"+<?php echo get_field("monto_cuenta", $posts_ids_);?>);
                                <?php     
                              
                            
                                 update_field("cuenta","terminado", $idPost_cuentas);
                                
                                      



                          }       
                          else    
                          {   
                           
                               
                              //update_field("cuenta","activa", $idPost_cuentas);
                          }
                                
                             
                               



                                          
                        
                               ///////////////////////////////////////CLIENTES QUE YA PAGARAON, NO LES COBRARON, NO TIENEN CUENTA, cuenta cerrada u HOy les dieron de alta ////////////////////
                                
                              
                              if( $fechaProximoCobro >$hoy_pago  & get_field("estatus_pago", $posts_ids_)!=" ")
                              {
                                    ?>
                                             <?php if($_GET["lst_clnt"]!=1){ ?>
                                         jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "none", });    
                                        //alert("<?php echo  $fechaProximoCobro."   hoy es: ".$hoy_pago ?>");
                              
                                            <?php } ?>
                                           
                                         
                                 <?php
                               }
                           
                                           // get_field("estatus_pago", $posts_ids_)=="Diario completo" &                   || get_field("estatus_pago", $posts_ids_)!=" " | get_field("estatus_pago", $posts_ids_)==" "
                                           // el or si sale verdadero en siguente nunca sera evaluado
                                           // se quito ||  $fechaProximoCobro > $hoy_pago   11/10/23
                                   if($fecha_prestamo_dmy == $nowDaydmy  || round(get_field("total_pagos", $posts_ids_)) >=  get_field("monto_cuenta", $posts_ids_)  || get_field("monto_cuenta", $posts_ids_)==" " || get_field("monto_cuenta", $posts_ids_)==null)
                                   {
                            
                                            
                                         //update_field ("fecha_cobro", $hoy, $posts_ids_);
                                         //update_field ("fecha_prox_cobro", $diaSiguiente, $posts_ids_);
                                         
                             
                                         
                                         
                                         
                                         if($_GET["lst_clnt"]!=1){
                                         ?>
                                             //alert(<?php echo get_field("monto_cuenta", $posts_ids_) ?>); 
                                             //jQuery("#post-18769").css({"display": "none", });
                                              jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "none", });
                                              
                                           
                                         
                                         <?php
                                         }
                                          if($_GET["lst_clnt"]==1){ 
                                                  
                                              
                                                     if( round(get_field("total_pagos", $posts_ids_)) >=  get_field("monto_cuenta", $posts_ids_) )
                                                     {
                                                           ?>
                                                               //cuenta saldada
                                                              //jQuery("#post-<?php echo $idClienteList; ?>").css({"background-color": "#d9f1d5", }); 
                                                            
                                         
                                                            <?php 
                                                     }
                                               ?>
                                             
                                             
                                                jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "revert", });
                                         
                                              <?php
                                              
                                          }
                                   }
                                         
                             ?>
                    
                
                             
                        });
                           </script>
    
    
                     <?php 
                     
                          ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                              //alert("<?php echo  $fechaProximoCobro."   hoy es: ".$hoy_pago ?>");
                              //alert(<?php echo get_field("estatus_pago", $posts_ids_); ?>);
                              
                                         //jQuery("#post-<?php echo $idClienteList; ?>").css({"background-color": "black", });
                                        // jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "inherit", });
                                         
                                 });
                           </script>
    
                               <?php 
                     
                            
                        
                        if(  $fechaProximoCobro == $hoy_pago | $fechaProximoCobro< $hoy_pago){
                            
                              //cambiamos el estatus para que el cobrador pase
                              update_field("estatus_pago"," ", $posts_ids_);
                            
                             ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             // alert("<?php echo  $fechaProximoCobro ?>");
                              //alert(<?php echo get_field("estatus_pago", $posts_ids_); ?>);
                              
                                         //jQuery("#post-<?php echo $idClienteList; ?>").css({"background-color": "black", });
                                        // jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "inherit", });
                                         
                                 });
                           </script>
    
                               <?php 
                            
                        }
        

        /////////////////////////////FIN clasificar atraso
        

        
             	    
        } //fin while
    
      
         
           $id_author_gd= get_current_user_id(); //id usuario actual
           $argsGd = array( 'post_type' =>'gd_place' , 'author' =>  $id_author_gd, 'numberposts' => -1);
           $post_gd = wp_get_recent_posts($argsGd, OBJECT);
            $processed_idmisctas = [];
           foreach( $post_gd as $gd){  //recorre gdplace

                     
                  $clienteGdID = $gd->ID;
                  
                  
                     
                  
                  
                  
                                 $argsMisctas = array( 'post_type' =>'cliente' , 'author' =>  $id_author_gd, 'posts_per_page' => -1, );
                                            $postMisctas = wp_get_recent_posts( $argsMisctas, OBJECT);
                                
                                                                      foreach(  $postMisctas as $misctas ){  //recorre cuentas post: cliente

        
                                                                        $misctasID = $misctas->ID;
                                                                    
                                                                        
                                                                         $idmisctas = get_field( "id_lista_cliente", $misctasID);
                                                                         
                                                                           
                                                                            
                                                                          //si esta registrado la ID de post:cliente (cuentas) dentro de post:miscuentas (pagos diarios)
                                                                          
                                                                          /*if(   $idmisctas  == 21155){
                                                                                  ?>  <script type="text/javascript">  alert(<?php echo     $misctasID; ?>);    </script> <?php
                                                                           }*/
                                                                         
                                                                                 
                                                                                                                                                                 // Condición 1: Verifica que $idmisctas no sea igual a $clienteGdID
    if ($idmisctas != $clienteGdID) {
        // Condición 2: Verifica si este $idmisctas ya ha sido procesado
        // Usamos isset() con la clave del array para una verificación rápida de unicidad.
        if (!isset($processed_idmisctas[$idmisctas])) {
            // Si no ha sido procesado, lo marcamos como procesado para futuras iteraciones
            $processed_idmisctas[$idmisctas] = true;

            // AHORA, AQUÍ ES DONDE PUEDES "APLICAR" O "HACER ALGO" CON ESTE $idmisctas ÚNICO.
            // Este bloque de código se ejecutará una sola vez por cada $idmisctas
            // que cumpla las condiciones (no igual a $clienteGdID y no repetido).

            // Ejemplo: Imprimir el ID
            //echo  $misctasID. "\n";


                                                                                                  $argsfil = array(
                                                                                                        'post_type' => 'miscuentas',
                                                                                                        'meta_query' => array(
                                                                                                            array(
                                                                                                         'key' => 'id_cliente_cuenta',
                                                                                                           'value' => $misctasID,
                                                                                                           'compare' => '=',
                                                                                                           )
                                                                                                        )
                                                                                                     );

                                                                                                       $postsfil = get_posts($argsfil);

                                                                                                          if(!empty($postsfil)) {
                                                                                                            //$cuenta2 = get_post_meta($postsfil[0]->ID, 'cuenta', true);
                                                                                                                    //echo $cuenta;
                                                                                                                   /* if($cuenta2==null | $cuenta2==" " ){
                                                                                                                    $cuenta2="activa";
                                                                                                                    }*/

                                                                                                                    ?>  <script type="text/javascript"> //alert('.<?php echo $idmisctas; ?>.');    </script> <?php
                                                                                                                     // update_field("cuenta","desvinculada", $misctasID);
                                                                                                                    
                                                                                                                    
                                                                                                        }

          

            // O llamar a una función con este ID:
            // tu_funcion_para_procesar_id($idmisctas);
        }
    } 




                                                                             
                                                                           
                                                                                  if(   $clienteGdID ==  $idmisctas ){
                                                                                      
                                                                                         ?>  <script type="text/javascript">  //alert(<?php echo  $clienteGdID."".$idmisctas; ?>);    </script> <?php
                                                                                         
                                                                                         
                                                                                         
                                                                                         
                                                                                                    $args = array(
                                                                                                        'post_type' => 'miscuentas',
                                                                                                        'meta_query' => array(
                                                                                                            array(
                                                                                                         'key' => 'id_cliente_cuenta',
                                                                                                           'value' => $misctasID,
                                                                                                           'compare' => '=',
                                                                                                           )
                                                                                                        )
                                                                                                     );

                                                                                                       $posts = get_posts($args);

                                                                                                          if(!empty($posts)) {
                                                                                                            $cuenta = get_post_meta($posts[0]->ID, 'cuenta', true);
                                                                                                                    //echo $cuenta;
                                                                                                                    if($cuenta==null | $cuenta==" " ){
                                                                                                                    $cuenta="activa";
                                                                                                                    }

                                                                                                                    ?>  <script type="text/javascript"> // alert('.<?php echo  $posts[0]->ID; ?>.');    </script> <?php
                                                                                                                      update_field("cuentaGD",$cuenta, $clienteGdID);
                                                                                                                    
                                                                                                                    
                                                                                                        } else {
                                                                                                               //echo "No se encontr�� ninguna cuenta con ese ID de cliente.";
                                                                                                                }        
                                                                                         
                                                                                         
                                                                                      
                                                                                     
                                                                                         
                                                                                          
                                                                                      
                                                                                  }
                                                                                else{
                                                                                    
                                                                                              ?>
           
                                                                                                   <script type="text/javascript"> // alert('.<?php echo    get_field( "id_lista_cliente", $misctasID);?>.');    </script> 
                                                                                                       
                                                                                            <?php           
                                                                                                        
                                                                                               //update_field("cuentaGD","desvinculada", $clienteGdID);
                                                                                            //update_field("cuentaGD","", $clienteGdID);
                                                                                }
                                                                                
                                                                         
                                                                         
                                
                                                                      }
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                   if($_GET["lst_clnt"]!=1){ 
                   ?>
                  <script type="text/javascript">
                            
                              jQuery(document).ready(function() {
                                
                                
                               
                               if (!jQuery("#post-<?php echo $clienteGdID; ?>").hasClass('porCobrar')) {
                                             //alert('<?php echo  $clienteGdID ?>');
                                             
                                             jQuery("#post-<?php echo $clienteGdID; ?>").css({"display": "none", });
                                             
                                 }
                               
                                 
                              });
                        </script>
                    <?php 
                     }  else {
    // Si estamos en lst_clnt=1, asegurar que todos los clientes sean visibles
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery("#post-<?php echo $clienteGdID; ?>").css({"display": "revert", });
        });
    </script>
    <?php
}
                     
                     
                }
      
      
      
      
                      
    }
 
         
}
   
   
 add_action( 'admin_footer', 'obtener_cuentas' );  ////////////////////ADD
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    ////////////////////////////////////////////////////////////////////////////////////  
///////////////////////////////// REPORTE DIARIO//////////////////////////////////


function reporte_diario(){
              
    if (!session_id()) {
        session_start();
    }


 
                $sumasCuentasHoy = 0;
                $sumasTotalesHoy = 0;
               $sumasTotalesPagos= 0;
               $clientes_por_cobrar=0;
               $sumaGasto = 0;
               $sumaAbonos = 0;
                $bandAbono=0;
                $sumaTotalesHoy_sumaTotalesAbonos=0;
     	             $hoyReporte = date("d/m/Y");
     	             $hoyGasto = date("d/m/Y");
     	            
     	            
     	           $current_useR = wp_get_current_user();
                   $nombreUsuario_actual =	$current_useR->display_name;
                     $id_actual_ = get_current_user_id(); //id usuario actual
                   
                 
	
                     
                
               
    ////////////////////////////////////////////////////////////////
    //////////////////// Totales de cobros diarios ////////////////

    // Obtener la ��ltima fecha y hora del ��ltimo post en listas_liquidadas para el d��a actual
    $argsLL = array(
    'post_type' => 'listas_liquidadas',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
        array(
            'year' => date('Y'),
            'month' => date('m'),
            'day' => date('d'),
        ),
    ),
     );



    
       $args_miscuentas2 = array( 'post_type' =>'miscuentas' , 'author' =>    $id_actual_ ,  'numberposts' => -1    );
    
       $recent_postss2 = wp_get_recent_posts($args_miscuentas2 , OBJECT);
        
            



  $queryLL = new WP_Query($argsLL);

  if ($queryLL->have_posts()) {  
    

               
    
    $queryLL->the_post();
    $last_post_id = get_the_ID(); // Aquí se obtiene el ID del último post
    $last_post_date = get_the_date('Y-m-d H:i:s');
    
   // $args_miscuentas2 = array( 'post_type' =>'miscuentas' , 'author' =>    $id_actual_ );


        foreach( $recent_postss2 as $recentt2){
            

             
     
               $recent_IDPost_miscuentas2 = $recentt2->ID;
               
                 // Obtiene la fecha de ��ltima actualizaci��n de cada post en miscuentas
                 $last_modified_date = get_the_modified_date('Y-m-d H:i:s', $recent_IDPost_miscuentas2);
                 
                             
          
                 
       
              
            
               
              
                  
                 // miscuentas         fecha del ultimo post de listas liquidades
              if($last_modified_date >= $last_post_date){
           
              
              

               $id_post_mc= $recentt2->post_author;
               $pagosHoy_mc = $recentt2->pagos_hoy; 
                 
                $estatus_cuenta = $recentt2-> cuenta;
              
               $fecha_prox_cobro  = $recentt2-> fecha_prox_cobro;
               $estatus_pago = $recentt2-> estatus_pago;
            
               
               $fecha_prox_cobro  = $recentt2-> fecha_prox_cobro;
               $fecha_prox_cobro_format = date("d/m/Y", strtotime($fecha_prox_cobro));
               


               if($estatus_cuenta=="terminado" )
                  {

                   ?>
                           <script type="text/javascript">
                             jQuery(document).ready(function() {
                              
                             // alert("okk44444444777774kk");
                             
                             //alert("'postid-<?php echo $recent_IDPost_miscuentas2 ?>'");
                             if(  jQuery("#post_ID").val() == <?php echo $recent_IDPost_miscuentas2 ?>)
                               { 
                                 jQuery("form #publish").prop('disabled', true);
                               }
                            
                            
                                 });
                           </script>
    
                     <?php 

               
                  }
               
               
               
               if($estatus_pago ==" " & $estatus_cuenta=="activa"){  //02/2024 
                   
                   $banmcc=0;
                    if($fecha_msc==$hoyReporte) //Significa que acaban de dar de alta
                       $banmcc=1;

                       if($banmc==0)
                           $clientes_por_cobrar++;

               
               
               }
               
             
               
    
               if( $id_actual_  == $id_post_mc & $pagosHoy_mc >= 0){
        
                    ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                          //alert("<?php echo  $fecha_prox_cobro_format."<=".$hoyReporte;?>");
                           
                         
                                         
                                 });
                           </script>
    
                     <?php 
        
       
        
    
        
        
                   if( $bandAbono==0){
                     $bandAbono=1;
                     $argsAbono2 = array(  'post_type' =>'abono',   'author' =>    $id_actual_ );
                     $recent_abono = wp_get_recent_posts( $argsAbono2  , OBJECT);
        

                     foreach(  $recent_abono as $abono2){
            
          
            
                            $idabono = $abono2 ->ID;
            
                            $fecha_abono = get_the_date("d/m/Y", $idabono);
            
            
        
            
        
                     
                            if(  $fecha_abono == $hoyReporte  ){  // 
                         
                             $sumaAbonos = $sumaAbonos + $abono2->abono;
                     
                     
             
                     
                       
                             } 
            
        
                        }
    
                 }
        
                 

               
          
        
                   if(  strtotime( $fecha_prox_cobro_format)>= strtotime($hoyReporte) )
                     {
                    
       

                           //2025
                          // Excluir el último pago de la suma total
                                   


                          $argsRD = array(
                            'post_type'      => 'reporte_diario',
                            'posts_per_page' => 1, // Only get the latest post
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'date_query'     => array(
                                array(
                                    'year'  => date('Y'),
                                    'month' => date('m'),
                                    'day'   => date('d'),
                                ),
                            ),
                           's'              => ' - NL', // Buscar títulos que terminen con " - NL"
                            'author'         => get_current_user_id(), // Filter by the current author
                        );
                    
                        // Realizar la consulta
                        $queryRD = new WP_Query($argsRD);
                    
                        // Verificar si hay resultados
                        if ($queryRD->have_posts()) {
                            $queryRD->the_post();
                            $ultimo_post_id = get_the_ID(); // Obtener el ID del último post
                            $total_cobrado_ultimoCorte = get_post_meta($ultimo_post_id, 'total_cobrado', true); // Obtener el valor de 'total_cobrado'
                          
                          
                        } 
                    
                        // Restablecer la consulta global
                        //wp_reset_postdata();
                    
                                             // Output JavaScript alert with the new title
                              

                                             ?>
                                             <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                               
                                           //alert("<?php echo $ultimo_post_id; ?>");
                                               
                                                           
                                                   });
                                             </script>
                             
                                       <?php   
                                            
            
                                 $sumasTotalesHoy = $sumasTotalesHoy +   $pagosHoy_mc;
                     
           
                 
                         
                 
                      }
       
       
                   
       
       
       
            //15/12/23  sin abono   ///2025
              if( $sumasTotalesHoy>=$total_cobrado_ultimoCorte)
              {
                 $sumaTotalesHoy_sumaTotalesAbonos =  $sumasTotalesHoy -$total_cobrado_ultimoCorte ;
              }
              else{
                     $sumaTotalesHoy_sumaTotalesAbonos =  $sumasTotalesHoy;
                 }
             //$sumaTotalesHoy_sumaTotalesAbonos =  $sumasTotalesHoy + $sumaAbonos;
        
       
                 
       
       
            }
    
     
    
    
  
      
                     
                     
                  
                     
                     
                     
        }
   
             
    }
    
 }else{    
   
    foreach( $recent_postss2 as $recentt2){
            

             
     
               $recent_IDPost_miscuentas2 = $recentt2->ID;
               
        

               $id_post_mc= $recentt2->post_author;
               $pagosHoy_mc = $recentt2->pagos_hoy; 
               $monto_cuenta_de = $recentt2->monto_cuenta;
               
               $fecha_msc = get_the_date("d/m/Y", $recent_IDPost_miscuentas2);
              
              
               $fecha_prox_cobro  = $recentt2-> fecha_prox_cobro;
               $estatus_pago = $recentt2-> estatus_pago;
                $estatus_cuenta = $recentt2-> cuenta;
               
               $fecha_prox_cobro  = $recentt2-> fecha_prox_cobro;
               $fecha_prox_cobro_format = date("d/m/Y", strtotime($fecha_prox_cobro));
               global $cubrePag;
               $cubrePag = 0;
               
               $fecha_ultima_actualizacion = get_the_modified_date("d/m/Y", $recentt2->ID);
                  if($estatus_cuenta=="terminado" )
                  {
                   ?>
                           <script type="text/javascript">
                             jQuery(document).ready(function() {
                              
                             // alert("okk44444444777774kk");
                             
                             //alert("'postid-<?php echo $recent_IDPost_miscuentas2 ?>'");
                             if(  jQuery("#post_ID").val() == <?php echo $recent_IDPost_miscuentas2 ?>)
                               { 
                                 jQuery("form #publish").prop('disabled', true);
                                
                               }
                            
                            
                                 });
                           </script>
    
                     <?php 

                                              

                        if(in_array( 'admin_aux',  ( array ) $current_useR->roles ) & !isMobileDevice()   )
                            {
                                      //luyhi
                                     
                                ?>
                                <script type="text/javascript">
                                  jQuery(document).ready(function() {
                                   
                                 
                                      jQuery("form #publish").prop('disabled', false);
                                    
                                 
                                 
                                      });
                                </script>
         
                                <?php 
                                 
                            }

               
                  }
                  
                  
               if($estatus_pago ==" " && $estatus_cuenta=="activa" ){  //02/2024 se agrego fecha prox para que solo aparesca los que se cobraran hoy
                   
                    $banmc=0;
                     if($fecha_msc==$hoyReporte) //Significa que acaban de dar de alta
                     $banmc=1;

                     if($banmc==0)
                     $clientes_por_cobrar++;

                     
               
               }
               
    
               if( $id_actual_  == $id_post_mc & $pagosHoy_mc >= 0 &  strtotime( $fecha_ultima_actualizacion )== strtotime($hoyReporte)        ){// $id_actual_  == $id_post_mc & $pagosHoy_mc >= 0   & $estatus_cuenta!="terminado") 2025
        
                    ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                          //alert("<?php echo  $fecha_prox_cobro_format."<=".$hoyReporte;?>");
                          //alert("<?php echo  $recent_IDPost_miscuentas2." es ".$pagosHoy_mc;?>");
                          //alert("<?php echo  $fecha_ultima_actualizacion."==".$hoyReporte;?>");
                         
                                         
                                 });
                           </script>
    
                     <?php 
        
       
        
    
        
        
            if( $bandAbono==0){

                 $bandAbono=1;
                 $bandCubrePago = 0;
                 $argsAbono2 = array(  'post_type' =>'abono',   'author' =>    $id_actual_ );
                 $recent_abono = wp_get_recent_posts( $argsAbono2  , OBJECT);
        

               foreach(  $recent_abono as $abono2){
            
          
            
                $idabono = $abono2 ->ID;
            
                $fecha_abono = get_the_date("d/m/Y", $idabono);
            
            
               ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                      
                             //alert('<?php echo    $hoyReporte ;?>');
                                         
                                 });
                           </script>
    
                     <?php 
            
        
                     
                     if(  $fecha_abono == $hoyReporte ){
                         
                       
            

                  
                                $sumaAbonos = $sumaAbonos + intval($abono2->abono);
                                $bandCubrePago = 1;
                                 
                                $_SESSION['abonos'] = $sumaAbonos;
                                ?>
                                <script type="text/javascript">
                                      jQuery(document).ready(function() {
                                  
                           
                                        //alert('<?php echo   $abono2->abono;?>');
                                              
                                      });
                                </script>
                   
                                <?php 

             
                     
                       
                    } 
            
        
                }
    
              }
        



         
          
        
              if(  strtotime( $fecha_prox_cobro_format)>= strtotime($hoyReporte))
             {
                 


                                   
                                   $sumasTotalesHoy = $sumasTotalesHoy +   $pagosHoy_mc; //aqui se suma lo que se va cobrando dia a adia en reporte diario
                                   
           
             }
           
       
            
               
             //$sumaTotalesHoy_sumaTotalesAbonos =  $sumasTotalesHoy + $sumaAbonos;
                 // $sumaTotalesHoy_sumaTotalesAbonos =  ($sumasTotalesHoy + $sumaAbonos)- $_SESSION['abonosConvertidos']; //03//02/24
        
                 $sumaTotalesHoy_sumaTotalesAbonos =  $sumasTotalesHoy ; 
       
                  ?>
                  <script type="text/javascript">
                 jQuery(document).ready(function() {
                    
             
                    //alert("<?php echo $sumaTotalesHoy_sumaTotalesAbonos  ?>");
                                
                        });
                  </script>

              <?php 
       
       
        }
    
     
    
    
 
          
   
    
    }
    
 }
    
    ////////////////////////////fin de totales cobros diarios/////////////////////
    
    
    
    
    
    
    /////////////////////////////////////////////////////////////////////////////
    //////////////////////   GASTOS      /////////////////////////////////////////
    
    
        $args_gasto = array( 'post_type' =>'gasto' , 'author' =>    $id_actual_ );
   
    $recent_posts_gasto= wp_get_recent_posts( $args_gasto , OBJECT);


        foreach( $recent_posts_gasto as $colm_gasto){
            
            $idgasto = $colm_gasto -> ID;
            $cantidadG = $colm_gasto -> cantidad;
            $aceptar =  $colm_gasto -> aceptar;
            
             $fechaGasto = get_the_date("d/m/Y", $idgasto);
             if($fechaGasto ==  $hoyGasto & $aceptar=="si" ){
             $sumaGasto = $sumaGasto + $cantidadG;
             }
            
              ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                          //alert("<?php echo    $aceptar ;?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
            
            
            
        }
    
    
       
  ////////////////fin gastos////////////////////////////////////////////////////////  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 /////////////////////////////////////////////////////////   
     ////////////////////cuentas///
    $args_cliente  = array( 'post_type' =>'cliente', 'author' =>    $id_actual_);
   
    $recent_post_cliente = wp_get_recent_posts($args_cliente , OBJECT);
    
                 

        foreach(   $recent_post_cliente as $recent_cliente){
     
       $recent_IDPost_cliente = $recent_cliente->ID;

             $id_author_post_cliente = $recent_cliente->post_author;
             
                 $fechaCuenta = get_the_date("d/m/Y",  $recent_IDPost_cliente );
                 
                 
                 
                 //$args_miscuentas2 = array( 'post_type' =>'miscuentas' , 'author' =>    $id_actual_ );


                 foreach( $recent_postss2 as $recentt2){
            

             
     
                      $id_cliente_cuenta = $recentt2->id_cliente_cuenta;
                      $cuenta_ = $recentt2->cuenta;
                      
                        if($recent_IDPost_cliente == $id_cliente_cuenta){
                            
                               if($cuenta_=="activa" & $fechaCuenta != $hoyReporte ){ //2024  
                            
                                    $sumasTotalesPagos =  $sumasTotalesPagos +  floatval($recent_cliente->valor_cuota_cliente);
                                    
                               }
                            
                         }
                  }    
                 
                 
                 
                 
                   ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                            //alert("<?php echo     $sumasTotalesPagos;?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
              
                 
                 
    
    if( $hoyReporte  == $fechaCuenta  &   $id_actual_ ==    $id_author_post_cliente ){
        
       
        
         $sumasCuentasHoy = $sumasCuentasHoy + floatval($recent_cliente->monto_cliente); //suma prestamos de hoy
         
         /*if($recentt2->monto_cuenta != null & $recentt2->cuotas_autorizadas != null){
          $sumasTotalesPagos =  $sumasTotalesPagos +  round(($recentt2->monto_cuenta /  $recentt2->cuotas_autorizadas),1); 
         }*/
       
       
       
     }
   
  
      
  
  
   
    
    }

      //////////////////////////fin cuenteas///









    ///////////////////////////////////////////////////////////////
    ////////////////////Inyecciones////////////////////////////////

          $valor_inyeccion=0;

           // $args_inyeccion = array('post_type' =>'inyeccion', 'posts_per_page' => 1, 'author' =>$id_actual_ ); solo me arrojaba 1 registro
                   
                   $args_inyeccion = array('post_type' =>'inyeccion', 'author' =>$id_actual_ ); 
                   $post_inyeccion= wp_get_recent_posts(  $args_inyeccion , OBJECT);
                   

    foreach( $post_inyeccion as $recentInyeccion){
     
        $id_inyeccion = $recentInyeccion->ID;
        
        
       $dateInyeccion = get_the_date("d/m/Y", $id_inyeccion); 
       
       if($dateInyeccion==$hoyReporte){
       $valor_inyeccion =   $valor_inyeccion + $recentInyeccion->valor;
       }
        //$id_author_reporteDiario = $recentDiario->post_author;
        
      
           
           
                      ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                          // alert("<?php  echo  $valor_inyeccion; ?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
           
    }

       //////////////////////////////fin inyecciones///////////////////////










    /////////////////////////////////////////////////////////////////                 
   ///////////////Fechas de Reporte Diario///////////////////////////////
                 
                 
                  
                   $args_reporteDiario = array('post_type' =>'reporte_diario', 'posts_per_page' => 1, 'author' =>$id_actual_, 'order' => 'DESC', 'orderby' => 'date' );
   
                   $post_reporteDiario = wp_get_recent_posts( $args_reporteDiario , OBJECT);
                   

  foreach($post_reporteDiario as $recentDiario){
     
        $id_reporteDiario = $recentDiario->ID;
    
        $id_author_reporteDiario = $recentDiario->post_author;
        
        $dateReporte = get_the_date("d/m/Y", $id_reporteDiario);
           
           
                      ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                            //alert("<?php  echo $id_reporteDiario; ?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
           
    }
    
    
    //penultimo registro de reporte diario

    
    $args_reporteDiario_pen = array(
    'post_type' => 'reporte_diario',
    'posts_per_page' => 2,
    'author' => $id_actual_,
    'order' => 'DESC',
    'orderby' => 'date',
   
 );

  $post_reporteDiario_pen = wp_get_recent_posts($args_reporteDiario_pen, OBJECT);

 if ($post_reporteDiario_pen && count($post_reporteDiario_pen) >= 2) {
    
    $recentDiario_pen = $post_reporteDiario_pen[1];
    
           $id_reporteDiario_pen = $recentDiario_pen->ID;
    $id_author_reporteDiario_pen = $recentDiario_pen->post_author;
                $dateReporte_pen = get_the_date("d/m/Y", $id_reporteDiario_pen);
              $caja_anterior_pen = $recentDiario_pen->caja_actual;   //la "caja anterior" diaria es la "caja actual" de ayer
    
  }
    
   
    
    ///////////////fin fecha reporte Diario/////////////////////////////////////
    
    
    
    
    
    
    
    
    
    
     
  ///////////////////////////////////////////////////////////////////////////////////////
  ///////////Actualizacion o insercion de fila en tabla Reporte Diario////////////////////////
    
       $caja_anterior = get_field("caja_anterior",  $id_reporteDiario);
        
                                                                 //id usuario actual == // id de author del post
                                                                 
 
    if( $dateReporte!=null  &&  $dateReporte ==  $hoyReporte &   $id_actual_ == $id_author_reporteDiario ){
        
  
                    ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                          // alert("<?php echo  $clientes_por_cobrar; ?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
            
     //Comision 3%
     $comision = $sumasTotalesHoy*0.03;
     //Caja actual  floatval
      
            $caja_anterior = isset($caja_anterior) ? $caja_anterior : 0;
            $sumasTotalesHoy = isset($sumasTotalesHoy) ? $sumasTotalesHoy : 0;
            $sumasTotalesAbonos = isset($sumasTotalesAbonos) ? $sumasTotalesAbonos : 0;
            $sumasCuentasHoy = isset($sumasCuentasHoy) ? $sumasCuentasHoy : 0;
            $sumaGasto = isset($sumaGasto) ? $sumaGasto : 0;
            $valor_inyeccion = isset($valor_inyeccion) ? $valor_inyeccion : 0;
            $sumaTotalesHoy_sumaTotalesAbonos = isset($sumaTotalesHoy_sumaTotalesAbonos) ? $sumaTotalesHoy_sumaTotalesAbonos : 0;
      
      $caja_actual =  ((( floatval($caja_anterior)+floatval($sumaTotalesHoy_sumaTotalesAbonos)) - $sumasCuentasHoy)-floatval($sumaGasto))+floatval($valor_inyeccion);
   
        
    //update_field("total_cobrado", $sumasTotalesHoy,  $id_reporteDiario);   $sumaTotalesHoy_sumaTotalesAbonos
    update_field("total_cobrado", $sumaTotalesHoy_sumaTotalesAbonos,  $id_reporteDiario);   
    update_field("cobrar_dia_actual", $sumasTotalesPagos,  $id_reporteDiario);
    update_field("total_prestado",  $sumasCuentasHoy,  $id_reporteDiario);
    update_field("clientes_con_pagos",  $clientes_por_cobrar,  $id_reporteDiario);
    update_field("gasto", $sumaGasto,  $id_reporteDiario);
    update_field("comision",   $comision,  $id_reporteDiario);
    update_field("caja_actual",   $caja_actual,  $id_reporteDiario);
    update_field("caja_anterior",   $caja_anterior_pen,  $id_reporteDiario);
 
 }  else
                 
                 
          {   
              
                  ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                            //alert("<?php echo "nueva fila"; ?>");
                             
                                         
                                 });
                           </script>
    
                     <?php 
              
         //if( empty($your_custom_que)){
             //agregamos fila 
           
                  
                  	
   $post_id_rd = wp_insert_post(array (
   'post_type' => 'reporte_diario',
   'post_title' => 	   $nombreUsuario_actual ,
   'post_content' =>   $nombreUsuario_actual ,
   'post_status' => 'publish',
   'comment_status' => 'closed',   // if you prefer
   'ping_status' => 'closed',      // if you prefer
 ));
   
   
   if ($post_id_rd) {
   // insert post meta
  add_post_meta($post_id_rd	, 'total_cobrado',   $sumaTotalesHoy_sumaTotalesAbonos );
  add_post_meta($post_id_rd	, 'caja_anterior',   $caja_anterior );

 
 }


     //}

 }
   
  wp_reset_postdata();  
                 
                 

                 
 ///////////////////////////////////fin de actualizacion    
    
}
 
add_action( 'admin_footer', 'reporte_diario' );  ////////////////////ADD
 















     function   suma_abonos(){
         
          
         
         
          
         $id_author_actual_sa = get_current_user_id(); //id usuario actual
    
    	 $abon= 0;
    	 
 if(isset($_GET['post'])){
     
     $idPost = $_GET['post'];
  
                $argsAbono = array(  'post_type' =>'abono', 'posts_per_page' => -1, 'author' =>  $id_author_actual_sa );
                
                $post_abono = wp_get_recent_posts( $argsAbono, OBJECT);
                
                
                
              foreach( $post_abono as $clienteAbono ){  //recorre cuentas post: miscuentas (menu detalles de pago)
                                      $id_abono =   $clienteAbono -> ID ;
                           

               
                                   // $id_cliente_cuenta = get_field( "id_cliente_cuenta", $idPost);
             
             if($idPost== get_field( "id_cliente", $id_abono ) ){
                 
                 
                $abon = $abon + get_field( "abono",  $id_abono );
                
                                 ?>
              
       <script type="text/javascript">

                jQuery(document).ready(function() {
                 //alert(" abono .'<?php echo     $abon   ?>'. ");
                // alert(" id_cliente.'<?php echo  get_field( "id_cliente", $id_abono ) ?>'. ");

                });///
       </script>                     
                            <?php 
                
                
             }
                  
                
              }
           
            
                       
                            
                                update_field("suma_abonado",    $abon, $idPost); 
                              
                       
               
             	             //rewind_posts();         
           //wp_reset_postdata();
               //return true;
         
             
             
  } 
}


//add_action('admin_head','suma_abonos'); ////////////////////ADD










////////////////////////////////////////////////////////////////////////////
/////////////////////////Nueva Liquidadas


function nueva_liquidadas() {

    // ==============================================================
    // 🔹 1. PROCESAR EL REPORTE SI SE LLAMA CON ?generar=1 (GET limpio)
    // ==============================================================
    if (isset($_GET['generar']) && $_GET['generar'] == 1) {


 





        $id_user = get_current_user_id();
        $current_user_nl = wp_get_current_user();
        $nombreUsuario_actual = $current_user_nl->display_name;

        // Obtener última "nueva_liquidada"
        $args_nl = array(
            'post_type' => 'nueva_liquidada',
            'posts_per_page' => 1,
            'author' => $id_user
        );
        $post_nl = wp_get_recent_posts($args_nl, OBJECT);

        $cobroTotal = 0;
        $totalPrestado_rd = 0;
        $caja_actual_nl = 0;
        $caja_anterior_nl = 0;
        $gastoTotal = 0;

        if (!empty($post_nl)) {
            $id_nl = $post_nl[0]->ID;
            $cobroTotal = floatval(get_field('total_cobrado_nl', $id_nl));
            $totalPrestado_rd = floatval(get_field('total_prestado_nl', $id_nl));
            $caja_actual_nl = floatval(get_field('caja_actual_nl', $id_nl));
            $caja_anterior_nl = floatval(get_field('caja_anterior_nl', $id_nl));
            $gastoTotal = floatval(get_field('gasto_nl', $id_nl));
        }

        // Crear nueva lista liquidada
        $post_id_ll = wp_insert_post(array(
            'post_type' => 'listas_liquidadas',
            'post_title' => $nombreUsuario_actual,
            'post_content' => $nombreUsuario_actual,
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        ));

        if ($post_id_ll && !is_wp_error($post_id_ll)) {
            add_post_meta($post_id_ll, 'total_cobrado_l', $cobroTotal);
            add_post_meta($post_id_ll, 'total_prestado_l', $totalPrestado_rd);
            add_post_meta($post_id_ll, 'caja_actual_l', $caja_actual_nl);
            add_post_meta($post_id_ll, 'caja_anterior_l', $caja_anterior_nl);
            add_post_meta($post_id_ll, 'gasto_ll', $gastoTotal);

            // Reset de nueva_liquidada
            if (!empty($post_nl)) {
                update_field('total_cobrado_nl', 0, $id_nl);
                update_field('total_prestado_nl', 0, $id_nl);
                update_field('comision_nl', 0, $id_nl);
                update_field('caja_actual_nl', 0, $id_nl);
                update_field('caja_anterior_nl', 0, $id_nl);
                update_field('gasto_nl', 0, $id_nl);
                update_field('fecha_inicio_nl', '-', $id_nl);
            }

            echo '<div class="notice notice-success"><p>✅ Reporte generado correctamente.</p></div>';

             // 🔄 Recargar automáticamente la página para mostrar los valores actualizados

echo '
<script>
window.addEventListener("load", function() {
    // Crear modal dinámicamente
    var modal = document.createElement("div");
    modal.id = "modalProcesando";
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.background = "rgba(0,0,0,0.6)";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.zIndex = "9999";
    modal.innerHTML = `
        <div style="
            background:#222;
            padding:40px 60px;
            border-radius:12px;
            color:#fff;
            font-size:22px;
            text-align:center;
            font-family:sans-serif;
            box-shadow:0 0 15px rgba(255,255,255,0.2);
        ">
            🔄 Procesando datos...<br><small>Por favor espera unos segundos</small>
        </div>
    `;
    document.body.appendChild(modal);

    // Esperar 3 segundos y redirigir
    setTimeout(function(){
       // modal.style.display = "none";
        window.location.href = window.location.pathname + "?post_type=nueva_liquidada";
    }, 3000);
});
</script>
';




        } else {
            echo '<div class="notice notice-error"><p>⚠️ Error al generar el reporte.</p></div>';
        }

        return; // 🔚 Detener aquí, no renderizar nada más
    }

    // ==============================================================
    // 🔹 2. TU LÓGICA ORIGINAL COMPLETA
    // ==============================================================
        
     // ===== LÓGICA ORIGINAL =====

//$postdate = '2010-02-23 18:57:33';/*For example*/

$fechaAhora = current_time('Y/m/d H:i:s');
$gastoTotal = 0;
$totalPrestado_rd=0;
$caja_actual_nl=0;
$captura_utlima_caja=0;
$cobroTotal= 0; // Inicializa la variable aquí

// Obtener la última fecha de actualización de la publicación listas_liquidadas
$post_type_actual = isset($_GET['post_type']) ? $_GET['post_type'] : '';
$argsLL = array(
        'post_type' => 'listas_liquidadas',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'author' => get_current_user_id(),
    );

    $queryLL = new WP_Query($argsLL);

    if ($queryLL->have_posts()) {
        $queryLL->the_post();
        $last_post_date = get_the_date('Y-m-d H:i:s');

        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $last_post_date);
        if ($fecha instanceof DateTime) {
            $fecha->modify('+1 day');
            $fecha_mas_un_dia = $fecha->format('Y-m-d H:i:s');
        } else {
            echo 'error';
            error_log("Error: No se pudo crear objeto DateTime desde '$last_post_date' con formato 'd/m/Y H:i:s'.");
        }



if ($post_type_actual == 'nueva_liquidada') {

    

        // --- Lógica para determinar si el botón debe estar deshabilitado ---
        $disable_button = true;
        $fecha_mas_un_dia_obj = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_mas_un_dia);
        $fechaAhora_obj = new DateTime(current_time('mysql'));
        $fechaAhora_date_str = $fechaAhora_obj->format('Y-m-d H:i:s');
        $fecha_mas_un_dia_date_str = $fecha_mas_un_dia_obj->format('Y-m-d H:i:s');
        $fecha_mas_un_dia_date_new = $fecha_mas_un_dia_obj->format('d/m/Y H:i:s');

        if ($fecha_mas_un_dia_date_str >= $fechaAhora_date_str) {
            $disable_button = true;
        } else {
            $disable_button = false;
        }

        ?>
        <script type="text/javascript">
        jQuery(document).ready(function() {
           /* jQuery("#posts-filter").append('<h2>Acumulado inicia o fue iniciado el: <?php echo $fecha_mas_un_dia_date_new; ?> </h2>');*/
            jQuery("#posts-filter").append('<h2>Si generó un reporte hoy por error o prueba, elimine el reporte generado en Listas Liquidadas.</h2>');
            jQuery("#posts-filter").append('<h2>Si generó un reporte hoy y quiere seguir cobrando, elimine el reporte generado en Listas Liquidadas.</h2>');
        });
        </script>
        <?php

    } else {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function() {
           // jQuery("#posts-filter").append('<h2>No hay publicaciones de tipo listas_liquidadas</h2>');
        });
        </script>
        <?php
    }

    wp_reset_postdata();
}

$theDate    = new DateTime($fechaAhora);
$stringDate = $theDate->format('Y-m-d H:i:s');
$id_actual_nl = get_current_user_id(); 
$current_user_nl = wp_get_current_user();
$nombreUsuario_actual = $current_user_nl->display_name;

$args_nl = array('post_type' =>'nueva_liquidada', 'posts_per_page' => 1, 'author' =>$id_actual_nl );
$post_nl= wp_get_recent_posts($args_nl , OBJECT);

foreach($post_nl as $recentNL){
    $id_nl = $recentNL->ID;
    $id_author_nl = $recentNL->post_author;
    $dateReporte = get_the_date("d/m/Y",  $id_nl);
}

$update_post = array(
    'ID' => $id_nl,
    'post_date' => $stringDate
);
wp_update_post($update_post);

if(is_null($id_nl)) {
    $post_id_nl = wp_insert_post(array(
        'post_type' => 'nueva_liquidada',
        'post_title' => $nombreUsuario_actual,
        'post_content' => $nombreUsuario_actual,
        'post_status' => 'publish',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
    ));
} else {

    $id_author_actual_nl = get_current_user_id(); 

    $argsLL = array(
        'post_type' => 'listas_liquidadas',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'author' => get_current_user_id(),
    );

    $queryLL = new WP_Query($argsLL);
    if ($queryLL->have_posts()) {
        $queryLL->the_post();
        $last_post_date = get_the_date('Y-m-d H:i:s');
        $datePlus = new DateTime($last_post_date);
        $datePlus->modify('+1 day');
        $next_day_date_ll = $datePlus->format('Y-m-d H:i:s');
    } else {
        $last_post_date = date('Y-m-d H:i:s');
    }

    // --- Cajas de reporte diario ---
    $argsRD = array('post_type' => 'reporte_diario', 'author' => $id_author_actual_nl);
    $your_custom_quer_rd = new WP_Query($argsRD);
    while ($your_custom_quer_rd->have_posts()) {
        $your_custom_quer_rd->the_post();
        $posts_ids_rd = get_the_ID();
        $last_modified_date = get_the_date('Y-m-d');
        if($captura_utlima_caja == 0){
            $captura_utlima_caja=1;
            $caja_actual_nl = get_field("caja_actual", $posts_ids_rd);
            $caja_anterior_nl = get_field("caja_anterior", $posts_ids_rd);
        }
        if($last_modified_date > $last_post_date){
            $totalPrestado_rd += get_field("total_prestado", $posts_ids_rd);
        }
    }

    // --- Rango de fechas ---
    $fecha_inicio_dmy = $next_day_date_ll;
    $fecha_fin_dmy = $stringDate;

  // Normalizar fechas de inicio y fin sin hora
    $fecha_inicio_dmy = date('Y-m-d', strtotime($fecha_inicio_dmy));
    $fecha_fin_dmy    = date('Y-m-d', strtotime($fecha_fin_dmy));


    // --- Consultas miscuentas, abonos y pagos ---
    $id_author_actual_oc = get_current_user_id();

    $args = array( 
        'post_type' => 'miscuentas', 
        'author' => $id_author_actual_oc,
        'posts_per_page' => -1
    ); 

    $query = new WP_Query($args);

    if ($query->have_posts()) { 
        $pagos_por_cliente = []; 
        $pagoDiario_por_cliente = []; 
        $abonos_por_cliente = []; 
        $pagocubierto_por_cliente = []; 
        $detalles_por_cliente = []; 
        $total_pagoCubierto = 0;
      
       
        $total_pago_general = 0;
        $total_general = 0;
        $idClienteAbono = [];
        $id_clientes = []; 
        $titulo_abono = [] ;
        $detalles_abonos = []; 
        $fechas_abonos = []; 

        while ($query->have_posts()) { 
            $query->the_post(); 
            $idPost_cuentas = get_the_ID(); 
            $clienteNombreText = get_the_title($idPost_cuentas); 
            $clienteNombre = $idPost_cuentas ;
            $idCuenta = get_field("id_cliente_cuenta", $idPost_cuentas); 
            $cuotas_autorizadas = get_field('cuotas_cliente', $idCuenta); 
            
            // --- Aquí siguen tus cálculos de abonos, pagos, sumatorias, totales, etc. ---
            
                 // Consultar los abonos para este cliente en el rango de fechas
$abonos_query = new WP_Query(array(
    'post_type' => 'abono',
    'author' => $id_author_actual_oc,
    'posts_per_page' => -1, // Obtener todos los posts sin límite
    'meta_query' => array(
        array(
            'key' => 'id_cliente',
            'value' => $idPost_cuentas,
            'compare' => '='
        ),
        array(
            'key' => 'cubrePagos',
            'value' => 0,
            'compare' => '>='
        )
    ),
    'date_query' => array(
        array(
            'after' => $fecha_inicio_dmy,
            'before' => $fecha_fin_dmy,
            'inclusive' => true
        ),
    ),
));

if ($abonos_query->have_posts()) {
    while ($abonos_query->have_posts()) {
        $abonos_query->the_post();
        $monto_abono = get_field('abono');
        $pagoCubiertoAbono = get_field('cubrePagos');
        $id_cliente = get_field('id_cliente');
        $fecha_abono = get_the_date('Y-m-d H:i:s');
        $titulo = trim(get_the_title());

        if (!preg_match('/Saldo/ui', $titulo)) {  
            if ($monto_abono) {
                if (!isset($abonos_por_cliente[$clienteNombre])) {
                    $abonos_por_cliente[$clienteNombre] = 0;
                }
                $abonos_por_cliente[$clienteNombre] += $monto_abono;
                $pagocubierto_por_cliente[$clienteNombre] += $pagoCubiertoAbono;
                $id_clientes[$clienteNombre] = $id_cliente;
                $titulo_abono[$clienteNombre] =  $titulo;

                if (!isset($fechas_abonos[$id_cliente])) {
                    $fechas_abonos[$id_cliente] = [];
                }
                $fechas_abonos[$id_cliente][] = $fecha_abono;
            }
        }
    }
}

// Comprobar si hay filas en 'pagos_abono'
if (have_rows('pagos_abono', $idPost_cuentas)) {   
    while (have_rows('pagos_abono', $idPost_cuentas)) { 
        the_row();
        for ($i = 1; $i <= $cuotas_autorizadas; $i++) { 
            $montoPago = get_sub_field('pago_#' . $i); 
            $fechaPago = get_sub_field('fecha_del_pago#' . $i); 

            if ($montoPago && $fechaPago) { 
                $fecha_obj = DateTime::createFromFormat('d/m/Y', $fechaPago);
                if ($fecha_obj !== false) {
                    $fechaPago_formateada = $fecha_obj->format('Y-m-d');
                } else {
                    $fechaPago_formateada = '';
                }


                
  

                if ($fechaPago_formateada >=  $fecha_inicio_dmy && $fechaPago_formateada <= $fecha_fin_dmy) {
                    
                


                    if (!isset($pagos_por_cliente[$clienteNombre])) {
                        $pagos_por_cliente[$clienteNombre] = 0;
                        $detalles_por_cliente[$clienteNombre] = [];
                    }

                    $pagos_por_cliente[$clienteNombre] += $montoPago;
                    $pagoDiario_por_cliente[$clienteNombre] = $montoPago;

                    $detalles_por_cliente[$clienteNombre][] = [
                        'monto' => $montoPago,
                        'fecha' => date('d-m-Y', strtotime($fechaPago_formateada)),
                    ];
                } 
            } 
        } 
    } 
} 

// Totales finales por cliente
 $total_pagoCubierto_general = 0;
foreach ($pagos_por_cliente as $cliente => $total) {
    $total_pagoCubierto = $total - ($pagoDiario_por_cliente[$cliente] * $pagocubierto_por_cliente[$cliente]);
    if ($total_pagoCubierto > 0) {

        $total_pagoCubierto_general += $total_pagoCubierto;

        
    }
}
  $total_abono_general = 0;
foreach ($abonos_por_cliente as $clienteABN => $total) {
    $total_abono_general += floatval(str_replace(',', '', $total));
}






// Obtener la cantidad total de gastos dentro del rango de fechas
$gastos_query = new WP_Query(array(
    'post_type' => 'gasto',
    'author' => $id_author_actual_oc,
    'posts_per_page' => -1,
    'date_query' => array(
        array(
            'after' => $fecha_inicio_dmy,
            'before' => $fecha_fin_dmy,
            'inclusive' => true
        ),
    ),
));

$total_gastos = 0;
if ($gastos_query->have_posts()) {
    while ($gastos_query->have_posts()) {
        $gastos_query->the_post();
        $monto_gasto = get_field('cantidad');
        $total_gastos += $monto_gasto;
    }
    wp_reset_postdata();
}


        ?>
                                <script>
                             jQuery(document).ready(function($) {
    
                                var fechaPa = "<?php echo $total_gastos; ?>"; 
                              //alert(fechaPa );
    
                             } );
                                </script>
                                <?php    

// Calcular cobro total
$cobroTotal = $total_pagoCubierto_general + $total_abono_general;

// Comisiones, actualización de campos
$comisionAcomulado = $cobroTotal * 0.03;
update_field('total_cobrado_nl', $cobroTotal, $id_nl);
update_field('total_prestado_nl', $totalPrestado_rd, $id_nl);
update_field('comision_nl', $comisionAcomulado, $id_nl);
update_field('caja_actual_nl', $caja_actual_nl, $id_nl);
update_field('gasto_nl', $total_gastos, $id_nl);
update_field('fecha_inicio_nl', $fecha_mas_un_dia_date_new, $id_nl);
wp_reset_postdata();





        }
        wp_reset_postdata();
    }

    // --- Cálculo final ---
    $comisionAcomulado = $cobroTotal * 0.03;
    update_field('total_cobrado_nl', $cobroTotal,  $id_nl);
    update_field("total_prestado_nl",$totalPrestado_rd,  $id_nl);
    update_field("comision_nl", $comisionAcomulado, $id_nl);
    update_field("caja_actual_nl", $caja_actual_nl, $id_nl);
    update_field("gasto_nl", $total_gastos, $id_nl);
    update_field('fecha_inicio_nl', $fecha_mas_un_dia_date_new, $id_nl);
}





    



    // ==============================================================
    // 🔹 3. BOTÓN GENERAR REPORTE
    // ==============================================================

    if (isset($_GET['post_type']) && $_GET['post_type'] == 'nueva_liquidada') :

          // 🔁 Recargar automáticamente solo una vez para reflejar la nueva fecha en el admin
if (empty($_GET['refreshed'])) {
    echo '
    <script>
    document.addEventListener("DOMContentLoaded", function(){
        // Espera 1 segundo antes de recargar (dar tiempo a guardar en BD)
        setTimeout(function(){
            const url = new URL(window.location.href);
            url.searchParams.set("refreshed", "1"); // evita recarga infinita
            window.location.href = url.toString();
        }, 1000);
    });
    </script>
    ';
}

    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        if ($("#publi_reporte").length === 0) {
            $("#posts-filter").append(`
                <button id="publi_reporte"
                        style="margin-bottom:30px;"
                        class="button button-primary button-large">
                    Generar Reporte
                </button>
            `);
        }
                   

                         jQuery(document).ready(function($) {

                            function normalizarFecha(fechaTexto) {
  const [fecha, hora] = fechaTexto.split(' ');
  const [dia, mes, año] = fecha.split('/');
  return new Date(`${año}-${mes}-${dia}T${hora || '00:00:00'}`);
}

  const fechaInicio = "<?php echo esc_js(get_field('fecha_inicio_nl', $id_nl)); ?>";
 const hoy = "<?php echo esc_js(date('d/m/Y H:i:s', strtotime(current_time('mysql')))); ?>"; // mismo formato que ACF
const fInicio = normalizarFecha(fechaInicio);
const fHoy = normalizarFecha(hoy);

  if (fechaInicio) {  //alert(hoy);

    // 🔸 Si fecha_inicio > hoy → reporte generado, esperar 12 AM → ocultar
    if (fInicio.getTime() > fHoy.getTime()) {  
      // Ocultar “Fecha inicio”
      $('td[data-colname="fecha inicio"], td[data-colname="Fecha inicio"]').each(function() {
        $(this).text('').css('color', '#888');
      });

      // Ocultar “Fecha Actual”
      $('td[data-colname="Fecha Actual"]').each(function() {
        $(this).text('').css('color', '#888');
      });

      // Caja Actual NL en 0
      $('td[data-colname="Caja Actual NL"], td[data-colname="Caja actual NL"]').each(function() {
        $(this).text('0').css({
          'color': '#888',
          'font-weight': 'bold'
        });
      });

      console.log("🔒 En espera: reporte generado, bloqueando datos hasta las 12 AM");
    } else {
      console.log("✅ Fecha válida: se pueden mostrar los datos");
    }
  } else {
    console.log("⚠️ No hay fecha_inicio_nl definida todavía.");
  }
});



        
            // 🚫 Bloquear el botón según la variable PHP
    var disableButton = <?php echo isset($disable_button) ? json_encode($disable_button) : 'false'; ?>;
    $("#publi_reporte").prop("disabled", disableButton);

        $("#publi_reporte").on("click", function(e) {
            e.preventDefault();
             // 🔄 Mostrar ventana modal al instante
if (!document.getElementById("modalProcesando")) {
    const modal = document.createElement("div");
    modal.id = "modalProcesando";
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.background = "rgba(0,0,0,0.6)";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.zIndex = "9999";
    modal.innerHTML = `
        <div style="
            background:#222;
            padding:40px 60px;
            border-radius:12px;
            color:#fff;
            font-size:22px;
            text-align:center;
            font-family:sans-serif;
            box-shadow:0 0 15px rgba(255,255,255,0.2);
        ">
            🔄 Generando reporte...<br><small>Por favor espera unos segundos</small>
        </div>
    `;
    document.body.appendChild(modal);
}






            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            var fechaActual = dd + '/' + mm + '/' + yyyy;
            var fechaMasUnDia = "<?php echo isset($fecha_mas_un_dia_date_new) ? $fecha_mas_un_dia_date_new : ''; ?>";

            //var msg = "Advertencia: Se está cerrando el acumulado desde (" + fechaMasUnDia + ") hasta (" + fechaActual + "). ¿Deseas generar el reporte?";
            var msg = "Advertencia: Genere el reporte semanal solo al finalizar el dia";
            if (confirm(msg)) {
                 

                window.location = window.location.pathname + "?post_type=nueva_liquidada&generar=1";
            }
             else {
                    // ❌ Si CANCELA → asegurarse de que el modal NO esté visible
        const modal = document.getElementById("modalProcesando");
        if (modal) modal.style.display = "none";
    }
        });
        


    });


  
    </script>
    <?php  
    endif;
}
add_action('admin_footer', 'nueva_liquidadas');

  ////////////////////ADD




















function mapa(){
    
echo do_shortcode( "[gd_map title='mapa' author_page_only='5'  width='100%'  height='500px'  maptype='ROADMAP'  zoom='0'  map_type='directory' lat=21.195607797026145 lng=-86.78461074829103  ] 
");

}


function muestraMapa(){
add_menu_page('Posicion de Clientes', 'Posicion de Clientes', 'manage_options', 'mapa_clientes', 'mapa');
}

add_action( 'admin_menu', 'muestraMapa' );









/////////////////////////////////////////////////////////////////////
////////////////////////////////////////solo ver sus propios post
function dcms_parse_query_author_only( $wp_query ) {


			global $current_user;
	
            $wp_query->set( 'admin_aux', $current_user->id );
	
}
add_filter('parse_query', 'dcms_parse_query_author_only' );




function dcms_remove_some_links_views( $views ) {
	unset($views['all']);
	unset($views['publish']);
	unset($views['trash']);
	unset($views['draft']);
	unset($views['pending']);
	return $views;
}




function cyb_list_own_posts_for_authors( $query ) {

 

    // Obtenemos la inforamci�0�1�0�6n sobre la pantalla actual
    // y el post type solicitado
    $current_screen = get_current_screen();
    $post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

    // Comprobamos que la pantalla sea la de edici�0�1�0�6n de posts
    // y si el usuario actual puede editar los posts de otros autores
    // Nota: get_current_screen() y get_post_type_object() pueden devolver null
    if( ( ! is_null( $current_screen ) && $current_screen->base == 'edit' )
        && ( ! is_null( $post_type_object ) && ! current_user_can( $post_type_object->cap->edit_others_posts ) )) {

      // Establecer el par�0�1�0�3metro "author" igual al usuario actual
      $query->set( 'admin_aux', get_current_user_id() );

    }

  
}

//add_action( 'pre_get_posts', 'cyb_list_own_posts_for_authors' );









///////////////////////////////////////////////////////////////////////////////
///////////////////////////////Escritorio a una sola columna por defecto

function crunchify_single_column( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'crunchify_single_column' );
 
function crunchify_single_dashboard(){
	return 1;
}
//add_filter( 'get_user_option_screen_layout_dashboard', 'crunchify_single_dashboard' );



   
   
   
   //////////////////////////////////////////////////////////////////
   /////////////quitar msj de confirmacion al cerrar//////////////////
   
   function logout_without_confirm($action, $result)

      {

      /**

      * Allow log out without confirmation

      */

      if ($action == "log-out" && !isset($_GET['_wpnonce'])) {

      $redirect_to = isset($_REQUEST['redirect_to']) ?

      $_REQUEST['redirect_to'] : '';

      $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));;

      header("Location: $location");

      die();

    }}
    
  add_action('check_admin_referer', 'logout_without_confirm', 10, 2);  
  
  
  
  
  
  
  //////////////////////////////////////////////////////
  ///////////////////redireccionamiento///////////////////////////////////
  
function my_custom_login_redirect(){
    
  //Pasamos a la funci���0�3n home_url() el slug de nuestra p���0�4gina de �0�10�6�99rea Privada
  
   $current_user = wp_get_current_user();
   
   
   
   
       if(in_array( 'admin',  ( array ) $current_user->roles )  )
          {
   
              wp_redirect( "wp-admin/users.php" );
                 exit();
             }
       
               else
       
             if(in_array( 'super_admin',  ( array ) $current_user->roles )  )
              {
   
               wp_redirect( "wp-admin/users.php" );
                exit();
              } 
              
         
              
           
             
  
                   wp_redirect( home_url("wp-admin/") );

                 exit();
            
              
           
       
       
}

add_action( 'wp_login','my_custom_login_redirect' );  ////////////////////ADD















function disable_new_posts() {
// Hide sidebar link
global $submenu;
//unset($submenu['edit.php?post_type=miscuentas'][10]);



// Hide link on listing page
if( $_GET['s'] == ''  ){
    
if (isset($_GET['post_type'])){
   echo '<style type="text/css">
 
#bulk-action-selector-bottom{display:none}
 #doaction2{display:none}
 .subtitle {display:none}
 /*.tablenav {display:none}*/
    </style>';

}

//listas liquidadas
if (isset($_GET['post_type']) && $_GET['post_type'] == 'listas_liquidadas') {
    echo '<style type="text/css">
    

  
   .wrap .wp-heading-inline+.page-title-action { display:none; }
    </style>';
}

//reporte diario
if (isset($_GET['post_type']) && $_GET['post_type'] == 'reporte_diario') {
    echo '<style type="text/css">
    

  
   .wrap .wp-heading-inline+.page-title-action { display:none; }
    </style>';
}

//nueva liquidad

if (isset($_GET['post_type']) && $_GET['post_type'] == 'nueva_liquidada') {
    echo '<style type="text/css">
    

  
   .wrap .wp-heading-inline+.page-title-action { display:none; }
    </style>';
}


//////////////////////////// css gastos
if (isset($_GET['post_type']) && $_GET['post_type'] == 'gasto'  ) {
    echo '<style type="text/css">
 
    </style>';
}

///////////////////////// css  listado de pagos

if (isset($_GET['post_type']) && $_GET['post_type'] == 'miscuentas'  && $_GET['s'] == '' ) {
    echo '<style type="text/css">
    
 .wrap .wp-heading-inline+.page-title-action { display:none; }
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
  #agCuenta { display:none; }
  #verCuenta { display:none; }
    </style>';
}


/////////////// GD PLACE 



if (isset($_GET['post_type']) && $_GET['post_type'] == 'gd_place' && $_GET['s'] == ""  ) {
    
       $user_id = get_current_user_id();  
       
       
       
       
       //ajuestes administrador
             echo '<style type="text/css">
          
  .ac-table-actions-buttons  {display:none}
  
  .page-title-action{display:none}
     
 #the-list .title  .row-actions .inline{ display:none; }

 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .geodir-regenerate-thumbnails{ display:none; }
    
    
    
     #geodir_wrapper div[data-argument="default_category"] {display:none}
 #geodir_wrapper div[data-argument="address_latitude"] {display:none}
 #geodir_wrapper div[data-argument="address_longitude"] {display:none}
 #geodir_wrapper div[data-argument="address_mapview"] {display:none} 
 
 
  #agCuenta { display:none; }
  #verCuenta { display:none; }
  #aagPago{display:none}
  
  
  #acf-group_636faa6731dc5{display:none}

  
    </style>';
       
       
       
    ////////////////////////bloqueos en movil
    if( isMobileDevice() ){
        
          echo '<style type="text/css">
          #wpadminbar {background: #4bbb63;}
          #wp-heading-inline span{display:none}
          
    .ac-edit-popper {
    display:none;
}
          
    table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr:focus-within td.acp-ie-editable .acp-ie-controls, table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr:focus-within td.acp-ie-editable .acp-ie-image-controls, table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr:hover td.acp-ie-editable .acp-ie-controls, table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr:hover td.acp-ie-editable .acp-ie-image-controls, table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr.forced-focus td.acp-ie-editable .acp-ie-controls, table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr.forced-focus td.acp-ie-editable .acp-ie-image-controls {
        display:none;
    }
          
 table.acp-ie-table.acp-ie-enabled.acp-ie-table--v2 tr td.acp-ie-editable .acp-ie-controls__item {
    cursor: pointer;
    display: none;
  }
  
  #ac-table-actions{display:none}
 .ac-table-actions.-init {
    display: none;
}
          
  .ac-table-actions-buttons  {display:none}
     
 #the-list .title  .row-actions .inline{ display:none; }
  #the-list .title  .row-actions .trash{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .geodir-regenerate-thumbnails{ display:none; }
    
    
    
     #geodir_wrapper div[data-argument="default_category"] {display:none}
 #geodir_wrapper div[data-argument="address_latitude"] {display:none}
 #geodir_wrapper div[data-argument="address_longitude"] {display:none}
 #geodir_wrapper div[data-argument="address_mapview"] {display:none} 
 
 
  #agCuenta { display:none; }
  #verCuenta { display:none; }
  #aagPago{display:none}
  
  
  #acf-group_636faa6731dc5{display:none}
  
    </style>';
    
        
    }
    
   
    
    echo '<style type="text/css">
    
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .geodir-regenerate-thumbnails{ display:none; }
    
    
    
     #geodir_wrapper div[data-argument="default_category"] {display:none}
 #geodir_wrapper div[data-argument="address_latitude"] {display:none}
 #geodir_wrapper div[data-argument="address_longitude"] {display:none}
 #geodir_wrapper div[data-argument="address_mapview"] {display:none} 
 
 
  #agCuenta { display:none; }
  #verCuenta { display:none; }
  #aagPago{display:none}
  

  #acf-group_636faa6731dc5{display:none}
  
    </style>';
    
    
    
    
    
}

}


}
add_action('admin_menu', 'disable_new_posts');  ////////////////////ADD






function disable_new_posts2() {
// Hide sidebar link
//global $submenu;
//unset($submenu['post.php?post=%post_id%&action=edit'][10]);

// Hide link on listing page 
      

 if (isset($_GET['action']) && $_GET['action'] == 'edit') {  
    echo '<style type="text/css">
 
 .wrap .wp-heading-inline+.page-title-action { display:none; }
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .inline .hide-if-no-js { display:none; }
 #agCliente { display:none; }
 #address_latitude { display:none; }
 #address_longitude { display:none; }
 #address_latitude { display:none; }
 #address_longitude { display:none; }
 
 
  #geodir_wrapper div[data-argument="default_category"] {display:none}
 #geodir_wrapper div[data-argument="address_latitude"] {display:none}
 #geodir_wrapper div[data-argument="address_longitude"] {display:none}
 #geodir_wrapper div[data-argument="address_mapview"] {display:none} 
 
    </style>';
}

 if (isset($_GET['post_type']) && $_GET['post_type'] == 'cliente' && $_GET['s'] == '' |  $_GET['s'] != '' ) {  
    echo '<style type="text/css">
 
 .wrap .wp-heading-inline+.page-title-action { display:none; }
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .inline .hide-if-no-js { display:none; }
 #agCliente { display:none; }
 
   #agPago { display:none; }
 #posts-filter  .tablenav .actions  a {display:none;}
    </style>';
}



 if (isset($_GET['post_type']) && $_GET['post_type'] == 'abono') {  
    echo '<style type="text/css">
 
 .wrap .wp-heading-inline+.page-title-action { display:none; }
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .inline .hide-if-no-js { display:none; }
  #the-list .title  .row-actions  .edit{ display:none; }
 #agCliente { display:none; }
 
 
   #agPago { display:none; }
 #posts-filter  .tablenav .actions  a {display:none;}
 
 .row-title{
pointer-events: none;
cursor: default;
}
 
 
 
    </style>';
}


 if (isset($_GET['post_type']) && $_GET['post_type'] == 'miscuentas') {  
    echo '<style type="text/css">
 
 .wrap .wp-heading-inline+.page-title-action { display:none; }
 #the-list .title  .row-actions .inline{ display:none; }
 #the-list .title  .row-actions .view{ display:none; }
 #the-list .title  .row-actions .inline .hide-if-no-js { display:none; }
  #the-list .title  .row-actions  .edit{ display:none; }
 #agCliente { display:none; }
 
 
   #agPago { display:none; }
 #posts-filter  .tablenav .actions  a {display:none;}
 

 
 
 
 
    </style>';

}











}
add_action('admin_menu', 'disable_new_posts2');    ////////////////////ADD





function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
, $_SERVER["HTTP_USER_AGENT"]);
}








function dashboard_preloader()
{
   
            
$idPost = get_field( "id_cliente_cuenta",  get_the_ID());

$valor_cuota = get_field( "valor_cuota_cliente",  $idPost);
$num_pagos =   get_field( "cuotas_cliente", $idPost)*2;

 $user_id = get_current_user_id();   
 $fecha_presta = get_the_date("d/m/Y", $idPost);
 $finaliza_presta = get_field( "fecha_terminar",  $idPost);
 $total_pagos_ = get_field( "total_pagos", get_the_ID());
 $abonos_tot_ = get_field( "suma_abonado", get_the_ID());
 $mont_cuenta_ = get_field( "monto_cuenta", get_the_ID());
 //$mont_cuenta_interes = $valor_cuota *$num_pagos;
  $finaliza_presta = update_field( "finaliza", $finaliza_presta );
  $inicia_presta = update_field( "inicia", $fecha_presta);
  
  
  
 $current_user  = new WP_User( $user_id);
       
     //alert($current_user->roles);
     //print_r($current_user->roles);
    
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    //jQuery('body').css('overflow', 'hidden');
    
     
    jQuery("input[name*='_wp_http_referer']").remove(); //11/08/2023
    jQuery('#your-profile .form-table:eq(6)').remove();
    
    //BLOQUEO DE MOVIL
       
                      jQuery("#save-post").click(function(e){

                               // e.preventDefault();
                                
                                
                               //jQuery("#save-post").submit();
                               
                             jQuery('#publishing-action').css('display', 'none'); 
                          
                  

                        });
    
      jQuery('#filter-by-date').css('display', 'none'); 
      
        // modal para acortar ruta de pago
                   
          var post_type = jQuery('#post_type').val();
if (post_type === 'gd_plac') {

    jQuery(document).ready(function() {

        var hasAaPagoButton = jQuery('#aagPago').length > 0;
        var hasVerCuentaButton = jQuery('#verCuenta').length > 0;
        var autoClickTimeout;
        var contador = 10; // segundos totales del conteo

        if (hasAaPagoButton /*|| hasVerCuentaButton*/) {

            // Contenido inicial con contador
            var messageDiv = jQuery('<div/>', {
                id: 'messageDiv',
                html: '<p style="font-weight:bold;">Espere un momento estamos buscando las cuentas de este cliente...</p>' +
                      '<p id="contador" style="font-size:24px;color:#0066cc;font-weight:bold;">' + contador + '</p>',
                css: {
                    'background-color': 'white',
                    'box-shadow': '0 0 10px rgba(0, 0, 0, 0.5)',
                    'font-weight': 'bold',
                    'text-align': 'center',
                    'padding': '20px'
                }
            });

            jQuery('body').append(messageDiv);

            jQuery('#messageDiv').dialog({
                modal: true,
                closeOnEscape: false,
                open: function(event, ui) {

                    var abortButton = jQuery('<button/>', {
                        text: 'DETENER PARA AGREGAR NUEVA CUENTA',
                        css: {
                            'margin-top': '10px',
                            'background-color': '#d9534f',
                            'color': 'white',
                            'padding': '8px 12px',
                            'border': 'none',
                            'cursor': 'pointer',
                            'border-radius': '5px'
                        },
                        click: function() {
                            clearTimeout(autoClickTimeout);
                            clearInterval(contadorInterval);
                            jQuery('#messageDiv').dialog('close').remove();
                        }
                    });

                    jQuery(this).parent().find('.ui-dialog-titlebar-close').hide();
                    jQuery(this).append(abortButton);

                    // 🔹 Contador visual cada 1 segundo
                    var contadorInterval = setInterval(function() {
                        contador--;
                        jQuery('#contador').text(contador);
                        if (contador <= 0) {
                            clearInterval(contadorInterval);
                        }
                    }, 1000);

                    // 🔹 Acción automática después del conteo
                    autoClickTimeout = setTimeout(function() {
                        if (hasVerCuentaButton) {
                            jQuery('#verCuenta')[0].click();
                        } else if (hasAaPagoButton) {
                            jQuery('#aagPago')[0].click();
                        }
                        jQuery('#messageDiv').dialog('close').remove();
                    }, contador * 1000);
                }
            });
        }
    });
}



        
        //

       if (jQuery('#post_type').val() === 'miscuentas' && !localStorage.getItem('reloaded')) {
        localStorage.setItem('reloaded', true);
        location.reload();
    } else {
        localStorage.removeItem('reloaded');
    }
    
   <?php   
   
  
                          

   
   
   
            if( isMobileDevice() )
            {  
                
                                
           if (isset($_GET['post_type']) && $_GET['post_type'] == 'reporte_diario' ) {
              
              ?> 
             
                  jQuery('#aceptarGasto').css('display', 'none'); 
                  jQuery('.author-other').remove();
                   jQuery('#wp-admin-bar-menu-toggle').css({"display":"none", });
                   jQuery('#adminmenuwrap ').css({"display":"none", });
                   jQuery('#wpadminbar').css('background', '#4bbb63'); 
                   
                   
                    
      
                   
                   
          
              <?php
              
               }//
                
                
                
                ?>
                   if ( jQuery('input[name="post_type"]').val() == 'abono') {
             jQuery('table').removeClass('wp-list-table');
             jQuery('.row-actions').hide();
             
        }
               if ( jQuery('input[name="post_type"]').val() == 'reporte_diario') {
             jQuery('table').removeClass('wp-list-table fixed');
            
             
        }
  
                 jQuery("#ac-table-actions").remove();
                 jQuery(".ac-edit-popper").remove();
                 jQuery(".ac-edit-popper").css("display", "none");
               
                jQuery('#search-submit').click(function(e) {
          e.preventDefault();
           if( jQuery('#post-search-input').val()==""){
               alert("Se requiere datos");
               
           }else
           {
               jQuery("#posts-filter").submit();
           }
      });
           
          //jQuery('.tablenav').css('display', 'none');   ///11/08/2023
          
          <?php
           if (isset($_GET['post_type']) && $_GET['post_type'] == 'reporte_diario') {  
               ?>
           
           jQuery('.row-actions').css('display', 'none'); 
           jQuery('.wrap .wp-heading-inline+.page-title-action').css('display', 'none'); 
      
           jQuery('.row-title').removeAttr("href");
           
           jQuer('#the-list').css('background', 'blue');
          
           
              
             



         <?php } ?>
         
           
           
           <?php     
                  
              if ($_GET['s'] != "" ) {
    
    ?> 
    
    //alert("okok");
    jQuery('.wp-heading-inline').css('display', 'none'); 
    jQuery('.row-actions .inline').css('display', 'none'); 
     jQuery('.row-actions .trash').css('display', 'none');
     jQuery('.row-actions .geodir-regenerate-thumbnails').css('display', 'none'); 
      jQuery('.page-title-action').css('display', 'none'); 
     
     
    
      
       
    
    <?php
    
}



             if (isset($_GET['post_type']) && $_GET['post_type'] == 'gasto'  ) 
             {
              
                 ?> 
                     
                     //jQuery('#publish').css('display', 'none');
                    //jQuery('#minor-publishing').css('display', 'none');
                   jQuery('#misc-publishing-actions').css('display', 'none');
                    jQuery('#save-post').css('display', 'revert'); 
                    jQuery('.row-actions').css('display', 'none'); 
                     //jQuery('#publishing-action').css('display', 'none'); 
                     
                     
               
              
                 <?php
                 
              
               }
                
                
       
             } 
       
       ?>
        
 
    

 <?php  
        
         if(in_array( 'super_admin',  ( array ) $current_user->roles ) &  !isMobileDevice()  )
       {
           
                
              
                  ?> 
                    jQuery("#adminmenu .menu-icon-users div.wp-menu-name").html("<strong>Gestionar Administradores</strong>");
                   //jQuery('#wpadminbar').css('background', '#4bbb63'); 
                   
              
              <?php
              
        }
        
         if(in_array( 'super_admin',  ( array ) $current_user->roles ) & isMobileDevice()  )
        {
              
                ?> 
                
                    jQuery('body').fadeOut('fast');
                 
                    alert("Acceso administradores solo por la web");
                    
                    jQuery(location).attr('href', 'https://cocunmx.com/salir.php');
              
              <?php
              
             
              //wp_redirect( "https://cocunmx.com/salir.php" );
            
        }
 
      if(in_array( 'admin',  ( array ) $current_user->roles )  | in_array( 'admin_aux',  ( array ) $current_user->roles ))
       {
           
                 
              
                  ?> 
                    jQuery("#adminmenu .menu-icon-users div.wp-menu-name").html("<strong>Administrar Cobradores</strong>");
                     //jQuery("#wp-admin-bar-my-account a").html("<strong>Administrar</strong>");
                   
                   //jQuery('#wpadminbar').css('background', '#4bbb63'); 
                   
              
              <?php
               
        }
        
         if(in_array( 'admin',  ( array ) $current_user->roles ) & isMobileDevice()  )
        {
              
                ?> 
                      jQuery('body').fadeOut('fast');
                    alert("Acceso administradores solo por la web");
                    jQuery(location).attr('href', 'https://cocunmx.com/salir.php');
              
              <?php
              
             
              //wp_redirect( "https://cocunmx.com/salir.php" );
            
        }
 
 
 
 
 
   if(in_array( 'admin_aux',  ( array ) $current_user->roles ) &  isMobileDevice()  )
       {
           
           
           
              
                  ?> 
              
                   jQuery('#wpadminbar').css('background', '#4bbb63'); 
                   
              
              <?php
              
        }
        
        
        if(in_array( 'cobranza',  ( array ) $current_user->roles ) &  isMobileDevice()==false  )
       {
              
                  ?> 
                       alert("Usuario Cobrador, acceso solo por APP");
                       jQuery('#aceptarGasto').css('display', 'none'); 
                       jQuery(location).attr('href','https://cocunmx.com/wp-login.php');
                   //jQuery('#wpadminbar').css('background', '#4bbb63'); 
              
              <?php
              
        }
 
 
 
 
 ///////////////////////////////////////////////////////////////////////////////////
 ///////////////////Ajustes Interfaz Admins AUX/////////////////////////////////////
 
 if(in_array( 'admin_aux',  ( array ) $current_user->roles )  )
 
        {

              
              
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'gasto' ) {
              
              ?> 
             
               //jQuery('#minor-publishing').css('display', 'none');
              //jQuery('#misc-publishing-actions').css('display', 'none');
            //jQuery('#save-post').css('display', 'none');  
              jQuery('#visibility').css('display', 'none'); 
              jQuery('#timestamp').css('display', 'none'); 
              
              <?php
              
          }
          
          
    ?> 
    
    <?php
         if (isset($_GET['post_type']) && $_GET['post_type'] != 'gasto' ) {
              
              ?>  
          
          jQuery('#minor-publishing').css('display', 'none');
          
           <?php
              
          }
    ?> 
          <?php if($_GET["regarcar"]==1){     ?>
              jQuery(location).attr('href','https://cocunmx.com/wp-admin/index.php?recargar=1');
              
          <?php } ?>
          
        //location.reload(true);
                
         jQuery('.author-other').remove();
         jQuery(document).ready(function($) {
       $('#meta-box-order-nonce').remove();
});
  //jQuery('#wp-admin-bar-menu-toggle').css({"display":"none", });
   //jQuery('#adminmenuwrap ').css({"display":"none", });
   
    //jQuery('#acf-field_636adfcbbb31b').prop( "disabled", true );


                var campos=0;
                var num_pagos_aprovado = '<?php echo  $num_pagos; ?>';
 
                var valor_Cuota = '<?php echo $valor_cuota; ?>';
                var abonoss_tot = '<?php echo $abonos_tot_; ?>';
                var pagosConAbonos = '<?php echo $total_pagos_+$abonos_tot_; ?>';
                var pagoRestante = '<?php echo round(($mont_cuenta_) - ($total_pagos_+$abonos_tot_), 2); ?>';

                var montoInteres = (valor_Cuota*num_pagos_aprovado)/2;
                 
                 
var post_type = jQuery('#post_type').val();

if(post_type === 'miscuentas') {

        // Ocultar el elemento .acf-label dentro del contenedor con data-name="total_pagos"
        jQuery('[data-name="total_pagos"] .acf-label').css('display', 'none');

// Ocultar el elemento .acf-input dentro del contenedor con data-name="total_pagos"
jQuery('[data-name="total_pagos"] .acf-input').css('display', 'none');

        
if (parseFloat(pagoRestante) <= 0) {
    var message4_1 = '| <strong style="font-size:18px; color: green;">TERMINADO</strong>';
    jQuery('.wrap form').prepend(message4_1);
} else if (parseFloat(valor_Cuota) > parseFloat(pagoRestante)) {
    var message4 = '| <strong style="font-size:18px;">Ingrese restante de pago como abono:   $</strong><strong style="font-size:18px;">' + pagoRestante + '</strong> ';
    jQuery('.wrap form').prepend(message4);
}


    var message = '| <strong style="font-size:18px;">Cuota Diario:$</strong><strong style="font-size:18px;">' + valor_Cuota + '</strong>  ';
    jQuery('.wrap form').prepend(message);

     
    
    var message2 = '<strong style="font-size:18px;">Restante:$</strong><strong style="font-size:18px;">' + pagoRestante  + '</strong> ';
    jQuery('.wrap form').prepend(message2);

   

    var message3 = '<strong style="font-size:12px;">Total Cuotas + Total Abonos($'+abonoss_tot+') = $</strong><strong style="font-size:15px;">' + pagosConAbonos + '</strong> ';
    jQuery('.wrap form div[data-name="total_pagos"]').prepend(message3);

    
                           //si el abono es mayo al restante...
    
   

                           jQuery("#acf-field_636424e77080a").on('input', function() {
        var valorAbono = parseFloat(jQuery(this).val());
                                                    if(valorAbono > pagoRestante_) {
                          alert("El abono debe ser menor al restante de pago");
                            jQuery("#acf-field_636424e77080a").val(0);
                    }
              });

}



 
 
 

 
     jQuery(".acf-field-62133128f8461 .acf-fields  ").find(':input').each(function() {
         
                  var elemento= this;
         
         
                    if( jQuery(elemento).attr('type')=="number" |  jQuery(elemento).attr('type')=="text"){ 
        
         //alert("okok");
         campos++;
         if(campos>num_pagos_aprovado){
             
         jQuery("."+campos).css({"display":"none", });
         //jQuery(".pago").css({"display":"none", });
             
         }
        
    }
         
          if(jQuery( elemento).val()!="" )
            {
              
              
             
              jQuery(elemento).css({"background-color": "#62E876", });
                 //jQuery(elemento).css({"background-color": "green", });

             }
          
          
    });      
          
          
          
          
          
          
          
          
          

<?php } ?>





///////////////////////////////////////////////////////////////////////////////
 ///////////////bloqueos en interfaz cobranza//////////////////////////////////////
    
  <?php  
  
                   ?> 
                    
                     var camposConDatos = 0;
                     var campos=0;
                     var campos2=0;
                     var num_pagos_aprovado = '<?php echo  $num_pagos; ?>';
              
                 <?php


  if(in_array( 'cobranza',  ( array ) $current_user->roles ) | isMobileDevice()   )
    {
         
          
          ?> 
                    
                     var camposConDatos = 0;
                     var campos=0;
                     var campos2=0;
                     var num_pagos_aprovado = '<?php echo  $num_pagos; ?>';
              
                 <?php
         
         if (isset($_GET['post_type']) && $_GET['post_type'] == 'gasto'  ) 
             {
              
                 ?> 
                      jQuery('#misc-publishing-actions').css('display', 'none');
                     //jQuery('#publish').css('display', 'none');
                     
                    //jQuery('#minor-publishing').css('display', 'none');
                    jQuery('#save-post').css('display', 'revert'); 
                    jQuery('.row-actions').css('display', 'none'); 
                   
                    
              
                 <?php
              
               }
         
         
         
          

        ?>   
        
          jQuery('#aceptarGasto').css('display', 'none'); 
          jQuery('.author-other').remove()
          jQuery('#wp-admin-bar-menu-toggle').css({"display":"none", });
          jQuery('#adminmenuwrap ').css({"display":"none", });
   
   
   
          jQuery('#acf-field_636adfcbbb31b').prop( "disabled", true );

      
 



 
     jQuery(".acf-field-62133128f8461 .acf-fields").find(':input').each(function() {
         
         var elemento= this;
         
            if( jQuery( elemento).attr('type')=="number"  ){
                             campos2++;
            }
            
    
         
         
    if( jQuery(elemento).attr('type')=="number" |  jQuery(elemento).attr('type')=="text")
    { 
        
        // alert("okok");
         campos++;
       
         if(campos>num_pagos_aprovado){
             
              jQuery("."+campos).css({"display":"none", });
                     //jQuery(".pago").css({"display":"none", });
             
               }
         
    }
         
         
         
        
    
         
          if(jQuery( elemento).val()!="" )
            {
               
                 
            
             if( jQuery(elemento).attr('type')=="number" |  jQuery(elemento).attr('type')=="text")
                   { 
                       //alert("okok");
                       camposConDatos++;
                     
                   }
              
              jQuery(elemento).prop( "disabled", true );
              jQuery(elemento).css({"background-color": "#62E876", });
                 //jQuery(elemento).css({"background-color": "green", });

             }
      
   
         jQuery('.fecha').on('keydown', function (e)
            {
                try {                
                    if ((e.keyCode == 8 || e.keyCode == 46))
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 


  jQuery('.pago').on('keydown', function (e)
            {
                try {                
                    if ((e.keyCode == 8 || e.keyCode == 46))
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
            
            
            
         

 //Calendario jquey

jQuery('.acf-ui-datepicker').css({"display": "none", }); 


         
   
         //alert("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value); 
        });
 
 
 
 

 
      if( jQuery("#title").val()!=""){
 
      jQuery("#title").on('keydown', function (e)
            {  
                try {                
                    if (   (e.keyCode >= 8  )  ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
  
  
     if( jQuery("#acf-group_6226c8e5ea6f9 .acf-field .acf-input input").val()!=""){
 
      jQuery("#acf-group_6226c8e5ea6f9 .acf-input").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
  
     if( jQuery("#acf-group_636faa6731dc5 .acf-field .acf-input input").val()!=""){
 
      jQuery("#acf-group_636faa6731dc5 .acf-input").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
  
     jQuery("#acf-group_636faa6731dc5").attr("style", "display:none");
  
//filtro de busqueda y btn de subir y bajar modulo
  jQuery("#filter-by-date").attr("style", "display:none");
  //jQuery("#post-query-submit").attr("style", "display:none");  // 11/08/2023
  jQuery(".handle-order-higher").attr("style", "display:none");
  //jQuery(".wrap .wp-heading-inline + .page-title-action").attr("style", "display:none");    
 

  jQuery(".handle-order-lower").attr("style", "display:none"); 
 
  if( jQuery(".input-group input").val()!=""){
 
      jQuery(".input-group input").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
 
 
    //campos de pagos
   
    
      if( jQuery("#acf-field_636970f40c518").val()!=""){
 
      jQuery("#acf-field_636970f40c518").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
  
  
  
   if( jQuery("#acf-field_62133233aba7b").val()!=""){
 
      jQuery("#acf-field_62133233aba7b").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }

 
    if( jQuery(".acf-field-accordion .acf-input .acf-input-wrap input").val()!=""){
 
      jQuery(".acf-field-accordion .acf-input .acf-input-wrap input").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }  
  
  
  
    if( jQuery("#dp1684277374138").val()!=""){
 
      jQuery("#dp1684277374138").on('keydown', function (e)
            {  
                try {                
                    if (  (e.keyCode >= 8  ) ) 
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
  }
 
   
// alert(camposConDatos);
    
   
 <?php    } ?>
    
    









///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
<?php   
  if(in_array( 'admin_aux',  ( array ) $current_user->roles ) & !isMobileDevice()   )
    {
          ?>
          
        //alert("jeje");
            jQuery(".acf-field-62133128f8461 .acf-fields").find(':input').each(function() {
         
         var elemento= this;
         
            if( jQuery( elemento).attr('type')=="number"  ){
                             campos2++;
            }
            
    
         
         
    if( jQuery(elemento).attr('type')=="number" |  jQuery(elemento).attr('type')=="text")
    { 
        
        // alert("okok");
         campos++;
       
         if(campos>num_pagos_aprovado){
             
              jQuery("."+campos).css({"display":"none", });
                     //jQuery(".pago").css({"display":"none", });
             
               }
         
    }
         
         
         
        
    
         
          if(jQuery( elemento).val()!="" )
            {
               
                 
            
             if( jQuery(elemento).attr('type')=="number" |  jQuery(elemento).attr('type')=="text")
                   { 
                       //alert("okok");
                       camposConDatos++;
                     
                   }
              
              jQuery(elemento).prop( "disabled", false ); //desbloquedo de botones de cuotas de aminx_aux
              jQuery(elemento).css({"background-color": "rgb(61 157 221)", });
                 //jQuery(elemento).css({"background-color": "green", });

             }
      
   
         jQuery('.fecha').on('keydown', function (e)
            {
                try {                
                    if ((e.keyCode == 8 || e.keyCode == 46))
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 


  jQuery('.pago').on('keydown', function (e)
            {
                try {                
                    if ((e.keyCode == 8 || e.keyCode == 46))
                        return false;
                    else
                        return true;               
                }
                catch (Exception)
                {
                    return false;
                }
            }); 
            
            
            
         

 //Calendario jquey

jQuery('.acf-ui-datepicker').css({"display": "none", }); 
//campo   'cubre pagos'
jQuery('.acf-field-654a9c85813aa').css({"display": "none", }); 
// campo saldo de abono
jQuery('.acf-field-654a9ccd9c892').css({"display": "none", }); 
// campo total saldo
jQuery('.acf-field-6554ef0dd212b').css({"display": "none", }); 
// bloqueo de campo total de abono
jQuery('#acf-field_636adfcbbb31b').prop('readonly', true);

         
   
         //alert("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value); 
        });



<?php } ?>
                  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////////////
//si el campo  de numero de pagos cubierto por abonos es mayor a 0 entonces hacemo auto clic  .pago y le damos valor a la variable num_pago_posicion 
  // Verifica si la bandera está establecida y luego imprime el script
  <?php  if (isset($_SESSION['abonar_ejecutado'])) {  ?>
var count = Number(jQuery('#acf-field_654a9c85813aa').val());

if(count > 0 /*& pagoRestante>0*/) {
    (async function() {
        for(var i = 0; i < count; i++) {
            await new Promise(resolve => {
                jQuery(".pago input").each(function() {
                    if (jQuery(this).val() == '') {
                        var name = jQuery(this).closest('.pago').data('name');  
                        var element = document.querySelector(".acf-input div[data-name='" + name + "']");
                        if (element) {
                            setTimeout(function() {
                                element.click();
                                resolve();
                            }, 10);  // Espera 10 milisegundos antes de hacer clic
                        }
                        return false;
                    }
                });
            });
        }
        jQuery('#acf-field_654a9c85813aa').val(0);  // Ajusta el valor a 0
        // Crea un div para mostrar el mensaje
        var messageDiv = jQuery('<div/>', {
            id: 'messageDiv',
            text: 'Calculando los pagos que cubre el abono, espere por favor...',
            css: {
                'background-color': 'white',
                'box-shadow': '0 0 10px rgba(0, 0, 0, 0.5)',
                'font-weight': 'bold',
                'text-align': 'center',
                'padding': '20px'
            }
        });
        jQuery('body').append(messageDiv);  // A�0�9ade el div al body
        // Muestra el div como un modal
        jQuery('#messageDiv').dialog({
            modal: true
        });
        jQuery('#publish').click();  // Hace clic en el bot��n "Actualizar"
    })();
}
<?php } ?>

/*jQuery(".acf-input div").on('click', function() {
   alert('Se hizo clic en el elemento con data-name=' + jQuery(this).data('name'));
});*/





////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
jQuery( '.pago' ).click(function() {
   
    
       
                    
       jQuery('.pago').on('keydown', function (e)
                     {
            try {                
                if ((e.keyCode == 8 || e.keyCode == 46))
                    return false;
                else
                    return true;               
            }
            catch (Exception)
            {
                return false;
            }
        }); 
        
        
       jQuery('.pago').keypress(function(event) {
if (event.which >= 48 && event.which <= 57) {
    event.preventDefault();
}
});
  





  
            //se quito variables inicialicilizadas y se colocaron  a partir de lina cod 3875
             
            
            var dataName = jQuery(this ).data('name');
            var idIput = jQuery('.acf-input div[data-name="'+dataName+'"] input' ).attr('id');
            var num_campos_datos = camposConDatos/2;
   // alert(num_campos_datos );
     
   //var num_pago_posicion = dataName.split('_#')[1] ;
  // var num_pago_posicion = parseInt(dataName.split('#')[1], 10);

   
   const hoy_p = new Date();  //hoy_p.toLocaleDateString('es-mx').
   var hoyFormato =   hoy_p.getFullYear()  + '/' + (hoy_p.getMonth()+1).toString().padStart(2, '0')  + '/' +  hoy_p.getDate().toString().padStart(2, '0');
  
     var hoyFormato_mx = hoy_p.toLocaleDateString('en-GB');
            
  // Asumiendo que 'dataName' es algo como "pago_#3"
var num_pago_posicion = parseInt(dataName.split('_#')[1], 10);

var $inputActual = jQuery('.acf-input div[data-name="'+dataName+'"] input');
var valorActual = parseFloat($inputActual.val()) || 0;

// Comprobar si el campo actual está relleno y no está deshabilitado
if (valorActual > 0 && !$inputActual.prop("disabled")) {
    // Comprobar si hay algún campo siguiente con datos
    var hayCampoConDatos = false;
    var num_pago_siguiente = num_pago_posicion + 1;
    var $inputSiguiente;

    // Buscar el siguiente campo con datos, si lo hay
    while (true) {
        $inputSiguiente = jQuery('.acf-input div[data-name="pago_#' + num_pago_siguiente + '"] input');
        if ($inputSiguiente.length === 0) {
            // No hay más campos, detener la búsqueda
            break;
        }
        if (parseFloat($inputSiguiente.val()) > 0) {
            // Encontramos un campo siguiente con datos
            hayCampoConDatos = true;
            break;
        }
        num_pago_siguiente++;
    }

    // Si hay un campo siguiente con datos, mostrar alerta
    if (hayCampoConDatos) {
        alert("Debe eliminar los pagos de abajo hacia arriba.");
    } else {
        // No hay campos siguientes con datos, se puede desrellenar el campo actual
        $inputActual.val('');
        // Asegúrate de que el nombre del campo de fecha coincida con el patrón correcto
        var nombreCampoFecha = 'fecha_del_pago_#' + num_pago_posicion;
        jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val("");
                            jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val("");
    }
}
else
    {

 if(  jQuery( '.acf-input div[data-name="'+dataName+'"] input' ).val()=="" )
 {       
          
        <?php if( $valor_cuota == ""){  ?>
 
               alert("Esta cliente no tiene cuenta definido. Agregue una cuenta a este usuario para poder agregar pagos");
       <?php }  else {    
           
           
          
           
           
           ?>
                    var abonoss_tot_ = '<?php echo $abonos_tot_; ?>' ;
                    var valor_cuota = '<?php echo $valor_cuota;   ?>';
                    var tot_actual_pagado = parseFloat((valor_cuota * num_pago_posicion))+parseFloat(abonoss_tot_) || 0;  
                     var iaux =0;
                     //alert(num_pago_posicion);
                    var banAlert =0;
                     
                    jQuery(document).on('click', '#cancelButton', function(event) {
                       event.preventDefault();
                       jQuery('#acf-field_636424e77080a').val(0);
                       jQuery('.acf-input div[data-name="pago_#'+num_pago_posicion+'"] input').val('').css('border', '1px solid grey');
                       jQuery(this).prev('strong').remove(); // Elimina el elemento <strong> que precede al botón
                       jQuery(this).remove();
                     });


                       for (var i = num_campos_datos+1; i <= num_pago_posicion ; i++) 
                        {
                            
                           
                            

                            if(pagoRestante==0)
                            {
                                jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                    
                              jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                   

                                jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                     

                                jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).prop( "disabled", true );
                   
                            }
                          
                            var abonoInicial =  Number(jQuery( '#acf-field_636424e77080a' ).val());
                //alert(" (El total de las cuotas que acaba de hacer click mas las anteriores ingresadas mas abonos Es de ( $" + tot_actual_pagado.toFixed(2) + ").  Supero El monto de pago de $" + montoInteres.toFixed(2) + ")? el abono inicial de  "+jQuery( '#acf-field_636424e77080a' ).val() +"es menor al pago  restante de"+pagoRestante+"?");
                               
                            //campo abono inicial

                            
                           if(parseFloat(tot_actual_pagado) > parseFloat(montoInteres)  & abonoInicial<pagoRestante )
                            {
                                    
                               var actu = valor_cuota - (parseFloat(tot_actual_pagado) - parseFloat(montoInteres));

                                 if(banAlert==0 ){
                                   
                                   jQuery( '#acf-field_636424e77080a' ).val(actu );
                                   jQuery('.acf-input div[data-name="pago_#'+num_pago_posicion+'"] input').val('').css('border', '1px solid orange');
                                   // Verifica si el mensaje ya existe en el DOM
if (jQuery('.wrap form div[data-name="pagos_abono"] .messageCancel').length === 0) {
    // Si no existe, crea y muestra el mensaje y el botón
    var messageCancel = '<strong class="messageCancel" style="font-size:12px; color:orange;">Este último campo por el momento quedará en blanco y se procesará después en automático</strong>';
    messageCancel += '<button id="cancelButton" style="display:block; margin-top:10px;">Cancelar</button>';
    jQuery('.wrap form div[data-name="pagos_abono"]').append(messageCancel);
}


banAlert =1;
                                      //jQuery( '.acf-input div[data-name="pago_#'+num_pago_posicion+'"] input' ).val('');
                                   // jQuery( '.acf-input div[data-name="fecha_del_pago#'+num_pago_posicion+'"] input[type="text"]' ).val(hoyFormato_mx);
                
    
                                //jQuery( '.acf-input div[data-name="fecha_del_pago#'+num_pago_posicion+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                                //jQuery( '.acf-input div[data-name="fecha_del_pago#'+num_pago_posicion+'"] input[type="text"]' ).prop( "disabled", true );
                                  //alert(num_pago_posicion);
                               //jQuery('.acf-input div[data-name="pago_#'+i+'"] input').click();
                               //alert("Disminuya el número de cuotas o ingrese el pago como abonos. (El total de las cuotas que acaba de hacer click mas las anteriores ingresadas mas abonos ( $" + tot_actual_pagado.toFixed(2) + ") superan al monto de pago $" + montoInteres.toFixed(2) + ")" );
                                 // alert("Este ultimo campo por el momento quedara en blanco  y se procesara despues en automatico al hacer clic al boton actualizar");
                                  
                               }
                           
                             

                             

                            if(i!=num_pago_posicion){ 
                           jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                    
                               jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                                // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                      
                             //alert(hoyFormato_mx);
           
                               jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                                //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val('20230513');
              
                              // jQuery( '.acf-input div[data-name="'+dataName+'"] input' ).prop( "disabled", true );
                               //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input' ).prop( "disabled", true );
           
                                   jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).prop( "disabled", true );
                                 //alert(montoInteres);

                             }
                          
                         
                        
                    }  
                      //alert('ok');
                    

                    if (parseFloat(tot_actual_pagado) <=parseFloat(montoInteres)   & pagoRestante<=0){
                       
                        //alert("ds");
                    jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                    
                      jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                     // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                      
                      //alert(hoyFormato_mx);
           
                      jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                      //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val('20230513');
              
                     // jQuery( '.acf-input div[data-name="'+dataName+'"] input' ).prop( "disabled", true );
                     //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input' ).prop( "disabled", true );
           
                      jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).prop( "disabled", true );
                      //alert(montoInteres);

                }    

                    

                if (parseFloat(tot_actual_pagado) <= parseFloat(montoInteres)  ){
                       
                    //alert("res");
                       jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                       
                         jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                        // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                         
                         //alert(hoyFormato_mx);
              
                         jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                         //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val('20230513');
                 
                        // jQuery( '.acf-input div[data-name="'+dataName+'"] input' ).prop( "disabled", true );
                        //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input' ).prop( "disabled", true );
              
                         jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).prop( "disabled", true );
                         //alert(montoInteres);
   
                   }    
    

                      




                 }  

                 
          

          
       <?php } ?>
     
 } 

  
}    
  


});


/////fin -pago

             

                      jQuery("#submitdiv").insertAfter("#normal-sortables");
 
               jQuery('a').on('click', function() {
                              //alert("okk");
                                     // jQuery('#preloader').show();
                          });   
                          
                             jQuery('#inicio').on('click', function() {
                              //alert("okk");
                                      //jQuery('#preloader').show('slow');
                          });
                          
                          

});
                  
                 
                 
                 
                 
                          
                          
                          
                          


              jQuery(window).load(function() { // makes sure the whole site is loaded
                              //jQuery('#status').fadeOut(); // will first fade out the loading animation
                              jQuery('#preloader').fadeOut('slow'); // will fade out the white DIV that covers the website.
                              jQuery('body').delay(100).css({'overflow':'visible'});
                          });
                          
                     
                          
</script>

<div style="top: 0px; bottom: 0px; position: fixed; left: 0px; right: 0px; background-color: rgb(255, 255, 255); z-index: 9999;" id="preloader">
<div id="status" style="width: 200px; height: 200px; position: absolute; z-index: 9999; background-position: center center; margin: 100px 0px 0px -100px; background-image: url('https://cocunmx.com/wp-includes/js/tinymce/skins/lightgray/img/loader.gif'); background-repeat: no-repeat; left: 50%; top: 100px;">&nbsp;</div>
</div>



<?php
}


add_action( 'admin_head', 'dashboard_preloader' ); /////////////////////////////////////////////////////////////////////ADD







/*add_filter('parse_query', 'filtro_cuentas_activas');

function filtro_cuentas_activas($query) {
  if (isset($_GET['post_type']) && $_GET['post_type'] == 'miscuentas') {
    if (isset($_GET['cuenta']) && $_GET['cuenta'] == 'activa') {
      $query->query_vars['meta_key'] = 'cuenta';
      $query->query_vars['meta_value'] = 'activa';
      $query->query_vars['meta_compare'] = '=';
      $query->query_vars['post__not_in'] = array(get_the_ID()); // Agrega esta línea
    }
  }
  return $query;
}*/














function custom_js_to_head() {
    
    $idPost = get_the_ID();
    $tituloActual = get_the_title(  $idPost);
    

    
    ?>
    <script>
    jQuery(function(){ 
               

       
       
      var cupo = jQuery('#acf-field_649b3499ae6a4').val() ;
        
        
              jQuery("body #wpadminbar").append('<a id ="inicio" style="margin-left:0px; float: right; " href="https://cocunmx.com/wp-admin/index.php" > <button class="button4" style="padding-left:15px; padding-right:15px;" name="button">Inicio</button></a>');
           
         
             if(jQuery("input[name='acf[field_620f42c159634]']").val()>0 ){ //si ya tiene un monto el boton atras evitan regresar al formulario vacio
                  //window.location.href = 'https://cocunmx.com/wp-admin/edit.php?post_type=gd_place&lst_clnt=1';
                    jQuery('#publish').hide();
                   jQuery("input").prop('disabled', true);
                   jQuery("body #wpadminbar").append('<a id ="atras" style="margin-left:0px; float: right" href="https://cocunmx.com/wp-admin/edit.php?post_type=gd_place&lst_clnt=1" class="page-title-action"> <button class="button4"  style="padding-left:15px; padding-right:15px;" name="button"> Atras </button></a>');
             
                 
             }else
             
                jQuery("body #wpadminbar").append('<a id ="atras" style="margin-left:0px; float: right" href="javascript: history.go(-1)" class="page-title-action"> <button class="button4"  style="padding-left:15px; padding-right:15px;" name="button"> Atras </button></a>');     
         
         
         
         
         
         
        jQuery("body #wpadminbar").append('<a id ="salir" style="margin-left:0px; float: right; " href="https://cocunmx.com/salir.php" > <button class="button4" style="padding-left:15px; padding-right:15px;" name="button">Salir</button></a>');
       
        
         jQuery("body.post-type-miscuentas .wrap h1").append('<a id ="agCliente" style="margin-left:50px" href="https://cocunmx.com/wp-admin/post-new.php?post_type=gd_place" class="page-title-action">Agregar Cliente </a>');
        

         <?php
                     // Asegúrate de tener acceso a las variables $idPost, $tituloActual y $cupo en este contexto.
$add_monto_url = add_query_arg(array(
    'post_type' => 'cliente',
    'idcliente' => $idPost,
    'nombre' => $tituloActual,
    'cupo' => get_field( "Cupo", $idPost), // Asegúrate de que esta variable esté definida y sea segura para usar en una URL.
), admin_url('post-new.php'));

// Genera un nonce para la acción que estás realizando.
$add_monto_nonce = wp_create_nonce('add_monto_action');
// Generar un nonce específico para la creación de un nuevo cliente
$nonce = wp_create_nonce('create_cliente_nonce');
// Crear la URL con el nonce incluido
$url = admin_url('post-new.php?post_type=cliente&_wpnonce=' . $nonce);
// Agrega el nonce a la URL.
//$add_monto_url = add_query_arg('_wpnonce', $add_monto_nonce, $add_monto_url);




         ?>

          //jQuery('#_ajax_linking_nonce').val('');
         //jQuery("body.post-type-gd_place .wrap h1").append('<a id ="agCuenta" style="margin-left:10px;"  href="https://cocunmx.com/wp-admin/post-new.php?post_type=cliente&idcliente=<?php echo $idPost  ?>&nombre=<?php echo $tituloActual ?>&cupo='+cupo+'" class="page-title-action">Agregar Monto</a>');
           
        //jQuery("body.post-type-gd_place .wrap h1").append('<a id="agCuenta" style="margin-left:10px;" href="<?php echo  esc_url($add_monto_url)  ?>" class="page-title-action">Agregar Monto</a>');
            
        //jQuery("body.post-type-gd_place .wrap h1").append('<a id="agCuenta" style="margin-left:10px;" href="<?php echo esc_url($url); ?>"class="page-title-action">Agregar Monto</a>');
        jQuery("body.post-type-gd_place .wrap h1").append(`
    <form id="agCuenta" action="" method="post" style="display: inline;">
    <input type="hidden" name="agCuenta_submitted" value="1">
    <input type="hidden" name="bandf" value="0">
        <button type="submit" style="margin-left:10px;" class="page-title-action">Agregar Monto</button>
    </form>
`);
        // Verifica si estamos en un custom post type "gd_place"
        /*if (jQuery('body').hasClass('post-type-gd_place')) {
        // Guarda los valores PHP en localStorage
        localStorage.setItem('cupo', '<?php echo get_field( "Cupo", $idPost); ?>');
        localStorage.setItem('tituloActual', '<?php echo esc_js($tituloActual); ?>');
        localStorage.setItem('idPost', '<?php echo esc_js($idPost); ?>');
        }*/




         // Verifica si estamos en un custom post type "cliente"
    /*if (jQuery('body').hasClass('post-type-cliente')) {
        // Modifica el valor del campo post_title
        //jQuery('input[name="post_title"]').val('<?php echo  $tituloActual ?>'); // Cambia 'Nuevo título' por el valor deseado

        // Modifica el valor del campo acf-acf[field_6371dda213f5d]
        //jQuery('input[name="acf-acf[field_6371dda213f5d]"]').val('<?php echo   $idPost ?>'); // Cambia 'Nuevo valor' por el valor deseado

       // Recupera los valores de localStorage
       var tituloActual = localStorage.getItem('tituloActual');
        var idPost = localStorage.getItem('idPost');

        // Verifica si los valores existen antes de asignarlos
        if (tituloActual !== null && idPost !== null) {
            // Asigna los valores recuperados a los campos
            jQuery('input[name="post_title"]').val(tituloActual);
            jQuery('input[name="acf[field_6371dda213f5d]"]').val(idPost);
        }
    }*/



      


          
               
        <?php 
           

                  // Verifica si el formulario ha sido enviado
if (isset($_POST['agCuenta_submitted']) && $_POST['agCuenta_submitted'] == '1') {
    // Reemplaza $tituloActual y $idPost con los valores que necesites
    //$tituloActual = "Título del post";
    //$idPost = 1;
    
     // echo "alert(".get_field( "Cupo", $idPost).");";

                

            // Verificar si el campo "Cupo" tiene un valor mayor a 0 en el post type "gd_place" con la ID $idPost
    $cupo_autorizado = false;
    $cupo_place =  intval(get_field( "Cupo", $idPost));
    if ($cupo_place > 0) { 
        $cupo_autorizado = true;
    } else {
        // Agregar una acción que mostrará el mensaje de error en el panel de administración
          

        ?>
    
           alert('Se requiere autorizar cupo por administrador');
       
   
     
     
        <?php
    }
    
    // Crear un nuevo post en el post type "cuenta" como borrador si el cupo está autorizado
    if ($cupo_autorizado) {

           // Verificar si ya existe un post con el meta valor 'id_lista_cliente' igual a $idPost
$args = array(
    'post_type'      => 'cliente',
    'post_status'    => 'any',
    'meta_key'       => 'id_lista_cliente',
    'meta_value'     => $idPost,
    'posts_per_page' => 1
);

$existing_posts = get_posts($args);

if ($existing_posts) {
    // Si existe, redireccionar al post existente
    $existing_post_id = $existing_posts[0]->ID;
    // Obtener el valor de la meta 'monto_cliente'
    $monto_cliente = get_post_meta($existing_post_id, 'monto_cliente', true);
    $edit_post_url = get_edit_post_link($existing_post_id);
    $edit_post_url = html_entity_decode($edit_post_url);

    // Verificar si 'monto_cliente' es mayor a 0, entonce se el crea una nueva cuenta
    if ($monto_cliente > 0) {

             // Crear un nuevo post de tipo 'gd_place' con el título $tituloActual
    $gd_place_post = array(
        'post_title'  => $tituloActual,
        'post_type'   => 'gd_place',
        'post_status' => 'publish' // O 'draft' si quieres que sea un borrador
    );

    // Insertar el post en la base de datos y obtener la ID del nuevo post
    $gd_place_post_id = wp_insert_post($gd_place_post);

          
        $new_post = array(
            'post_title'    => $tituloActual,
            'post_type'     => 'cliente',
            'post_status'   => 'draft', // Publicar inicialmente como borrador
            'meta_input'    => array(
                'id_lista_cliente' => $gd_place_post_id 
            )
        );
    
            
    // Insertar el nuevo post en la base de datos y obtener el ID del nuevo post
   //wp_insert_post($new_post);
   $new_post_id = wp_insert_post($new_post);
    // Verificar si el post se creó correctamente
   
        // Construir la URL para editar el nuevo post
        $edit_post_url = admin_url('post.php?post=' . $new_post_id . '&action=edit');

        // Redirigir al usuario a la página de edición del nuevo post
        //wp_redirect($edit_post_url);
        ?>
    
         //alert('<?php echo $edit_post_url; ?>');
         window.location.href = '<?php echo $edit_post_url; ?>';

       
       
      <?php
    }
     else
     {
         ?>
        //alert('<?php echo $edit_post_url; ?>');
         window.location.href = '<?php echo $edit_post_url; ?>';

          <?php
     }
    
   } else  {


        $new_post = array(
            'post_title'    => $tituloActual,
            'post_type'     => 'cliente',
            'post_status'   => 'draft', // Publicar inicialmente como borrador
            'meta_input'    => array(
                'id_lista_cliente' => $idPost
            )
        );
    
            
    // Insertar el nuevo post en la base de datos y obtener el ID del nuevo post
   //wp_insert_post($new_post);
   $new_post_id = wp_insert_post($new_post);
    // Verificar si el post se creó correctamente
   
        // Construir la URL para editar el nuevo post
        $edit_post_url = admin_url('post.php?post=' . $new_post_id . '&action=edit');

        // Redirigir al usuario a la página de edición del nuevo post
        //wp_redirect($edit_post_url);
        ?>
    
         //alert('<?php echo $edit_post_url; ?>');
         window.location.href = '<?php echo $edit_post_url; ?>';

       
       
      <?php
       }
     
    }





    
    }









            
                $idPostC = get_the_ID();
                $tituloActualC = get_the_title(  $idPostC);
                
              $idActorActu =  get_current_user_id();
              
             
              
         
             
                    //global $lastid; 
        
 if (isset($_GET['post_type']) && $_GET['post_type'] == 'cliente' && $_GET['bandf']==1){
                  
              
                   
                
                 global $wpdb;
                 $table = $wpdb->prefix.'geodir_gd_place_detail';
                 $table_posts = $wpdb->prefix.'posts';

                 $result = $wpdb->get_results( "SELECT * FROM wp_geodir_gd_place_detail WHERE post_id=".$_GET['idcnta']);
                 
                 forEach($result as $r){
                     
                      $city =  $r->city;
                      $street =       $r->street;
                      $street2 =  $r->street2;
                      $country =   $r->country;
                      $latitude =  $r->latitude;
                      $longitude =  $r->longitude;
                      
                      }
                
              
              

                 $format = array('%s','%d');
              
                    //$id_posts = 
                      $hoy_bd = date('y-m-j,h-i-s '); 
           
          if($_GET['bandf']==1){
                      
                     
                          //se crea el post
                       $data_post = array('post_title' => $_GET['nombre'], 'post_author' =>  $idActorActu, 'post_date' =>  $hoy_bd, 'post_type' => "gd_place", 'post_status' => "publish");  
                     
                       $wpdb->insert($table_posts,$data_post ,$format);
                       $lastid = $wpdb->insert_id;
            
                         // se crea en GD directory
                     $data = array('post_title' => $_GET['nombre'], 'post_id' => $lastid,'post_status' => NULL, 'post_category' => ",9,", 'default_category' => "9",'city' =>  $city, 
                     'street' =>  $street, 'street2' =>  $street2, 'country' =>  $country, 'latitude' =>  $latitude,  'longitude' =>  $longitude);  
                     $wpdb->insert($table,$data,$format);
               
          }
    
               ?>
                   jQuery("#acf-field_6371dda213f5d").val(<?php echo $lastid;  ?>); 
                   
                   jQuery("#title").val('<?php echo  $_GET['nombre'];  ?>');  
                   
                  // jQuery("#submitdiv").css("display","none");
                   
                   
                   
                   //actulizacion en  base de datos al crear una "nueva cuenta"
                    jQuery("#publish").click(function(e){

                             e.preventDefault();
                            jQuery("#post").submit();
    
                     });
      
                <?php
                          
       
            
      } 
      
      
      
                     
                             global $wpdb;
                             $table_name = $wpdb->prefix.'geodir_gd_place_detail';
                               //$table_name_post = $wpdb->prefix.'posts';

                               $data_update = array('post_status' => "publish");
                               //$data_update_posts = array('post_type' => "gd_place", 'post_status' => "publish");
    
                              $data_where = array('post_id' => $lastid);
                              //$data_where_posts = array('ID' => $lastid);  
                              
                              ///ajustar aqui
                               
                                        // echo "alert(".$lastid.");";
                             // se actualiza el posr de geo directory
                             $wpdb->update($table_name , $data_update, $data_where);
                              
                              // se actualiza el post de wordpress
                             //$wpdb->update($table_name_post, $data_update_posts, $data_where_posts);

                  
                 // ID de la cuenta para Cancelar y eliminar
                     $url = $_SERVER["REQUEST_URI"];
                 $idurl = substr($url, 24, -12);
                 
                 $index = explode("?", $url);
               
          
            // cpndicion y consulta para elimininar cuentas que no se rellenaron
        if($index[0]=="/wp-admin/index.php" || $url== "/wp-admin/edit.php?post_type=gd_place"){
                       //echo 'alert("okok");';
                 
      
           
         
                 global $wpdb;
                 $tableD = $wpdb->prefix.'geodir_gd_place_detail';
                 $table_postsD = $wpdb->prefix.'posts';
                 $null ='';
                 $resultD = $wpdb->get_results( "SELECT * FROM wp_geodir_gd_place_detail WHERE post_status IS NULL");
                 
                 forEach($resultD as $rD){
                     
                      $post_id_d =  $rD->post_id;
                      $wpdb->delete( $table_postsD, array( 'id' => $post_id_d  ) );
                      
                      
                      //echo "alert(".$post_id_d.");";
                      
                        
                   
                      }
          
          
          
                  }
          
                  


            // accion para eliminar cuentas incompletas
         if($_GET["cancelar"]==1){

             
             global $wpdb;
                             $table_name = $wpdb->prefix.'geodir_gd_place_detail';
                               $table_name_post = $wpdb->prefix.'posts';
                           
                $wpdb->delete( $table_name_post, array( 'id' => $_GET["idcntac"] ) );
                 $wpdb->delete( $table_name, array( 'id' => $_GET["idcntac"] ) );
                
             
         }



          ?>  
              //guar nueva cuenta
             //jQuery("body.post-type-cliente .wrap h1").append('<a id ="guardarCuenta" class="button button-primary button-large" style="margin-left:10px; display:"  href="https://cocunmx.com/wp-admin/edit.php?post_type=gd_place&cancelar=1&idcntac=<?php echo $lastid?>" class="page-title-action">Publicar</a><br><br>');
                //btn cancelr cuenta
             //jQuery("body.post-type-cliente .wrap h1").append('<a id ="cancelarCuenta" style="margin-left:10px; display:"  href="https://cocunmx.com/wp-admin/edit.php?post_type=gd_place&cancelar=1&idcntac=<?php echo $lastid?>" class="page-title-action">Cancelar</a><br><br>');
           
            //jQuery("body.post-type-gd_place .wrap h1").append('<a id ="agNvCuenta" style="margin-left:10px; display: none"  href="https://cocunmx.com/wp-admin/post-new.php?post_type=cliente&nombre=<?php echo $tituloActualC ?>&bandf=1&idcnta=<?php echo $idurl ?>&idcliente=<?php echo $idurl ?>&cupo='+cupo+'" class="page-title-action">Nueva Cuenta</a><br><br>');
         
                                                                                                                    
             jQuery("body.post-type-gd_place .wrap h1").append(`
             <form id="agNvCuenta" action="" method="post" style="display: inline;">
                 <input type="hidden" name="agCuenta_submitted" value="1">
    
                <input type="hidden" name="bandf" value="0">
                     <button type="submit" style="margin-left:10px;" class="page-title-action">Agregar Cuenta</button>
                 </form>
             `);
          <?php  
      

      
                 
           $id_author_actual_p = get_current_user_id(); //id usuario actual
    
    
       
       //listado de clientes (post: gd_place )/ cuentas (post: clientes) / pagos diarios (post: miscuentas)
       
       
       
           $argsCliente = array( 'post_type' =>'cliente' , 'author' =>  $id_author_actual_p, 'posts_per_page' => -1);
           $post_cliente = wp_get_recent_posts($argsCliente, OBJECT);

           $ok =0;
           $idPostListaCliente = $idPost;  // post actual
             $idPostPagos=0;                                
         
              //print array
                 
                  
 
             
                foreach( $post_cliente as $cliente ){  //recorre cuentas post: cliente

                     

                       $clienteID = $cliente->ID;
                      
             
                       
                     $idcta = get_field( "id_lista_cliente", $clienteID);
                                       
                     ?> //alert(<?php echo      $idcta ; ?>); <?php 
                             //si esta registrado la ID de post: gd_place dentro de Cuentas (post: cliente)
          
                       if(   $idPostListaCliente == $idcta  ){       
                                $ok=1;
                                $idPostPagos  = $clienteID;
                                $idbtnpagos=0;
                                
                                            $argsMisctas = array( 'post_type' =>'miscuentas' , 'author' =>  $id_author_actual_p, 'posts_per_page' => -1);
                                            $postMisctas = wp_get_recent_posts( $argsMisctas, OBJECT);
                                             
                                                                      foreach(  $postMisctas as $misctas ){  //recorre cuentas post: cliente

        
                                                                        $misctasID = $misctas->ID;
                                                                    
                                                                        
                                                                         $idmisctas = get_field( "id_cliente_cuenta", $misctasID);
                                                                         
                                                                              ?> //alert(<?php echo      $clienteID."lll".$idmisctas; ?>); <?php
                                                                            
                                                                          //si esta registrado la ID de post:cliente (cuentas) dentro de post:miscuentas (pagos diarios)
                                                                         
                                                                                  if(   $clienteID ==  $idmisctas ){
                                                                                      
                                                                                      
                                                                                      
                                                                                      $idbtnpagos=$misctasID;
                                                                                         
                                                                                          
                                                                                      
                                                                                  }
                                                                                else{
                                                                                    
                                                                                       ?>
           
                                                                             
           
                                                                                            <?php
                                                                                }
                                                                                
                                                                         
                                                                         
                                
                                                                      }
                            

                           }
                                 
                
                  
                            
           
               }
               
         
         ?>
         
        
         
         
            //jQuery("body.post-type-cliente .wrap h1").append('<a id ="agPago" style="margin-left:50px"  href="https://cocunmx.com/wp-admin/post.php?post=<?php echo  $idPostPagos;  ?>&action=edit" class="page-title-action">Agregar Pagos</a>');
            
             
             
             <?php  if (isset($_GET['post_type']) && $_GET['post_type'] == 'miscuentas'){  ?> 
              jQuery("body.post-type-miscuentas .wrap h1").append('<br> <span style = "color: green; font-size:15px">-->Haz clic el triangulos verdes para  detalles</span> <br> <span style = "color: green; font-size:18px"><strong>Elige a que cuenta quieres agregar pagos</strong></span>');
              
              const params = new URLSearchParams(window.location.search);
    const hayBusqueda = params.has('s');

    if (hayBusqueda) {
        jQuery('table.wp-list-table tbody tr').each(function() {
            let $row = jQuery(this);

            let estadoPago = $row.find('td').eq(8).text().trim();  
            let cuenta = $row.find('td').eq(12).text().trim().toLowerCase();

            if (estadoPago !== '' && cuenta === 'activa') {
                $row.hide(); // Oculta la fila
            }
        });
    }
              
              
              
              <?php }  ?>
              
            
              <?php  

              
              if($idbtnpagos>0){  

                  
                  ?> 

              //jQuery("body.post-type-gd_place .wrap h1").append('<a id ="aagPago" style="margin-left:50px"  href="https://cocunmx.com/wp-admin/post.php?post=<?php echo $idbtnpagos ;  ?>&action=edit" class="page-title-action">Agregar Pagos</a>');
               jQuery("body.post-type-gd_place .wrap h1").append('<a id ="aagPago" style="margin-left:50px; display:none;"  href="https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=asc&s=<?php echo $tituloActual   ?>&post_status=all&post_type=miscuentas" class="page-title-action">Agregar Pagos</a>');
              jQuery( "#agCuenta" ).css( "display", "none" );
               //jQuery( "#agNvCuenta" ).css( "display", "inherit" );
              
            <?php }  else {  ?>
                jQuery( "#agNvCuenta" ).css( "display", "none" ); //30/04/24
                         //jQuery("body.post-type-gd_place .wrap h1").append('<span style = "color: red; font-size:15px">Importante!</span> <span style = " font-size:15px">Recuerda agregar una cuenta al finalizar el registro de cada cliente para poder ingresar sus pagos diarios</span>');
                
            <?php } ?>
            
        
        <?php 
        
        
        
                                       if (isset($_GET['post_type']) && $_GET['post_type'] == 'gd_place'   ) {
    
                ?>
                       
                              
                             // alert("okok");
                             
                                    //$("#campotexto").attr("type")
                                     jQuery(" #the-list .title .row-actions span.edit a").text('Ver Cuentas');
                                     jQuery( "#agNvCuenta" ).css( "display", "none" );
                                    // jQuery("a").attr("href","https://cocunmx.com/wp-admin/post.php?post=<?php echo  $clienteID;  ?>&action=edit");

                             
                                         
                          
    
                     <?php 
    
                  }
        
        
        
        
        ?>
        
        
        
        
        
          //jQuery("body.post-type-gd_place .wrap h1").append('<a id ="verCuenta" style="margin-left:10px;  margin-top:20px"  href="https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=asc&s=<?php echo $tituloActual   ?>&post_status=all&post_type=miscuentas" class="page-title-action">Ver Cuentas</a>');
          jQuery("body.post-type-gd_place .wrap h1").append('<a id="verCuenta" style="margin-left:10px; margin-top:20px" href="https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=asc&s=<?php echo $tituloActual ?>&post_status=all&post_type=miscuentas&ac-rules=%7B%22condition%22%3A%22AND%22%2C%22rules%22%3A%5B%7B%22id%22%3A%2264a4aa61656040%22%2C%22field%22%3A%2264a4aa61656040%22%2C%22type%22%3A%22string%22%2C%22input%22%3A%22text%22%2C%22operator%22%3A%22equal%22%2C%22value%22%3A%22activa%22%7D%5D%2C%22valid%22%3Atrue%7D&layout=6214a7938be8a&action=-1&paged=1&action2=-1" class="page-title-action">Ver Cuentas</a>');

          
          
       

        
          /*jQuery("body.post-type-miscuentas .wrap h1").append('<a id ="agCuenta" style="margin-left:50px"  href="https://cocunmx.com/wp-admin/post-new.php?post_type=cliente" class="page-title-action">Agregar Nueva Cuenta</a>');*/
          
          
            /*jQuery("body.post-type-cliente .wrap h1").append('<a id ="verCuenta" style="margin-left:50px"  href="https://cocunmx.com/wp-admin/edit.php?post_type=cliente" class="page-title-action">Ver Cuentas</a>');*/
        




        
        
    });
    </script>
    <?php
}

add_action('admin_head', 'custom_js_to_head');  ////////////////////ADD



    
   // global  $user_iid;
   
   
   
   
 
   
   
   
   
   
   
   
   function lista_usuarios()
{
   
         
          $user_current_iid_ = get_current_user_id();
          
          $_SESSION["usuario_anterior"]=$user_current_iid_;
         $paged = $_GET["paged"];
         $idlistuser = $_GET["id"];
      
          
             	  ?>
             	  
             	  
                             <script type="text/javascript">
                             
                            // window.onbeforeunload = null;
                              
                               jQuery(document).ready(function() {
                                 
                                 
                                  var pathname =  jQuery(location).attr('href');
                                   var paged = '<?php echo  $paged ?>';
                                   var idlistuser =  '<?php echo  $idlistuser ?>';
                                   
                                  jQuery(document).ready(function() {
                                    jQuery('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">');
                                  });
                                 
                                 //para ver solo sus cobradores dado de alta
                                 
                                  jQuery("#acf-field_647108780ae81").val(<?php echo  $user_current_iid_ ?>);
                             
                           
                               
                              
                             
                               
                             });
                           
                             </script>
    
                <?php
          
             
    
}
   
add_action('admin_head', 'lista_usuarios');
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    
  function redirect_after_logout() {
      	  ?>
                             <script type="text/javascript">
                              
                               
                              document.cookie = "PHPSESSID=;Path=/cv;expires=Thu, 01 Jan 1970 00:00:01 GMT;"; 

                             </script>
    
                             <?php
      	
      
      		                    if( $_SESSION["esAdmin"]==null |$_SESSION["esAdmin"]==2){	
      		                  
      		    	            ?>
                                          <script type="text/javascript">
                                            //alert("sin session ");
                               
                                         window.location.reload();
                           
                                      </script>
    
                             <?php
      
				               $_SESSION["esAdmin"]=3;
		 
				
				                   $user_current_iid = get_current_user_id();
                                    
                                     
                                     $blogusers = get_users( array( 'role__in' => array( 'author', 'admin_aux' ) ) );
                                         // Array of WP_User objects.
                                      foreach ( $blogusers as $user ) {
                                          
                                          
                                            $admin_aux_id =   $user->id;
                                               
                                               
             
                                        if( $user_current_iid !=   $admin_aux_id ){
                                             
                          
                                                  $user_admin_aux  = new WP_User($admin_aux_id);
                                              
                                                // Remove role
                                                   $user_admin_aux  ->remove_role( 'admin_aux' );

                                               // Add role
                                                  $user_admin_aux  ->add_role( 'cobranza' );
                                           
                                          }    
                                               
                                               
                                               
                                  }
				
			}
    
    
         
     
     
    }
 add_action('admin_footer','redirect_after_logout');   ////////////////////ADD
 




//apply_filters( "edit_{$post_type}_per_page", int $posts_per_page )




function modify_edit_post_type_per_page_defaults($posts_per_page) { 

    // Update the $posts_per_page variable according to your website requirements and return this variable. You can modify the $posts_per_page variable conditionally too if you want.

    return $posts_per_page; 
}
// add the filter
add_filter( "edit_cliente_per_page", "modify_edit_post_type_per_page_defaults", 200, 1 );


function disable_unload_alert() {
    wp_dequeue_script( 'wp-beforeunload-js' );
}
add_action( 'admin_enqueue_scripts', 'disable_unload_alert' );



///ejecuta el reporte diario de forma automatico ///////////////
function my_login_redirect( $redirect_to, $request, $user ) {
    // Si el inicio de sesi��n fue exitoso, ejecuta la URL
    
    if ( isset($user->ID) ) {
        
        // Comprueba si la URL ya se ha ejecutado para este usuario
        $has_run = get_user_meta( $user->ID, 'my_url_has_run', true );
        
        if ( ! $has_run ) {
            
                wp_remote_get('https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=desc&post_status=all&post_type=reporte_diario&ac-rules=%7B%22condition%22%3A%22AND%22%2C%22rules%22%3A%5B%7B%22id%22%3A%22date%22%2C%22field%22%3A%22date%22%2C%22type%22%3A%22date%22%2C%22input%22%3A%22text%22%2C%22operator%22%3A%22date_today%22%2C%22value%22%3Anull%7D%5D%2C%22valid%22%3Atrue%7D' );
               // Marca la URL como ejecutada para este usuario
               update_user_meta( $user->ID, 'my_url_has_run', true );
            
        }
        
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );






function redirect_to_specific_page() {
    if ( is_page( 'diario' ) && $_SERVER['HTTP_HOST'] == 'cocunmx.com' ) {
        
        wp_redirect( 'https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=desc&post_status=all&post_type=reporte_diario&ac-rules=%7B%22condition%22%3A%22AND%22%2C%22rules%22%3A%5B%7B%22id%22%3A%22date%22%2C%22field%22%3A%22date%22%2C%22type%22%3A%22date%22%2C%22input%22%3A%22text%22%2C%22operator%22%3A%22date_today%22%2C%22value%22%3Anull%7D%5D%2C%22valid%22%3Atrue%7D', 301 );
        exit;
    }
}
add_action( 'template_redirect', 'redirect_to_specific_page' );







function mostrar_solo_admins( $query ) {
    
    
    if ( ! is_admin() ) {
        return;
    }
    
    $current_user = wp_get_current_user();
$roles = $current_user->roles;


// Mostrar los roles del usuario actual
foreach ( $roles as $role ) {
   // echo $role;
}

  
  if($role =="super_admin"){

    $screen = get_current_screen();
    if ( $screen->id !== 'users' ) {
        return;
    }

    $query->set( 'role', 'admin' );
  }
  
  
  
  
    if($role =="admin"){
                      

    $screen = get_current_screen();
    if ( $screen->id !== 'users' ) {
        return;
    }

    $query->set( 'role', 'cobranza' );
  }
  
  
  if($role =="admin_aux"){
                             

    $screen = get_current_screen();
    if ( $screen->id !== 'users' ) {
        return;
    }

    $query->set( 'role', 'cobranza' );
    
                           
             	              
    
  }
  
  
  
  
}


add_action( 'pre_get_users', 'mostrar_solo_admins' );


//eliminar el menus usuario para admin_aux

add_action('admin_menu', 'remove_user_menu_for_admin_aux');

function remove_user_menu_for_admin_aux() {
    // Obt��n el usuario actualmente conectado
    $current_user = wp_get_current_user();

    // Si el rol del usuario es 'admin_aux', oculta el men�� de usuarios
    if (in_array('admin_aux', $current_user->roles)) {
        remove_menu_page('users.php');
    }
}


//ver usarios creados por cada usuario

add_action('pre_get_users', 'filter_users_by_creator');

function filter_users_by_creator($query) {
    // Obt��n el ID del usuario actualmente conectado
    $current_user_id = get_current_user_id();

    // Si el usuario actualmente conectado es un administrador, no filtres la lista de usuarios
    /*if (current_user_can('administrator')) {
        return;
    }*/


$meta_value = get_user_meta($current_user_id, 'autor_usuario', true);

// Imprime el valor del meta key
/*echo 'El valor del meta key "autor_usuario" para el usuario actualmente conectado es: ' . $meta_value;*/


    // Establece el par��metro 'meta_key' en 'acf-field_647108780ae81'
    $query->set('meta_key', 'autor_usuario');

    // Establece el par��metro 'meta_value' en el ID del usuario actualmente conectado
    $query->set('meta_value', $current_user_id);
}










function modify_admin_bar( $wp_admin_bar ) {
    
    
      
    $current_user = wp_get_current_user();
$roles = $current_user->roles;


// Mostrar los roles del usuario actual
foreach ( $roles as $role ) {
   // echo $role;
}

  
  if($role =="admin_aux"){
      
        $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Bienvenido,', '<strong>  Estas como administrador en la cuenta de:</strong>', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );


  }
  
    if($role =="admin"){
      
        $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Bienvenido,', 'Administrador:', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );


  }
  
    
    

    
    
}
add_filter( 'admin_bar_menu', 'modify_admin_bar', 25 );

$fecha_corte_global = null;

function abonar($post_id, $post, $update) {

    global $fecha_corte_global;
         // Establece una bandera en la sesión para saber que la función abonar se ha ejecutado
    if (!session_id()) {
        session_start();
    }
    $_SESSION['abonar_ejecutado'] = true;


    // Verificar si la acción es actualizar y si es del tipo de post adecuado.
    if ($update && $post->post_type === 'miscuentas') {
        error_log('La función abonar se ejecutó al guardar un post.');

        $idPost = $post_id;
        $id_author_actual_sa = get_current_user_id(); // ID del usuario actual
        $titulo = get_the_title($idPost);
        $abonoInicial = get_field("abono", $idPost);
        $suma_abonado = 0;
        
              // Primera consulta para obtener el post más reciente con cubrePagos >= 1
$args_cubre_pagos = array(
    'post_type' => 'abono',
    'posts_per_page' => 1,
    'author' => $id_author_actual_sa,
    'meta_query' => array(
        array(
            'key' => 'id_cliente',
            'value' => $idPost,
            'compare' => '='
        ),
        array(
            'key' => 'cubrePagos',
            'value' => 1,
            'compare' => '>='
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC'
);

$cubre_pagos_query = new WP_Query($args_cubre_pagos);
$fecha_corte = '';

if ($cubre_pagos_query->have_posts()) {
    $cubre_pagos_query->the_post();
    $fecha_corte = get_the_date('Y-m-d H:i:s'); // Obtener la fecha del post más reciente con cubrePagos >= 1
    $fecha_corte_global  = $fecha_corte ;
    error_log("Fecha de corte: $fecha_corte");
}






wp_reset_postdata(); // Restablecer la consulta global de postdata
    

   if( $fecha_corte!=null){ 

// Segunda consulta para sumar los abonos de los posts publicados después del post  mas reciente con cubrePagos >= 1
$args_abonos = array(
    'post_type' => 'abono',
    'posts_per_page' => -1, // Obtener todos los posts //oroiginl -1
    'author' => $id_author_actual_sa,
    'meta_query' => array(
        
        //ajuste 010824
        array(
            'key' => 'id_cliente',
             'value' => $idPost,
             'compare' => '='
           ),
        //

        array(
            'key' => 'cubrePagos',
            'value' => 0,
            'compare' => '='
        )
    ),
    'date_query' => array(
        array(
            'after' => $fecha_corte, // Solo obtener posts después de la fecha de corte
            'inclusive' => true // Incluir el post en la fecha de corte
        )
    ),
    'orderby' => 'date',
    'order' => 'ASC' // Orden ascendente para sumar desde el más antiguo al más reciente
);

$abonos_query = new WP_Query($args_abonos);

   // si existe un post reciente con cubrePagos >= 1 ahora se hace la suma de los abonos después de este post
if ($abonos_query->have_posts()) {
    while ($abonos_query->have_posts()) {
        $abonos_query->the_post();
        
       $suma_abonado += get_field('abono');  //aqui estaba la problem, agarrba valores de otros ide clientes
       
      
    }

    wp_reset_postdata();
} 

}     
        else {    // si No se encontro ningun poste reciente con cubrePagos >= 1, sumar todos los abonos
           
                      // Consulta para obtener todos los abonos con cubrePagos = 0
            $args_abonos_cubre_pagos_cero = array(
               'post_type' => 'abono',
               'posts_per_page' => -1, // Obtener todos los posts
                 'author' => $id_author_actual_sa,
                  'meta_query' => array(
                      array(
                         'key' => 'id_cliente',
                          'value' => $idPost,
                          'compare' => '='
                        ),
                        array(
                          'key' => 'cubrePagos',
                          'value' => '0',
                           'compare' => '='
                            )
                    ),
                    'orderby' => 'date',
                    'order' => 'ASC'
               );

             $abonos_cubre_pagos_cero_query = new WP_Query($args_abonos_cubre_pagos_cero);


if ($abonos_cubre_pagos_cero_query->have_posts()) {
    while ($abonos_cubre_pagos_cero_query->have_posts()) {
        $abonos_cubre_pagos_cero_query->the_post();
        $suma_abonado += get_field('abono');
    }

    
}
        }
        wp_reset_postdata(); // Restablecer la consulta global de postdata

        



        // Sumar el abono inicial al total acumulado
        $suma_abonado += $abonoInicial;

        // Obtener el valor de la cuota del cliente asociado con el post de tipo 'miscuentas'
        $id_cliente_cuenta = get_field("id_cliente_cuenta", $idPost);
        $valor_cuota_cliente = get_field("valor_cuota_cliente", $id_cliente_cuenta);

        // Calcular el valor de cubrePagos y saldoAbono
        $cubrePagos = 0;
        $saldoAbono = 0;
        if ($valor_cuota_cliente > 0 && $suma_abonado > 0) {
          
            $cubrePagos = intval($suma_abonado / $valor_cuota_cliente);

               // Obtener el cociente de la división
               $cociente = $suma_abonado / $valor_cuota_cliente;

               // Calcular el resto basado en el cociente redondeado
                $resto = ($cociente - $cubrePagos)*$valor_cuota_cliente ;
               
                  // Redondear el resto a dos dígitos decimales
               $saldoAbono = round($resto, 2);

           // $saldoAbono = fmod($suma_abonado, $valor_cuota_cliente);
        }


        


        // Insertar abonos que no cubren cuotas
        if (  $cubrePagos == 0 & $abonoInicial>0) {
        $post_id_abono = wp_insert_post(array(
            'post_type' => 'abono',
            'post_title' => $titulo,
            'post_content' => $titulo,
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        ));

        if ($post_id_abono) {
            update_post_meta($post_id_abono, 'abono', $abonoInicial);
            update_post_meta($post_id_abono, 'id_cliente', $idPost);
            update_post_meta($post_id_abono, "cubrePagos",  0);
            update_post_meta($post_id_abono, "saldoDeAbono", 0);
            update_post_meta($post_id_abono, "total_saldo", $suma_abonado); 
        
           
        }
       }  
       

       
       
        // Insertar abonos que SI cubren cuotas
        if (  $cubrePagos >=1) {
            $post_id_abono = wp_insert_post(array(
                'post_type' => 'abono',
                'post_title' => $titulo,
                'post_content' => $titulo,
                'post_status' => 'publish',
                'comment_status' => 'closed',
                'ping_status' => 'closed',
            ));
    
            if ($post_id_abono) {
                update_post_meta($post_id_abono, 'abono', $abonoInicial);
                update_post_meta($post_id_abono, 'id_cliente', $idPost);
                update_post_meta($post_id_abono, "cubrePagos",  $cubrePagos);
                update_post_meta($post_id_abono, "saldoDeAbono", $saldoAbono);
                update_post_meta($post_id_abono, "total_saldo", $suma_abonado);
                //update_post_meta($post_id_abono, "cubrePagos",  $fecha_corte_global);
            }

                //actulizar
                update_field("cubrePagos",$cubrePagos , $idPost); //es activa el
                update_field("abono",0 , $idPost);
           } 

               //inserccion de SALDOS
             //  $cubrePagos >= 1 && $saldoAbono > 0 Si cubrePagos es mayor o igual a 1, insertar el saldo como un nuevo abono
        if ( $cubrePagos >= 1 && $saldoAbono > 0) {
            $post_id_saldo_abono = wp_insert_post(array(
                'post_type' => 'abono',
                'post_title' => $titulo . ' - Saldo',
                'post_content' => $titulo . ' - Saldo de abono',
                'post_status' => 'publish',
                'comment_status' => 'closed',
                'ping_status' => 'closed',
            ));

            if ($post_id_saldo_abono) {
                update_post_meta($post_id_saldo_abono, 'abono', $saldoAbono);
                update_post_meta($post_id_saldo_abono, 'id_cliente', $idPost);
                update_post_meta($post_id_saldo_abono, "cubrePagos", 0); // Saldo no cubre pagos completos
                update_post_meta($post_id_saldo_abono, "saldoDeAbono", 0); // No hay saldo restante
                update_post_meta($post_id_saldo_abono, "total_saldo", $saldoAbono);
            }

             // Actualizar el campo suma_abonado con el $saldoAbono
              update_field("suma_abonado", round($saldoAbono, 2), $idPost);
              update_field("cubrePagos",$cubrePagos , $idPost);
              update_field("abono",0 , $idPost);
              
        }else{
        // Actualizar el campo suma_abonado con el total de abonos
        update_field("suma_abonado", round($suma_abonado, 2), $idPost);
        update_field("abono",0 , $idPost);
     
          }
        // Restablecer la consulta global de WordPress
        wp_reset_postdata();


                       
    

        
       

        
    }
      
   

}
add_action('save_post', 'abonar', 10, 3);


function imprimir_fecha_corte_js() {
   
    ?>
    <script>
        // alert("okok2024");
         var fechaCort = '<?php echo $fecha_corte_global; ?>';
         alert("La fecha de corte es: " + fechaCort);
        
    </script>
    <?php
}
//add_action('admin_head', 'imprimir_fecha_corte_js');

function btn_abonar(){
    
    
    $current_post_id = get_the_ID(); // Obtener el ID del post actual

      if ($current_post_id) {
    $post_type = get_post_type($current_post_id); // Obtener el tipo de post

      
    $idPost = get_field( "id_cliente_cuenta",  get_the_ID());

$valor_cuota = get_field( "valor_cuota_cliente",  $idPost);
$num_pagos =   get_field( "cuotas_cliente", $idPost)*2;

 $user_id = get_current_user_id();   
 $fecha_presta = get_the_date("d/m/Y", $idPost);
 $finaliza_presta = get_field( "fecha_terminar",  $idPost);
 $total_pagos_ = get_field( "total_pagos", get_the_ID());
 $abonos_tot_ = get_field( "suma_abonado", get_the_ID());
 $mont_cuenta_ = get_field( "monto_cuenta", get_the_ID()); 
     





    // Verificar si el post actual es del tipo 'miscuentas'
    if ($post_type === 'miscuentas') {
        
        
                
                ?>
               <script type="text/javascript">

                //var valor_Cuota = '<?php echo $valor_cuota; ?>';
                //var abonoss_tot = '<?php echo $abonos_tot_; ?>';
                //var pagosConAbonos = '<?php echo $total_pagos_+$abonos_tot_; ?>';
                var pagoRestante_ = parseFloat('<?php echo ($mont_cuenta_) - ($total_pagos_ + $abonos_tot_); ?>');


                   jQuery(document).ready(function() {
    

           
                    

              
    
           jQuery("#acf-group_636415e032473 .inside").append('<input type="submit" name="save" id="publish" style="margin-bottom:30px;" class="button button-primary button-large" value="Abonar">');
       
                                                                 
                                                                                                                       
         jQuery("#acf-group_636415e032473 .inside").append('<a id ="" style="margin-left:0px; margin-top:30px;"  href="https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=asc&s&post_status=all&post_type=abono&ac-rules=%7B%22condition%22%3A%22AND%22%2C%22rules%22%3A%5B%7B%22id%22%3A%2263644de84872b0%22%2C%22field%22%3A%2263644de84872b0%22%2C%22type%22%3A%22double%22%2C%22input%22%3A%22number%22%2C%22operator%22%3A%22equal%22%2C%22value%22%3A%22<?php echo 	 $current_post_id;   ?>%22%7D%5D%2C%22valid%22%3Atrue%7D" class="page-title-action">Ver Abonos</a>');
    
         jQuery( "#acf-group_636415e032473" ).addClass( "closed" );
         jQuery( "#acf-group_636d805ba2c3e" ).addClass( "closed" );
    
   
    
   
    
    
    
                       });

                </script>   
 
             <?php 
        
        
      } 
 }

    
    

}

add_action('admin_head', 'btn_abonar');




function valor_cuota_campo(){
 
    //tabla de cuentas de clientes
//buscamos el ultimo ID post type reciente de clientes para actulizar

  $id_author_actual_ = get_current_user_id(); //id usuario actual

    $argss = array('post_type' =>'cliente', 'posts_per_page' => 1,'author' =>   $id_author_actual_);
                 $recent_posts = wp_get_recent_posts($argss, OBJECT);

         
    foreach( $recent_posts as $recent ){
     
                        $recentID = $recent->ID;
             $id_author_post_ctas = $recent->post_author;
             
          
             
           
         }
         
             ?>
                           <script type="text/javascript">
                          jQuery(document).ready(function() {
                             
                              //alert("<?php echo $recentID; ?>");
                             
                                         
                                 });
                           </script>
    
                     <?php  
         
         
         
       
       $nombreCliente  = get_the_title( $recentID);
       $cuotas_cliente = get_field( "cuotas_cliente", $recentID);
       $fecha_prestamo = get_the_date("d-m-Y", $recentID);
       $fecha_terminar = date("d/m/Y",strtotime("$fecha_prestamo"."+ $cuotas_cliente days")); 
                $monto = get_field( "monto_cliente", $recentID);
                
                
                if (get_field( "interes_cliente", $recentID)!=null){
   $interes_porcentaje = get_field( "interes_cliente", $recentID)/100;
              
 


        $interes_monto  = $monto*$interes_porcentaje;
              $MontoTot = $monto+$interes_monto;
        //$cuotas_cliente = get_field( "cuotas_cliente", $recentID);



       if($cuotas_cliente>0){
       $valor_cuota =      round( $MontoTot/$cuotas_cliente, 1, PHP_ROUND_HALF_UP); 


       update_field("valor_cuota_cliente", $valor_cuota, $recentID);
       update_field("fecha_terminar", $fecha_terminar , $recentID);
}

}

$nombre_completo =  get_post_meta( $recentID,'nombre_completo', true );



    if($valor_cuota >0 & !empty($valor_cuota) ){
    

  
      $update_post_c = array( 'ID' => $recentID, 'post_title'  =>  get_the_title( $recentID )  );
 
       // Update the post into the database
        wp_update_post( $update_post_c  );

      }
    rewind_posts(); 
    wp_reset_postdata(); 



    //buscamos el ultimpo ID de miscuentas
    $args_miscuentas = array( 'post_type' =>'miscuentas', 'posts_per_page' => 1, 'author' =>   $id_author_actual_ );
   
    $recent_postss = wp_get_recent_posts($args_miscuentas , OBJECT);


     /*foreach( $recent_postss as $recentt){
     
               $recent_IDPost_miscuentas = $recentt->ID;
               }*/
               
               if (!empty($recent_postss)) {
                   $recent_IDPost_miscuentas = $recent_postss[0]->ID;
               }
    
      $nombreCuentas= get_the_title(  $recent_IDPost_miscuentas);
    
     
    //Actualizamos filas si es igual
    $IDClienteCuenta = get_field("id_cliente_cuenta",$recent_IDPost_miscuentas);
    //if( $nombreCuentas==$nombreCliente) 

        ?>
          <script type="text/javascript">
           jQuery(document).ready(function() {
      
               //alert("<?php echo $IDClienteCuenta.''.$nombreCuentas?>--<?php echo $recentID ?>");
      
                  
             });
             </script>

        <?php 
  
    if($IDClienteCuenta>0 && $IDClienteCuenta==$recentID){
        
        
            // echo  $IDClienteCuenta ;
        
          update_field("monto_cuenta", $MontoTot,  $recent_IDPost_miscuentas);
         // update_field("valor_cuota_cliente", $valor_cuota,  $recent_IDPost_miscuentas);
 
       }


   





} 

  //add_action( 'admin_head', 'valor_cuota_campo' );   ////////////////////ADD
 


function crear_cuenta_cliente($post_id) {
   

   


    // Verificamos si el post es de tipo 'cliente'
    if (get_post_type($post_id) === 'cliente') {
         
       

           $nombreCliente  = get_the_title( $post_id);
           $cuotas_cliente = get_field( "cuotas_cliente", $post_id);
           $fecha_prestamo = get_the_date("d-m-Y", $post_id);
           $fecha_terminar = date("d/m/Y",strtotime("$fecha_prestamo"."+ $cuotas_cliente days")); 
                    $monto = get_field( "monto_cliente", $post_id);
                    //$monto = $_POST['monto_cliente'];
                    
                


                    if (get_field( "interes_cliente", $post_id)!=null){
                       $interes_porcentaje = get_field( "interes_cliente", $post_id)/100;
                  
     
    
    
                       $interes_monto  = $monto*$interes_porcentaje;
                       $MontoTot = $monto+$interes_monto;
                       //$cuotas_cliente = get_field( "cuotas_cliente", $recentID);
    
    
    
                      if($cuotas_cliente>0){
                  
                            $valor_cuota =  round( $MontoTot/$cuotas_cliente, 1, PHP_ROUND_HALF_UP); 
                            update_field("valor_cuota_cliente", $valor_cuota, $post_id);
                            update_field("fecha_terminar", $fecha_terminar , $post_id);
    
                      }
    
                    }


      
    
            // Obtenemos el título del cliente
            $titulo = get_the_title($post_id);

            // Insertamos un nuevo post de tipo 'miscuentas'
            $post_data = array(
                'post_type' => 'miscuentas',
                'post_title' => $titulo,
                'post_content' => $titulo,
                'post_status' => 'publish',
                'comment_status' => 'closed', // if you prefer
                'ping_status' => 'closed', // if you prefer
            );

        

        if ( get_post($post_id)) {   
                // Verificamos si el mensaje de 'cliente' está publicado
       if ( get_post_status($post_id) == 'publish') {        
            // Si el post se inserta correctamente
            if ( $post_data) {
                
                $post_id_cuenta = wp_insert_post($post_data);
                // Insertamos el post meta 'monto_cuenta'
                //add_post_meta($post_id_cuenta, 'monto_cuenta', $valor_cuota);
                add_post_meta($post_id_cuenta, 'monto_cuenta', $MontoTot);

                // Insertamos el post meta 'id_cliente_cuenta' con el valor del ID del cliente
                add_post_meta($post_id_cuenta, 'id_cliente_cuenta', $post_id);
            }

              // Send a message and stop the execution of the script
        //wp_die('okok miscuentas ' . $valor_cuota);
    }
      
      
    }
    else {
        // El post no existe o no se ha guardado correctamente
        wp_die('El post no existe o no se ha guardado correctamente ');
        echo 'El post no existe o no se ha guardado correctamente.';
    }

}

}
add_action('save_post', 'crear_cuenta_cliente',10,2);







function publicar_inmediatamente($data, $postarr) {
    if($data['post_status'] == 'auto-draft') {
        $data['post_status'] = 'publish';
    }
    return $data;
}
//add_filter('wp_insert_post_data', 'publicar_inmediatamente', '99', 2);


function publicar_borradores() {
    // Obtener los posts en modo borrador
    $args = array(
        'post_status' => 'draft',
        'post_type' => 'cliente', // Cambia esto al tipo de post que necesites
        'posts_per_page' => -1,
    );
    $borradores = get_posts($args);

    // Recorrer los posts y cambiar su estado a 'publish'
    foreach ($borradores as $borrador) {
        $borrador->post_status = 'publish';
        wp_update_post($borrador);
    }
}
//add_action('init', 'publicar_borradores');


function publish_post_on_publish_click($post_id, $post, $update) {
    // Comprobar si $_POST contiene nuestra variable personalizada que indica un clic en "Publicar"
    if (isset($_POST['publish_clicked']) && $_POST['publish_clicked'] == 'yes') {
        // Comprobar si el post es de tipo 'cliente' y está en estado 'draft'
        if ($post->post_type == 'cliente' && $post->post_status == 'draft') {
            // Eliminar la acción para evitar bucles infinitos
            remove_action('save_post', 'publish_post_on_publish_click', 10);

            // Actualizar el post a 'publish'
            wp_update_post(array(
                'ID'          => $post_id,
                'post_status' => 'publish'
            ));

            // Volver a añadir la acción
            add_action('save_post', 'publish_post_on_publish_click', 10, 3);
        }
    }
}
add_action('save_post', 'publish_post_on_publish_click', 10, 3);

// Añadir un campo oculto al formulario de edición de post para detectar el clic en "Publicar"
function add_publish_button_input() {
    global $post;
    if ($post->post_type == 'cliente') {
        echo '<input type="hidden" name="publish_clicked" id="publish_clicked" value="no">';
        echo '
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#publish").click(function() {
                    $("#publish_clicked").val("yes");
                });
            });
        </script>';
    }
}
add_action('post_submitbox_misc_actions', 'add_publish_button_input');




/**
 * Función para actualizar vínculos entre posts con validación completa
 */
function actualizar_vinculos_completos() {
    $current_user_id = get_current_user_id();
     
    // 1. Obtener todos los gd_place públicos del usuario
    $gd_places = get_posts([
        'post_type' => 'gd_place',
        'author' => $current_user_id,
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    // 2. Procesar cada gd_place
    foreach ($gd_places as $place) {
        $place_id = $place->ID;
         $gd_cuenta = get_post_meta($place_id, 'cuentaGD', true);

          if ($gd_cuenta == '' || ($gd_cuenta != 'desvinculada' && $gd_cuenta != 'terminado' && $gd_cuenta != 'activa')){
                     // Si la cuenta está vacía o desvinculada, actualizamos el estado
                    update_post_meta($place_id, 'cuentaGD', 'desvinculada');
                 }

        // Buscar clientes vinculados a este gd_place
        $clientes = get_posts([
            'post_type' => 'cliente',
            'author' => $current_user_id,
            'post_status' => 'publish',
            'meta_query' => [[
                'key' => 'id_lista_cliente',
                'value' => $place_id,
                'compare' => '='
            ]],
            'numberposts' => -1
        ]);

             // Actualizar estado en gd_place
             if ( !empty($clientes) ) {

                 if($gd_cuenta == ''){
                    update_post_meta($place_id, 'cuentaGD', 'activa');
                 }
            
                 //update_post_meta($place_id, 'cuentaGD', 'activa');
             }
             
        //update_post_meta($place_id, 'cuentaGD', empty($clientes) ? 'desvinculad' : 'activa');  //chocaba con terminando //11/08/2025
    }
            $ids_a_excluir = [];
    // 3. Obtener todas las miscuentas públicas del usuario
    $mis_cuentas = get_posts([
        'post_type' => 'miscuentas',
        'author' => $current_user_id,
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    // 4. Procesar cada miscuenta
    foreach ($mis_cuentas as $cuenta) {
        $id_cliente_cuenta = get_post_meta($cuenta->ID, 'id_cliente_cuenta', true);
          $ids_a_excluir[] = $id_cliente_cuenta;
          $cliente_cuenta = get_post_meta($cuenta->ID, 'cuenta', true);
        
        // Si id de cuenta es vacia
        if (empty($id_cliente_cuenta)) {
            update_post_meta($cuenta->ID, 'cuenta', 'desvinculada');
            continue;
        }else
                   if($cliente_cuenta == '' ){
                                              update_post_meta($cuenta->ID, 'cuenta', 'activa');
                                   }
                
                

        // Buscar el cliente específico
        $cliente = get_posts([
            'post_type' => 'cliente',
            'author' => $current_user_id,
            'post_status' => 'publish',
            'post__in' => [$id_cliente_cuenta],
            'numberposts' => -1
        ]);

      




            
             
        // Verificar si el cliente existe y tiene el id_lista_cliente correcto
        //                 ID de postype cuentas           ID cuenta postype miscuentas
        if (!empty($cliente) && $cliente[0]->ID == $id_cliente_cuenta) {
            // Verificar si el cliente referencia un gd_place existente
                      $gd_place_id = get_post_meta($cliente[0]->ID, 'id_lista_cliente', true);
                          //echo "<script>alert('GD Place {$gd_place_id} ');</script>";
                          //update_post_meta($cuenta->ID, 'cuenta', 'activa');
                         
            $gd_place_existe = get_posts([
                'post_type' => 'gd_place',
                'author' => $current_user_id,
                'post__in' => [$gd_place_id],
                'post_status' => 'publish',
                'numberposts' => -1
            ]);
              
                         

               if (empty($gd_place_existe)) {
                     
                    //echo "<script>alert('GD Place {$gd_place_id} ');</script>";
                    //update_post_meta($gd_place_existe->ID, 'cuentaGD', 'desvinculadr');
                        if (empty($cliente_cuenta )){ 
                               update_post_meta($cuenta->ID, 'cuenta', 'desvinculada');
                        } 
                                

                    //update_post_meta($cuenta->ID, 'cuenta', 'desvinculada');

                       


                 }

           //update_post_meta($cuenta->ID, 'cuenta', !empty($gd_place_existe) ? 'activa' : 'desvinculada');
            if (!empty($gd_place_existe)) {

                $gd_place_post_id = $gd_place_existe[0]->ID; //aquí obtienes el ID real del post
               

                           //si estatus de la cuenta esta vacia
                        if (empty($cliente_cuenta ))
                            { 
                                 //update_post_meta($cuenta->ID, 'cuenta', 'desvinculada');

                                   
                                 update_post_meta( $gd_place_post_id  , 'cuentaGD', 'desvinculada');

                            } else{
                                   
                                   if($cliente_cuenta == 'terminado' ){
                                              update_post_meta(  $gd_place_post_id  , 'cuentaGD', 'terminado');
                                   }

                                   if($cliente_cuenta == 'desvinculada' ){
                                              update_post_meta(  $gd_place_post_id  , 'cuentaGD', 'desvinculada');
                                   }
                            }
                          
                              //update_post_meta($cuenta->ID, 'cuenta', 'activa');
                                     
                }
                
        } else {   
            
         
           
            //update_post_meta($cuenta->ID, 'cuenta', 'activa');
           // update_post_meta(  $gd_place_id , 'cuentaGD', 'desvinculada');
             
        }

    }


        
         // Obtener otros clientes
$otros_clientes = get_posts([
    'post_type' => 'cliente',
    'author' => $current_user_id,
    'post_status' => 'publish',
    'post__not_in' => $ids_a_excluir,
    'numberposts' => -1
]);

// Crear mensaje para mostrar
/*$mensaje = "CLIENTES ENCONTRADOS (excluyendo ID: " . $id_cliente_cuenta . "):\\n";
$mensaje .= "Total: " . count($otros_clientes) . " clientes\\n\\n";

foreach ($otros_clientes as $index => $clienteOtros) {
    $gd_place_idOtros = get_post_meta($clienteOtros->ID, 'id_lista_cliente', true);
    $mensaje .= ($index + 1) . ". Cliente ID: " . $clienteOtros->ID . " -> GD Place: " . $gd_place_idOtros . "\\n";
}

echo "<script>alert('" . $mensaje . "');</script>";*/

// Desvincular solo los que realmente no tienen cuentas activas
foreach ($otros_clientes as $clienteOtros) {
    $gd_place_idOtros = get_post_meta($clienteOtros->ID, 'id_lista_cliente', true);
    
    if (!empty($gd_place_idOtros)) {
        update_post_meta($gd_place_idOtros, 'cuentaGD', 'desvinculada');
      
    }
}




}

add_action('admin_init', 'actualizar_vinculos_completos');




//update_related_custom_posts();


/* 
En este código, reemplaza 'meta_key_miscuentas', 'meta_key_cliente', y 'meta_key_abono' 
con los nombres reales de los campos personalizados que estás utilizando para relacionar 
cada tipo de post con gd_place.

Este código buscará y eliminará todos los posts de los tipos miscuentas, cliente, y abono
 que tengan un meta campo que coincida con el ID del post de gd_place que está siendo 
 enviado a la papelera .
*/


 
function eliminar_posts_relacionados_al_papelera($post_id) {
    $post_type = get_post_type($post_id);

    if ($post_type == 'gd_place') {
        // Define un array con los tipos de post y sus respectivos meta keys
        $post_types_to_delete = array(
            'miscuentas' => 'meta_key_miscuentas',
            'cliente' => 'meta_key_cliente',
            'abono' => 'meta_key_abono'
        );

        foreach ($post_types_to_delete as $type => $meta_key) {
            $related_posts = get_posts(array(
                'post_type' => $type,
                'numberposts' => -1,
                'post_status' => 'any',
                'meta_query' => array(
                    array(
                        'key' => $meta_key,
                        'value' => $post_id,
                    ),
                ),
            ));

            if ($related_posts) {
                foreach ($related_posts as $related_post) {
                    wp_delete_post($related_post->ID, true);
                }
            }
        }
    }
}

//add_action('wp_trash_post', 'eliminar_posts_relacionados_al_papelera');




function otorgar_permisos_admin_aux() {
    // Obtener el objeto del rol 'admin_aux'
    $role = get_role('admin_aux');

    // Asegúrate de que el rol existe antes de modificarlo
    if ($role) {
        // Añadir la capacidad 'edit_posts' al rol 'admin_aux'
        $role->add_cap('edit_posts');
        $role->add_cap('edit_published_posts');
        $role->add_cap('edit_others_posts');
        $role->add_cap('publish_posts');
        // ... y así sucesivamente para todas las capacidades que necesites otorgar
         // Capacidades para publicaciones del tipo 'cliente'
         $role->add_cap('edit_clientes'); // Asumiendo que 'edit_clientes' es la capacidad necesaria
         $role->add_cap('edit_published_clientes');
         $role->add_cap('edit_others_clientes');
    }
}

// Ejecutar la función en el hook 'admin_init'
add_action('admin_init', 'otorgar_permisos_admin_aux');


function desactivar_borrador_automatico() {
    remove_action('admin_init', '_wp_auto_drafts');
}
add_action('admin_init', 'desactivar_borrador_automatico', 1);

function disable_autosave_for_all_posts() {
    wp_dequeue_script('autosave');
}

add_action('admin_enqueue_scripts', 'disable_autosave_for_all_posts');

//ver numero de post real
function filtrar_posts_por_usuario_actual_en_admin($query) {
    // Verificar si estamos en el panel de administración y si es la consulta principal
    if (is_admin() && $query->is_main_query()) {
        // Obtener el tipo de post actual de la consulta
        $post_type = $query->get('post_type');

        // Si estamos en la lista de un tipo de post específico (cambia 'gd_place' por tu tipo de post)
        if ('miscuentas' == $post_type) {
            // Obtener el ID del usuario actual
            $user_id = get_current_user_id();

            // Establecer el autor de la consulta al usuario actual
            $query->set('author', $user_id);
        }
            

        if ('cliente' == $post_type) {
            // Obtener el ID del usuario actual
            $user_id = get_current_user_id();

            // Establecer el autor de la consulta al usuario actual
            $query->set('author', $user_id);
        }

        if ('gd_place' == $post_type) {
            // Obtener el ID del usuario actual
            $user_id = get_current_user_id();

            // Establecer el autor de la consulta al usuario actual
            $query->set('author', $user_id);
        }


    }
    return $query;
}

add_action('pre_get_posts', 'filtrar_posts_por_usuario_actual_en_admin');

/**
 * Sobrescribe la función wp_verify_nonce para desactivar la verificación de nonces en todo el sitio.
 */
if ( ! function_exists( 'wp_verify_nonce' ) ) {
    function wp_verify_nonce( $nonce, $action = -1 ) {
        return 1; // WordPress espera que wp_verify_nonce devuelva 1 o 2 cuando el nonce es válido.
    }
}

// ¡ADVERTENCIA! Esto desactiva la verificación de nonce para una acción específica.
// Solo haz esto si entiendes completamente las implicaciones de seguridad.

add_filter('check_ajax_referer', function ($action, $result) {
    if ('save_post_action' === $action) {
        return true; // Forzar la verificación del nonce a verdadero para 'mi_accion_especifica'
    }
    return $result; // Para todas las demás acciones, deja la verificación del nonce como está.
}, 10, 2);

add_filter('wp_verify_nonce', function($result, $nonce, $action){
    return 1; // Devuelve siempre 1 para simular un nonce verificado
}, 10, 3);


/////////2024 dic

function agregar_formulario_fechas() {
    global $post;
    // Verificar si estamos en la pantalla de listado de 'miscuentas'
    if ($post->post_type === 'miscuentas') {
        ?>
      <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Crear el formulario de fechas
                var formHtml = `
                    <div class="alignleft actions" style="margin-bottom: 10px;">
                        <h2 style="display:inline; margin-right: 10px;">Buscar Pagos por Fechas</h2>
                        <form method="post" action="" style="display:inline;">
                            <label for="fecha_inicio" style="margin-right: 5px;">Fecha de Inicio:</label>
                            <input type="date" name="fecha_inicio" required>

                            <label for="fecha_fin" style="margin-right: 5px;">Fecha de Fin:</label>
                            <input type="date" name="fecha_fin" required>

                            <input type="submit" value="Buscar Pagos" class="button button-primary">
                        </form>
                    </div>
                `;

                // Insertar el formulario después de subsubsub
                $('.subsubsub').after(formHtml);
                $('#porfecha').insertAfter('.subsubsub');
                $('.totGen').insertAfter('#porfecha');
            });
        </script>
        <?php
        // Llamar a la función para mostrar los resultados
        if ($post && $post->post_type === 'miscuentas' && $_SERVER['REQUEST_METHOD'] === 'POST') {
           
           
          
           
            if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];
       
                // Llamar a la función obtener_cuentas2() con las fechas recibidas
              echo  obtener_cuentas2($fecha_inicio, $fecha_fin);
            }
        }
    }
}
add_action('admin_notices', 'agregar_formulario_fechas');


function obtener_cuentas2($fecha_inicio, $fecha_fin) { 
    // Fecha de inicio: 1 de agosto de 2024 
    //$fecha_inicio_formateada = '2024-02-01'; 
    // Fecha de fin: hoy 
    //$fecha_fin_formateada = date('Y-m-d'); 
    
 
    ///$fecha_inicio_formateada = date('Y-m-d', strtotime($fecha_inicio)); // Convertir a formato Y-m-d
    //$fecha_fin_formateada = date('Y-m-d', strtotime($fecha_fin)); // Convertir a formato Y-m-d
      // Inicializar las fechas
      //$fecha_inicio_formateada = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d', strtotime('first day of this month'));
      //$fecha_fin_formateada = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : date('Y-m-d');

       // Convertir las fechas a formato día/mes/año para su uso posterior
    $fecha_inicio_dmy = date('Y-m-d', strtotime($fecha_inicio));
    $fecha_fin_dmy = date('Y-m-d', strtotime($fecha_fin));

     // Inicializar el total general
    $total_general = 0;
    ?>
    <script>

 jQuery(document).ready(function($) {

    var fego = "<?php echo  $fecha_inicio_dmy; ?>"; 
    //alert(fego );

 } );
    </script>
    <?php

    $id_author_actual_oc = get_current_user_id(); //id usuario actual
   

    // Crear una consulta para obtener todos los posts de tipo 'miscuentas' 
    $args = array( 
        'post_type' => 'miscuentas', 
        'author' =>  $id_author_actual_oc,
        'posts_per_page' => -1 // Obtener todos los posts sin límite 
    ); 

    $query = new WP_Query($args); 

    // Comprobar si hay resultados 
    if ($query->have_posts()) { 
       
        echo '<table id="porfecha" class="wp-list-table widefat fixed striped">';
        echo '<thead><tr>
        <th>Cliente</th>
        <th>Nombre</th>
       <th>#Total Pagado</th>
        <th>Abono</th>
       
          
           <th>#Cuotas completos</th>
           
           <th>Detalles de Pagos</th>
           <th>#pca</th>
        </tr></thead>';
        echo '<tbody>';

        $pagos_por_cliente = []; // Array para acumular pagos por cliente
        $pagoDiario_por_cliente = []; // lo que debe pagar diario
        $abonos_por_cliente = []; // Array para acumular abonos por cliente
        $pagocubierto_por_cliente = []; // Array para acumular numero  de pagos cubierto con el abono
        $detalles_por_cliente = []; // Array para acumular detalles de pagos
        $total_pagoCubierto =0;
        $total_abono_general =0;
        $total_pagoCubierto_general =0;
        $total_pago_general =0;
        $total_general =0;
        $idClienteAbono = [];
        $id_clientes = []; // Para almacenar los IDs de cliente
        $titulo_abono = [] ;
        $detalles_abonos = []; // Array para acumular detalles de abonos
        $fechas_abonos = []; // Array para almacenar las fechas de abono
        while ($query->have_posts()) { 
            $query->the_post(); 
            $idPost_cuentas = get_the_ID(); 

            $clienteNombreText = get_the_title($idPost_cuentas); // Obtener el nombre del cliente 

            $clienteNombre = $idPost_cuentas ;
            
            $idCuenta = get_field("id_cliente_cuenta", $idPost_cuentas); 

            // Obtener el número de cuotas autorizadas 
            $cuotas_autorizadas = get_field('cuotas_cliente', $idCuenta); 


            $total_abonos_cliente = 0;
             
            ?>
            <script>
            jQuery(document).ready(function($) {
            
            
            //alert( $cuotas_autorizadas );
            
            } );
            </script>
            <?php

                    
            // Consultar los abonos para este cliente en el rango de fechas
            $abonos_query = new WP_Query(array(
                'post_type' => 'abono',
                'author' => $id_author_actual_oc,
                'posts_per_page' => -1, // Obtener todos los posts sin límite
                'meta_query' => array(
                    array(
                        'key' => 'id_cliente' , 
                        'value' => $idPost_cuentas,     //	33859   
                        'compare' => '='
                    ),

                    array(

                        'key' => 'cubrePagos',
                        'value' => 0,
                        'compare' => '>='
                    )

                ),
                'date_query' => array(
                    array(
                        'after' => $fecha_inicio_dmy,
                        'before' => $fecha_fin_dmy,
                        'inclusive' => true

                       
                    ),
                ),
            ));


          

if ($abonos_query->have_posts()) {
while ($abonos_query->have_posts()) {
    $abonos_query->the_post();
    $monto_abono = get_field('abono'); // total_saldo Asegúrate de que este es el campo correcto para el monto del abono
    $pagoCubiertoAbono = get_field('cubrePagos');
    $id_cliente = get_field('id_cliente');
    $fecha_abono = get_the_date('Y-m-d H:i:s'); // Obtener la fecha y hora del post de abono

    // Obtener el título del post actual
    $titulo = trim(get_the_title());

    // Verificar si el título no contiene "– Saldo" (usando el guion largo)
    if (!preg_match('/Saldo/ui', $titulo))
    {  
    if ($monto_abono) {

        //$total_abonos_cliente += $monto_abono; // Sumar el monto de cada abono

         // Acumular el monto del abono por cliente
         if (!isset($abonos_por_cliente[$clienteNombre])) {
            $abonos_por_cliente[$clienteNombre] = 0;
          
        }
        $abonos_por_cliente[$clienteNombre] += $monto_abono;
        $pagocubierto_por_cliente[$clienteNombre] += $pagoCubiertoAbono;
        $id_clientes[$clienteNombre] = $id_cliente;
        $titulo_abono[$clienteNombre] =  $titulo;
        
               // Acumular la fecha y hora del abono
    if (!isset($fechas_abonos[$id_cliente])) {
        $fechas_abonos[$id_cliente] = [];
    }
    $fechas_abonos[$id_cliente][] = $fecha_abono;


       // echo $titulo;
        //echo $id_cliente;
        //echo   $id_clientes[$clienteNombre] ;
    }
   

    }

}
}
/*else{ // si no hay cubrePagos >0 entonces buscamos que sean igual a 0


          
             // Consultar los abonos para este cliente en el rango de fechas
             $abonos_query = new WP_Query(array(
                'post_type' => 'abono',
                'author' => $id_author_actual_oc,
                'posts_per_page' => -1, // Obtener todos los posts sin límite
                'meta_query' => array(
                    array(
                        'key' => 'id_cliente' , 
                        'value' => $idPost_cuentas,     //	33859   
                        'compare' => '='
                    ),

                    array(

                        'key' => 'cubrePagos',
                        'value' => 0,
                        'compare' => '='
                    )

                ),
                'date_query' => array(
                    array(
                        'after' => $fecha_inicio_dmy,
                        'before' => $fecha_fin_dmy,
                        'inclusive' => true

                       
                    ),
                ),
            ));


          

if ($abonos_query->have_posts()) {
while ($abonos_query->have_posts()) {
    $abonos_query->the_post();
    $monto_abono = get_field('abono'); // total_saldo Asegúrate de que este es el campo correcto para el monto del abono
    $pagoCubiertoAbono = get_field('cubrePagos');
    
    if ($monto_abono) {

        //$total_abonos_cliente += $monto_abono; // Sumar el monto de cada abono

         // Acumular el monto del abono por cliente
         if (!isset($abonos_por_cliente[$clienteNombre])) {
            $abonos_por_cliente[$clienteNombre] = 0;
        }
        $abonos_por_cliente[$clienteNombre] += $monto_abono;
        $pagocubierto_por_cliente[$clienteNombre] += $pagoCubiertoAbono;
       

    }
}
}

        

}*/

//$abonos_por_cliente[$clienteNombre] = $total_abonos_cliente; // Acumula los abonos







  // echo $total_abonos_cliente ;
//echo  $monto_abono;
//echo   $total_abono_general;
//echo $total_abonos_cliente;

                  

                 



            // Comprobar si hay filas en 'pagos_abono' 
            if (have_rows('pagos_abono', $idPost_cuentas)) {   
                while (have_rows('pagos_abono', $idPost_cuentas)) { 
                    the_row(); 

                 
                    // Recorrer los pagos usando un bucle for 
                    for ($i = 1; $i <= $cuotas_autorizadas; $i++) { 
                        $montoPago = get_sub_field('pago_#' . $i); 
                        $fechaPago = get_sub_field('fecha_del_pago#' . $i); 
                         
                        


                      
                        // Verificar que el monto y la fecha no estén vacíos y que la fecha esté dentro del rango deseado 
                        if ($montoPago && $fechaPago) { 
                       
                           
                           

                            //$fechaPago_formateada = date('Y/m/d', strtotime($fechaPago)); 
                            
                     
                            //$fecha_inicio_formateada = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
                            // Formato día/mes/año
                           // $fechaPago_formateada = date($fechaPago);
                            //$fechaPago_formateada = date('Y-m-d', strtotime($fechaPago));
                           
                          
                              // Crear un objeto DateTime a partir del formato d/m/Y
$fecha_obj = DateTime::createFromFormat('d/m/Y', $fechaPago);

// Verificar si la conversión fue exitosa
if ($fecha_obj !== false) {
    // Formatear la fecha en el formato Y-m-d
    $fechaPago_formateada = $fecha_obj->format('Y-m-d');
    //echo "La fecha en formato Y-m-d es: " . $fechaPago_formateada; // Imprime: 2024-06-12
} else {
    echo "La fecha original no es válida.";
}

?>
<script>
jQuery(document).ready(function($) {

var fechaPa = "<?php echo "sin formato".$fechaPago."con formato".$fechaPago_formateada .">=". $fecha_inicio_dmy; ?>"; 
//alert(fechaPa );

} );
</script>
<?php
                       

                       /* if (empty($montoPago) && empty($fechaPago)) { 
                            $fechaPago = date('d/m/Y');   //29/02/2024

                            $montoPago = 0;
                             
                            echo '<script type="text/javascript">
                            alert("se rompera el bucle");
                        </script>';
                       

                        }*/
                              
                        /*echo '<script type="text/javascript">
                        alert("La fecha fomarta: ' . $fechaPago_formateada . '");
                    </script>';*/

                            if ($fechaPago_formateada >=  $fecha_inicio_dmy  &&  $fechaPago_formateada <= $fecha_fin_dmy) 
                            { 
  
                               
                                  
                                ?>
                                <script>
                             jQuery(document).ready(function($) {
    
                                var fechaPa = "<?php echo "sin formato".$fechaPago."con formato".$fechaPago_formateada .">=". $fecha_inicio_dmy; ?>"; 
                               //alert(fechaPa );
    
                             } );
                                </script>
                                <?php




                          
                                // Acumular el monto por cliente
                                if (!isset($pagos_por_cliente[$clienteNombre])) {
                                    $pagos_por_cliente[$clienteNombre] = 0;
                                    $detalles_por_cliente[$clienteNombre] = []; // Inicializar detalles
                                }

                                $pagos_por_cliente[$clienteNombre] += $montoPago;
                                $pagoDiario_por_cliente[$clienteNombre] = $montoPago;
                               

                                // Agregar detalle de pago
                                $detalles_por_cliente[$clienteNombre][] = [
                                    'monto' => $montoPago,
                                    'fecha' => date('d-m-Y', strtotime($fechaPago_formateada)),
                                ];
                            } 






                        } 
                    } 
                } 
            }   


        }

        // Mostrar el total por cliente
       /*foreach ($pagos_por_cliente as $cliente => $total) {
            echo '<tr>';
            echo '<td>' . esc_html($cliente) . '</td>'; 
            echo '<td>' . esc_html($total) . '</td>'; 
            echo '<td><button class="ver-detalles" data-cliente="' . esc_attr($cliente) . '">Ver Detalles</button></td>'; 
            echo '</tr>';
        }*/
    
        // Imprimir los resultados después de acumular todos los abonos
/*foreach ($abonos_por_cliente as $clienteNombre => $total_abonos) {
    // Verificar si el total de abonos es mayor que 0
    if ($total_abonos > 0) {
        echo '<tr>';
        echo '<td>' . esc_html($clienteNombre) . '</td>'; // Imprimir el nombre del cliente
        echo '<td>' . esc_html($total_abonos) . '</td>'; // Imprimir el total de abonos
        echo '</tr>';
    }
}*/      


       
       




        foreach ($pagos_por_cliente as $cliente => $total) {
            
           

           

            $total_pagoCubierto = $total-($pagoDiario_por_cliente[$cliente]*$pagocubierto_por_cliente[$cliente]);
             
            if ($total_pagoCubierto<0){
                
                echo '<td><a href="' . admin_url('post.php?post=' . $cliente . '&action=edit') . '">' . esc_html($cliente) . '</a></td>';

                echo '<td> (verficar) ' . esc_html( get_the_title($cliente) ) .' '.$rev. '</td>'; 
                echo '<td>' . esc_html(/*$abonos_por_cliente[$cliente]+*/$total_pagoCubierto ) . '</td>';
                    echo '<td> Verificar abonos</td>';
            }
            //$total_general += $total_pagoCubierto; // Sumar al total general
                 if ($total_pagoCubierto>0){
            echo '<tr>';  
           
            echo '<td>' . esc_html($cliente) . '</td>';   
            echo '<td>' . esc_html( get_the_title($cliente) ) .'</td>'; 
            echo '<td>' . esc_html(/*$abonos_por_cliente[$cliente]+*/$total_pagoCubierto ) . '</td>';
            echo '<td>' /*. esc_html($abonos_por_cliente[$cliente]) . '</td>'*/; 
            
         
            echo '<td>' . esc_html($total_pagoCubierto) . '</td>';
           
            echo '<td><button class="ver-detalles-pago" data-cliente="' . esc_attr($cliente) . '">Ver Detalles</button></td>';
            echo '<td>' . esc_html($pagocubierto_por_cliente[$cliente]) . '</td>'; 
            echo '</tr>';
        }
        
            //$total_abono_general += $abonos_por_cliente[$cliente];
            $total_pagoCubierto_general += $total_pagoCubierto;
           
        }

           
        // Verificar si el array de pagos está vacío y si el array de abonos no está vacío
//if (!empty($abonos_por_cliente)) {
                 
    foreach ($abonos_por_cliente as $clienteABN => $total) { // Suponiendo que tienes un array de clientes
        // Asigna 0 a los abonos por cliente
      
       
       
        echo '<tr>';  
        echo '<td>' . esc_html(  $id_clientes[$clienteABN] ) . '</td>';   
        echo '<td>' . esc_html($titulo_abono[$clienteABN]) . '</td>'; 
        echo '<td>' . esc_html( $total) . '</td>'; 
        echo '<td>' . esc_html($total) . '</td>'; // O cualquier otro valor que desees mostrar
        echo '<td>0</td>'; // O cualquier otro valor que desees mostrar
        //echo '<td><button class="ver-detalles-abono" data-cliente="' . esc_attr($id_clientes[$clienteNombre]) . '" data-tipo="abono">Ver Detalles</button></td>';
        echo '<td><button class="ver-detalles-abono" data-cliente="' . $id_clientes[$clienteABN] . '" data-tipo="abono">Ver Detalles</button></td>';
        echo '<td>0</td>'; // O cualquier otro valor que desees mostrar
        
        echo '</tr>';
       
        $total_abono_general += $total;
    //}

} 

// Obtener la cantidad total de gastos dentro del rango de fechas
$gastos_query = new WP_Query(array(
    'post_type' => 'gasto',
    'author' => $id_author_actual_oc,
    'posts_per_page' => -1, // Obtener todos los posts sin límite
    'date_query' => array(
        array(
            'after' => $fecha_inicio_dmy,
            'before' => $fecha_fin_dmy,
            'inclusive' => true
        ),
    ),
));

$total_gastos = 0;
if ($gastos_query->have_posts()) {
    while ($gastos_query->have_posts()) {
        $gastos_query->the_post();
        $monto_gasto = get_field('cantidad'); // Asegúrate de que este es el campo correcto para el monto del gasto
        $total_gastos += $monto_gasto;
    }
    wp_reset_postdata();
}






echo '<tr>';
echo '<td colspan="2"></td>';
echo '<td><h3 class="totGe" >Total $' . number_format($total_pagoCubierto_general+ $total_abono_general, 1) . '</h3></td>';
echo '<td><h3 class="totGe">$' . number_format($total_abono_general, 1) . '</h3></td>';
echo '<td><h3 class="totGe">$' . number_format($total_pagoCubierto_general, 1) . '</h3></td>';
echo '<td><h3 class="totGen" >Gastos: $' . number_format($total_gastos, 1) . '</h3></td>';
echo '</tr>';

echo '</tbody>';
echo '</table>';
       
           

        //echo '<h3 class= "totGen" >Total Cuotas: $' . number_format( $total_pagoCubierto_general, 1) . '</h3></tbody>  </table>';  
        //echo '<h3 class= "totGen" >Total abonos: $' . number_format($total_abono_general, 1) . '</h3></tbody>  </table>'; 
        //echo '<h3 class= "totGen" >Cuotas+abonos: $' . number_format($total_pagoCubierto_general+ $total_abono_general, 1) . '</h3></tbody>  </table>'; 
        
    
    } else { 
        echo '<div class="wrap"><h2>No se encontraron pagos .</h2></div>'; 
    } 

    // Restablecer la consulta global 
    wp_reset_postdata(); 

    
          

      // Incluir JavaScript para manejar el despliegue de detalles
    ?>
       
       <script>
    jQuery(document).ready(function($) {
        $('.ver-detalles-pago').on('click', function() {
            var cliente = $(this).data('cliente');
            
            // Crear un modal o un div para mostrar detalles
            var detallesHtml = '<h3>Detalles de ' + cliente + '</h3><ul>';
            
            // Obtener detalles de pagos para el cliente
            var detalles = <?php echo json_encode($detalles_por_cliente); ?>;
            
            if (detalles[cliente]) {
                detalles[cliente].forEach(function(detalle) {
                    detallesHtml += '<li>Monto: ' + detalle.monto + ', Fecha: ' + detalle.fecha + '</li>';
                });
            } else {
                detallesHtml += '<li>No hay detalles disponibles.</li>';
            }
            
            detallesHtml += '</ul>';
            
            // Mostrar detalles en un modal o en un div
            var $modal = $('<div class="modal"></div>').html(detallesHtml);
            $('body').append($modal);
            $modal.dialog({
                title: 'Detalles de Pagos',
                modal: true,
                close: function() {
                    $(this).dialog('destroy').remove();
                },
                open: function() {
                    // Estilo del modal
                    $(this).css({
                        'background-color': 'white', // Fondo blanco
                        'border': '1px solid #ccc', // Borde gris claro
                        'padding': '20px', // Espaciado interno
                        'border-radius': '5px' // Bordes redondeados
                    });
                    // Estilo de la barra de título
                    $('.ui-dialog-titlebar').css({
                        'background-color': '#f1f1f1', // Color de fondo de la barra de título
                        'border-bottom': '1px solid #ccc' // Borde inferior de la barra de título
                    });
                    // Estilo del título
                    $('.ui-dialog-title').css({
                        'color': '#333' // Color del texto del título
                    });
                }
            });
        });
        



        $('.ver-detalles-abono').on('click', function() {
            var cliente = $(this).data('cliente');
            
            // Crear un modal o un div para mostrar detalles
            var detallesHtml = '<h3>Detalles de ' + cliente + '</h3><ul>';
            
            // Obtener detalles de abonos para el cliente
            var detalles = <?php echo json_encode($detalles_abonos); ?>;
            
            if (detalles[cliente]) {
                detallesHtml += '<li>Monto: ' + detalles[cliente]['monto'] + ', Fecha: ' + detalles[cliente]['fecha'] + '</li>';
            } else {
                detallesHtml += '<li>No hay detalles disponibles.</li>';
            }
            
            detallesHtml += '</ul>';
            
            // Mostrar detalles en un modal o en un div
            var $modal = $('<div class="modal"></div>').html(detallesHtml);
            $('body').append($modal);
            $modal.dialog({
                title: 'Detalles de Abonos',
                modal: true,
                close: function() {
                    $(this).dialog('destroy').remove();
                },
                open: function() {
                    // Estilo del modal
                    $(this).css({
                        'background-color': 'white', // Fondo blanco
                        'border': '1px solid #ccc', // Borde gris claro
                        'padding': '20px', // Espaciado interno
                        'border-radius': '5px' // Bordes redondeados
                    });
                    // Estilo de la barra de título
                    $('.ui-dialog-titlebar').css({
                        'background-color': '#f1f1f1', // Color de fondo de la barra de título
                        'border-bottom': '1px solid #ccc' // Borde inferior de la barra de título
                    });
                    // Estilo del título
                    $('.ui-dialog-title').css({
                        'color': '#333' // Color del texto del título
                    });
                }
            });
        });




        
    });
</script>
    <?php


}










function agregar_formulario_fechas_reporte() {
    global $post;
    // Verificar si estamos en la pantalla de reporte diario
    if ($post->post_type === 'reporte_diario') {
        ?>
      <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Crear el formulario de fechas
                var formHtml = `
                    <div class="alignleft actions" style="margin-bottom: 10px;">
                        <h2 style="display:inline; margin-right: 10px;">Buscar Pagos por Fechas</h2>
                        <form method="post" action="" style="display:inline;">
                            <label for="fecha_inicio" style="margin-right: 5px;">Fecha de Inicio:</label>
                            <input type="date" name="fecha_inicio" required>

                            <label for="fecha_fin" style="margin-right: 5px;">Fecha de Fin:</label>
                            <input type="date" name="fecha_fin" required>

                            <input type="submit" value="Buscar Pagos" class="button button-primary">
                        </form>
                    </div>
                `;

                // Insertar el formulario después de subsubsub
                $('.subsubsub').after(formHtml);
                $('#porfecha').insertAfter('.subsubsub');
                $('.totGen').insertAfter('#porfecha');
            });
        </script>
        <?php
        // Llamar a la función para mostrar los resultados
        if ($post && $post->post_type === 'reporte_diario' && $_SERVER['REQUEST_METHOD'] === 'POST') {
           
           
          
           
            if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];
       
                // Llamar a la función obtener_cuentas2() con las fechas recibidas
              echo  actualizar_reporte_diario($fecha_inicio, $fecha_fin);
            }
        }
    }
}
//add_action('admin_notices', 'agregar_formulario_fechas_reporte');








function  actualizar_reporte_diario ($fecha_inicio, $fecha_fin){


    // Fecha de inicio: 1 de agosto de 2024 
    //$fecha_inicio_formateada = '2024-02-01'; 
    // Fecha de fin: hoy 
    //$fecha_fin_formateada = date('Y-m-d'); 
    
 
    ///$fecha_inicio_formateada = date('Y-m-d', strtotime($fecha_inicio)); // Convertir a formato Y-m-d
    //$fecha_fin_formateada = date('Y-m-d', strtotime($fecha_fin)); // Convertir a formato Y-m-d
      // Inicializar las fechas
      //$fecha_inicio_formateada = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d', strtotime('first day of this month'));
      //$fecha_fin_formateada = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : date('Y-m-d');

       // Convertir las fechas a formato día/mes/año para su uso posterior
       $fecha_inicio_dmy = date('Y-m-d', strtotime($fecha_inicio));
       $fecha_fin_dmy = date('Y-m-d', strtotime($fecha_fin));
   
        // Inicializar el total general
       $total_general = 0;
       ?>
       <script>
   
    jQuery(document).ready(function($) {
   
       var fego = "<?php echo  $fecha_inicio_dmy; ?>"; 
       //alert(fego );
   
    } );
       </script>
       <?php
   
       $id_author_actual_oc = get_current_user_id(); //id usuario actual
      
   
       // Crear una consulta para obtener todos los posts de tipo 'miscuentas' 
       $args = array( 
           'post_type' => 'miscuentas', 
           'author' =>  $id_author_actual_oc,
           'posts_per_page' => -1 // Obtener todos los posts sin límite 
       ); 
   
       $query = new WP_Query($args); 
   
       // Comprobar si hay resultados 
       if ($query->have_posts()) { 
          
           echo '<table id="porfecha" class="wp-list-table widefat fixed striped">';
           echo '<thead><tr><th>Cliente</th><th>Total Pagos</th><th>Detalles</th><th>Total Abonos</th></tr></thead>';
           echo '<tbody>';
   
           $pagos_por_cliente = []; // Array para acumular pagos por cliente
           $abonos_por_cliente = []; // Array para acumular abonos por cliente
           $detalles_por_cliente = []; // Array para acumular detalles de pagos
           $total_abono_general =0;
           while ($query->have_posts()) { 
               $query->the_post(); 
               $idPost_cuentas = get_the_ID(); 
               $clienteNombre = get_the_title($idPost_cuentas); // Obtener el nombre del cliente 
   
               $idCuenta = get_field("id_cliente_cuenta", $idPost_cuentas); 
   
               // Obtener el número de cuotas autorizadas 
               $cuotas_autorizadas = get_field('cuotas_cliente', $idCuenta); 
   
   
               $total_abonos_cliente = 0;
                
               ?>
               <script>
               jQuery(document).ready(function($) {
               
               
               //alert( $cuotas_autorizadas );
               
               } );
               </script>
               <?php
   
                       
               // Consultar los abonos para este cliente en el rango de fechas
               $abonos_query = new WP_Query(array(
                   'post_type' => 'abono',
                   'author' => $id_author_actual_oc,
                   'posts_per_page' => -1, // Obtener todos los posts sin límite
                   'meta_query' => array(
                       array(
                           'key' => 'id_cliente',
                           'value' => $idPost_cuentas,
                           'compare' => '='
                       ),
   
                       array(
                           'key' => 'cubrePagos',
                           'value' => 0,
                           'compare' => '='
                       )
   
                   ),
                   'date_query' => array(
                       array(
                           'after' => $fecha_inicio_dmy,
                           'before' => $fecha_fin_dmy,
                           'inclusive' => true
   
                          
                       ),
                   ),
               ));
   
   
             
   
   if ($abonos_query->have_posts()) {
   while ($abonos_query->have_posts()) {
       $abonos_query->the_post();
       $monto_abono = get_field('abono'); // total_saldo Asegúrate de que este es el campo correcto para el monto del abono
       if ($monto_abono) {
   
           $total_abonos_cliente += $monto_abono; // Sumar el monto de cada abono
       }
   }
   }
   
   $abonos_por_cliente[$clienteNombre] = $total_abonos_cliente; // Acumula los abonos
   
   
   
   
   //echo   $total_abono_general;
   //echo $total_abonos_cliente;
   
   
   
   
   
   
   
               // Comprobar si hay filas en 'pagos_abono' 
               if (have_rows('pagos_abono', $idPost_cuentas)) { 
                   while (have_rows('pagos_abono', $idPost_cuentas)) { 
                       the_row(); 
   
   
                       // Recorrer los pagos usando un bucle for 
                       for ($i = 1; $i <= $cuotas_autorizadas; $i++) { 
                           $montoPago = get_sub_field('pago_#' . $i); 
                           $fechaPago = get_sub_field('fecha_del_pago#' . $i); 
                           
                           // Verificar que el monto y la fecha no estén vacíos y que la fecha esté dentro del rango deseado 
                           if ($montoPago && $fechaPago) { 
                           
                               //$fechaPago_formateada = date('Y/m/d', strtotime($fechaPago)); 
                               
                        
                               //$fecha_inicio_formateada = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
                               // Formato día/mes/año
                              // $fechaPago_formateada = date($fechaPago);
                               //$fechaPago_formateada = date('Y-m-d', strtotime($fechaPago));
                              
                             
                                 // Crear un objeto DateTime a partir del formato d/m/Y
   $fecha_obj = DateTime::createFromFormat('d/m/Y', $fechaPago);
   
   // Verificar si la conversión fue exitosa
   if ($fecha_obj !== false) {
       // Formatear la fecha en el formato Y-m-d
       $fechaPago_formateada = $fecha_obj->format('Y-m-d');
       //echo "La fecha en formato Y-m-d es: " . $fechaPago_formateada; // Imprime: 2024-06-12
   } else {
       echo "La fecha original no es válida.";
   }
   
   ?>
   <script>
   jQuery(document).ready(function($) {
   
   var fechaPa = "<?php echo "sin formato".$fechaPago."con formato".$fechaPago_formateada .">=". $fecha_inicio_dmy; ?>"; 
   //alert(fechaPa );
   
   } );
   </script>
   <?php
                             
   
                               if ($fechaPago_formateada >=  $fecha_inicio_dmy  &&  $fechaPago_formateada <= $fecha_fin_dmy) { 
   
                                   ?>
                                   <script>
                                jQuery(document).ready(function($) {
       
                                   var fechaPa = "<?php echo "sin formato".$fechaPago."con formato".$fechaPago_formateada .">=". $fecha_inicio_dmy; ?>"; 
                                  //alert(fechaPa );
       
                                } );
                                   </script>
                                   <?php
                                
                                   // Acumular el monto por cliente
                                   if (!isset($pagos_por_cliente[$clienteNombre])) {
                                       $pagos_por_cliente[$clienteNombre] = 0;
                                       $detalles_por_cliente[$clienteNombre] = []; // Inicializar detalles
                                   }
                                   $pagos_por_cliente[$clienteNombre] += $montoPago;
                                   //$total_general += $montoPago; // Sumar al total general
   
                                   // Agregar detalle de pago
                                   $detalles_por_cliente[$clienteNombre][] = [
                                       'monto' => $montoPago,
                                       'fecha' => date('d-m-Y', strtotime($fechaPago_formateada)),
                                   ];
                               } 
                           } 
                       } 
                   } 
               } 
           }
   
           // Mostrar el total por cliente
          /*foreach ($pagos_por_cliente as $cliente => $total) {
               echo '<tr>';
               echo '<td>' . esc_html($cliente) . '</td>'; 
               echo '<td>' . esc_html($total) . '</td>'; 
               echo '<td><button class="ver-detalles" data-cliente="' . esc_attr($cliente) . '">Ver Detalles</button></td>'; 
               echo '</tr>';
           }*/
   
          
           foreach ($pagos_por_cliente as $cliente => $total) {
   
   
   
   
   
   
               echo '<tr>';
               echo '<td>' . esc_html($cliente) . '</td>'; 
               echo '<td>' . esc_html($total) . '</td>'; 
               echo '<td><button class="ver-detalles" data-cliente="' . esc_attr($cliente) . '">Ver Detalles</button></td>';
               echo '<td>' . esc_html($abonos_por_cliente[$cliente]) . '</td>'; // Mostrar el total de abonos 
               echo '</tr>';
               $total_abono_general += $abonos_por_cliente[$cliente];
           }
   
        
   
   
           echo '<h3 class= "totGen" >Total pagos: $' . number_format($total_general, 1) . '</h3></tbody>  </table>';  
           echo '<h3 class= "totGen" >Total abonos: $' . number_format($total_abono_general, 1) . '</h3></tbody>  </table>'; 
           echo '<h3 class= "totGen" >Total (pagos mas abonos): $' . number_format($total_general+ $total_abono_general, 1) . '</h3></tbody>  </table>'; 
       } else { 
           echo '<div class="wrap"><h2>No se encontraron pagos .</h2></div>'; 
       } 
       // Restablecer la consulta global 
       wp_reset_postdata(); 
   
         // Incluir JavaScript para manejar el despliegue de detalles
       ?>
          <script>
       jQuery(document).ready(function($) {
           $('.ver-detalles').on('click', function() {
               var cliente = $(this).data('cliente');
               
               // Crear un modal o un div para mostrar detalles
               var detallesHtml = '<h3>Detalles de ' + cliente + '</h3><ul>';
               
               // Obtener detalles de pagos para el cliente
               var detalles = <?php echo json_encode($detalles_por_cliente); ?>;
               
               if (detalles[cliente]) {
                   detalles[cliente].forEach(function(detalle) {
                       detallesHtml += '<li>Monto: ' + detalle.monto + ', Fecha: ' + detalle.fecha + '</li>';
                   });
               } else {
                   detallesHtml += '<li>No hay detalles disponibles.</li>';
               }
               
               detallesHtml += '</ul>';
               
               // Mostrar detalles en un modal o en un div
               var $modal = $('<div class="modal"></div>').html(detallesHtml);
               $('body').append($modal);
               $modal.dialog({
                   title: 'Detalles de Pagos',
                   modal: true,
                   close: function() {
                       $(this).dialog('destroy').remove();
                   },
               open: function() {
                   // Estilo del modal
                   $(this).css({
                       'background-color': 'white', // Fondo blanco
                       'border': '1px solid #ccc', // Borde gris claro
                       'padding': '20px', // Espaciado interno
                       'border-radius': '5px' // Bordes redondeados
                   });
                   // Estilo de la barra de título
                   $('.ui-dialog-titlebar').css({
                       'background-color': '#f1f1f1', // Color de fondo de la barra de título
                       'border-bottom': '1px solid #ccc' // Borde inferior de la barra de título
                   });
                   // Estilo del título
                   $('.ui-dialog-title').css({
                       'color': '#333' // Color del texto del título
                   });
   
   
               }
   
   
               });
           });
       });
   </script>  
   
       <?php



}





function shortcode_fecha_mas_un_dia() {
    if (get_post_type() != 'nueva_liquidada') {
        return 'No aplica';
    }

    $argsLL = array(
        'post_type' => 'listas_liquidadas',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'author' => get_current_user_id(),
    );

    $queryLL = new WP_Query($argsLL);

    if ($queryLL->have_posts()) {
        $queryLL->the_post();
        $last_post_date = get_the_date('d/m/Y H:i');
        $hoy = date('d/m/Y H:i');

        if ($last_post_date == $hoy) {
            $fecha_mas_un_dia = $last_post_date;
        } else {
            $fecha = DateTime::createFromFormat('d/m/Y H:i', $last_post_date);
            if ($fecha) {
                $fecha->modify('+1 day');
                $fecha_mas_un_dia = $fecha->format('d/m/Y H:i');
            } else {
                $fecha_mas_un_dia = 'Error al calcular la fecha';
            }
        }

        wp_reset_postdata();
        return $fecha_mas_un_dia;

    } else {
        return 'No hay listas liquidadas';
    }
}
add_shortcode('fecha_mas_un_dia', 'shortcode_fecha_mas_un_dia');






function mostrar_hola_en_footer_admin() {

    $fecha = do_shortcode('[fecha_mas_un_dia]');
    
    echo 'La fecha es: ' . esc_html($fecha);
    echo '<div style="text-align:center; font-weight:bold; margin-top:20px;">='. esc_html($fecha).'</div>';
   
}
//add_action('admin_footer', 'mostrar_hola_en_footer_admin');






function restrict_post_type_access_after_report( $screen ) {
    error_log('restrict_post_type_access_after_report está corriendo');

    // Define los tipos de post a los que se restringirá el acceso
    $restricted_post_types = array('cliente', 'gd_place', 'miscuentas', 'abono', 'gasto', 'inyeccion');

    // Verifica si la pantalla actual corresponde a uno de los post types restringidos
    if ( isset($screen->post_type) && in_array( $screen->post_type, $restricted_post_types ) ) {

        // Obtiene el ID del usuario actual
        $current_user_id = get_current_user_id();

        // Consulta para encontrar el último post de tipo 'listas_liquidadas' creado por el usuario actual
        $args_latest_report = array(
            'post_type'      => 'listas_liquidadas',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'author'         => $current_user_id,
            'fields'         => 'ids', // Solo necesitamos saber si existe
        );

        $query_latest_report = new WP_Query($args_latest_report);

        // Si se encontró un post de 'listas_liquidadas'
        if ( $query_latest_report->have_posts() ) {
            // Obtiene la fecha de creación del último post
            $latest_post_id = $query_latest_report->posts[0];
            $latest_post_date = get_the_date('Y-m-d', $latest_post_id);
            $current_date = date('Y-m-d');

            // Si la fecha del último post es hoy, restringe el acceso
            if ($latest_post_date === $current_date) {
                wp_die(
                    '<h2>El comulado de cobro se ha liquidado hoy, espere despues de las 12am para seguir cobrando</h2><p>El acceso a esta sección se encuentra temporalmente restringido debido al reporte generado. Podrá acceder nuevamente después de las 12 AM.</p>',
                    'Acceso Restringido',
                    array(
                        'response'  => 403, // Código de estado HTTP 403 Forbidden
                        'back_link' => true, // Muestra un enlace para regresar
                    )
                );
            }
        }
        // Si no se generó un reporte hoy, el acceso se permite implícitamente al no llamar a wp_die()
    }
}

add_action( 'current_screen', 'restrict_post_type_access_after_report' );







add_action('admin_footer', 'agrupar_nombres_repetidos_en_admin');

function agrupar_nombres_repetidos_en_admin() {
    global $pagenow;

    if ($pagenow !== 'edit.php' || !isset($_GET['post_type']) || $_GET['post_type'] !== 'gd_place') {
        return;
    }

    
    // ❌ NO ejecutar cuando lst_clnt=1
    if (isset($_GET['lst_clnt']) && $_GET['lst_clnt'] == '1') {
        return; 
    }
    ?>
    <style>
        .duplicado-toggle {
            display: inline-block;
            color: gray !important;
            font-size: 11px;
            margin-top: 2px;
            line-height: 1.2;
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
                    const rows = $('tr.type-gd_place');
        const seen = {};

        // Fecha actual en formato dd/mm/yyyy
        const today = new Date().toLocaleDateString('es-MX', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });

        rows.each(function() {
            const $row = $(this);
            const cuentaText = $row.find('td').eq(9).text().trim().toLowerCase(); // columna "Cuenta"
            const fechaText = $row.find('td').eq(4).text().trim(); // columna "Fecha"

            // Extraer fecha en formato dd/mm/yyyy desde texto como "Publicado\n28/06/2025 a las ..."
            const fechaMatch = fechaText.match(/(\d{2}\/\d{2}\/\d{4})/);
            const fechaPublicacion = fechaMatch ? fechaMatch[1] : '';

            if (cuentaText !== 'activa') return; // Solo agrupar si la cuenta es activa
            if (fechaPublicacion === today) return; // Omitir si la publicación es de hoy

            const $link = $row.find('td.title.column-title a');
            const title = $link.text().trim();

            if (!seen[title]) {
                seen[title] = [];
            }
            seen[title].push($row);
        });

        $.each(seen, function(title, rowList) {
            if (rowList.length > 1) {
                const count = rowList.length;
                const firstRow = rowList[0];
                const $titleCell = firstRow.find('td.title.column-title');
                const $link = $titleCell.find('a');

                if ($titleCell.find('.duplicado-toggle').length === 0) {
                    const toggle = $('<div class="duplicado-toggle">(' + count + ' cuentas)</div>');
                    $titleCell.append(toggle);
                }

                for (let i = 1; i < rowList.length; i++) {
                    rowList[i].hide();
                }
            }
        });
    });
    </script>
    <?php
}



// Actualiza automáticamente "caja_dia" al abrir la lista de reporte_diario
add_action('load-edit.php', function () {

    // Verifica que estamos en la lista de reporte_diario
    $screen = get_current_screen();
    if ( $screen->post_type !== 'reporte_diario' ) return;

    // Obtener todos los posts reporte_diario publicados
    $reportes = get_posts([
        'post_type'      => 'reporte_diario',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);

    foreach ( $reportes as $post_id ) {
        $total_cobrado  = floatval(get_post_meta($post_id, 'total_cobrado', true));
        $total_prestado = floatval(get_post_meta($post_id, 'total_prestado', true));
        $base           = floatval(get_post_meta($post_id, 'base', true));

        // Calcular la fórmula
        $total_neto = $total_cobrado - $total_prestado + $base;

        // Guardar el valor en el campo caja_dia
        update_post_meta($post_id, 'caja_dia', $total_neto);
    }

});




// 🔹 Ocultar submenús "All" y "Add New" en los tipos de post personalizados
add_action('admin_menu', function() {
    global $submenu;

    // --- 1. Nueva Liquidad ---
    $post_type_1 = 'nueva_liquidada';
    if (isset($submenu["edit.php?post_type=$post_type_1"])) {
        unset($submenu["edit.php?post_type=$post_type_1"][5]);  // "All Nueva Liquidadas"
        unset($submenu["edit.php?post_type=$post_type_1"][10]); // "Add New"
    }

    // --- 2. Listas Liquidadas ---
    $post_type_2 = 'listas_liquidadas';
    if (isset($submenu["edit.php?post_type=$post_type_2"])) {
        unset($submenu["edit.php?post_type=$post_type_2"][5]);  // "All Listas Liquidadas"
        unset($submenu["edit.php?post_type=$post_type_2"][10]); // "Add New"
    }
});




// ==================================================
// Forzar que la columna "Cliente Principal" muestre el ID del padre
// ==================================================
/*add_action('manage_gd_place_posts_custom_column', function($col, $post_id) {
    if ($col === 'cliente_principal') {

        // Obtener relación (puede devolver array u objeto)
        $parent = get_field('parent_cliente_id', $post_id);

        if (empty($parent)) {
            echo '–';
            return;
        }

        // Si es array, tomar el primero
        if (is_array($parent)) {
            $parent_obj = $parent[0];
        } else {
            $parent_obj = $parent;
        }

        // Extraer el ID real
        $parent_id = is_object($parent_obj) ? $parent_obj->ID : intval($parent_obj);

        echo '<strong>#' . $parent_id . '</strong>';
    }
}, 10, 2);*/


 // ======================================================
// Mostrar siempre el ID del padre en la columna Cliente Principal
// ======================================================
/*add_action('manage_gd_place_posts_custom_column', function($col, $post_id) {

    // ESTE es el slug real de la columna
    if ($col !== '690fb5a36e978c') {
        return;
    }

    // Leer el campo relacional
    $parent = get_field('parent_cliente_id', $post_id);

    if (empty($parent)) {
        echo '–';
        return;
    }

    // Si es array, tomar primer elemento
    if (is_array($parent)) {
        $parent_obj = $parent[0];
    } else {
        $parent_obj = $parent;
    }

    // Obtener ID real
    $parent_id = is_object($parent_obj) ? $parent_obj->ID : intval($parent_obj);

    // Mostrar SOLO el ID
    echo '<strong>#' . $parent_id . '</strong>';

}, 20, 2);*/




//---------------------------------------------------------
// 1. Cambiar destino del clic en el TÍTULO del listado
//---------------------------------------------------------
add_filter('get_edit_post_link', 'redirigir_titulo_a_miscuentas', 10, 3);
function redirigir_titulo_a_miscuentas($link, $post_id, $context){

    if (get_post_type($post_id) !== 'gd_place') return $link;

    // Título del cliente
    $title = get_the_title($post_id);
    $buscar = urlencode($title);

    // Redirige a miscuentas filtrado por nombre
    return admin_url("edit.php?post_type=miscuentas&s={$buscar}");
}



//---------------------------------------------------------
// 2. Agregar botón “+ Nueva Cuenta” sin afectar el título
//---------------------------------------------------------
//add_filter('post_row_actions', 'agregar_boton_nueva_cuenta_gdplace', 10, 2);
function agregar_boton_nueva_cuenta_gdplace($actions, $post){
    if ($post->post_type !== 'gd_place') return $actions;

    // URL real de edición (crear nueva cuenta)
    $editar = admin_url("post.php?post={$post->ID}&action=edit");

    // Agregar acción
    $actions['nueva_cuenta'] = 
        "<a style='color:#2271b1;font-weight:600;' href='{$editar}'>+ Nueva cuenta</a>";

    return $actions;
}






/* ============================================================
 * 1) MOSTRAR SOLO LOS PADRES (no duplicados) en lst_clnt=1
 * ============================================================ */

/*add_filter('the_posts', function($posts, $query) {

    if (!is_admin()) return $posts;
    if (!$query->is_main_query()) return $posts;

    if (!isset($_GET['post_type']) || $_GET['post_type'] !== 'gd_place') return $posts;
    if (!isset($_GET['lst_clnt']) || $_GET['lst_clnt'] != '1') return $posts;

    if (!is_array($posts)) return $posts;

    $filtered = [];

    foreach ($posts as $p) {

        if (!isset($p->ID)) continue;

        $raw = get_post_meta($p->ID, 'parent_cliente_id', true);

        // 🔥 SI ES ARRAY, TOMAMOS EL PRIMER VALOR
        if (is_array($raw)) {
            $raw = reset($raw);
        }

        // Normalizar
        $clean = trim((string)$raw);

        // Padre sin definir (muestra "-")
        $is_empty = (
            $clean === '' ||
            $clean === '0' ||
            $clean === '-' ||
            $clean === null
        );

        // Padre real: parent_cliente_id == ID
        $is_real_parent = ((int)$clean === (int)$p->ID);

        if ($is_empty || $is_real_parent) {
            $filtered[] = $p;
        }
    }

    return $filtered;

}, 10, 2);*/







/* ============================================================
 * 2) LÓGICA DE CLICS EN LOS NOMBRES
 * ============================================================ */
add_filter('get_edit_post_link', function($url, $post_id) {

    // Solo aplicar en gd_place
    if ( get_post_type($post_id) !== 'gd_place' ) {
        return $url;
    }

    // Solo en lista especial
    if ( !isset($_GET['lst_clnt']) || $_GET['lst_clnt'] != '1' ) {
        return $url;
    }

    $nombre = get_the_title($post_id);



 /* ============================================================
 * Primer clic → búsqueda en miscuentas
 * ============================================================ */
return admin_url(
    'edit.php?post_type=miscuentas&s=' . urlencode($nombre)
);

}, 10, 2);




/**
 * Monitor de rendimiento para funciones personalizadas
 */
function auditar_sistema_wordpress() {
    // Solo ejecutar para administradores para no afectar a usuarios finales
    if (!current_user_can('manage_options')) return;

    global $wp_actions;
    
    $pico_memoria = memory_get_peak_usage() / 1024 / 1024;
    $uso_actual = memory_get_usage() / 1024 / 1024;

    echo "<div style='position:fixed; bottom:0; right:0; background:#222; color:#0f0; padding:15px; z-index:99999; font-family:monospace; font-size:12px; border-left:4px solid #00ff00; max-height:400px; overflow-y:auto;'>";
    echo "<h3>📊 REPORTE DE RECURSOS</h3>";
    echo "Pico de RAM: " . round($pico_memoria, 2) . " MB<br>";
    echo "Uso Actual: " . round($uso_actual, 2) . " MB<br>";
    echo "----------------------------<br>";
    
    // Lista de tus funciones críticas para vigilar
    $mis_funciones = [
        'nueva_liquidadas',
        'obtener_cuentas',
        'reporte_diario',
        'agregar_cuenta',
        'abonar'
    ];

    foreach ($mis_funciones as $funcion) {
        if (has_action('admin_footer', $funcion) || has_action('admin_head', $funcion) || has_action('init', $funcion)) {
            // Intentamos medir el tiempo de carga de estas funciones específicamente
            echo "✅ Activa: <b>$funcion</b><br>";
        } else {
            echo "❌ Inactiva: $funcion<br>";
        }
    }

    echo "----------------------------<br>";
    echo "Total Hooks ejecutados: " . count($wp_actions);
    echo "</div>";
}

// Lo enganchamos al final de todo para capturar el pico máximo
add_action('admin_footer', 'auditar_sistema_wordpress', 9999);









// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';





