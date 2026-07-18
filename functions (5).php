<?php
session_start();
//header('Set-Cookie: nombre_cookie=valor; SameSite=None; Secure');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//setcookie( 'PHPSESSID', '', time() - 86400, '/folder/');
date_default_timezone_set("America/Mexico_City");

/**
 *  स्विच: Activa o desactiva el preloader globalmente.
 * true  -> El preloader se mostrará.
 * false -> El preloader estará desactivado.
 */
define('COCUM_PRELOADER_ACTIVO', true);

/**
 * Twenty Twenty-Two functions and definitions
 * 08may26
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
    remove_action('admin_menu', 'remove_user_menu_for_admin_aux');
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

    /* //NUEVOS REGISTROS (agregados al final, comentados como solicitado)
    remove_action('save_post_gd_place', 'asignar_padre_hijo_unificado', 20);
    remove_action('save_post_gd_place', 'cocum_force_categoria_padre_hijo_gd_place', 120);
    remove_action('save_post_gd_place', 'cocum_validar_nombre_unico_gd_place', 15);
    remove_action('save_post_miscuentas', 'sincronizar_datos_economicos_pago', 30);

    remove_action('load-edit.php', 'reporte_diario');

    remove_action('wp_trash_post', ''); // hay callback anónimo (closure), no removible por nombre
    remove_action('wp_logout', 'revertir_rol_al_cerrar_sesion', 1);
    remove_action('wp_logout', 'auto_limpiar_sesion_al_salir');

    remove_action('admin_init', 'desactivar_borrador_automatico', 1);
    remove_action('admin_init', 'bloquear_escritorio_para_admin_custom');

    remove_action('init', 'remover_todas_las_acciones');
    remove_action('init', 'otorgar_permisos_admin_aux');
    remove_action('init', 'enforce_superadmin_user_role');

    remove_action('template_redirect', 'control_acceso_universal');
    remove_action('add_meta_boxes', 'quitar_bloque_atraso_acf', 99);

    // Callbacks anónimos detectados (no removibles por nombre):
    // - varios add_action('admin_head', function(){...})
    // - varios add_action('admin_footer', function(){...})
    // - varios add_action('admin_init', function(){...})
    // - varios add_action('load-edit.php', function(){...})
    // - varios add_action('wp_ajax_update_comision_reporte_ajax', function(){...})*/
    
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
 * UI: En alta de Nuevo Cliente (gd_place padre) fijar categoría "Nuevo Cliente" y bloquear selector.
 */
add_action('admin_footer', function () {
    if (!is_admin()) return;
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'gd_place' || $screen->base !== 'post') return;

    // Solo en alta (post-new.php), no en edición
    if (!isset($_GET['post_type']) || $_GET['post_type'] !== 'gd_place' || isset($_GET['post'])) return;
    ?>
    <script>
jQuery(function($){
    // 1. INYECCIÓN CSS INMUTABLE
    // Al inyectar esto en el <head>, GeoDirectory no puede sobreescribirlo, 
    // sin importar cuántas veces recargue el campo por AJAX.
    $('head').append(`
        <style>
            /* Apunta directamente al contenedor Select2 que le sigue al ID de GeoDirectory */
            select#gd_placecategory + .select2-container,
            select[name="gd_placecategory[]"] + .select2-container {
                pointer-events: none !important; /* Desactiva los clics físicos */
                background-color: #f0f0f1 !important; /* Color gris de bloqueado */
                opacity: 0.8 !important;
            }
            /* Ocultar la 'X' para que no puedan eliminar la etiqueta */
            select#gd_placecategory + .select2-container .select2-selection__choice__remove,
            select[name="gd_placecategory[]"] + .select2-container .select2-selection__choice__remove {
                display: none !important;
            }
            /* Ocultar el cursor para que sea evidente que no se puede editar */
            select#gd_placecategory + .select2-container .select2-selection {
                cursor: not-allowed !important;
            }
        </style>
    `);

    // 2. FUNCIÓN PARA FORZAR EL VALOR A "Nuevo Cliente"
    function forzarValorCategoria() {
        // Usamos los IDs exactos de tus selectores
        const $select = $('select#gd_placecategory, select[name="gd_placecategory[]"]');
        if ($select.length === 0) return;

        let valObjetivo = null;
        $select.find('option').each(function(){
            if ($(this).text().trim() === 'Nuevo Cliente') {
                valObjetivo = $(this).val();
            }
        });

        if (valObjetivo) {
            const valorActual = $select.val();
            const necesitaActualizar = Array.isArray(valorActual) ? !valorActual.includes(valObjetivo) : valorActual !== valObjetivo;
            
            // Si no tiene el valor correcto, se lo inyectamos
            if (necesitaActualizar || valorActual == null) {
                $select.val([valObjetivo]);
                
                // Disparar la actualización visual solo si Select2 ya existe
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.trigger('change.select2');
                }
            }
        }
    }

    // 3. EL VIGÍA (MutationObserver)
    // Esto es mucho más potente que setTimeout o setInterval. 
    // Vigila el DOM y si GeoDirectory "parpadea" o recarga el formulario, 
    // vuelve a forzar el valor inmediatamente antes de que el usuario haga nada.
    const observer = new MutationObserver(function(mutations) {
        forzarValorCategoria();
    });

    // Le decimos que vigile todo el formulario (o el body) en busca de cambios
    observer.observe(document.body, { childList: true, subtree: true });

    // Ejecutamos una vez de inmediato por si ya estaba cargado
    forzarValorCategoria();
});
</script>

  
    <?php
}, 99);

/**
 * Backend seguro: forzar categoría según padre/hijo en gd_place.
 * - Padre => "cliente nuevo"
 * - Hijo  => "nueva cuenta"
 */
if (!function_exists('cocum_get_or_create_gd_place_term_id')) {
    function cocum_get_or_create_gd_place_term_id($name, $slug) {
        $tax = 'gd_placecategory';

        $term = get_term_by('slug', sanitize_title($slug), $tax);
        if ($term && !is_wp_error($term)) return intval($term->term_id);

        $term = get_term_by('name', $name, $tax);
        if ($term && !is_wp_error($term)) return intval($term->term_id);

        $created = wp_insert_term($name, $tax, ['slug' => sanitize_title($slug)]);
        if (!is_wp_error($created) && isset($created['term_id'])) return intval($created['term_id']);

        return 0;
    }
}

if (!function_exists('cocum_sync_geodir_default_category')) {
    function cocum_sync_geodir_default_category($post_id, $cat_id) {
        global $wpdb;
        $post_id = intval($post_id);
        $cat_id  = intval($cat_id);
        if ($post_id <= 0 || $cat_id <= 0) return;

        $table = $wpdb->prefix . 'geodir_gd_place_detail';

        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM {$table} WHERE post_id = %d LIMIT 1",
            $post_id
        ));

        if ($exists) {
            $wpdb->update(
                $table,
                [
                    'default_category' => (string)$cat_id,
                    'post_category'    => ',' . $cat_id . ',',
                ],
                ['post_id' => $post_id],
                ['%s', '%s'],
                ['%d']
            );
        }
    }
}

if (!function_exists('cocum_force_categoria_padre_hijo_gd_place')) {
    function cocum_force_categoria_padre_hijo_gd_place($post_id, $post, $update) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id)) return;
        if (!$post || $post->post_type !== 'gd_place') return;

        $cat_padre = cocum_get_or_create_gd_place_term_id('Nuevo Cliente', 'nuevo-cliente');
        $cat_hijo  = cocum_get_or_create_gd_place_term_id('Nueva Cuenta', 'nueva-cuenta');
        if ($cat_padre <= 0 || $cat_hijo <= 0) return;

        $parent = intval(get_post_meta($post_id, 'parent_cliente_id', true));
        $is_padre = ($parent === 0 || $parent === intval($post_id));

        $cat_objetivo = $is_padre ? $cat_padre : $cat_hijo;

        // Forzar taxonomía SIEMPRE
        wp_set_post_terms($post_id, [$cat_objetivo], 'gd_placecategory', false);

        // Sincronizar tabla geodirectory
        cocum_sync_geodir_default_category($post_id, $cat_objetivo);
    }
}
add_action('save_post_gd_place', 'cocum_force_categoria_padre_hijo_gd_place', 120, 3);








/**
 * PARCHE CATEGORÍAS GD_PLACE (padre/hijo) + sincronización GeoDirectory
 * Regla:
 * - PADRE  => categoría "cliente nuevo"
 * - HIJO   => categoría "nueva cuenta"
 */
if (!function_exists('cocum_get_or_create_gd_place_term_id')) {
    function cocum_get_or_create_gd_place_term_id($name, $slug) {
        $tax = 'gd_placecategory';

        $term = get_term_by('slug', sanitize_title($slug), $tax);
        if ($term && !is_wp_error($term)) {
            return intval($term->term_id);
        }

        $term = get_term_by('name', $name, $tax);
        if ($term && !is_wp_error($term)) {
            return intval($term->term_id);
        }

        $created = wp_insert_term($name, $tax, ['slug' => sanitize_title($slug)]);
        if (!is_wp_error($created) && isset($created['term_id'])) {
            return intval($created['term_id']);
        }

        return 0;
    }
}

if (!function_exists('cocum_sync_geodir_default_category')) {
    function cocum_sync_geodir_default_category($post_id, $cat_id) {
        global $wpdb;
        $post_id = intval($post_id);
        $cat_id  = intval($cat_id);
        if ($post_id <= 0 || $cat_id <= 0) return;

        $table = $wpdb->prefix . 'geodir_gd_place_detail';

        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM {$table} WHERE post_id = %d LIMIT 1",
            $post_id
        ));

        if ($exists) {
            $wpdb->update(
                $table,
                [
                    'default_category' => (string)$cat_id,
                    'post_category'    => ',' . $cat_id . ',',
                ],
                ['post_id' => $post_id],
                ['%s', '%s'],
                ['%d']
            );
        }
    }
}

if (!function_exists('cocum_apply_gd_place_category_rule')) {
    function cocum_apply_gd_place_category_rule($post_id) {
        if (get_post_type($post_id) !== 'gd_place') return;

        $cat_padre = cocum_get_or_create_gd_place_term_id('Nuevo Cliente', 'cliente-nuevo');
        $cat_hijo  = cocum_get_or_create_gd_place_term_id('Nueva Cuenta', 'nueva-cuenta');

        if ($cat_padre <= 0 || $cat_hijo <= 0) return;

        $parent = intval(get_post_meta($post_id, 'parent_cliente_id', true));
        $is_padre = ($parent === 0 || $parent === intval($post_id));
        $cat_objetivo = $is_padre ? $cat_padre : $cat_hijo;

        // Regla de negocio: forzar categoría correcta
        wp_set_post_terms($post_id, [$cat_objetivo], 'gd_placecategory', false);

        // Sincronizar detalle geodirectory
        cocum_sync_geodir_default_category($post_id, $cat_objetivo);
    }
}

// Aplicar en guardado
add_action('save_post_gd_place', function($post_id, $post, $update){
    if (wp_is_post_revision($post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    cocum_apply_gd_place_category_rule($post_id);
}, 120, 3);

// Reparación manual históricos:
// /wp-admin/edit.php?post_type=gd_place&fix_gd_place_cat=1
add_action('admin_init', function(){
    if (!is_admin()) return;
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['fix_gd_place_cat']) || $_GET['fix_gd_place_cat'] != '1') return;

    $ids = get_posts([
        'post_type'      => 'gd_place',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);

    if (!empty($ids)) {
        foreach ($ids as $pid) {
            cocum_apply_gd_place_category_rule(intval($pid));
        }
    }
}, 20);


/**
 * Normaliza nombre para comparación robusta.
 * - lowercase
 * - trim
 * - colapsa espacios múltiples
 */
if (!function_exists('cocum_normalize_cliente_nombre')) {
    function cocum_normalize_cliente_nombre($name) {
        $name = wp_strip_all_tags((string)$name);
        $name = preg_replace('/\s+/u', ' ', $name);
        $name = trim($name);
        $name = mb_strtolower($name, 'UTF-8');
        return $name;
    }
}

/**
 * Detecta si un gd_place es padre (Nuevo Cliente) o hijo (Nueva Cuenta).
 */
if (!function_exists('cocum_is_gd_place_padre')) {
    function cocum_is_gd_place_padre($post_id) {
        $post_id = intval($post_id);
        $parent = intval(get_post_meta($post_id, 'parent_cliente_id', true));
        return ($parent === 0 || $parent === $post_id);
    }
}

/**
 * Busca si existe otro gd_place (del mismo author) con el mismo nombre normalizado.
 * Solo aplica para padres.
 */
if (!function_exists('cocum_existe_nombre_duplicado_gd_place_padre')) {
    function cocum_existe_nombre_duplicado_gd_place_padre($post_id, $nombre, $author_id) {
        $post_id   = intval($post_id);
        $author_id = intval($author_id);
        $target    = cocum_normalize_cliente_nombre($nombre);
        if ($target === '') return false;

        $q = new WP_Query([
            'post_type'      => 'gd_place',
            'post_status'    => ['publish', 'draft', 'pending', 'private', 'future'],
            'posts_per_page' => -1,
            'author'         => $author_id,
            'fields'         => 'ids',
            'post__not_in'   => $post_id > 0 ? [$post_id] : [],
        ]);

        if (!$q->have_posts()) return false;

        foreach ($q->posts as $pid) {
            // Solo comparar contra padres (Nuevo Cliente)
            if (!cocum_is_gd_place_padre($pid)) {
                continue;
            }

            $titulo_existente = get_the_title($pid);
            if (cocum_normalize_cliente_nombre($titulo_existente) === $target) {
                return true;
            }
        }

        return false;
    }
}

/**
 * Validación principal al guardar gd_place.
 * - Solo bloquea si el post actual es padre (Nuevo Cliente).
 * - No bloquea hijos (Nueva Cuenta).
 * - Compara por author actual.
 */
if (!function_exists('cocum_validar_nombre_unico_gd_place')) {
    function cocum_validar_nombre_unico_gd_place($post_id, $post, $update) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id)) return;
        if (!$post || $post->post_type !== 'gd_place') return;

        $author_id = intval($post->post_author ?: get_current_user_id());
        $titulo    = $post->post_title;

        // Si es hijo, permitir repetido
        if (!cocum_is_gd_place_padre($post_id)) {
            return;
        }

        // Si duplicado en padres del mismo author -> bloquear
        if (cocum_existe_nombre_duplicado_gd_place_padre($post_id, $titulo, $author_id)) {
            wp_die(
                '<h1>Cliente duplicado</h1><p>Ese cliente ya existe para este usuario. Verifica el nombre (se comparan mayúsculas/minúsculas y espacios).</p>',
                'Nombre duplicado',
                ['response' => 400, 'back_link' => true]
            );
        }
    }
}
add_action('save_post_gd_place', 'cocum_validar_nombre_unico_gd_place', 15, 3);


/**
 * Muestra un mensaje personalizado en el listado de 'miscuentas' cuando un cliente
 * no tiene cuentas activas pero sí tiene un historial de cuentas terminadas.
 *
 * @param WP_Query $query La consulta principal de WordPress.
 */
function cocum_aviso_historial_disponible($query) {
    // Solo actuar en el admin, en la consulta principal y para el CPT 'miscuentas'
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'miscuentas') {
        return;
    }

    // Verificar que estamos en la pantalla de edición
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'miscuentas' || $screen->base !== 'edit') {
        return;
    }

    // Condiciones: Hay una búsqueda y no se está viendo el historial.
    if (isset($_GET['s']) && !empty($_GET['s']) && !isset($_GET['ver_historial'])) {
        $search_term = sanitize_text_field($_GET['s']);

        // Contar cuántas cuentas 'activas' hay para esta búsqueda
        $args_activas = $query->query_vars;
        $args_activas['posts_per_page'] = 1; // Solo necesitamos saber si hay al menos una
        $args_activas['fields'] = 'ids';
        $query_activas = new WP_Query($args_activas);

        // Si no hay cuentas activas...
        if ($query_activas->post_count === 0) {
            // ...verificamos si hay cuentas 'terminado' para el mismo cliente.
            $args_terminadas = [
                'post_type' => 'miscuentas',
                's' => $search_term,
                'posts_per_page' => 1,
                'fields' => 'ids',
                'meta_query' => [['key' => 'cuenta', 'value' => 'terminado']]
            ];
            $query_terminadas = new WP_Query($args_terminadas);

            // Si hay terminadas, mostramos el aviso y detenemos la carga.
            if ($query_terminadas->have_posts()) {
                add_action('admin_notices', function() {
                    echo '<div class="notice notice-info"><p>Al parecer, ya se terminaron las cuentas activas para este cliente. Haz clic en el botón <strong>\'Ver Historial (Terminados)\'</strong> para verificar.</p></div>';
                });

                // Forzamos a que la consulta principal no devuelva nada para que WP no muestre la tabla.
                $query->set('post__in', [0]);
            }
        }
    }
}
add_action('pre_get_posts', 'cocum_aviso_historial_disponible');

/**
 * Capa extra para altas rápidas/flows alternos antes de insertar.
 */
if (!function_exists('cocum_bloquear_insert_gd_place_duplicado')) {
    function cocum_bloquear_insert_gd_place_duplicado($data, $postarr) {
        if (!is_admin()) return $data;
        if (($data['post_type'] ?? '') !== 'gd_place') return $data;
        if (($data['post_status'] ?? '') === 'auto-draft') return $data;

        $post_id   = isset($postarr['ID']) ? intval($postarr['ID']) : 0;
        $author_id = intval($data['post_author'] ?? get_current_user_id());
        $titulo    = (string)($data['post_title'] ?? '');

        // Intentar detectar padre/hijo desde postarr/meta enviado
        $parent_meta = 0;
        if (isset($_POST['parent_cliente_id'])) {
            $parent_meta = intval($_POST['parent_cliente_id']);
        } elseif (isset($_POST['acf']) && is_array($_POST['acf'])) {
            // Si conoces la key ACF exacta de parent_cliente_id, se puede agregar aquí
        } elseif ($post_id > 0) {
            $parent_meta = intval(get_post_meta($post_id, 'parent_cliente_id', true));
        }

        $is_padre = ($post_id > 0)
            ? cocum_is_gd_place_padre($post_id)
            : ($parent_meta === 0);

        // Si no es padre, no bloquear
        if (!$is_padre) return $data;

        if (cocum_existe_nombre_duplicado_gd_place_padre($post_id, $titulo, $author_id)) {
            wp_die(
                '<h1>Cliente duplicado</h1><p>Ese cliente ya existe para este usuario. Verifica el nombre (se comparan mayúsculas/minúsculas y espacios).</p>',
                'Nombre duplicado',
                ['response' => 400, 'back_link' => true]
            );
        }

        return $data;
    }
}
add_filter('wp_insert_post_data', 'cocum_bloquear_insert_gd_place_duplicado', 20, 2);





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















  

/**
 * Sincroniza los totales y estados de una cuenta de pago.
 * Se ejecuta solo al GUARDAR, no al cargar el listado.
 */
function sincronizar_datos_economicos_pago($idPost_cuentas) {
    if (get_post_type($idPost_cuentas) !== 'miscuentas') return;

    $id_cliente_ref = get_field("id_cliente_cuenta", $idPost_cuentas);
    if (!$id_cliente_ref) return;

    // El sistema permite registrar hasta el doble de cuotas autorizadas (ej. 13 cuotas = 26 campos de pago)
    // Si el bucle solo llega a 'cuotas_cliente', ignorará los pagos registrados en los campos extra.
    $cuotas_base = intval(get_field("cuotas_cliente", $id_cliente_ref) ?? 0);
    $cuotas_autorizadas = $cuotas_base * 2;
    
    $contadorPagos = 0;
    $totalPagado = 0;
    $totalPagadoHoy = 0;
    $hoy = date("d/m/Y");
    $ultima_fecha_pago = '';
    
    // Obtenemos los pagos que han sido cubiertos por abonos o saldos extras (campo 'cubrePagos')
    $pagos_cubiertos_abono = intval(get_field("cubrePagos", $idPost_cuentas) ?? 0);

    // Cálculos basados en el repetidor de pagos
    if (have_rows('pagos_abono', $idPost_cuentas)) {
        while (have_rows('pagos_abono', $idPost_cuentas)) {
            the_row();
            for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
                // MODIFICADO POR BLACKBOX - 2026-05-12 19:30
                // Leer variantes de nombre de campo para evitar perder pagos al editar/borrar.
                $monto_raw = get_sub_field('pago_#' . $i);
                if ($monto_raw === null || $monto_raw === '') {
                    $monto_raw = get_sub_field('pago#' . $i);
                }
                $monto = floatval($monto_raw);

                // Intentamos obtener la fecha con y sin guion bajo por inconsistencias en el registro de campos
                $fecha_p = get_sub_field('fecha_del_pago#' . $i);
                if (!$fecha_p) {
                    $fecha_p = get_sub_field('fecha_del_pago_#' . $i);
                }

                if ($monto > 0) {
                    $contadorPagos++;
                    $totalPagado += $monto;
                    
                    // Sumar al total de hoy si la fecha coincide
                    if ($fecha_p == $hoy) {
                        $totalPagadoHoy += $monto;
                    }
                    if ($fecha_p) {
                        $ultima_fecha_pago = $fecha_p;
                    }
                }
            }
        }
    }

    // MODIFICADO POR BLACKBOX - 2026-05-12 19:30
    // No forzar numero_pagos con cubrePagos: al borrar pagos debe bajar inmediatamente (ej. 4 -> 3).
    // 'cubrePagos' se usa para lógica de abonos, no para sobreescribir conteo real del repetidor.

    // Días de atraso
    $fecha_prestamo = get_the_date('Y-m-d', $idPost_cuentas);
    $hoy_date = date("Y-m-d");
    $intervalo = date_diff(date_create($fecha_prestamo), date_create($hoy_date));
    $dias_transcurridos = intval($intervalo->format('%R%a'));
    $diasAtrasados = max(0, $dias_transcurridos - $contadorPagos);

    // Cálculo de fechas de cobro
    $fecha_cobro_db = '';
    $fecha_prox_cobro_db = '';

    if ($ultima_fecha_pago) {
        // Convertimos el formato d/m/Y del repetidor a Y-m-d para la base de datos
        $date_obj = DateTime::createFromFormat('d/m/Y', $ultima_fecha_pago);
        if ($date_obj) {
            $fecha_cobro_db = $date_obj->format('Y-m-d');
            $date_obj->modify('+1 day');
            $fecha_prox_cobro_db = $date_obj->format('Y-m-d');
        }
    }

    // MODIFICADO: No sobreescribir si ya existe una fecha válida y no hay pagos nuevos
    if (!$fecha_prox_cobro_db) {
        $fecha_existente = get_post_meta($idPost_cuentas, 'fecha_prox_cobro', true);
        $fecha_prox_cobro_db = !empty($fecha_existente) ? $fecha_existente : date('Y-m-d');
    }

    // CÁLCULO DE PAGOS HOY (Sincronizado con la lógica de abonos)
    // Buscamos abonos registrados hoy para este registro de miscuentas
    $abonos_hoy = get_posts(array(
        'post_type' => 'abono',
        'posts_per_page' => -1,
        'meta_query' => array(
            array('key' => 'id_cliente', 'value' => $idPost_cuentas, 'compare' => '='),
        ),
        'date_query' => array(
            array('year' => date('Y'), 'month' => date('m'), 'day' => date('d'))
        )
    ));
    
    $abono_sum_hoy = 0;
    $total_saldo_sum = 0;
    foreach ($abonos_hoy as $abono_p) {
        $abono_sum_hoy += floatval(get_post_meta($abono_p->ID, 'abono', true));
        $cubre = intval(get_post_meta($abono_p->ID, 'cubrePagos', true));
        if ($cubre >= 1) {
            $total_saldo_sum += floatval(get_post_meta($abono_p->ID, 'total_saldo', true));
        }
    }
    $pagos_hoy_calculado = ($totalPagadoHoy - $total_saldo_sum) + $abono_sum_hoy;

    // ACTUALIZACIÓN DE BASE DE DATOS (Centralizada)
    update_field("pagos_hoy", $pagos_hoy_calculado, $idPost_cuentas);
    update_field("total_pagos", $totalPagado, $idPost_cuentas);
    update_field("numero_pagos", $contadorPagos, $idPost_cuentas);
    update_field("atraso_abono", $diasAtrasados, $idPost_cuentas);
    update_field("cuotas_autorizadas", $cuotas_autorizadas, $idPost_cuentas);
    
    // Guardar las fechas calculadas en el registro de miscuentas
    if ($fecha_cobro_db) {
        update_field("fecha_cobro", $fecha_cobro_db, $idPost_cuentas);
    }
    update_field("fecha_prox_cobro", $fecha_prox_cobro_db, $idPost_cuentas);

    // Actualizar estado de cuenta
    $monto_total_cuenta = floatval(get_field("monto_cuenta", $idPost_cuentas));
    $abonos_extra = floatval(get_field("suma_abonado", $idPost_cuentas));
    
    if ($monto_total_cuenta > 0 && round($totalPagado + $abonos_extra, 2) >= $monto_total_cuenta) {
        update_field("cuenta", "terminado", $idPost_cuentas);
    } else {
        update_field("cuenta", "activa", $idPost_cuentas);
    }

    // Sincronizar con el GD_PLACE (Padre)
    $id_gd_place = get_field("id_lista_cliente", $id_cliente_ref);
    if ($id_gd_place) {
        update_field("dias_atraso_cliente", $diasAtrasados, $id_gd_place);
        
        // 🛡️ REGLA DE PRIORIDAD MEJORADA:
        // Antes de decidir el estado del gd_place, verificamos el estado REAL de todas sus cuentas hijas.
        $estado_final_gd_place = 'terminado'; // Asumimos terminado por defecto

        $cuentas_vinculadas = get_posts(array(
            'post_type'  => 'cliente',
            'meta_key'   => 'id_lista_cliente',
            'meta_value' => $id_gd_place,
            'fields'     => 'ids',
            'posts_per_page' => -1
        ));

        foreach ($cuentas_vinculadas as $c_id) {
            $pago_rel_query = new WP_Query(array(
                'post_type'  => 'miscuentas',
                'meta_key'   => 'id_cliente_cuenta',
                'meta_value' => $c_id,
                'posts_per_page' => 1,
                'fields' => 'ids'
            ));

            if ($pago_rel_query->have_posts()) {
                $pago_id = $pago_rel_query->posts[0];
                // Forzamos la lectura del estado más reciente desde la BD
                $estado_cuenta_hija = get_post_meta($pago_id, 'cuenta', true);
                if ($estado_cuenta_hija === 'activa') {
                    $estado_final_gd_place = 'activa'; // Si encontramos una activa, el padre es activo.
                    break; // No necesitamos seguir buscando
                }
            }
        }
        update_field("cuentaGD", $estado_final_gd_place, $id_gd_place);


        
        // Sincronizar fechas con la tabla de Clientes (gd_place)
        if ($fecha_cobro_db) {
            update_field("fecha_ultimo_cobro_cliente", date("d/m/Y", strtotime($fecha_cobro_db)), $id_gd_place);
        }
        update_field("fecha_prox_cobro_cliente", date("d/m/Y", strtotime($fecha_prox_cobro_db)), $id_gd_place);
    }
}

// Ejecutar al guardar el post de miscuentas
add_action('save_post_miscuentas', 'sincronizar_datos_economicos_pago', 30);

// Forzar sincronización también cuando ACF guarda (evita desfase en conteo visual/listado)
add_action('acf/save_post', function($post_id){
    if (get_post_type($post_id) === 'miscuentas') {
        sincronizar_datos_economicos_pago($post_id);
    }
}, 20);

// MODIFICADO POR BLACKBOX - 2026-05-12 20:20
// Segunda pasada tardía para asegurar persistencia completa de ACF y evitar retardo visual.
add_action('acf/save_post', function($post_id){
    if (get_post_type($post_id) !== 'miscuentas') {
        return;
    }

    sincronizar_datos_economicos_pago($post_id);

    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[miscuentas-sync-late] post_id=' . $post_id . ' numero_pagos=' . get_field('numero_pagos', $post_id) . ' total_pagos=' . get_field('total_pagos', $post_id));
    }
}, 999);

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
                     'posts_per_page' => -1,
                        /*'no_found_rows' => true*/)

            );

               // PASO 2: Cargar TODOS los abonos de hoy UNA SOLA VEZ (antes del loop)
               $todos_abonos_hoy = get_posts(array(
                   'post_type' => 'abono',
                   'numberposts' => -1,
                   'date_query' => array(
                       array(
                           'year' => date('Y'),
                           'month' => date('m'),
                           'day' => date('d'),
                       )
                   )
               ));
               
               // Cargar abonos con cobertura (cubrePagos)
               $todos_abonos_cobertura = get_posts(array(
                   'post_type' => 'abono',
                   'numberposts' => -1,
                   'date_query' => array(
                       array(
                           'year' => date('Y'),
                           'month' => date('m'),
                           'day' => date('d'),
                       )
                   ),
                   'meta_query' => array(
                       array(
                           'key' => 'cubrePagos',
                           'value' => 1,
                           'compare' => '>=',
                       )
                   )
               ));
               
               // ============================================
               // OPTIMIZACIÓN: PRE-CARGAR E INDEXAR DATOS
               // ============================================
               
               // Pre-cargar todos los posts de miscuentas
               $all_miscuentas_posts = get_posts(array(
                   'post_type' => 'miscuentas',
                   'author' => $id_author_actual_oc,
                   'posts_per_page' => -1,
                   'fields' => 'ids'  // Solo IDs para rapidez
               ));
               
               // MODIFICADO POR BLACKBOX - 2026-05-12 20:40
               // No recalcular en bloque aquí: causaba desfase visual por orden de render/cache.
               // Se recalcula por fila más abajo para lectura en vivo.
               $campos_miscuenta_cache = array();
               foreach ($all_miscuentas_posts as $misc_id) {
                   $campos_miscuenta_cache[$misc_id] = get_fields($misc_id);
               }
               
               // Pre-cargar todos los posts de clientes
               $all_clientes_posts = get_posts(array(
                   'post_type' => 'cliente',
                   'posts_per_page' => -1,
                   'fields' => 'ids'
               ));
               
               // Pre-cargar campos de clientes indexados por ID
               $campos_cuenta_cache = array();
               foreach ($all_clientes_posts as $cliente_id) {
                   $campos_cuenta_cache[$cliente_id] = get_fields($cliente_id);
               }
               
               // Pre-cargar metadatos de abonos indexados por ID
               $abonos_meta_cache = array();
               $all_abonos = array_merge($todos_abonos_hoy, $todos_abonos_cobertura);
               foreach ($all_abonos as $abono) {
                   if (!isset($abonos_meta_cache[$abono->ID])) {
                       $abonos_meta_cache[$abono->ID] = array(
                           'id_cliente' => get_post_meta($abono->ID, 'id_cliente', true),
                           'abono' => get_post_meta($abono->ID, 'abono', true),
                           'total_saldo' => get_post_meta($abono->ID, 'total_saldo', true)
                       );
                   }
               }
               
               // Indexar abonos por cliente para acceso rápido
               $abonos_por_cliente = array();
               foreach ($todos_abonos_hoy as $abono) {
                   $cliente_id = $abonos_meta_cache[$abono->ID]['id_cliente'];
                   if (!isset($abonos_por_cliente[$cliente_id])) {
                       $abonos_por_cliente[$cliente_id] = array();
                   }
                   $abonos_por_cliente[$cliente_id][] = $abono;
               }
               
               // Indexar abonos con cobertura por cliente
               $abonos_cobertura_por_cliente = array();
               foreach ($todos_abonos_cobertura as $abono) {
                   $cliente_id = $abonos_meta_cache[$abono->ID]['id_cliente'];
                   if (!isset($abonos_cobertura_por_cliente[$cliente_id])) {
                       $abonos_cobertura_por_cliente[$cliente_id] = array();
                   }
                   $abonos_cobertura_por_cliente[$cliente_id][] = $abono;
               }
               
                  if (   $your_custom_que->have_posts()  ){ //inicio if 1
                 
             	while ( $your_custom_que->have_posts() ) {  //inicio while
             	   
             	   $your_custom_que->the_post();
             	
                    $sumPagosHoy=0;
                    // RESET DE VARIABLES POR CADA FILA (Evita que una cuenta herede datos de la anterior)
                    $contadorPagos = 0;
                    $contadorPagosHoy = 0;
                    $totalPagado = 0;
                    $totalPagadoHoy = 0;
                    $diasAtraso = 0;
                    $tot_abonos = 0;
                    $pagoYabono = 0;
                    $restaIngresoReal = 0;
                    $total_saldo_sum = 0;
             	
             	    

                     $idPost_cuentas = get_the_ID();

                     // MODIFICADO POR BLACKBOX - 2026-05-12 19:45
                     // Forzar invalidación de cache y sincronización por fila para evitar retardo visual.
                     clean_post_cache($idPost_cuentas);
                     wp_cache_delete($idPost_cuentas, 'post_meta');
                     sincronizar_datos_economicos_pago($idPost_cuentas);

                     // Releer datos frescos tras sincronizar.
                     $campos_miscuenta = get_fields($idPost_cuentas);
                     if (!is_array($campos_miscuenta)) {
                         $campos_miscuenta = array();
                     }

                     
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
                   
        	  	
     
     
                
                        if($campos_miscuenta["pagos_hoy"] > 0){
    
                           $sumPagosHoy = $sumPagosHoy + $campos_miscuenta["pagos_hoy"];
                        }
                            


               //$idPost_cuentas es la id en bucle de "miscuentas" es decir la table de "pagos"
              // $idCuenta = $campos_miscuenta["id_cliente_cuenta"];
               
                     
               // PARTE 1: Recuperación robusta del ID de Cuenta (Triple Blindaje)
               // Gemini 19/05/26 01:15
               $idCuentaRaw = !empty($campos_miscuenta["id_cliente_cuenta"]) ? $campos_miscuenta["id_cliente_cuenta"] : get_post_meta($idPost_cuentas, 'id_cliente_cuenta', true);
               if (empty($idCuentaRaw)) {
                   $idCuentaRaw = get_post_meta($idPost_cuentas, 'field_63644de84872b', true); // Clave técnica ACF
               }
               if (is_array($idCuentaRaw)) { $idCuentaRaw = reset($idCuentaRaw); }
               $idCuenta = intval($idCuentaRaw);


               // Usar campos precargados en cache
               $campos_cuenta = isset($campos_cuenta_cache[$idCuenta]) ? $campos_cuenta_cache[$idCuenta] : array();
           
               // MODIFICADO POR BLACKBOX - 2026-05-12 18:25
               // En listado, usar mismo criterio de sincronización (doble de cuotas base).
               $cuotas_autorizadas = intval($campos_cuenta["cuotas_cliente"]) * 2;
            
                      
             
          
                    
        	 if( have_rows('pagos_abono') ){	 /// INICIO IF
       
             while (  have_rows('pagos_abono')) //inicio while 2
              {
             
                  the_row();
          
      
              
               
            
              
             // OPTIMIZACIÓN: Se eliminó update_field del listado. 
             // Ahora se procesa en sincronizar_datos_economicos_pago() al guardar.


            
             
             
             for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
              
         

           
             // MODIFICADO POR BLACKBOX - 2026-05-12 18:25
             $valorPago =  'pago_#' . $i ;
             $valorPagoAlt = 'pago#' . $i ;
              
             $fechaDelPago = 'fecha_del_pago#'. $i ;
             $fechaDelPagoAlt = 'fecha_del_pago_#'. $i ;
            
             $montoPago = get_sub_field($valorPago);
             if ($montoPago === null || $montoPago === false || $montoPago === '') {
                 $montoPago = get_sub_field($valorPagoAlt);
             }

             $fechaPago = get_sub_field($fechaDelPago);
             if (!$fechaPago) {
                 $fechaPago = get_sub_field($fechaDelPagoAlt);
             }

                     if(floatval($montoPago) > 0)
                     {
                         
                        $contadorPagos++;
                        $totalPagado =  $totalPagado + floatval($montoPago);
                      
                         
                     } 
                     
                     
                     
                     
                     if(floatval($montoPago) > 0 && $fechaPago == $hoy_pago_registro)
                     {
                         
                       $contadorPagosHoy++;
                       $totalPagadoHoy =     $totalPagadoHoy + floatval($montoPago);
                      
                         
                     } 
                       
                         
                }         
      
                      $tot_abonos = $campos_miscuenta["suma_abonado"];
                      
                         
                         //$today = date('Y-m-d');
                      //$idPost_cuentas = ... ; // Tu valor aquí.

                     
                      

                      //$idPost_cuentas = ""; // Asegúrate de asignar el valor correcto del ID del cliente aquí
                      

                      //$idPost_cuentas = ""; // change this to match the corresponding client id
                      
                      // PASO 2: Usar abonos indexados (sin query ni get_post_meta repetido)
                      $abonos_cliente_hoy = isset($abonos_por_cliente[$idPost_cuentas]) ? $abonos_por_cliente[$idPost_cuentas] : array();
                      
                      $abono_sum_hoy = 0;
                      if (!empty($abonos_cliente_hoy)) {
                          $total_abonos = array_map(function($abono) use ($abonos_meta_cache) {
                              return $abonos_meta_cache[$abono->ID]['abono'];
                          }, $abonos_cliente_hoy);
                          $abono_sum_hoy = array_sum($total_abonos);
                      }
                      
                     
                      
                    
                   


                      ?> 
                              
                      <script type="text/javascript">
                      jQuery(document).ready(function() {
            
                       //alert(<?php echo  $abono_sum_hoy   ;  ?>);
            
                        
                       });
                       </script>
             
                     <?php


                      
                      $total_saldo_sum = 0;
                      if (!empty($abonos_cobertura_cliente)) {
                          $total_saldos = array_map(function($abono) use ($abonos_meta_cache) {
                              return $abonos_meta_cache[$abono->ID]['total_saldo'];
                          }, $abonos_cobertura_cliente);
                          $total_saldo_sum = array_sum($total_saldos);
                      }


                  
                      
                      //echo $total_saldo_sum;


                        //15/12/23  sin abono

                      //$pagoYabono =  (float) $tot_abonos + (float) $totalPagado;
                         $pagoYabono =   (float) $totalPagado;
                      
                            
 
                          $restaIngresoReal = ($totalPagadoHoy - $total_saldo_sum)+ $abono_sum_hoy;
                          $restaIngresoReal = ($totalPagadoHoy - $total_saldo_sum) + $abono_sum_hoy;
                          
                          

                // update_field("pagos_hoy", $restaIngresoReal); // Movido a save_post
                // update_field("total_pagos", $pagoYabono);   // Movido a save_post
                // update_field("numero_pagos", $contadorPagos); // Movido a save_post

                
  
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
                       
                         $numPagos = $contadorPagos;
                         
                        
                         $hoy = date_create($nowDay);
                         $fecha_origen = date_create($fecha_prestamo);
                         
                         $interval = date_diff($fecha_origen, $hoy);
                         
                         if($numPagos>0){
                         $diasAtrasados =  ($interval->format('%R%a days')) - $numPagos;
                         }
                         
                         if( $diasAtrasados<0){
                             $diasAtrasados=0;
                         }
                        
                // update_field("atraso_abono", $diasAtrasados); // Movido a save_post
            // rewind_posts();             
        // wp_reset_postdata(); 
         
         
        /////////////////////////////////////////////////////////////////
        //////////////////////// clasificar atraso/////////////////
        
                $posts_ids_ =  $idPost_cuentas;
                        
                $idCliente = $idCuenta;
                // MODIFICADO: Fallback a get_post_meta si ACF devuelve vacío
                //$idClienteList = !empty($campos_cuenta["id_lista_cliente"]) ? $campos_cuenta["id_lista_cliente"] : get_post_meta($idCliente, 'id_lista_cliente', true);

                // Validación de seguridad para evitar IDs en blanco
               /* if (empty($idClienteList)) {
                    continue;
                }*/
                
                       
                    // PARTE 2: Recuperación robusta del ID del Cliente gd_place (Triple Blindaje)
                // Gemini 19/05/26 01:15
                $idClienteListRaw = !empty($campos_cuenta["id_lista_cliente"]) ? $campos_cuenta["id_lista_cliente"] : get_post_meta($idCliente, 'id_lista_cliente', true);
                if (empty($idClienteListRaw) && $idCliente > 0) {
                    $idClienteListRaw = get_post_meta($idCliente, 'field_6371dda213f5d', true); // Clave técnica
                }
                if (is_array($idClienteListRaw)) { $idClienteListRaw = reset($idClienteListRaw); }
                $idClienteList = intval($idClienteListRaw);


                $campos_lista = get_fields($idClienteList);
                        
                        //Obtengo datos de table de tabla pagos(miscuentas)
                        $atrasoDias = $diasAtrasados;
                        $fechaUltimoCobro = $campos_miscuenta["fecha_cobro"];
                        // MODIFICADO POR GEMINI - Fallback para fecha si ACF devuelve vacío
                        $fechaProximoCobro = !empty($campos_miscuenta["fecha_prox_cobro"]) ? $campos_miscuenta["fecha_prox_cobro"] : get_post_meta($idPost_cuentas, 'fecha_prox_cobro', true);
                        //$hoy_pago = date('d/m/Y');
                                  // 1) Mantén tus variables como FECHAS (strings d/m/Y)
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
                              // Usar cache de clientes si está disponible, sino hacer get_fields
                              $campos_lista = isset($campos_cuenta_cache[$idClienteList]) ? $campos_cuenta_cache[$idClienteList] : get_fields($idClienteList);
                              
                              // Actualizar solo si los valores cambiaron
                              $fecha_ultimo_cobro_formatted = date("d/m/Y", strtotime($fechaUltimoCobro));
                              $fecha_prox_cobro_formatted = date("d/m/Y", strtotime($fechaProximoCobro));
                              
                              $dias_atraso_actual = isset($campos_lista['dias_atraso_cliente']) ? $campos_lista['dias_atraso_cliente'] : '';
                              if ($dias_atraso_actual != $atrasoDias) {
                                  update_field("dias_atraso_cliente", $atrasoDias, $idClienteList);
                              }
                              
                              $fecha_ultimo_cobro_actual = isset($campos_lista['fecha_ultimo_cobro_cliente']) ? $campos_lista['fecha_ultimo_cobro_cliente'] : '';
                              if ($fecha_ultimo_cobro_actual !== $fecha_ultimo_cobro_formatted) {
                                  update_field("fecha_ultimo_cobro_cliente", $fecha_ultimo_cobro_formatted, $idClienteList);
                              }
                              
                              $fecha_prox_cobro_actual = isset($campos_lista['fecha_prox_cobro_cliente']) ? $campos_lista['fecha_prox_cobro_cliente'] : '';
                              if ($fecha_prox_cobro_actual !== $fecha_prox_cobro_formatted) {
                                  update_field("fecha_prox_cobro_cliente", $fecha_prox_cobro_formatted, $idClienteList);
                              }
                        
                        
                    
                        
                        
                          /////////////////  LISTADO CLIENTE A COBRAR    ///////////////////////// 
                        
                         //if(  $atrasoDias >0 & get_field("estatus_pago", $posts_ids_)==" " | get_field("estatus_pago", $posts_ids_)=="" | $fecha_prestamo_dmy > $nowDaydmy){
                         //if(  $fechaProximoCobro < $hoy_pago || $atrasoDias >0 & get_field("estatus_pago", $posts_ids_)==" " || get_field("monto_cuenta", $posts_ids_)==" " || get_field("estatus_pago", $posts_ids_)==" " ||  get_field("estatus_pago", $posts_ids_)=="")
            

                       // if($fecha_prestamo_dmy < $nowDaydmy |  get_field("estatus_pago", $idPost_cuentas)==" " & get_field("monto_cuenta", $idPost_cuentas)!=" " ){
                            
                            if( $campos_miscuenta["cuenta"] == "activa"  ){
                               
                                  // 🛡️ REGLA DE ORO: Si detectamos que esta cuenta está activa y vamos a pintar de rojo,
                                // forzamos que el estado global del cliente (gd_place) sea "activa".
                                if (get_post_meta($idClienteList, 'cuentaGD', true) !== 'activa') {
                                    update_post_meta($idClienteList, 'cuentaGD', 'activa');
                                }

                             //actualiza table de lista de clientes
                              // Usar cache de clientes si está disponible, sino hacer get_fields
                              $campos_lista_activa = isset($campos_cuenta_cache[$idClienteList]) ? $campos_cuenta_cache[$idClienteList] : get_fields($idClienteList);
                              
                              $fecha_ultimo_cobro_formatted_activa = date("d/m/Y", strtotime($fechaUltimoCobro));
                              $fecha_prox_cobro_formatted_activa = date("d/m/Y", strtotime($fechaProximoCobro));
                              
                              // Actualizar solo si los valores cambiaron
                              $dias_atraso_actual_activa = isset($campos_lista_activa['dias_atraso_cliente']) ? $campos_lista_activa['dias_atraso_cliente'] : '';
                              if ($dias_atraso_actual_activa != $atrasoDias) {
                                  update_field("dias_atraso_cliente", $atrasoDias, $idClienteList);
                              }
                              
                              $fecha_ultimo_cobro_actual_activa = isset($campos_lista_activa['fecha_ultimo_cobro_cliente']) ? $campos_lista_activa['fecha_ultimo_cobro_cliente'] : '';
                              if ($fecha_ultimo_cobro_actual_activa !== $fecha_ultimo_cobro_formatted_activa) {
                                  update_field("fecha_ultimo_cobro_cliente", $fecha_ultimo_cobro_formatted_activa, $idClienteList);
                              }
                              
                              $fecha_prox_cobro_actual_activa = isset($campos_lista_activa['fecha_prox_cobro_cliente']) ? $campos_lista_activa['fecha_prox_cobro_cliente'] : '';
                              if ($fecha_prox_cobro_actual_activa !== $fecha_prox_cobro_formatted_activa) {
                                  update_field("fecha_prox_cobro_cliente", $fecha_prox_cobro_formatted_activa, $idClienteList);
                              }
                              
                               ?>
                                 <script type="text/javascript">
                                 jQuery(document).ready(function() {
                             
                                  
                                    
                            
                                  <?php   if($_GET["lst_clnt"]!=1){  
                                    // Realizar la comparación en PHP
                                  
                                  // MODIFICADO POR GEMINI - 19/05/26 00:45
                                  // Si el ID del cliente viene vacío, forzamos la recuperación que el diagnóstico demostró que sí funciona
                                  if (empty($idClienteList) && !empty($idCuenta)) {
                                      $idClienteList = get_post_meta($idCuenta, 'id_lista_cliente', true);
                                      if (is_array($idClienteList)) { $idClienteList = reset($idClienteList); }
                                  }

                                  $fecha_prox_val = !empty($fechaProximoCobro) ? $fechaProximoCobro : get_post_meta($idPost_cuentas, 'fecha_prox_cobro', true);
                                  $fecha_prox_timestamp = strtotime(str_replace('/', '-', $fecha_prox_val));
                                  $hoy_timestamp = strtotime(str_replace('/', '-', $hoy_pago));
                                  $estatus_pago_tmp = trim((string)$campos_miscuenta["estatus_pago"]);
                                  $mostrar_cliente = ($fecha_prox_timestamp <= $hoy_timestamp) || ($estatus_pago_tmp === "");
                                    ?>

                                      //alert("ID: <?php echo esc_js($idClienteList); ?> - Cliente: <?php echo esc_js(get_the_title($idClienteList)); ?>");
                                   //alert("<?php echo $fechaProximoCobro." <=  ".$hoy_pago ?>");
                                    
                                                                        
                                        <?php 
                                      // BLOQUE DE DIAGNÓSTICO DE DESCONEXIÓNn
                                      // Gemini 19/05/26 00:45 - Eliminados IDs de prueba
                                     /* $idCuenta=35295; $idPost_cuentas=35296;
                                      if (empty($idClienteList) || get_post_type($idClienteList) !== 'gd_place') {
                                          $pago_id = $idPost_cuentas;
                                          $cuenta_id = $idCuenta;
                                          $cuenta_status = get_post_status($cuenta_id);
                                          $cuenta_type = get_post_type($cuenta_id);
                                          $meta_directo = get_post_meta($cuenta_id, 'id_lista_cliente', true);
                                          
                                          $error_msg = "⚠️ DIAGNÓSTICO DE DESCONEXIÓN DETECTADO:\\n";
                                          $error_msg .= "1. ORIGEN PAGO (ID: " . $pago_id . " [" . (get_post_type($pago_id) ?: 'N/A') . "]) -> " . get_the_title($pago_id) . "\\n";
                                          
                                          if (empty($cuenta_id)) {
                                              $error_msg .= "2. VÍNCULO CUENTA: VACÍO. El pago no tiene cuenta asignada.\\n";
                                          } elseif ($cuenta_id == $pago_id) {
                                              $error_msg .= "2. VÍNCULO CUENTA (ID: " . $cuenta_id . "): ERROR! Apunta al propio pago.\\n";
                                          } elseif (!$cuenta_status) {
                                              $error_msg .= "2. VÍNCULO CUENTA (ID: " . $cuenta_id . "): NO EXISTE (Borrada).\\n";
                                          } elseif ($cuenta_type !== 'cliente') {
                                              $error_msg .= "2. VÍNCULO CUENTA (ID: " . $cuenta_id . "): TIPO INCORRECTO (" . $cuenta_type . "). Debe ser 'cliente'.\\n";
                                          } else {
                                              $error_msg .= "2. VÍNCULO CUENTA (ID: " . $cuenta_id . " [cliente]): OK.\\n";
                                          }

                                          if (empty($meta_directo)) {
                                              $error_msg .= "3. DESTINO CLIENTE (gd_place): VACÍO en la base de datos de la cuenta.\\n";
                                          } elseif (is_array($meta_directo)) {
                                              $error_msg .= "3. DESTINO CLIENTE: ERROR (Array). IDs detectados: " . json_encode($meta_directo) . "\\n";
                                          } else {
                                              $target_id = intval($meta_directo);
                                              $target_type = get_post_type($target_id);
                                              
                                              if ($target_id == $cuenta_id) {
                                                  $error_msg .= "3. DESTINO CLIENTE (ID: " . $target_id . "): ERROR! La cuenta apunta a sí misma.\\n";
                                              } elseif ($target_type !== 'gd_place') {
                                                  $error_msg .= "3. DESTINO CLIENTE (ID: " . $target_id . "): TIPO INCORRECTO (" . ($target_type ?: 'Desconocido') . "). Debe ser 'gd_place'.\\n";
                                              } else {
                                                  $error_msg .= "3. DESTINO CLIENTE (ID: " . $target_id . " [gd_place]): OK. Name: " . get_the_title($target_id) . "\\n";
                                              }
                                          }
                                          
                                          $error_msg .= "\\nNota: Todos los eslabones deben ser OK para que el cliente aparezca en rojo en el listado.";
                                          echo "alert('" . esc_js($error_msg) . "');";
                                      }*/
                                      ?>


                                   
                                   


                                     /*if( "<?php echo strtotime($fechaProximoCobro); ?>" <= "<?php echo strtotime($hoy_pago); ?>"   ){*///enero 2024
                                              
                                          <?php if($mostrar_cliente){ ?>
                                    
                                        // MODIFICADO POR BLACKBOX - fallback por desalineación id_lista_cliente vs row gd_place
                                        var idObjetivoRojo = "<?php echo esc_js($idClienteList); ?>";
                                        
                                        jQuery("#post-" + idObjetivoRojo).css({"background-color": "rgb(255, 137, 137)"}); // rojo
                                        jQuery("#post-" + idObjetivoRojo).addClass("porCobrar"); // se requiere para control de listado

                                        // 🪄 CORRECCIÓN VISUAL: Si la fila es roja, el estatus NO puede ser "terminado"
                                        // Buscamos en las celdas de esta fila y cambiamos el texto si dice terminado
                                        jQuery("#post-" + idObjetivoRojo).find('td').each(function() {
                                            if (jQuery(this).text().trim().toLowerCase() === 'terminado') {
                                                jQuery(this).html('<span>activa</span>');
                                            }
                                        });

                                         //jQuery("#post-" + idObjetivoRojo).removeClass("bandera");
                                        jQuery("#post-" + idObjetivoRojo).css({"display": "revert", }); //ayuda al control  de: cliente a cobrar
                                      
                                    
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
                        ////////////////// PROTECCIÓN DE ESTADO GLOBAL //////////////////////////////////////////
                        // Si la cuenta que estamos procesando ahora es 'terminado', pero el cliente 
                        // tiene OTRA cuenta activa, no debemos permitir que el estado pase a terminado.
                        
                        if ($campos_miscuenta["cuenta"] == "terminado") {
                            $status_global = get_post_meta($idClienteList, 'cuentaGD', true);
                            // Si el global ya es 'activa' (porque una cuenta anterior en el bucle lo activó),
                            // no hacemos nada. Pero si el global dice 'terminado' y el sistema lo pintó de rojo,
                            // significa que hubo un error de sincronización previo que corregimos aquí.
                            
                            // Verificamos si realmente no hay ninguna otra cuenta activa antes de dejarlo como terminado
                            // (Esta comprobación ya es parte de sincronizar_datos_economicos_pago, pero ayuda a la visualización)
                        }




                        
                        /////////////////////////////////////////////////////////////////////////////////////////
                        ////////////////// cliente con cuentas cerradas//////////////////////////////////////////////////

                            


                          if   ($campos_miscuenta["monto_cuenta"] > 0 && round($campos_miscuenta["total_pagos"] + $tot_abonos, 2) >=  $campos_miscuenta["monto_cuenta"] )
                          {
                                if (get_post_meta($idPost_cuentas, 'cuenta', true) !== 'terminado') {
                                    update_field("cuenta", "terminado", $idPost_cuentas);
                                }
                          }       
                          else    
                          {   
                                // 🛡️ CORRECCIÓN: Si no ha terminado, forzar 'activa' para mantener control
                                if (get_post_meta($idPost_cuentas, 'cuenta', true) !== 'activa') {
                                    update_field("cuenta", "activa", $idPost_cuentas);
                                }
                          }
                                
                             
                               



                                          
                        
                               ///////////////////////////////////////CLIENTES QUE YA PAGARAON, NO LES COBRARON, NO TIENEN CUENTA, cuenta cerrada u HOy les dieron de alta ////////////////////
                                
                              
                              // MODIFICADO POR BLACKBOX - 2026-05-16 17:45
                              // Usar comparación por timestamp para evitar errores por formato d/m/Y en comparación string.
                              $fecha_prox_cmp_ts = strtotime(str_replace('/', '-', $fechaProximoCobro));
                              $hoy_cmp_ts = strtotime(str_replace('/', '-', $hoy_pago));

                              // MODIFICADO POR BLACKBOX - 2026-05-16 18:20
                              // Si la cuenta está ACTIVA, no ocultarla solo por estatus_pago.
                              // Caso reportado: cliente activo (ej. Lupe) quedaba fuera de "Clientes a Cobrar".
                              $estatus_pago_limpio = trim((string)$campos_miscuenta["estatus_pago"]);
                              $cuenta_limpia = strtolower(trim((string)$campos_miscuenta["cuenta"]));

                              if( ($fecha_prox_cmp_ts > $hoy_cmp_ts) && ($estatus_pago_limpio !== "") && ($cuenta_limpia !== "activa") )
                              {
                                    ?>
                                             <?php if($_GET["lst_clnt"]!=1){ ?>
                                         // MODIFICADO POR BLACKBOX - No ocultar si la fila ya fue marcada como porCobrar por otra cuenta activa/vencida
                                         if (!jQuery("#post-<?php echo $idClienteList; ?>").hasClass('porCobrar')) {
                                         if (!jQuery("#post-<?php echo $idClienteList; ?>").hasClass('porCobrar') && !jQuery("#post-<?php echo $idClienteList; ?>").hasClass('pagoCubiertoHoy')) {
                                             jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "none", });
                                         }
                                        //alert("<?php echo  $fechaProximoCobro."   hoy es: ".$hoy_pago ?>");
                              
                                            <?php } ?>
                                           
                                         
                                 <?php
                               }
                           
                                           // get_field("estatus_pago", $posts_ids_)=="Diario completo" &                   || get_field("estatus_pago", $posts_ids_)!=" " | get_field("estatus_pago", $posts_ids_)==" "
                                           // el or si sale verdadero en siguente nunca sera evaluado
                                           // se quito ||  $fechaProximoCobro > $hoy_pago   11/10/23
                                   if($fecha_prestamo_dmy == $nowDaydmy  || ($campos_miscuenta["monto_cuenta"] > 0 && round($campos_miscuenta["total_pagos"], 2) >=  $campos_miscuenta["monto_cuenta"])  || $campos_miscuenta["monto_cuenta"] == " " || $campos_miscuenta["monto_cuenta"] == null)
                                   {
                            
                                            
                                         //update_field ("fecha_cobro", $hoy, $posts_ids_);
                                         //update_field ("fecha_prox_cobro", $diaSiguiente, $posts_ids_);
                                         
                             
                                         
                                         
                                         
                                         if($_GET["lst_clnt"]!=1){
                                         ?>
                                             //alert(<?php echo get_field("monto_cuenta", $posts_ids_) ?>); 
                                             //jQuery("#post-18769").css({"display": "none", });
                                              // MODIFICADO POR BLACKBOX - No ocultar si ya fue marcada porCobrar
                                              if (!jQuery("#post-<?php echo $idClienteList; ?>").hasClass('porCobrar')) {
                                              if (!jQuery("#post-<?php echo $idClienteList; ?>").hasClass('porCobrar') && !jQuery("#post-<?php echo $idClienteList; ?>").hasClass('pagoCubiertoHoy')) {
                                                  jQuery("#post-<?php echo $idClienteList; ?>").css({"display": "none", });
                                              }
                                              
                                           
                                         
                                         <?php
                                         }
                                          if($_GET["lst_clnt"]==1){ 
                                                  
                                              
                                                     if( $campos_miscuenta["monto_cuenta"] > 0 && round($campos_miscuenta["total_pagos"], 2) >=  $campos_miscuenta["monto_cuenta"] )
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
                     
                            
                        
                        // MODIFICADO POR BLACKBOX - 2026-05-16 17:45
                        // Comparación robusta por timestamp para detectar vencido/hoy correctamente.
                        if( ($fecha_prox_cmp_ts == $hoy_cmp_ts) || ($fecha_prox_cmp_ts < $hoy_cmp_ts) ){
                            
                              //cambiamos el estatus para que el cobrador pase
                               update_field("estatus_pago"," ", $posts_ids_); // Movido
                            
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
           
           // OPTIMIZACIÓN: Obtener los posts de 'cliente' una sola vez fuera del bucle de gd_place
           $argsMisctas = array( 'post_type' =>'cliente' , 'author' =>  $id_author_gd, 'posts_per_page' => -1, );
           $postMisctas = wp_get_recent_posts( $argsMisctas, OBJECT);

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
                     }
                     
                     
                }
      
      
      
      
                      
    }
 
         
}
   
   
add_action('admin_footer', function() {
    $screen = get_current_screen();
    // MODIFICADO POR BLACKBOX - 2026-05-12 21:05
    // Ejecutar también en listado de miscuentas para refresco inmediato sin navegar a gd_place.
    if ($screen && ($screen->post_type === 'gd_place' || $screen->post_type === 'miscuentas')) {
        obtener_cuentas();
    }
});  ////////////////////ADD
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    ////////////////////////////////////////////////////////////////////////////////////  
///////////////////////////////// REPORTE DIARIO//////////////////////////////////

// Inserta una fila placeholder de reporte_diario para una fecha concreta.
function cocum_insertar_reporte_diario_placeholder($user_id, $fecha_ymd, $caja_base = 0) {
    $user = get_user_by('id', $user_id);
    if (!$user) {
        return 0;
    }

    $post_title = $user->display_name;
    $post_date_local = $fecha_ymd . ' 00:00:00';

    $post_id = wp_insert_post(array(
        'post_type'      => 'reporte_diario',
        'post_title'     => $post_title,
        'post_content'   => $post_title,
        'post_status'    => 'publish',
        'post_author'    => $user_id,
        'post_date'      => $post_date_local,
        'post_date_gmt'  => get_gmt_from_date($post_date_local),
        'comment_status' => 'closed',
        'ping_status'    => 'closed',
    ));

    if (!$post_id || is_wp_error($post_id)) {
        return 0;
    }

    update_post_meta($post_id, 'total_cobrado', 0);
    update_post_meta($post_id, 'cobrar_dia_actual', 0);
    update_post_meta($post_id, 'total_prestado', 0);
    update_post_meta($post_id, 'clientes_con_pagos', 0);
    update_post_meta($post_id, 'gasto', 0);
    update_post_meta($post_id, 'comision', 0);
    update_post_meta($post_id, 'caja_anterior', floatval($caja_base));
    update_post_meta($post_id, 'caja_actual', floatval($caja_base));

    return $post_id;
}

// Garantiza continuidad diaria: si faltan días, crea filas placeholder para no "brincar" fechas.
function cocum_backfill_reporte_diario_usuario($user_id) {
    $user_id = intval($user_id);
    if ($user_id <= 0) {
        return;
    }

    $tz = wp_timezone();
    $hoy = new DateTime('now', $tz);
    $hoy_ymd = $hoy->format('Y-m-d');

    $ultimo = get_posts(array(
        'post_type'      => 'reporte_diario',
        'author'         => $user_id,
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
    ));

    // Si no existe ninguno, crear el de hoy para arrancar la secuencia diaria.
    if (empty($ultimo)) {
        cocum_insertar_reporte_diario_placeholder($user_id, $hoy_ymd, 0);
        return;
    }

    $ultimo_id = intval($ultimo[0]);
    $ultima_fecha_ymd = get_the_date('Y-m-d', $ultimo_id);
    $caja_base = floatval(get_post_meta($ultimo_id, 'caja_actual', true));

    if (empty($ultima_fecha_ymd)) {
        return;
    }

    $cursor = DateTime::createFromFormat('Y-m-d', $ultima_fecha_ymd, $tz);
    if (!$cursor) {
        return;
    }

    $cursor->modify('+1 day');

    while ($cursor->format('Y-m-d') <= $hoy_ymd) {
        $fecha_cursor = $cursor->format('Y-m-d');

        $existe_en_fecha = get_posts(array(
            'post_type'      => 'reporte_diario',
            'author'         => $user_id,
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'date_query'     => array(
                array(
                    'year'  => intval($cursor->format('Y')),
                    'month' => intval($cursor->format('m')),
                    'day'   => intval($cursor->format('d')),
                ),
            ),
        ));

        if (empty($existe_en_fecha)) {
            $nuevo_id = cocum_insertar_reporte_diario_placeholder($user_id, $fecha_cursor, $caja_base);
            if ($nuevo_id) {
                $caja_base = floatval(get_post_meta($nuevo_id, 'caja_actual', true));
            }
        } else {
            $caja_base = floatval(get_post_meta(intval($existe_en_fecha[0]), 'caja_actual', true));
        }

        $cursor->modify('+1 day');
    }
}

// Intervalo personalizado de 10 minutos para WP-Cron.
function cocum_cron_schedules_reporte_diario($schedules) {
    if (!isset($schedules['cocum_every_10_minutes'])) {
        $schedules['cocum_every_10_minutes'] = array(
            'interval' => 10 * MINUTE_IN_SECONDS,
            'display'  => 'Cocum cada 10 minutos',
        );
    }
    return $schedules;
}
add_filter('cron_schedules', 'cocum_cron_schedules_reporte_diario');

// Programa el cron de reporte_diario cada 10 minutos y limpia el cron diario anterior.
function cocum_programar_cron_backfill_reporte_diario() {
    // Registrar nuevo cron de 10 minutos si no existe.
    if (!wp_next_scheduled('cocum_cron_reporte_diario_10min')) {
        wp_schedule_event(time() + 60, 'cocum_every_10_minutes', 'cocum_cron_reporte_diario_10min');
    }

    // Limpiar cron diario anterior para evitar ejecución duplicada.
    $legacy = wp_next_scheduled('cocum_cron_backfill_reporte_diario');
    if ($legacy) {
        wp_unschedule_event($legacy, 'cocum_cron_backfill_reporte_diario');
    }
}
add_action('init', 'cocum_programar_cron_backfill_reporte_diario');

// Ejecuta reporte_diario() como si fuera el usuario indicado (sin depender del menú).
function cocum_recalcular_reporte_diario_usuario($user_id) {
    $user_id = intval($user_id);
    if ($user_id <= 0) {
        return;
    }

    // Sincronizar pagos_hoy de todas las miscuentas del usuario ANTES de calcular el reporte.
    // Esto garantiza que reporte_diario() lea valores frescos aunque el cobrador no haya
    // guardado el formulario de miscuentas directamente (update_field no actualiza post_modified).
    $ids_miscuentas = get_posts(array(
        'post_type'      => 'miscuentas',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'post_status'    => 'publish',
    ));
    foreach ($ids_miscuentas as $mc_id) {
        sincronizar_datos_economicos_pago(intval($mc_id));
    }

    $prev_user_id = get_current_user_id();
    wp_set_current_user($user_id);
    ob_start();
    reporte_diario();
    ob_end_clean();
    wp_set_current_user($prev_user_id);
}

// Función principal del cron: backfill de fechas + recálculo de totales por usuario.
function cocum_ejecutar_cron_backfill_reporte_diario() {
    global $wpdb;

    $authors = $wpdb->get_col(
        "SELECT DISTINCT post_author
         FROM {$wpdb->posts}
         WHERE post_type IN ('miscuentas', 'reporte_diario')
           AND post_status IN ('publish')
           AND post_author > 0"
    );

    if (empty($authors)) {
        return;
    }

    foreach ($authors as $author_id) {
        $author_id = intval($author_id);
        cocum_backfill_reporte_diario_usuario($author_id);
        cocum_recalcular_reporte_diario_usuario($author_id);
        // Rellenar métricas esperadas en filas placeholder que quedaron en cero
        // (días en que nadie entró al sistema y reporte_diario() no corrió para esa fecha).
        cocum_rellenar_metricas_esperadas_usuario($author_id);
    }
}
add_action('cocum_cron_reporte_diario_10min', 'cocum_ejecutar_cron_backfill_reporte_diario');
// Mantener hook legacy por compatibilidad por si quedó algún evento programado antiguo.
add_action('cocum_cron_backfill_reporte_diario', 'cocum_ejecutar_cron_backfill_reporte_diario');

/**
 * Actualiza "cobrar_dia_actual" y "clientes_con_pagos" en filas de reporte_diario
 * que quedaron en cero porque nadie entró al sistema ese día.
 * Estas métricas se pueden calcular en cualquier momento desde los datos actuales.
 */
function cocum_rellenar_metricas_esperadas_usuario($user_id) {
    $user_id = intval($user_id);
    if ($user_id <= 0) return;

    // Calcular total esperado de cobro diario y conteo de clientes activos
    $clientes = get_posts(array(
        'post_type'      => 'cliente',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ));

    $miscuentas_all = get_posts(array(
        'post_type'      => 'miscuentas',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ));

    // Indexar miscuentas por id_cliente_cuenta para búsqueda rápida
    $mc_index = array();
    foreach ($miscuentas_all as $mc) {
        $id_cli = get_field('id_cliente_cuenta', $mc->ID);
        if ($id_cli) {
            $mc_index[intval($id_cli)] = $mc;
        }
    }

    $cobrar_esperado  = 0;
    $clientes_activos = 0;

    foreach ($clientes as $cli_id) {
        if (!isset($mc_index[$cli_id])) continue;
        $mc = $mc_index[$cli_id];
        $estatus_cuenta = get_field('cuenta', $mc->ID);
        $estatus_pago   = get_field('estatus_pago', $mc->ID);

        if ($estatus_cuenta === 'activa') {
            $cobrar_esperado += floatval(get_field('valor_cuota_cliente', $cli_id));
            if (trim($estatus_pago) === '') {
                $clientes_activos++;
            }
        }
    }

    if ($cobrar_esperado <= 0 && $clientes_activos <= 0) return;

    // Actualizar filas de reporte_diario donde cobrar_dia_actual sigue en cero
    $reportes_vacios = get_posts(array(
        'post_type'      => 'reporte_diario',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'AND',
            array('key' => 'cobrar_dia_actual', 'value' => '0', 'compare' => '='),
            array('key' => 'total_cobrado',     'value' => '0', 'compare' => '='),
        ),
    ));

    foreach ($reportes_vacios as $rd) {
        update_field('cobrar_dia_actual', $cobrar_esperado, $rd->ID);
        update_field('clientes_con_pagos', $clientes_activos, $rd->ID);
    }
}


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
    'author' => $id_actual_,
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
               
               // MODIFICADO: Usar get_field() porque wp_get_recent_posts no trae metas en el objeto
               $id_post_mc = $recentt2->post_author;
               $pagosHoy_mc = floatval(get_field("pagos_hoy", $recent_IDPost_miscuentas2)); 
               $estatus_cuenta = get_field("cuenta", $recent_IDPost_miscuentas2);
               $fecha_prox_cobro = get_field("fecha_prox_cobro", $recent_IDPost_miscuentas2);
               $estatus_pago = get_field("estatus_pago", $recent_IDPost_miscuentas2);

                 // Obtiene la fecha de última actualización de cada post en miscuentas
                 $last_modified_date = get_the_modified_date('Y-m-d H:i:s', $recent_IDPost_miscuentas2);
                 
                             
          
                 
       
              
            
               
              
                  
                 // miscuentas         fecha del ultimo post de listas liquidades
              if($last_modified_date >= $last_post_date){
           
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
               
               // MODIFICADO: Usar get_field() para leer datos de miscuentas
               $id_post_mc = $recentt2->post_author;
               $pagosHoy_mc = floatval(get_field("pagos_hoy", $recent_IDPost_miscuentas2)); 
               $monto_cuenta_de = get_field("monto_cuenta", $recent_IDPost_miscuentas2);
               $estatus_cuenta = get_field("cuenta", $recent_IDPost_miscuentas2);
               $fecha_prox_cobro = get_field("fecha_prox_cobro", $recent_IDPost_miscuentas2);
               $estatus_pago = get_field("estatus_pago", $recent_IDPost_miscuentas2);
               
               $fecha_msc = get_the_date("d/m/Y", $recent_IDPost_miscuentas2);
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
               
    
               // CORREGIDO: ya no dependemos de post_modified (que no se actualiza con update_field).
               // pagos_hoy fue recalculado justo antes de llamar a reporte_diario() en el cron,
               // por lo que > 0 significa que el cobrador SÍ cobró hoy.
               if( $id_actual_  == $id_post_mc && $pagosHoy_mc > 0 ){
        
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
            // CORRECCIÓN: Usar get_field para obtener datos de ACF
            $cantidadG = get_field('cantidad', $idgasto);
            $aceptar =  get_field('aceptar', $idgasto);
            
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
            
                      // MODIFICADO: get_field para vínculos
                      $id_cliente_cuenta = get_field("id_cliente_cuenta", $recentt2->ID);
                      $cuenta_ = get_field("cuenta", $recentt2->ID);
                      
                        if($recent_IDPost_cliente == $id_cliente_cuenta){
                            
                               if($cuenta_=="activa" & $fechaCuenta != $hoyReporte ){ //2024  
                            
                                    $sumasTotalesPagos =  $sumasTotalesPagos +  floatval(get_field("valor_cuota_cliente", $recent_cliente->ID));
                                    
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
        
       
        
         $sumasCuentasHoy = $sumasCuentasHoy + floatval(get_field("monto_cliente", $recent_cliente->ID)); //suma prestamos de hoy
         
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
       $valor_iny = get_field('valor', $id_inyeccion); 
       
       if($dateInyeccion==$hoyReporte){
       $valor_inyeccion =   $valor_inyeccion + floatval($valor_iny);
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
              $caja_anterior_pen = get_field('caja_actual', $id_reporteDiario_pen);   //la "caja anterior" diaria es la "caja actual" de ayer
    
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
     //$comision = $sumasTotalesHoy*0.03;
     // 🛠️ MODIFICADO: Comisión dinámica desde ajustes (Default 3%)
     $porcentaje_ajuste = floatval(get_option('comision_cobrador_porcentaje', 3)) / 100;
     $comision = $sumasTotalesHoy * $porcentaje_ajuste;
     //Caja actual  floatval
      
            $caja_anterior = isset($caja_anterior) ? $caja_anterior : 0;
            $sumasTotalesHoy = isset($sumasTotalesHoy) ? $sumasTotalesHoy : 0;
            $sumasTotalesAbonos = isset($sumasTotalesAbonos) ? $sumasTotalesAbonos : 0;
            $sumasCuentasHoy = isset($sumasCuentasHoy) ? $sumasCuentasHoy : 0;
            $sumaGasto = isset($sumaGasto) ? $sumaGasto : 0;
            $valor_inyeccion = isset($valor_inyeccion) ? $valor_inyeccion : 0;
            $sumaTotalesHoy_sumaTotalesAbonos = isset($sumaTotalesHoy_sumaTotalesAbonos) ? $sumaTotalesHoy_sumaTotalesAbonos : 0;
      
      $caja_actual =  ((( floatval($caja_anterior)+floatval($sumaTotalesHoy_sumaTotalesAbonos)) - $sumasCuentasHoy)-floatval($sumaGasto))+floatval($valor_inyeccion);
   
        
    // Si el calculo viejo da 0 pero ya existe un valor bueno recalculado, no lo pisamos.
    $total_cobrado_guardar = floatval($sumaTotalesHoy_sumaTotalesAbonos);
    $total_cobrado_actual = floatval(get_field('total_cobrado', $id_reporteDiario));
    if ($total_cobrado_guardar <= 0 && $total_cobrado_actual > 0) {
        $total_cobrado_guardar = $total_cobrado_actual;
    }
    update_field("total_cobrado", $total_cobrado_guardar,  $id_reporteDiario);   
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
 
/**
 * 🛠️ EJECUCIÓN DE CÁLCULOS DEL REPORTE DIARIO
 * Se movió al inicio de la carga para que los valores se reflejen inmediatamente en la tabla.
 */
add_action('load-edit.php', function() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'reporte_diario') {
        // Antes de calcular el día actual, asegurar que no existan saltos en días anteriores.
        cocum_backfill_reporte_diario_usuario(get_current_user_id());
        reporte_diario();
    }
});
 















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

      // NUEVA LINEA (pasada final antes del corte):m
cocum_recalcular_huecos_reporte_diario($id_user, null, null, 30);

    if (isset($_GET['generar']) && $_GET['generar'] == 1) {



        $id_user = get_current_user_id();

        // NUEVA LINEA:
cocum_recalcular_huecos_reporte_diario($id_user, null, null, 5);
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

    // Fallback de seguridad: cerrar modal aunque falle la navegación en app/webview
    var forceCloseMs = 10000;
    setTimeout(function(){
        var m = document.getElementById("modalProcesando");
        if (m) {
            m.style.display = "none";
            if (m.parentNode) m.parentNode.removeChild(m);
        }
    }, forceCloseMs);

    // Esperar 3 segundos y redirigir
    setTimeout(function(){
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
            // Modificado: Se avanza al día siguiente al último corte (ej. del 24 al 25)
            // para que los acumulados no cuenten el día del administrador y coincidan 
            // con la búsqueda manual en Detalles de Pago.
            $fecha->modify('+1 day');
            $fecha->setTime(0, 0, 0);
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
        
        // Modificado: El reporte acumulado debe iniciar al comienzo del día siguiente
        // al último corte (25 en tu ejemplo), ignorando el día del corte (24).
        $datePlus->modify('+1 day');
        $datePlus->setTime(0, 0, 0);
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
        if($last_modified_date >= date('Y-m-d', strtotime($next_day_date_ll))){
            $totalPrestado_rd += get_field("total_prestado", $posts_ids_rd);
        }
    }

    // --- Rango de fechas ---
    // Normalizamos a Y-m-d para asegurar que las comparaciones de texto con fechas de pagos
    // (que no tienen hora) funcionen correctamente y no excluyan el primer día.
    $fecha_inicio_dmy = date('Y-m-d', strtotime($next_day_date_ll));
    $fecha_fin_dmy = date('Y-m-d', strtotime($stringDate));
    $huecos_restantes_nl = 0;
    $backfill_en_proceso_nl = false;
    $huecos_nl = cocum_contar_huecos_reporte_diario($id_author_actual_nl, $fecha_inicio_dmy, $fecha_fin_dmy);
    if ($huecos_nl > 0) {
        $limite_backfill_nl = min(30, intval($huecos_nl));
        $procesados_nl = cocum_recalcular_huecos_reporte_diario($id_author_actual_nl, $fecha_inicio_dmy, $fecha_fin_dmy, $limite_backfill_nl);
        $huecos_restantes_nl = cocum_contar_huecos_reporte_diario($id_author_actual_nl, $fecha_inicio_dmy, $fecha_fin_dmy);
        $backfill_en_proceso_nl = ($huecos_restantes_nl > 0);

        $segundos_estimados_nl = max(10, intval(ceil($huecos_restantes_nl / 30) * 15));
        echo '<div class="notice notice-info"><p>🔄 Recuperando histórico... espere aproximadamente ' . intval($segundos_estimados_nl) . ' segundo(s).</p></div>';
    }
    
    
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
            // MODIFICADO: Usar el doble de cuotas para no perder pagos extra en el acumulado
            $cuotas_base = intval(get_field('cuotas_cliente', $idCuenta));
            $cuotas_autorizadas = $cuotas_base * 2; 
            
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
            'after'     => $fecha_inicio_dmy,
            'before'    => $fecha_fin_dmy,
            'inclusive' => true, // Cambiado a true para incluir desde las 00:00:00 del día inicial
           
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
            // MODIFICADO: Lectura robusta de campos (con y sin guion bajo)
            $montoPago_raw = get_sub_field('pago_#' . $i);
            if ($montoPago_raw === null || $montoPago_raw === '') {
                $montoPago_raw = get_sub_field('pago#' . $i);
            }
            $montoPago = floatval($montoPago_raw);

            $fechaPago = get_sub_field('fecha_del_pago#' . $i);
            if (!$fechaPago) {
                $fechaPago = get_sub_field('fecha_del_pago_#' . $i);
            }

            if ($montoPago && $fechaPago) { 
                $fecha_obj = DateTime::createFromFormat('d/m/Y', $fechaPago);
                if ($fecha_obj !== false) {
                    $fechaPago_formateada = $fecha_obj->format('Y-m-d');
                } else {
                    $fechaPago_formateada = '';
                    $fechaPago_formateada = date('Y-m-d', strtotime(str_replace('/', '-', $fechaPago)));
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
$porcentaje_ajuste = floatval(get_option('comision_cobrador_porcentaje', 3)) / 100;
$comisionAcomulado = $cobroTotal * $porcentaje_ajuste;

// --- PASO 4: Recalcular acumulados desde la fuente cuando no hay huecos ---
if ($huecos_restantes_nl === 0 && !$backfill_en_proceso_nl) {
    // Inicializar caja_anterior_nl si no existe
    if (!isset($caja_anterior_nl)) {
        $caja_anterior_nl = 0;
    }
    $caja_anterior_nl = floatval($caja_anterior_nl);
    
    // Obtener el id del primer post de miscuentas del usuario
    $cuentas_args = array(
        'post_type'      => 'miscuentas',
        'author'         => $id_author_actual_nl,
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    );
    
    $cuentas_query = get_posts($cuentas_args);
    $id_misc_cuentas = !empty($cuentas_query) ? intval($cuentas_query[0]) : null;
    
    if ($id_misc_cuentas && $id_misc_cuentas > 0) {
        // Programar ejecución después de cargar la página
        update_option('cocum_paso4_pendiente_' . $id_author_actual_nl, array(
            'id_nl' => $id_nl,
            'id_author' => $id_author_actual_nl,
            'fecha_inicio' => $fecha_inicio_dmy,
            'caja_anterior' => $caja_anterior_nl,
            'timestamp' => time(),
        ));
    }
} else if ($huecos_restantes_nl > 0) {
    // Aún hay huecos pendientes
}

// ==============================================================
// 🔹 1. PROCESAR EL REPORTE SI SE LLAMA CON ?generar=1 (Cálculo fresco)
// ==============================================================
if (isset($_GET['generar']) && $_GET['generar'] == 1 && !$backfill_en_proceso_nl) {
    // Crear nueva lista liquidada permanente con los datos RECIÉN CALCULADOS
    $post_id_ll = wp_insert_post(array(
        'post_type' => 'listas_liquidadas',
        'post_title' => $nombreUsuario_actual,
        'post_content' => $nombreUsuario_actual,
        'post_status' => 'publish',
        'comment_status' => 'closed',
        'ping_status' => 'closed',
    ));

    if ($post_id_ll && !is_wp_error($post_id_ll)) {
        // Usamos las variables locales que tienen el dato real del momento
        add_post_meta($post_id_ll, 'total_cobrado_l', $cobroTotal);
        add_post_meta($post_id_ll, 'total_prestado_l', $totalPrestado_rd);
        add_post_meta($post_id_ll, 'caja_actual_l', $caja_actual_nl);
        add_post_meta($post_id_ll, 'caja_anterior_l', $caja_anterior_nl);
        add_post_meta($post_id_ll, 'gasto_ll', $total_gastos);

        // Reset de nueva_liquidada para el próximo ciclo
        update_field('total_cobrado_nl', 0, $id_nl);
        update_field('total_prestado_nl', 0, $id_nl);
        update_field('comision_nl', 0, $id_nl);
        update_field('caja_actual_nl', 0, $id_nl);
        update_field('caja_anterior_nl', 0, $id_nl);
        update_field('gasto_nl', 0, $id_nl);
        update_field('fecha_inicio_nl', '-', $id_nl);

        echo '<div class="notice notice-success"><p>✅ Reporte generado correctamente con datos actualizados al momento.</p></div>';

        echo '
        <script>
        window.addEventListener("load", function() {
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
                    🔄 Procesando datos finales...<br><small>Por favor espera unos segundos</small>
                </div>
            `;
            document.body.appendChild(modal);

            // Fallback: en app/webview puede congelarse; forzar cierre de overlay
            var forceCloseMs = 10000;
            setTimeout(function(){
                var m = document.getElementById("modalProcesando");
                if (m) {
                    m.style.display = "none";
                    if (m.parentNode) m.parentNode.removeChild(m);
                }
            }, forceCloseMs);

            setTimeout(function(){
                window.location.href = window.location.pathname + "?post_type=nueva_liquidada";
            }, 3000);
        });
        </script>';
    } else {
        echo '<div class="notice notice-error"><p>⚠️ Error al generar el reporte.</p></div>';
    }
}

if (isset($_GET['generar']) && $_GET['generar'] == 1 && $backfill_en_proceso_nl) {
    $segundos_estimados_nl = max(10, intval(ceil($huecos_restantes_nl / 30) * 15));
    echo '<div class="notice notice-error"><p>⏳ Recuperando histórico... espere aproximadamente ' . intval($segundos_estimados_nl) . ' segundo(s) antes de generar el reporte.</p></div>';
}

wp_reset_postdata();





        }
        wp_reset_postdata();
    }

    // --- Cálculo final ---
    $porcentaje_ajuste = floatval(get_option('comision_cobrador_porcentaje', 3)) / 100;
    $comisionAcomulado = $cobroTotal * $porcentaje_ajuste;
    if (!$backfill_en_proceso_nl) {
        update_field('total_cobrado_nl', $cobroTotal,  $id_nl);
        update_field("total_prestado_nl",$totalPrestado_rd,  $id_nl);
        update_field("comision_nl", $comisionAcomulado, $id_nl);
        update_field("caja_actual_nl", $caja_actual_nl, $id_nl);
        update_field("gasto_nl", $total_gastos, $id_nl);
        update_field('fecha_inicio_nl', $fecha_mas_un_dia_date_new, $id_nl);
    }
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
add_action('admin_footer', function() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'nueva_liquidada') {
        nueva_liquidadas();
    }
});

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
                else
                   wp_redirect( home_url("wp-admin/") );

                 exit();
            
              
           
       
       
}

add_action( 'wp_login','my_custom_login_redirect' );  ////////////////////ADD















function disable_new_posts() {
// Hide sidebar link
global $submenu;
//unset($submenu['edit.php?post_type=miscuentas'][10]);
 $current_user = wp_get_current_user();


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
        /* Ocultar el botón nativo de "Añadir nuevo" en Reporte Diario */
        .wrap a.page-title-action { display: none !important; }
    </style>';
}

//nueva liquidad

if (isset($_GET['post_type']) && $_GET['post_type'] == 'nueva_liquidada') {
    echo '<style type="text/css">
    

  
   .wrap .wp-heading-inline+.page-title-action { display:none; }
   .tablenav .pagination-links, .tablenav-pages { display: none !important; }
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
    if( isMobileDevice() & in_array( 'cobranza',  ( array ) $current_user->roles )){
        
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
 
 .subsubsub .all { display: none !important; }
 .subsubsub .mine { display: none !important; }
 .subsubsub .publish { display: none !important; }
 .subsubsub .trash { display: none !important; }
    </style>';

}











}
add_action('admin_menu', 'disable_new_posts2');    ////////////////////ADD





function isMobileDevice() {
    /*return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);*/

   $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    // 1. Cabecera enviada por WebViews en Android
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) return true;
    // 2. Marcador de WebView en el User Agent (común en Android)
    if (strpos($ua, '; wv') !== false) return true;
    // 3. Firma personalizada (se recomienda que tu App envíe "CocunApp" en el User Agent)
    if (strpos($ua, 'cocunapp') !== false) return true;
    
    return false;


}








function dashboard_preloader()
{
    // Verificar si el preloader está activado antes de continuar.
    if (!defined('COCUM_PRELOADER_ACTIVO') || COCUM_PRELOADER_ACTIVO !== true) {
        return;
    }
   
            
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

       // MODIFICADO POR BLACKBOX - 2026-05-12 20:40
       // Desactivada recarga forzada del editor miscuentas para no generar latencia/falso estado en listado.
    
   <?php   
   
  
                          

   
   
   
            if( isMobileDevice() & in_array( 'cobranza',  ( array ) $current_user->roles ))
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
                
                  
                 
                    /*alert("Acceso administradores solo por la webv");
                    
                    jQuery(location).attr('href', 'https://cocunmx.com/salir.php');*/
              
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
                      /*jQuery('body').fadeOut('fast');
                    alert("Acceso administradores solo por la webd");
                    jQuery(location).attr('href', 'https://cocunmx.com/salir.php');*/
              
              <?php
              
             
              //wp_redirect( "https://cocunmx.com/salir.php" );
            
        }
 
 
 
 
 
   if(in_array( 'admin_aux',  ( array ) $current_user->roles ) &  isMobileDevice()  )
       {
           
           
           
              
                  ?> 
                         
                   jQuery('#wpadminbar').css('background', 'linear-gradient(to right, #157dc3, #4bbb63)'); 
                   
              
              <?php
              
        }
        
        
        if(in_array( 'cobranza',  ( array ) $current_user->roles ) &  isMobileDevice()==false  )
       {
              
                  ?> 
                       //alert("Usuario Cobrador, acceso solo por APP");
                       //jQuery('#aceptarGasto').css('display', 'none'); 
                       //jQuery(location).attr('href','https://cocunmx.com/wp-login.php');
                   //jQuery('#wpadminbar').css('background', '#4bbb63'); 
              
                         
                jQuery('#wpadminbar').css('background', 'linear-gradient(to right, #157dc3, #4bbb63)'); 
                   
              
              
              <?php
              
        }
 
    ///////////////////////////////////////////////////////////////////////       







//////////////////////////////////////////////////////
 /////////////////   //////general de click a pagos
    ?> 
    var campos=0;
                var num_pagos_aprovado = '<?php echo  $num_pagos; ?>';
 
                var valor_Cuota = '<?php echo $valor_cuota; ?>';
                var abonoss_tot = '<?php echo $abonos_tot_; ?>';
                var pagosConAbonos = '<?php echo $total_pagos_+$abonos_tot_; ?>';
                var pagoRestante = '<?php echo round(($mont_cuenta_) - ($total_pagos_+$abonos_tot_), 2); ?>';

                var montoInteres = (valor_Cuota*num_pagos_aprovado)/2;
                 
                 
var post_type = jQuery('#post_type').val();

if(post_type === 'miscuentas') {
        // MODIFICADO POR BLACKBOX - 2026-05-12 20:40
        // Evitar recarga automática en edición de miscuentas (provoca refresco desfasado en listado).
        // if (!localStorage.getItem('reloaded')) { localStorage.setItem('reloaded', true); location.reload(); } else { localStorage.removeItem('reloaded'); }

        // Ocultar el elemento .acf-label dentro del contenedor con data-name="total_pagos"
        jQuery('[data-name="total_pagos"] .acf-label').css('display', 'none');

// Ocultar el elemento .acf-input dentro del contenedor con data-name="total_pagos"
jQuery('[data-name="total_pagos"] .acf-input').css('display', 'none');
   
               // 🛡️ BLOQUEO MANUAL: Si aún hay deuda, no permitir cambio de estado a terminado
        if (parseFloat(pagoRestante) > 0) {
            let $statusSelect = jQuery('[data-name="cuenta"] select');
            // Bloquear visualmente y funcionalmente
            $statusSelect.css({
                'background-color': '#f0f0f0',
                'cursor': 'not-allowed',
                'pointer-events': 'none'
            });
            $statusSelect.closest('.acf-input').on('click', function() {
                alert("SISTEMA: No se puede cambiar el estado a 'Terminado' manualmente porque el cliente aún presenta deuda ($" + pagoRestante + ").");
            });
        }


        
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
   ////////////////////////////////////fin general clic pagos//////////// 
    
    

   /////////////////////////////////funcion clic pagos///////////////////////////////////////
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
                            
                         var fechaExistente = jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val();
    
             // Solo llenar si está vacío
    if (!fechaExistente) {
        jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
        jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
    }
                            

                            if(pagoRestante==0)
                            {
                                jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                    
                              // AJUSTE: Solo asignar fecha si no existe una anterior para evitar sobrescribir datos
                              if (!fechaExistente) {
                                  jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                                  jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                              }

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
                    
                               // AJUSTE: Solo asignar fecha si no existe una anterior para evitar sobrescribir datos
                               if (!fechaExistente) {
                                   jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                                   jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                               }
                                // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                      
                             //alert(hoyFormato_mx);
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
                    
                      // AJUSTE: Solo asignar fecha si no existe una anterior para evitar sobrescribir datos
                      if (!fechaExistente) {
                          jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                          jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                      }
                     // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                      
                      //alert(hoyFormato_mx);
                      //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="hidden"]' ).val('20230513');
              
                     // jQuery( '.acf-input div[data-name="'+dataName+'"] input' ).prop( "disabled", true );
                     //jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input' ).prop( "disabled", true );
           
                      jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).prop( "disabled", true );
                      //alert(montoInteres);

                }    

                    

                if (parseFloat(tot_actual_pagado) <= parseFloat(montoInteres)  ){
                       
                    //alert("res");
                       jQuery( '.acf-input div[data-name="pago_#'+i+'"] input' ).val('<?php echo $valor_cuota  ?>');
                       
                         // AJUSTE: Solo asignar fecha si no existe una anterior para evitar sobrescribir datos
                         if (!fechaExistente) {
                             jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="text"]' ).val(hoyFormato_mx);
                             jQuery( '.acf-input div[data-name="fecha_del_pago#'+i+'"] input[type="hidden"]' ).val(hoyFormato.replace(/\/+/g,''));
                         }
                        // jQuery( '.acf-input div[data-name="fecha_del_pago'+ dataName.split('_')[1]+'"] input[type="text"]' ).val('<?php   echo    "17/05/2023";  ?>');
                         
                         //alert(hoyFormato_mx);
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



          
<?php



 ///////////////////////////////////////////////////////////////////////////////////
 ///////////////////Ajustes Interfaz Admins AUX/////////////////////////////////////
  //if(in_array( 'admin_aux',  ( array ) $current_user->roles )  )
 if(in_array( 'cobranza',  ( array ) $current_user->roles ) & !isMobileDevice()   )

 
        {

              //otorgar_permisos_admin_aux() ;
              
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


                
          
          
          
          
          
          
          
          

<?php } ?>

///////////////////////////////////////fin





///////////////////////////////////////////////////////////////////////////
////////////////////////////permisos admin_aux//////////////////////////////
<?php
  //if(in_array( 'admin_aux',  ( array ) $current_user->roles ) /*& !isMobileDevice()*/   )   
  if(in_array( 'cobranza',  ( array ) $current_user->roles ) & !isMobileDevice()  )
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
  
     jQuery("#acf-group_636faa6731dc5").attr("style", "display:none !important;");
  
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
                  
/////////////////////////////////////////////fin interfaz admin/////////////////////////////////////////




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








///////////////////////////////////////////////////////////////////////////////
 ///////////////bloqueos en interfaz cobranza//////////////////////////////////////
    
  <?php  
  
                   ?> 
                    
                     var camposConDatos = 0;
                     var campos=0;
                     var campos2=0;
                     var num_pagos_aprovado = '<?php echo  $num_pagos; ?>';
              
                 <?php


  if(in_array( 'cobranza',  ( array ) $current_user->roles ) & isMobileDevice()   )
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
    
    





             

                      jQuery("#submitdiv").insertAfter("#normal-sortables");
 
               /*jQuery('a').on('click', function() {
                              jQuery('#preloader').show();  // Mostrar preloader inmediatamente al hacer clic
                          });  */ 

                            jQuery('a').on('click', function(e) {
                    var href = jQuery(this).attr('href');
                    // No mostrar preloader en enlaces vacíos, anclas (#), JavaScript o que abren en pestaña nueva
                    if (href && href !== '#' && !href.startsWith('#') && !href.startsWith('javascript:') && jQuery(this).attr('target') !== '_blank') {
                        jQuery('#preloader').show();
                    }
                });
                          
                             /*jQuery('#inicio').on('click', function() {
                              jQuery('#preloader').show();  // Mostrar preloader inmediatamente
                          });*/
                          
                          

});
                  
                 
                 
                 
                 
                          
                          
                          
                          


    // 🚀 OPTIMIZACIÓN DE PRELOADER PARA EVITAR CONGELAMIENTO EN APP
    // Usamos DOMContentLoaded que se ejecuta antes que window.load, haciendo la transición más rápida.
    document.addEventListener('DOMContentLoaded', function() {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.display = 'none';
        }
        document.body.style.overflow = 'visible';
    });

    // Fallback de seguridad: si algo bloquea el DOMContentLoaded,
    // nos aseguramos de que el preloader desaparezca de todas formas.
    window.addEventListener('load', function() {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.display = 'none';
        }
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
               // $row.hide(); // Oculta la fila
                // 🟢 Solo en miscuentas: No ocultar en búsqueda, poner leyenda y color verde
                $row.css({"display": "revert", "background-color": "#e7f7ed"});
                
                var $titleLink = $row.find('td.column-title strong a, td.column-title a').first();
                if ($titleLink.length && !$titleLink.find('.leyenda-pago').length) {
                    $titleLink.append(' <span class="leyenda-pago" style="color: #1d2327; font-size: 11px; background: #c3e6cb; padding: 2px 5px; border-radius: 3px; margin-left: 5px; font-weight: normal; border: 1px solid #7ad03a;">✅ Pago cubierto hoy</span>');
                }
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

/**
 * Bloquea la Edición Rápida (Quick Edit) en los listados para roles específicos:
 * admin_aux, super_admin y cobranza.
 */
add_filter( 'post_row_actions', 'remover_edicion_rapida_por_rol', 99, 2 );
add_filter( 'page_row_actions', 'remover_edicion_rapida_por_rol', 99, 2 );
function remover_edicion_rapida_por_rol( $actions, $post ) {
    $user = wp_get_current_user();
    $roles_bloqueados = array( 'admin_aux', 'super_admin', 'cobranza' );

    if ( array_intersect( $roles_bloqueados, (array) $user->roles ) ) {
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
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
                              
                               // Borra la cookie de sesión de PHP
    document.cookie = "PHPSESSID=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    
   
    
    // Redirige al login forzando una recarga completa
   // window.location.href = "/wp-login.php?loggedout=true";
                              

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
                                          
                                          
                                            $admin_aux_id =   $user->ID;
                                               
                                               
             
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
 //add_action('admin_footer','redirect_after_logout');   ////////////////////ADD
 
/**
 * Revierte el rol de admin_aux a cobranza específicamente al cerrar sesión.
 */
function revertir_rol_al_cerrar_sesion($user_id) {
    $user = get_userdata($user_id);
    
    // Si el usuario que está saliendo es un admin_aux, lo regresamos a cobranza
    if ( $user && in_array( 'admin_aux', (array) $user->roles ) ) {
        $user->remove_role( 'admin_aux' );
        $user->add_role( 'cobranza' );
        
        // Limpiamos la variable de sesión para evitar bucles
        if ( ! session_id() ) { session_start(); }
        $_SESSION["esAdmin"] = null;
        
        error_log("DEBUG: Usuario " . $user->user_login . " revertido a cobranza exitosamente.");
        // DETENER LA EJECUCIÓN PARA VER EL MENSAJE
       // wp_die("SISTEMA: El rol de '" . $user->user_login . "' ha sido cambiado de 'admin_aux' a 'cobranza' con éxito. <br><br><a href='".wp_login_url()."'>Ir al Login</a>");
    }


        if ( $user && in_array( 'admin', (array) $user->roles ) ) {
        $user->remove_role( 'cobranza' );
        //$user->add_role( 'cobranza' );
        
        error_log("DEBUG: Usuario " . $user->user_login . " revertido a cobranza exitosamente.");
        // DETENER LA EJECUCIÓN PARA VER EL MENSAJE
       // wp_die("SISTEMA: El rol de '" . $user->user_login . "' ha sido cambiado  con éxito. <br><br><a href='".wp_login_url()."'>Ir al Login</a>");
    }



}
add_action('wp_logout', 'revertir_rol_al_cerrar_sesion', 1, 1);



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
        
        // Ejecutar como máximo una vez por día por usuario (no una sola vez en toda la vida).
        $today_ymd = wp_date('Y-m-d');
        $last_run_date = get_user_meta( $user->ID, 'my_url_last_run_date', true );
        
        if ( $last_run_date !== $today_ymd ) {
            
                wp_remote_get('https://cocunmx.com/wp-admin/edit.php?ac-actions-form=1&orderby=title&order=desc&post_status=all&post_type=reporte_diario&ac-rules=%7B%22condition%22%3A%22AND%22%2C%22rules%22%3A%5B%7B%22id%22%3A%22date%22%2C%22field%22%3A%22date%22%2C%22type%22%3A%22date%22%2C%22input%22%3A%22text%22%2C%22operator%22%3A%22date_today%22%2C%22value%22%3Anull%7D%5D%2C%22valid%22%3Atrue%7D' );
               // Marca el día de ejecución para este usuario.
               update_user_meta( $user->ID, 'my_url_last_run_date', $today_ymd );
            
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
    $user_login = $current_user->user_login;
    $roles = $current_user->roles;

    // DEBUG
    error_log("DEBUG mostrar_solo_admins - Usuario: " . $user_login);

    // Si el usuario es "concummx" o "cocunmx", mostrar TODOS los usuarios sin filtros
    if ( $user_login === 'concummx' || $user_login === 'cocunmx' ) {
        error_log("DEBUG: Es admin principal, retornando sin filtros");
        return;  // No aplicar filtros
    }

    // Verificar la pantalla actual
    $screen = get_current_screen();
    if ( $screen->id !== 'users' ) {
        return;
    }

    // Filtrar según el rol del usuario
    if ( in_array( 'super_admin', $roles )  ) {
          // 1. Definimos exactamente qué roles queremos ver
    $roles_permitidos = array( 'admin', 'admin_aux' );
    
    // 2. Filtramos la consulta para que solo incluya estos roles
    $query->set( 'role__in', $roles_permitidos );

    }
    elseif ( in_array( 'admin', $roles ) ) {
        $query->set( 'role', 'cobranza' );
    }
    elseif ( in_array( 'admin_aux', $roles ) ) {
        $query->set( 'role', 'cobranza' );
    }
}


//add_action( 'pre_get_users', 'mostrar_solo_admins' );


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
    // Obtén el ID del usuario actualmente conectado
    $current_user_id = get_current_user_id();
    $current_user = wp_get_current_user();
    $user_login = $current_user->user_login;

   
    // Si es "concummx" o "cocunmx", no aplicar filtros
    if ( $user_login === 'concummx' || $user_login === 'cocunmx' ) {
        error_log("DEBUG: Es admin principal, retornando sin filtros");
        return;
    }

    // Si el usuario actualmente conectado es un administrador, no filtres la lista de usuarios
    /*if (current_user_can('administrator')) {
        return;
    }*/

    $meta_value = get_user_meta($current_user_id, 'autor_usuario', true);

    // Imprime el valor del meta key
    /*echo 'El valor del meta key "autor_usuario" para el usuario actualmente conectado es: ' . $meta_value;*/

    // Establece el parámetro 'meta_key' en 'acf-field_647108780ae81'
    $query->set('meta_key', 'autor_usuario');

    // Establece el parámetro 'meta_value' en el ID del usuario actualmente conectado
    $query->set('meta_value', $current_user_id);
    
    error_log("DEBUG: Aplicando filtro por autor_usuario = " . $current_user_id);
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
        
        // --- MEJORA: Validar espacios disponibles en el repetidor antes de procesar ---
        $cuotas_autorizadas = intval(get_field("cuotas_cliente", $id_cliente_cuenta) ?? 0) * 2;
        $espacios_libres = 0;
        if (have_rows('pagos_abono', $idPost)) {
            while (have_rows('pagos_abono', $idPost)) {
                the_row();
                for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
                    $val = get_sub_field('pago_#' . $i);
                    if (empty($val)) $val = get_sub_field('pago#' . $i);
                    if (empty($val)) $espacios_libres++;
                }
            }
        }
        reset_rows(); // Resetear el puntero para futuros usos en esta ejecución

        // Calcular el valor de cubrePagos y saldoAbono
        $cubrePagos = 0;
        $saldoAbono = 0;
        if ($valor_cuota_cliente > 0 && $suma_abonado > 0) {
          
            $cubrePagos = intval($suma_abonado / $valor_cuota_cliente);

               // Obtener el cociente de la división
               $cociente = $suma_abonado / $valor_cuota_cliente;

               // Calcular el resto basado en el cociente redondeado
                $resto = $suma_abonado - ($cubrePagos * $valor_cuota_cliente);

               // --- CORRECCIÓN DE CONFLICTO: Si sobran pagos pero no hay cuadros ---
               if ($cubrePagos > $espacios_libres) {
                   $pagos_excedentes = $cubrePagos - $espacios_libres;
                   $monto_sobrante_real = ($pagos_excedentes * $valor_cuota_cliente) + $resto;
                   
                   $cubrePagos = $espacios_libres; // Solo mandamos a pintar los cuadros que caben
                   $saldoAbono = round($monto_sobrante_real, 2); // El resto se queda como "sobra" analizable
               } else {
                   $saldoAbono = round($resto, 2);
               }
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

                // NUEVO: Llenar automáticamente los montos de los pagos cubiertos (inteligente)
                if ($cubrePagos > 0 && have_rows('pagos_abono', $idPost)) {
                    while (have_rows('pagos_abono', $idPost)) {
                        the_row();
                        $fecha_hoy = date("d/m/Y");
                        $pagos_llenados = 0;

                        // Buscar el primer pago VACÍO y llenar desde ahí
                        for ($i = 1; $i <= $cuotas_autorizadas && $pagos_llenados < $cubrePagos; $i++) {
                            $monto_actual = get_sub_field('pago_#' . $i);

                            // Si el pago está vacío, llenarlo
                            if (empty($monto_actual)) {
                                update_sub_field(array('pagos_abono', get_row_index(), 'pago_#' . $i), $valor_cuota_cliente, $idPost);

                                // Llenar la fecha también
                                $fecha_actual = get_sub_field('fecha_del_pago_#' . $i);
                                if (empty($fecha_actual)) {
                                    update_sub_field(array('pagos_abono', get_row_index(), 'fecha_del_pago_#' . $i), $fecha_hoy, $idPost);
                                }

                                $pagos_llenados++;
                            }
                        }
                    }
                }
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

        // SINCRONIZACIÓN FINAL: Recalcular todo el estado del cliente tras el abono
        sincronizar_datos_economicos_pago($idPost);


                       
    

        
       

        
    }
      
   

}
add_action('save_post', 'abonar', 10, 3);//


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
        $role->add_cap('read');
        $role->add_cap('edit_posts');
        $role->add_cap('edit_published_posts');
        $role->add_cap('edit_others_posts');
        $role->add_cap('publish_posts');
        // ... y así sucesivamente para todas las capacidades que necesites otorgar
         // Capacidades para publicaciones del tipo 'cliente'
         $role->add_cap('edit_clientes'); // Asumiendo que 'edit_clientes' es la capacidad necesaria
         $role->add_cap('edit_published_clientes');
         $role->add_cap('edit_others_clientes');


          // Lista de slugs de post types que deben ser visibles para el administrador auxiliar
        $post_types = [
            'cliente', 
            'gd_place', 
            'miscuentas', 
            'abono', 
            'gasto', 
            'inyeccion', 
            'reporte_diario', 
            'listas_liquidadas', 
            'nueva_liquidada'
        ];

        foreach ($post_types as $type) {
            // Se añaden capacidades tanto en singular como en plural para asegurar compatibilidad con la configuración de los CPTs
            $role->add_cap("edit_{$type}");
            $role->add_cap("edit_{$type}s");
            $role->add_cap("edit_published_{$type}s");
            $role->add_cap("edit_others_{$type}s");
            $role->add_cap("publish_{$type}s");
            $role->add_cap("read_{$type}");
            $role->add_cap("delete_{$type}");
            $role->add_cap("delete_{$type}s");
            $role->add_cap("delete_published_{$type}s");
            $role->add_cap("delete_others_{$type}s");
        }



    }
}

// Ejecutar la función en el hook 'admin_init'
add_action('init', 'otorgar_permisos_admin_aux');


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

            // REQUERIMIENTO: Los roles cobranza y admin_aux solo ven ACTIVAS por defecto.
            $user = wp_get_current_user();
            $roles_restringidos = array( 'cobranza', 'admin_aux' );
            if ( array_intersect( $roles_restringidos, (array) $user->roles ) && empty($_GET['ver_historial']) ) {
                $meta_query = (array) $query->get('meta_query');
                $meta_query[] = array(
                    'key'     => 'cuenta',
                    'value'   => 'activa',
                    'compare' => '=',
                );
                $query->set('meta_query', $meta_query);
            }
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

        if ('reporte_diario' == $post_type) {
            $user_id = get_current_user_id();
            $query->set('author', $user_id);

            // Comportamiento híbrido:
            // - Sin filtro: mostrar solo HOY.
            // - Con acp_filter[date]=YYYYMMDD: respetar la fecha filtrada.
            $fecha_filtro_acp = '';
            if (isset($_GET['acp_filter']) && is_array($_GET['acp_filter']) && isset($_GET['acp_filter']['date'])) {
                $fecha_filtro_acp = sanitize_text_field(wp_unslash((string) $_GET['acp_filter']['date']));
            }

            if (preg_match('/^\d{8}$/', $fecha_filtro_acp)) {
                $anio = intval(substr($fecha_filtro_acp, 0, 4));
                $mes  = intval(substr($fecha_filtro_acp, 4, 2));
                $dia  = intval(substr($fecha_filtro_acp, 6, 2));
                if (checkdate($mes, $dia, $anio)) {
                    $query->set('date_query', array(
                        array(
                            'year'  => $anio,
                            'month' => $mes,
                            'day'   => $dia,
                        )
                    ));
                }
            } else {
                $hoy = current_time('Y-m-d');
                $partes = explode('-', $hoy);
                $query->set('date_query', array(
                    array(
                        'year'  => (int)$partes[0],
                        'month' => (int)$partes[1],
                        'day'   => (int)$partes[2],
                    )
                ));
            }
            $query->set('posts_per_page', 1);
            $query->set('paged', 1);
            $query->set('page', 1);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }

        if ('nueva_liquidada' == $post_type) {
            $user_id = get_current_user_id();
            $query->set('author', $user_id);
            $query->set('posts_per_page', 1);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
            $query->set('paged', 1);
            $query->set('page', 1);

            $latest_nl = get_posts(array(
                'post_type' => 'nueva_liquidada',
                'author' => $user_id,
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                'fields' => 'ids',
                'suppress_filters' => true,
            ));
            if (!empty($latest_nl)) {
                $query->set('post__in', $latest_nl);
                $query->set('orderby', 'post__in');
            }
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
        $id_clientes = []; // Para almacenar los IDs de cliente
        $titulo_abono = [] ;
        $detalles_abonos = []; // Array para acumular detalles de abonos
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

           $resumen_pagos = cocum_calcular_pagos_miscuentas_por_rango($idPost_cuentas, $fecha_inicio_dmy, $fecha_fin_dmy);
           $pagos_por_cliente[$clienteNombre] = floatval($resumen_pagos['total_pagos']);
           $pagoDiario_por_cliente[$clienteNombre] = floatval($resumen_pagos['ultimo_pago_diario']);
           $detalles_por_cliente[$clienteNombre] = isset($resumen_pagos['detalles_pagos']) ? $resumen_pagos['detalles_pagos'] : array();

           $resumen_cliente = cocum_calcular_pagos_miscuentas_en_rango($idPost_cuentas, $fecha_inicio_dmy, $fecha_fin_dmy);
           $abonos_por_cliente[$clienteNombre] = floatval($resumen_cliente['total_abonos']);
           $pagocubierto_por_cliente[$clienteNombre] = floatval($resumen_cliente['total_cubierto']);
           $id_clientes[$clienteNombre] = intval($resumen_cliente['id_cliente']);
           $titulo_abono[$clienteNombre] = (string) $resumen_cliente['titulo_abono'];
           $detalles_abonos[$clienteNombre] = isset($resumen_cliente['detalles_abonos']) ? $resumen_cliente['detalles_abonos'] : array();
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
        // Solo mostrar si hay abono > 0
        if ($total > 0) {
            echo '<tr>';  
            echo '<td>' . esc_html(  $id_clientes[$clienteABN] ) . '</td>';   
            echo '<td>' . esc_html($titulo_abono[$clienteABN]) . '</td>'; 
            echo '<td>' . esc_html( $total) . '</td>'; 
            echo '<td>' . esc_html($total) . '</td>';
            echo '<td>0</td>';
            echo '<td><button class="ver-detalles-abono" data-cliente="' . $id_clientes[$clienteABN] . '" data-tipo="abono">Ver Detalles</button></td>';
            echo '<td>0</td>';
            echo '</tr>';
        }
        
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

    // ⚠️ Ejecutar SOLO cuando lst_clnt=1
    if (!isset($_GET['lst_clnt']) || $_GET['lst_clnt'] != '1') {
        return; 
    }

    $status_by_post_id = [];
    $financial_mode_by_post_id = [];
    global $wp_query;
    $listed_gd_ids = [];
    if (isset($wp_query->posts) && is_array($wp_query->posts)) {
        foreach ($wp_query->posts as $listed_post) {
            if (!isset($listed_post->ID)) {
                continue;
            }
            $post_id = intval($listed_post->ID);
            if ($post_id <= 0) {
                continue;
            }
            $listed_gd_ids[] = $post_id;
            $status_by_post_id[$post_id] = strtolower(trim((string) get_post_meta($post_id, 'cuentaGD', true)));
        }
    }

    $gd_financial_stats = [];
    $today_ts = strtotime(wp_date('Y-m-d'));
    $parse_date_to_ts = static function($raw_value) {
        $raw_value = trim((string) $raw_value);
        if ($raw_value === '') {
            return 0;
        }

        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $raw_value, $matches)) {
            return strtotime($matches[3] . '-' . $matches[2] . '-' . $matches[1]);
        }

        $timestamp = strtotime(str_replace('/', '-', $raw_value));
        return $timestamp ? $timestamp : 0;
    };

    foreach ($listed_gd_ids as $gd_id) {
        $gd_financial_stats[$gd_id] = [
            'has_linked_client' => false,
            'mis_count' => 0,
            'has_pending' => false,
            'has_pending_today' => false,
            'has_terminated' => false,
        ];
    }

    $normalize_related_id = static function($raw_value) {
        if (is_array($raw_value)) {
            $raw_value = reset($raw_value);
        } elseif (is_object($raw_value) && isset($raw_value->ID)) {
            $raw_value = $raw_value->ID;
        }

        $clean_value = trim((string) $raw_value);
        if ($clean_value === '') {
            return 0;
        }

        if (is_numeric($clean_value)) {
            return intval($clean_value);
        }

        return 0;
    };

    if (!empty($listed_gd_ids)) {
        $listed_gd_lookup = array_fill_keys(array_map('intval', $listed_gd_ids), true);
        $clientes_ids = get_posts([
            'post_type' => 'cliente',
            'post_status' => 'any',
            'fields' => 'ids',
            'posts_per_page' => -1,
        ]);

        $cliente_to_gd = [];
        foreach ($clientes_ids as $cliente_id) {
            $gd_raw = get_post_meta($cliente_id, 'id_lista_cliente', true);
            if (empty($gd_raw)) {
                $gd_raw = get_post_meta($cliente_id, 'field_6371dda213f5d', true);
            }
            if (empty($gd_raw)) {
                $gd_raw = get_field('id_lista_cliente', $cliente_id);
            }

            $gd_id = $normalize_related_id($gd_raw);
            if ($gd_id > 0 && isset($listed_gd_lookup[$gd_id]) && isset($gd_financial_stats[$gd_id])) {
                $cliente_to_gd[$cliente_id] = $gd_id;
                $gd_financial_stats[$gd_id]['has_linked_client'] = true;
            }
        }

        if (!empty($cliente_to_gd) || !empty($listed_gd_lookup)) {
            $miscuentas_ids = get_posts([
                'post_type' => 'miscuentas',
                'post_status' => 'publish',
                'fields' => 'ids',
                'posts_per_page' => -1,
            ]);

            foreach ($miscuentas_ids as $miscuenta_id) {
                $cliente_raw = get_post_meta($miscuenta_id, 'id_cliente_cuenta', true);
                if (empty($cliente_raw)) {
                    $cliente_raw = get_field('id_cliente_cuenta', $miscuenta_id);
                }
                $cliente_id = $normalize_related_id($cliente_raw);

                $gd_id = 0;
                if ($cliente_id > 0 && isset($cliente_to_gd[$cliente_id])) {
                    $gd_id = $cliente_to_gd[$cliente_id];
                } elseif ($cliente_id > 0 && isset($listed_gd_lookup[$cliente_id]) && get_post_type($cliente_id) === 'gd_place') {
                    // Fallback: en algunos casos id_cliente_cuenta apunta directo al gd_place.
                    $gd_id = $cliente_id;
                } elseif ($cliente_id > 0) {
                    // Fallback: resolver gd_place desde el cliente cuando no quedó en el índice inicial.
                    $gd_from_cliente_raw = get_post_meta($cliente_id, 'id_lista_cliente', true);
                    if (empty($gd_from_cliente_raw)) {
                        $gd_from_cliente_raw = get_post_meta($cliente_id, 'field_6371dda213f5d', true);
                    }
                    if (empty($gd_from_cliente_raw)) {
                        $gd_from_cliente_raw = get_field('id_lista_cliente', $cliente_id);
                    }
                    $gd_from_cliente_id = $normalize_related_id($gd_from_cliente_raw);
                    if ($gd_from_cliente_id > 0 && isset($listed_gd_lookup[$gd_from_cliente_id])) {
                        $gd_id = $gd_from_cliente_id;
                    }
                }

                if ($gd_id <= 0) {
                    // Fallback final: miscuentas puede guardar referencia directa a lista cliente.
                    $gd_direct_raw = get_post_meta($miscuenta_id, 'id_lista_cliente', true);
                    if (empty($gd_direct_raw)) {
                        $gd_direct_raw = get_post_meta($miscuenta_id, 'field_6371dda213f5d', true);
                    }
                    if (empty($gd_direct_raw)) {
                        $gd_direct_raw = get_field('id_lista_cliente', $miscuenta_id);
                    }
                    $gd_direct_id = $normalize_related_id($gd_direct_raw);
                    if ($gd_direct_id > 0 && isset($listed_gd_lookup[$gd_direct_id])) {
                        $gd_id = $gd_direct_id;
                    }
                }

                if ($gd_id <= 0 || !isset($gd_financial_stats[$gd_id])) {
                    continue;
                }

                $gd_financial_stats[$gd_id]['has_linked_client'] = true;
                $gd_financial_stats[$gd_id]['mis_count']++;

                $monto_total = floatval(get_post_meta($miscuenta_id, 'monto_cuenta', true));
                $total_pagos = floatval(get_post_meta($miscuenta_id, 'total_pagos', true));
                $suma_abonado = floatval(get_post_meta($miscuenta_id, 'suma_abonado', true));
                $saldo_pendiente = round($monto_total - ($total_pagos + $suma_abonado), 2);
                $estado_cuenta = strtolower(trim((string) get_post_meta($miscuenta_id, 'cuenta', true)));
                if ($estado_cuenta === '') {
                    $estado_cuenta = strtolower(trim((string) get_field('cuenta', $miscuenta_id)));
                }
                $estatus_pago = trim((string) get_post_meta($miscuenta_id, 'estatus_pago', true));
                if ($estatus_pago === '') {
                    $estatus_pago = trim((string) get_field('estatus_pago', $miscuenta_id));
                }
                $fecha_prox_raw = get_post_meta($miscuenta_id, 'fecha_prox_cobro', true);
                if ($fecha_prox_raw === '') {
                    $fecha_prox_raw = get_field('fecha_prox_cobro', $miscuenta_id);
                }
                $fecha_prox_ts = $parse_date_to_ts($fecha_prox_raw);
                $is_pending_today = ($estado_cuenta === 'activa') && (($fecha_prox_ts > 0 && $fecha_prox_ts <= $today_ts) || $estatus_pago === '');

                if ($saldo_pendiente > 0.01 || $estado_cuenta === 'activa') {
                    $gd_financial_stats[$gd_id]['has_pending'] = true;
                } else {
                    $gd_financial_stats[$gd_id]['has_terminated'] = true;
                }
                if ($is_pending_today) {
                    $gd_financial_stats[$gd_id]['has_pending_today'] = true;
                }
            }
        }
    }

    foreach ($listed_gd_ids as $gd_id) {
        $status_text = isset($status_by_post_id[$gd_id]) ? $status_by_post_id[$gd_id] : '';
        $status_is_active = in_array($status_text, ['activa', 'activo'], true);
        $status_is_terminated = in_array($status_text, ['terminado', 'liquidado', 'finalizado'], true);
        $status_is_registered = in_array($status_text, ['', 'registrado', 'nuevo', 'sin estado', 'desvinculada'], true);

        $stats = isset($gd_financial_stats[$gd_id]) ? $gd_financial_stats[$gd_id] : null;
        if (is_array($stats) && $stats['has_pending_today']) {
            $financial_mode_by_post_id[$gd_id] = 'pending';
            continue;
        }
        if (is_array($stats) && intval($stats['mis_count']) === 0) {
            $financial_mode_by_post_id[$gd_id] = 'registered';
            continue;
        }
        if (is_array($stats) && $stats['mis_count'] > 0) {
            $financial_mode_by_post_id[$gd_id] = 'terminated';
            continue;
        }

        if ($status_is_active) {
            $financial_mode_by_post_id[$gd_id] = 'pending';
            continue;
        }
        if ($status_is_terminated) {
            $financial_mode_by_post_id[$gd_id] = 'terminated';
            continue;
        }
        if ($status_is_registered || (is_array($stats) && !$stats['has_linked_client'])) {
            $financial_mode_by_post_id[$gd_id] = 'registered';
            continue;
        }
        $financial_mode_by_post_id[$gd_id] = 'pending';
    }
    ?>
    <style>
        /* Estilo para el toggle de duplicados */
        .duplicado-toggle {
            display: inline-block;
            color: gray !important;
            font-size: 11px;
            margin-top: 2px;
            line-height: 1.2;
            cursor: pointer; /* Indica que es interactivo */
            margin-left: 5px;
            padding: 2px 5px;
            border-radius: 3px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }
        .duplicado-toggle:hover {
            background-color: #e0e0e0;
        }
    </style>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        const rows = $('tr.type-gd_place');
        const groupedClients = new Map();
        const defaultMode = 'all';
        const statusByPostId = <?php echo wp_json_encode($status_by_post_id); ?> || {};
        const modeByPostId = <?php echo wp_json_encode($financial_mode_by_post_id); ?> || {};
        let detectedStatusColumnClass = '';
        let detectedDateColumnClass = '';

        function normalizeText(value) {
            return String(value || '').trim().toLowerCase();
        }

        function getColumnClassByKeywords(keywords, fallbackClasses) {
            if (Array.isArray(fallbackClasses)) {
                for (let i = 0; i < fallbackClasses.length; i++) {
                    const className = fallbackClasses[i];
                    if ($('thead th.' + className + ', tfoot th.' + className).length) {
                        return className;
                    }
                }
            }

            let foundClass = '';
            $('thead th, tfoot th').each(function() {
                if (foundClass) return;
                const $th = $(this);
                const text = normalizeText($th.text());
                const matchesKeyword = keywords.some(function(keyword) {
                    return text.indexOf(keyword) !== -1;
                });
                if (!matchesKeyword) return;

                const classes = ($th.attr('class') || '').split(/\s+/);
                const columnClass = classes.find(function(cls) {
                    return cls.indexOf('column-') === 0;
                });

                if (columnClass) {
                    foundClass = columnClass;
                }
            });

            return foundClass;
        }

        function getCellTextByColumnClass($row, columnClass) {
            if (!columnClass) return '';
            return normalizeText($row.find('td.' + columnClass).first().text());
        }

        function extractStatusText($row) {
            let statusText = getCellTextByColumnClass($row, detectedStatusColumnClass);
            if (statusText) return statusText;

            const knownStatuses = [
                'terminado',
                'liquidado',
                'finalizado',
                'registrado',
                'nuevo',
                'sin estado',
                'activa',
                'desvinculada'
            ];

            $row.find('td').each(function() {
                if (statusText) return;
                const cellText = normalizeText($(this).text());
                if (knownStatuses.indexOf(cellText) !== -1) {
                    statusText = cellText;
                }
            });

            return statusText;
        }

        function extractDateText($row) {
            return getCellTextByColumnClass($row, detectedDateColumnClass);
        }

        function getDateValue(rowItem) {
            if (!(rowItem.date instanceof Date) || isNaN(rowItem.date.getTime())) {
                return 0;
            }
            return rowItem.date.getTime();
        }

        function getSortedRows(clientRows) {
            return clientRows.slice().sort(function(a, b) {
                return getDateValue(b) - getDateValue(a);
            });
        }

        function isTerminatedStatus(status) {
            return status === 'terminado' || status === 'liquidado' || status === 'finalizado';
        }

        function isRegisteredStatus(status) {
            return status === '' || status === 'registrado' || status === 'nuevo' || status === 'sin estado';
        }

        function isPendingStatus(status) {
            return !isTerminatedStatus(status) && !isRegisteredStatus(status);
        }

        function getRowByMode(clientRows, mode) {
            const sortedRows = getSortedRows(clientRows);
            const pendingRows = sortedRows.filter(function(r) { return r.mode === 'pending'; });
            const terminatedRows = sortedRows.filter(function(r) { return r.mode === 'terminated'; });
            const registeredRows = sortedRows.filter(function(r) { return r.mode === 'registered'; });

            if (mode === 'pending') return pendingRows[0] || null;
            if (mode === 'terminated') return terminatedRows[0] || null;
            if (mode === 'registered') return registeredRows[0] || null;

            return pendingRows[0] || terminatedRows[0] || registeredRows[0] || sortedRows[0] || null;
        }

        function setActiveButton(mode) {
            $('#cocum-gd-filters .page-title-action').css({
                'background-color': '',
                'border-color': '',
                'color': ''
            });
            $('#cocum-gd-filters .page-title-action[data-mode="' + mode + '"]').css({
                'background-color': '#3858e9',
                'border-color': '#3858e9',
                'color': '#fff'
            });
        }

        function applyFilter(mode) {
            rows.hide();
            rows.find('.duplicado-toggle').remove();

            groupedClients.forEach(function(clientRows) {
                const rowToDisplay = getRowByMode(clientRows, mode);
                if (!rowToDisplay) return;

                rowToDisplay.$row.show();

                if (clientRows.length > 1) {
                    const $titleCell = rowToDisplay.$row.find('td.title.column-title');
                    const toggle = $('<div class="duplicado-toggle">(' + clientRows.length + ' cuentas)</div>');
                    $titleCell.append(toggle);
                }
            });

            setActiveButton(mode);
        }

        detectedStatusColumnClass = getColumnClassByKeywords(
            ['estatus', 'estado', 'status', 'cuenta'],
            ['column-cuenta', 'column-cuenta_gd', 'column-cuentagd', 'column-estado', 'column-estatus', 'column-status']
        );
        detectedDateColumnClass = getColumnClassByKeywords(['fecha', 'date'], ['column-date', 'column-fecha']);

        rows.each(function(index) {
            const $row = $(this);
            const rowIdRaw = ($row.attr('id') || '').replace('post-', '');
            const rowPostId = parseInt(rowIdRaw, 10);
            const metaStatus = Number.isNaN(rowPostId) ? '' : normalizeText(statusByPostId[rowPostId]);
            const rowMode = Number.isNaN(rowPostId) ? '' : normalizeText(modeByPostId[rowPostId]);
            const cuentaText = metaStatus || extractStatusText($row);
            const fechaTextRaw = extractDateText($row);
            const $link = $row.find('td.title.column-title a');
            const titleRaw = $link.text().trim();
            const title = titleRaw.toLowerCase();
            const key = title !== '' ? title : ('sin-titulo-' + index);

            let publicationDate = null;
            const fechaMatch = fechaTextRaw.match(/(\d{2}\/\d{2}\/\d{4})/);
            if (fechaMatch && fechaMatch[1]) {
                const fechaParts = fechaMatch[1].split('/');
                publicationDate = new Date(fechaParts[2] + '-' + fechaParts[1] + '-' + fechaParts[0]);
            }

            if (!groupedClients.has(key)) {
                groupedClients.set(key, []);
            }

            groupedClients.get(key).push({
                $row: $row,
                status: cuentaText,
                mode: rowMode,
                date: publicationDate
            });
        });

        const $h1 = $('body.post-type-gd_place .wrap h1');
        if ($h1.length) {
            const buttons = [
                { mode: 'all', label: 'Todos' },
                { mode: 'pending', label: 'Con Pagos Pendientes' },
                { mode: 'terminated', label: 'Terminados' },
                { mode: 'registered', label: 'Solo Registrados' }
            ];

            const $filters = $('<span id="cocum-gd-filters" style="margin-left:10px;"></span>');

            buttons.forEach(function(btn) {
                const $button = $('<a href="#" class="page-title-action" data-mode="' + btn.mode + '" style="margin-left:6px;">' + btn.label + '</a>');
                $button.on('click', function(e) {
                    e.preventDefault();
                    applyFilter(btn.mode);
                });
                $filters.append($button);
            });

            $h1.append($filters);
        }

        applyFilter(defaultMode);
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
// AJUSTE: Permitir que cobranza en web vea listas_liquidadas, nueva_liquidada y gasto
add_action('admin_menu', function() {
    global $submenu, $menu;
    $current_user = wp_get_current_user();
    
    // Si es cobranza en web, MOSTRAR estos post types
    if (in_array('cobranza', $current_user->roles) && !isMobileDevice()) {
        // AJUSTE: Manipular directamente el menú global para agregar post types
        global $menu;
        
        $post_types = array(
            'nueva_liquidada' => 'Nueva Liquidada',
            'listas_liquidadas' => 'Listas Liquidadas',
            'gasto' => 'Gastos',
        );
        
        foreach ($post_types as $pt_slug => $pt_name) {
            $menu_slug = "edit.php?post_type=$pt_slug";
            $found = false;
            
            // Verificar si el menú ya existe
            foreach ($menu as $item) {
                if (isset($item[2]) && $item[2] === $menu_slug) {
                    $found = true;
                    break;
                }
            }
            
            // Si no existe, agregarlo manualmente
            if (!$found) {
                $position = 65 + array_search($pt_slug, array_keys($post_types));
                $menu[$position] = array(
                    $pt_name,                      // Menu title
                    'read',                        // Capability
                    $menu_slug,                    // Menu slug
                    '',                            // Page title
                    'menu-top',                    // CSS classes
                    'toplevel_page_' . $pt_slug,   // Menu ID
                    'dashicons-admin-post',        // Icon
                );
            }
        }
        
        // Cobranza en web puede ver y acceder a estos menús (solo el menú principal, sin submenús).
        // Ocultar submenús también para cobranza.
        foreach (array('nueva_liquidada', 'listas_liquidadas') as $pt_slug) {
            $key = "edit.php?post_type=$pt_slug";
            if (isset($submenu[$key])) {
                unset($submenu[$key][5]);  // "Todo ..."
                unset($submenu[$key][10]); // "Añadir nuevo"
            }
        }
        return;
    }

    // Para otros usuarios, ocultar los submenús
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
// Agregar link "Edita Datos" en row actions de miscuentas
//---------------------------------------------------------
add_filter('post_row_actions', function($actions, $post) {
    if ($post->post_type !== 'miscuentas') {
        return $actions;
    }
    
    // Obtener el ID del cliente vinculado a este registro de miscuentas
    $id_cliente = intval(get_post_meta($post->ID, 'id_cliente_cuenta', true));
    
    if ($id_cliente) {
        // Obtener el ID de gd_place vinculado al cliente
        $id_gd_place = intval(get_post_meta($id_cliente, 'id_lista_cliente', true));
        
        if ($id_gd_place) {
            // Generar URL de edición para gd_place
            $edit_url = admin_url('post.php?post=' . $id_gd_place . '&action=edit');
            
            // Agregar link al principio de las acciones (primero que papelera)
            $actions['info contacto'] = '<a href="' . esc_url($edit_url) . '" style="color:green;">📍Info Contacto</a>';
        }
    }
    
    return $actions;
}, 10, 2);

/**
 * Muestra el ID del Cliente Principal (gd_place) de forma discreta en el título
 * de los registros en el listado de miscuentas.
 */
add_filter('the_title', function($title, $id) {
    if (!is_admin()) return $title;

    // Solo actuar en el listado (edit.php) de 'miscuentas'
    $screen = get_current_screen();
    if ($screen && $screen->base === 'edit' && $screen->post_type === 'miscuentas') {
        
        // 1. Obtener ID del Post Cliente (tipo 'cliente')
        $id_cliente = get_post_meta($id, 'id_cliente_cuenta', true);
        
        if ($id_cliente) {
            // 2. Obtener ID del Cliente Principal (tipo 'gd_place')
            $id_gd_place = get_post_meta($id_cliente, 'id_lista_cliente', true);
            
            if ($id_gd_place) {
                // Retornar el título con el ID prefijado en gris
                return '[ID: #' . esc_html($id_gd_place) . ']' . $title;
            }
        }
    }
    return $title;
}, 10, 2);

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
add_filter('post_row_actions', 'agregar_boton_nueva_cuenta_gdplace', 10, 2);
function agregar_boton_nueva_cuenta_gdplace($actions, $post){
    if ($post->post_type !== 'gd_place') return $actions;

    // URL real de edición (crear nueva cuenta)
    $editar = admin_url("post.php?post={$post->ID}&action=edit");

   // Agregamos la opción de editar perfil con un color distintivo
    $actions['editar_perfil'] = 
        "<a style='color:blue;font-weight:bold;' href='{$editar}'>📝 Editar Datos</a>";

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
//add_action('admin_footer', 'auditar_sistema_wordpress', 9999);




/**
 * Shortcode para mostrar el nombre y rol del usuario actual.
 * Uso: [perfil_usuario]
 */
function shortcode_usuario_y_rol() {
    // Verificamos si el usuario ha iniciado sesión
    if ( is_user_logged_in() ) {
        // Obtenemos el objeto del usuario actual
        $current_user = wp_get_current_user();
        
        // Obtenemos el nombre y el rol principal
        $nombre = $current_user->display_name;
        $rol = !empty( $current_user->roles ) ? $current_user->roles[0] : 'sin rol';

        // Traducción amigable de los roles comunes de WordPress
        $roles_traducidos = array(
            'administrator' => 'Administrador',
            'editor'        => 'Editor',
            'author'        => 'Autor',
            'contributor'   => 'Colaborador',
            'subscriber'    => 'Suscriptor'
        );

        $rol_final = isset( $roles_traducidos[$rol] ) ? $roles_traducidos[$rol] : ucfirst($rol);

        // Retornamos el HTML (usamos ob_start para mayor limpieza)
        return '<div class="user-profile-info">' . 
                    'Hola, <strong>' . esc_html( $nombre ) . '</strong> (' . esc_html( $rol_final ) . ')' . 
               '</div>';
    }
    
    // Si no está logueado, puedes retornar un mensaje o nada
    return '<a href="' . wp_login_url() . '">Iniciar sesión</a>';
}
add_shortcode( 'perfil_usuario', 'shortcode_usuario_y_rol' );


add_action('wp_logout', 'auto_limpiar_sesion_al_salir');
function auto_limpiar_sesion_al_salir() {
    if ( !session_id() ) {
        session_start();
    }
    // Borra todas las variables de sesión
    //session_unset();
    // Destruye la sesión física en el servidor
    //session_destroy();
    // session_destroy(); // Comentado para evitar la destrucción prematura de la sesión durante el Magic Link
}

// Inyecta el script de limpieza en el footer de todas las páginas
add_action('wp_footer', 'limpiar_rastros_magic_links_js');

function limpiar_rastros_magic_links_js() {
    ?>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Buscamos el botón de cerrar sesión (ajusta el selector si es necesario)
        const botonesCerrar = document.querySelectorAll('a[href*="logout"], .cerrar-sesion-btn, .wp-block-button__link');

        botonesCerrar.forEach(function(boton) {
            boton.addEventListener('click', function(e) {
                // Mensaje de depuración en consola para que veas que funciona
                console.log('Limpiando cookies y almacenamiento...');

                // 2. Limpieza de LocalStorage y SessionStorage
                localStorage.clear();
                sessionStorage.clear();
                
                // IMPORTANTE: Se ha eliminado la limpieza de cookies por JS aquí.
                // Si se borran las cookies antes de enviar la petición de logout al servidor,
                // el servidor no podrá identificar al usuario y no podrá revertir su rol.
            });
        });
    });
    </script>
    <?php
}


/**
 * 1. Redirigir al entrar (Login)
 */
add_filter( 'login_redirect', 'definir_inicio_personalizado_admin', 10, 3 );
function definir_inicio_personalizado_admin( $redirect_to, $request, $user ) {
    if ( is_wp_error( $user ) ) return $redirect_to;

    $roles = (array) $user->roles;
    // Agregamos todos los slugs de tus roles manuales
    if ( in_array( 'admin', $roles ) || in_array( 'super_admin', $roles ) ) {
        return admin_url( 'users.php' );
    }
    return $redirect_to;
}

/**
 * Agrega un link de "Ver Historial" DEBAJO de la tabla del listado de Miscuentas
 * para los roles de cobranza, admin_aux y administradores.
 */
add_action( 'admin_footer', function() {
    global $current_screen;
    
    if ( !$current_screen || $current_screen->post_type !== 'miscuentas' ) {
        return;
    }
    
    $user = wp_get_current_user();
    $roles_ver_boton = array( 'cobranza', 'admin_aux', 'admin', 'super_admin', 'administrator', 'Administrador' );
    
    if ( !array_intersect( $roles_ver_boton, (array) $user->roles ) ) {
        return;
    }
    
    if ( !isset($_GET['ver_historial']) ) {
        $url = add_query_arg( 'ver_historial', '1' );
        $label = '📂 Ver Historial (Terminados)';
        $btn_id = 'btn-ver-historial';
        $btn_color = '#d63638';
    } else {
        $url = remove_query_arg( 'ver_historial' );
        $label = '✅ Ver Solo Activas';
        $btn_id = 'btn-ver-activas';
        $btn_color = '#4bbb63';
    }
    
    // Imprimimos el botón con estilos fijos para que se acople perfectamente en línea
    echo '<a id="' . esc_attr($btn_id) . '" href="' . esc_url($url) . '" style="color: ' . esc_attr($btn_color) . ' !important; font-weight: bold !important; border: 2px solid ' . esc_attr($btn_color) . ' !important; padding: 4px 12px !important; border-radius: 4px !important; display: inline-block !important; text-decoration: none !important; font-size: 12px !important; margin-left: 12px !important; vertical-align: middle !important; line-height: 1.4 !important; white-space: nowrap !important;">
        ' . esc_html($label) . '
    </a>';
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            function acomodarBotonHistorial() {
                var miBoton = $('#<?php echo esc_js($btn_id); ?>');
                
                // 1. Intentar colocarlo justo al lado del toggle de "Inline Edit"
                var inlineEdit = $('.inline-edit-toggle, label[for="inline-edit-toggle"]').prev();
                if (inlineEdit.length) {
                    miBoton.insertAfter(inlineEdit);
                    return;
                }

                // 2. Si no lo encuentra, buscar el botón "Reset Sorting" que se ve claramente en tu pantalla
                var resetSorting = $('input[value="Reset Sorting"], .reset-sorting, button:contains("Reset Sorting")').first();
                if (resetSorting.length) {
                    miBoton.insertAfter(resetSorting);
                    return;
                }
                
                // 3. Tercera opción de respaldo: meterlo en la barra de herramientas principal (.wp-filter)
                var wpFilter = $('.wp-filter .actions, .wp-filter').first();
                if (wpFilter.length) {
                    miBoton.appendTo(wpFilter);
                }
            }

            // Ejecutar al cargar la página
            acomodarBotonHistorial();

            // Pequeño retraso por si los otros botones tardan en cargar por AJAX/JS
            setTimeout(acomodarBotonHistorial, 500);
        });
    </script>
    <?php
}, 999);

/**
 * 2. Bloquear el acceso al "index.php" (Escritorio) y mandarlos a Usuarios
 * Esto hace que si escriben /wp-admin/ a secas, los mande a la lista.
 */
add_action( 'admin_init', 'bloquear_escritorio_para_admin_custom' );
function bloquear_escritorio_para_admin_custom() {
    global $pagenow;
    
    // Si el usuario intenta entrar a index.php (el dashboard)
    if ( $pagenow == 'index.php' ) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;
        
        if ( in_array( 'admin', $roles ) || in_array( 'super_admin', $roles ) ) {
            wp_redirect( admin_url( 'users.php' ) );
            exit;
        }
    }
}

/**
 * Oculta el menú lateral izquierdo para el rol 'admin'
 */
add_action('admin_head', 'quitar_menu_lateral_admin');

function quitar_menu_lateral_admin() {
    $user = wp_get_current_user();
    
    // Verificamos si el usuario tiene el rol 'admin'
    if ( in_array( 'admin', (array) $user->roles ) ) {
        echo '<style>
            /* Oculta la barra negra y el fondo del menú */
            #adminmenuback, 
            #adminmenuwrap { 
                display: none !important; 
            }
            
            /* Ajusta el cuerpo del contenido para que ocupe todo el ancho */
            #wpcontent, 
            #wpfooter { 
                margin-left: 0 !important; 
            }
            
            /* Opcional: Oculta la barra superior de WordPress si también te estorba */
            /* #wpadminbar { display: none !important; } */
            /* html.wp-toolbar { padding-top: 0 !important; } */
        </style>';
    }
}

function enforce_superadmin_user_role() {
    // Buscar el usuario por login
    $user = get_user_by('login', 'superadmin');
    if (!$user) return;

    // Si ya tiene solo ese rol, no hacer nada
    if ($user->roles === ['super_admin']) return;

    // Forzar que SOLO tenga ese rol
    $user->set_role('super_admin');
}
add_action('init', 'enforce_superadmin_user_role');


add_filter( 'user_has_cap', 'otorgar_capacidades_temporales', 10, 3 );

function otorgar_capacidades_temporales( $allcaps, $cap, $args ) {
    $user = wp_get_current_user();
    if ( !$user->ID ) return $allcaps;

    // 1. Verificamos que sea un usuario con rol de cobranza
    // 2. Verificamos que NO esté en la App (es decir, está en la Web)
    if ( in_array( 'cobranza', $user->roles ) && !isMobileDevice() ) {
        
        // Obtenemos el objeto del rol admin_aux
        $role_aux = get_role( 'admin_aux' );

        if ( $role_aux ) {
            // Recorremos todas las capacidades de admin_aux
            foreach ( $role_aux->capabilities as $cap_name => $granted ) {
                // Se las asignamos al usuario actual solo para esta carga de página
                $allcaps[$cap_name] = $granted;
            }
        }
        
        // AJUSTE: Dar acceso TOTAL a los post types personalizados
        // Esto es necesario para que aparezcan en el menú
        $post_types = array('nueva_liquidada', 'listas_liquidadas', 'gasto');
        
        foreach ($post_types as $pt) {
            // Capacidades básicas
            $allcaps['read'] = true;
            $allcaps['edit_posts'] = true;
            $allcaps['edit_others_posts'] = true;
            $allcaps['edit_published_posts'] = true;
            $allcaps['publish_posts'] = true;
            $allcaps['delete_posts'] = true;
            $allcaps['delete_others_posts'] = true;
            $allcaps['delete_published_posts'] = true;
            
            // Capacidades específicas del post type
            $allcaps["edit_{$pt}"] = true;
            $allcaps["read_{$pt}"] = true;
            $allcaps["delete_{$pt}"] = true;
            $allcaps["edit_{$pt}s"] = true;
            $allcaps["edit_others_{$pt}s"] = true;
            $allcaps["publish_{$pt}s"] = true;
            $allcaps["read_private_{$pt}s"] = true;
            $allcaps["delete_{$pt}s"] = true;
            $allcaps["delete_private_{$pt}s"] = true;
            $allcaps["delete_published_{$pt}s"] = true;
            $allcaps["delete_others_{$pt}s"] = true;
            $allcaps["edit_private_{$pt}s"] = true;
            $allcaps["edit_published_{$pt}s"] = true;
        }
    }

    return $allcaps;
}


/**
 * Seguridad y Limpieza Universal para CocunMX
 */

// 1. Quitar barra de herramientas en todo el sitio público
add_filter('show_admin_bar', '__return_false');

// 2. Gestión de redirecciones y acceso
add_action( 'template_redirect', 'control_acceso_universal' );

function control_acceso_universal() {
    // Si la página no existe, al Home.
    if ( is_404() ) {
        wp_redirect( home_url(), 301 );
        exit;
    }
}

add_action( 'add_meta_boxes', 'quitar_bloque_atraso_acf', 99 );

function quitar_bloque_atraso_acf() {
    // Usamos el ID que encontraste: acf-group_636faa6731dc5
    // El post type es 'gd_place' (según tu URL)
    remove_meta_box( 'acf-group_636faa6731dc5', 'gd_place', 'normal' );
}

// ==================================================
// Meta box: Fecha de Registro en gd_place
// ==================================================
add_action('add_meta_boxes', 'cocum_registrar_metabox_fecha_registro');
function cocum_registrar_metabox_fecha_registro() {
    add_meta_box(
        'cocum_fecha_registro',
        'Fecha de Registro',
        'cocum_render_metabox_fecha_registro',
        'cliente',
        'side',
        'high'
    );
}

function cocum_render_metabox_fecha_registro($post) {
    wp_nonce_field('cocum_fecha_registro_nonce', 'cocum_fecha_registro_nonce');
    $fecha = ($post->post_date && $post->post_date !== '0000-00-00 00:00:00')
        ? date('Y-m-d', strtotime($post->post_date))
        : date('Y-m-d');
    echo '<label for="cocum_fecha_registro"><strong>Fecha de alta:</strong></label><br>';
    echo '<input type="date" id="cocum_fecha_registro" name="cocum_fecha_registro" value="' . esc_attr($fecha) . '" style="width:100%; margin-top:6px; padding:4px;">';
    echo '<p style="color:#666; font-size:11px; margin-top:4px;">Puedes seleccionar una fecha anterior para registros atrasados.</p>';
}

add_action('save_post_cliente', 'cocum_guardar_fecha_registro', 5, 1);
function cocum_guardar_fecha_registro($post_id) {
    if (!isset($_POST['cocum_fecha_registro_nonce']) || !wp_verify_nonce($_POST['cocum_fecha_registro_nonce'], 'cocum_fecha_registro_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (empty($_POST['cocum_fecha_registro'])) return;

    $nueva_fecha = sanitize_text_field($_POST['cocum_fecha_registro']);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $nueva_fecha)) return;

    $post = get_post($post_id);
    $hora_actual = ($post->post_date && $post->post_date !== '0000-00-00 00:00:00')
        ? date('H:i:s', strtotime($post->post_date))
        : current_time('H:i:s');

    $post_date_local = $nueva_fecha . ' ' . $hora_actual;
    $post_date_gmt   = get_gmt_from_date($post_date_local);

    remove_action('save_post_cliente', 'cocum_guardar_fecha_registro', 5);
    wp_update_post(array(
        'ID'            => $post_id,
        'post_date'     => $post_date_local,
        'post_date_gmt' => $post_date_gmt,
    ));
    add_action('save_post_cliente', 'cocum_guardar_fecha_registro', 5);
}

/**
 * Control de acceso para el rol Cobranza.
 * Bloquea el acceso web normal, permitiendo solo App o Magic Link.
 */
function restringir_acceso_cobranza_web() {
    // Si es una petición AJAX o no hay usuario, no hacemos nada
    if ( wp_doing_ajax() || ! is_user_logged_in() ) return;

    $user = wp_get_current_user();

    // Solo verificamos al rol 'cobranza'
    if ( in_array( 'cobranza', (array) $user->roles ) ) {
        
        // 1. Detectar si es la App (usando tu función isMobileDevice)
        $es_app = isMobileDevice();
        
        // 2. Detectar si entró por Magic Link (flag de sesión persistente)
        $es_magic_link = ( isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] == 2 );

        // REGLA: Si NO es App Y NO es Magic Link -> Bloquear acceso Web
        if ( ! $es_app && ! $es_magic_link ) {
            
            // Si intenta acceder a cualquier parte del escritorio (admin)
            if ( is_admin() ) {
                wp_die(
                    '<h1>Acceso Denegado</h1>
                    <p>Por razones de seguridad, el acceso web para Cobradores está restringido.</p>
                    <p><strong>Por favor:</strong> Use la aplicación móvil oficial o solicite un enlace de acceso  al administrador.</p>
                    <p><a href="' . wp_logout_url( home_url() ) . '">Cerrar sesión y volver</a></p>',
                    'Seguridad CocunMX',
                    array( 'response' => 403 )
                );
            }
        }
    }
}
// Lo ejecutamos en admin_init para proteger el panel...
add_action('admin_init', 'restringir_acceso_cobranza_web');


// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Agrega un mensaje de confirmación global al intentar enviar cualquier post a la papelera.
 */
add_action('admin_footer', 'confirmacion_eliminacion_global');
function confirmacion_eliminacion_global() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Detecta el clic en los enlaces de "Papelera" (clase .submitdelete de WP)
        $(document).on('click', '.submitdelete, .row-actions .trash a', function(e) {
            var mensaje = "⚠️ ADVERTENCIA DE SEGURIDAD\n\n¿Está totalmente seguro de que desea enviar este registro a la papelera?\n\nRecuerde que esta acción puede afectar saldos, reportes y registros vinculados.";
            if (!confirm(mensaje)) {
                e.preventDefault();
                jQuery('#preloader').hide(); // Ocultamos el cargador si el usuario cancela
                return false;
            }
        });
    });
    </script>
    <?php
}

add_action( 'admin_menu', function() {
    // 1. Obtener el usuario actual
    $user = wp_get_current_user();
    
    // 2. Definir los roles a restringir
    $roles_ocultar = array( 'cobranza', 'admin_aux', 'super_admin' );
    
    // 3. Si coincide el rol, removemos el menú usando el slug nativo del contenedor
    if ( array_intersect( $roles_ocultar, (array) $user->roles ) ) {
        
        // Al remover 'options-general.php', WordPress eliminará todo el bloque del ID "menu-settings"
        remove_menu_page( 'options-general.php' );
        
    }
}, 9999 );

/**
 * 🛠️ GESTIÓN DE COMISIONES PARA ADMIN_AUX (VENTANA EMERGENTE EN REPORTE DIARIO)
 */
// 1. Manejar el guardado del porcentaje vía AJAX para evitar pantallas en blanco y bloqueos
add_action('wp_ajax_update_comision_reporte_ajax', function() {
    if ( !check_ajax_referer('nonce_comision_reporte', '_wpnonce', false) ) {
        wp_send_json_error('Error de seguridad');
    }
    $nuevo_valor = floatval($_POST['comision_valor']);
    update_option('comision_cobrador_porcentaje', $nuevo_valor);
    wp_send_json_success();
});

// 2. Inyectar botón y ventana emergente (modal) en el listado de Reporte Diario
add_action('admin_footer', function() {
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'reporte_diario') return;

    $valor_actual = get_option('comision_cobrador_porcentaje', 3);
    $nonce_field = wp_nonce_field('nonce_comision_reporte', '_wpnonce', true, false);

    if (isset($_GET['comision_updated'])) {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Porcentaje de comisión actualizado correctamente al ' . esc_html($valor_actual) . '%</p></div>';
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Inyectar botón junto al título (estilo similar al botón de historial)
        $('.wp-heading-inline').after('<button id="btn-open-comision" class="page-title-action" style="display: inline-block !important; background:#f0f6fb; border: 2px solid #007cba; color:#016087; font-weight:bold; margin-left:15px; vertical-align:middle;">⚙️ Porcentaje Comisión</button>');

        // HTML de la Ventana Emergente
        var modalHtml = `
        <div id="modal-comision-box" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:999999; display:flex; align-items:center; justify-content:center;">
            <div style="background:#fff; padding:30px; border-radius:12px; width:300px; box-shadow:0 15px 35px rgba(0,0,0,0.5); text-align:center;">
                <h3 style="margin:0 0 15px 0;">Ajustar Comisión (%)</h3>
                <p style="font-size:12px; color:#666; margin-bottom:20px;">Este valor afecta el Reporte Diario y Liquidaciones.</p>
                <form method="post" action="">
                    <input type="hidden" name="update_comision_reporte" value="1">
                    <?php echo str_replace('"', '\"', $nonce_field); ?>
                    <div style="display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:25px;">
                        <input type="number" name="comision_valor" step="0.1" value="<?php echo $valor_actual; ?>" style="width:100px; font-size:24px; font-weight:bold; text-align:center; padding:10px; border:2px solid #ddd; border-radius:6px;">
                        <span style="font-size:26px; font-weight:bold;">%</span>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <button type="button" id="btn-close-comision" class="button button-large">Cancelar</button>
                        <button type="submit" class="button button-primary button-large" style="font-weight:bold;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>`;

        $('body').append(modalHtml).find('#modal-comision-box').hide();

        $('#btn-open-comision').on('click', function(e) {
            e.preventDefault();
            $('#modal-comision-box').fadeIn(150).css('display', 'flex');
        });

        $('#btn-close-comision, #modal-comision-box').on('click', function(e) {
            if (e.target === this) $('#modal-comision-box').fadeOut(150);
        });

        // ⏳ Guardado vía AJAX: Evita la pantalla en blanco y automatiza la recarga
        $('#modal-comision-box form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var valor = $form.find('input[name="comision_valor"]').val();
            var nonce = $form.find('input[name="_wpnonce"]').val();

            $btn.prop('disabled', true).text('Guardando...');
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'update_comision_reporte_ajax',
                    comision_valor: valor,
                    _wpnonce: nonce
                },
                success: function() {
                    // Redirección automática: Simula que el usuario da "Enter" a la URL
                    window.location.href = 'edit.php?post_type=reporte_diario&comision_updated=1';
                },
                error: function() {
                    alert('Error al guardar. Por favor intente de nuevo.');
                    $btn.prop('disabled', false).text('Guardar');
                }
            });
        });
    });
    </script>
    <?php
}, 100);


function ocultar_y_bloquear_elementos_cocun_app() {
    // Detectamos si el User Agent contiene la marca de nuestra aplicación de Android
    if ( isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'cocunapp') !== false ) {
        ?>
        <style type="text/css">
            /* 1. Oculta la lupa por completo */
            #wp-admin-bar-command-palette, 
            .wp-admin-bar-command-palette,
            #wp-admin-bar-root-default .hide-if-no-js {
                display: none !important;
            }

            /* 2. Bloquea el menú sándwich (evita clics y toques) */
            #wp-admin-bar-menu-toggle,
            .wp-admin-bar-menu-toggle,
            #wp-admin-bar-menu-toggle .ab-item {
                pointer-events: none !important;
                cursor: default !important;
                opacity: 0.8; /* Opcional: le baja un poco el brillo para notar que está inactivo */
            }

            /* 3. Bloquea el recuadro de perfil/saludo derecho (evita abrir el menú desplegable del usuario) */
            #wp-admin-bar-my-account,
            .wp-admin-bar-my-account,
            #wp-admin-bar-my-account .ab-item {
                pointer-events: none !important;
                cursor: default !important;
            }
        </style>
        <?php
    }
}
// Enganchamos la función para el panel de administración y el front-end de WordPress
add_action('wp_head', 'ocultar_y_bloquear_elementos_cocun_app', 100);
add_action('admin_head', 'ocultar_y_bloquear_elementos_cocun_app', 100);





/**
 * Recalcula UN dia especifico de reporte_diario para un usuario.
 * Se usa para reparar fechas con datos incompletos/en cero
 * tomando informacion real de miscuentas, cliente, gasto e inyeccion.
 */
function cocum_normalizar_fecha_ymd($valor_fecha) {
    $valor_fecha = trim((string) $valor_fecha);
    if ($valor_fecha === '') {
        return '';
    }

    $formatos = array('Y-m-d', 'd/m/Y', 'd-m-Y', 'Ymd');
    foreach ($formatos as $fmt) {
        $obj = DateTime::createFromFormat($fmt, $valor_fecha);
        if ($obj instanceof DateTime) {
            return $obj->format('Y-m-d');
        }
    }

    if (preg_match('/^\s*(\d{1,2})\s*(?:de\s+)?([a-záéíóúñ]+)\s*(?:de\s+)?(\d{4})\s*$/iu', $valor_fecha, $m_es)) {
        $dia = intval($m_es[1]);
        $mes_txt = strtolower(remove_accents($m_es[2]));
        $anio = intval($m_es[3]);
        $meses_es = array(
            'enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4,
            'mayo' => 5, 'junio' => 6, 'julio' => 7, 'agosto' => 8,
            'septiembre' => 9, 'setiembre' => 9, 'octubre' => 10,
            'noviembre' => 11, 'diciembre' => 12,
        );
        if (isset($meses_es[$mes_txt])) {
            $mes = intval($meses_es[$mes_txt]);
            if (checkdate($mes, $dia, $anio)) {
                return sprintf('%04d-%02d-%02d', $anio, $mes, $dia);
            }
        }
    }

    $ts = strtotime(str_replace('/', '-', $valor_fecha));
    if ($ts === false) {
        return '';
    }

    return date('Y-m-d', $ts);
}

/**
 * Calcula solo los pagos por fecha de una cuenta de miscuentas.
 * Se usa para reutilizar la misma logica de rango sin mezclar abonos.
 */
function cocum_calcular_pagos_miscuentas_por_rango($idPost_cuentas, $fecha_inicio_ymd, $fecha_fin_ymd) {
    $idPost_cuentas = intval($idPost_cuentas);
    $fecha_inicio_ymd = cocum_normalizar_fecha_ymd($fecha_inicio_ymd);
    $fecha_fin_ymd = cocum_normalizar_fecha_ymd($fecha_fin_ymd);

    $resultado = array(
        'total_pagos' => 0.0,
        'ultimo_pago_diario' => 0.0,
        'detalles_pagos' => array(),
    );

    if ($idPost_cuentas <= 0 || $fecha_inicio_ymd === '' || $fecha_fin_ymd === '') {
        return $resultado;
    }

    $idCuenta = intval(get_field('id_cliente_cuenta', $idPost_cuentas));
    $cuotas_autorizadas = $idCuenta > 0 ? intval(get_field('cuotas_cliente', $idCuenta)) : 0;
    if ($cuotas_autorizadas <= 0) {
        return $resultado;
    }

    if (!have_rows('pagos_abono', $idPost_cuentas)) {
        return $resultado;
    }

    while (have_rows('pagos_abono', $idPost_cuentas)) {
        the_row();
        for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
            $montoPago = get_sub_field('pago_#' . $i);
            if ($montoPago === null || $montoPago === false || $montoPago === '') {
                $montoPago = get_sub_field('pago#' . $i);
            }

            $fechaPago = get_sub_field('fecha_del_pago#' . $i);
            if ($fechaPago === null || $fechaPago === false || $fechaPago === '') {
                $fechaPago = get_sub_field('fecha_del_pago_#' . $i);
            }

            if (floatval($montoPago) <= 0 || empty($fechaPago)) {
                continue;
            }

            $fechaPago_ymd = cocum_normalizar_fecha_ymd($fechaPago);
            if ($fechaPago_ymd >= $fecha_inicio_ymd && $fechaPago_ymd <= $fecha_fin_ymd) {
                $montoPago = floatval($montoPago);
                $resultado['total_pagos'] += $montoPago;
                $resultado['ultimo_pago_diario'] = $montoPago;
                $resultado['detalles_pagos'][] = array(
                    'monto' => $montoPago,
                    'fecha' => $fechaPago_ymd,
                );
            }
        }
    }

    return $resultado;
}

/**
 * Calcula los pagos de una cuenta de miscuentas dentro de un rango de fechas.
 * Devuelve solo el resultado del cálculo para poder reutilizarlo despues en otras pantallas.
 */
function cocum_calcular_pagos_miscuentas_en_rango($idPost_cuentas, $fecha_inicio_ymd, $fecha_fin_ymd) {
    $idPost_cuentas = intval($idPost_cuentas);
    $fecha_inicio_ymd = cocum_normalizar_fecha_ymd($fecha_inicio_ymd);
    $fecha_fin_ymd = cocum_normalizar_fecha_ymd($fecha_fin_ymd);

    $resultado = array(
        'total_pagos' => 0.0,
        'total_abonos' => 0.0,
        'total_cubierto' => 0.0,
        'ultimo_pago_diario' => 0.0,
        'detalles_pagos' => array(),
        'id_cliente' => 0,
        'titulo_abono' => '',
        'detalles_abonos' => array(),
    );

    if ($idPost_cuentas <= 0 || $fecha_inicio_ymd === '' || $fecha_fin_ymd === '') {
        return $resultado;
    }

    $idCuenta = get_field('id_cliente_cuenta', $idPost_cuentas);
    $cuotas_autorizadas = intval(get_field('cuotas_cliente', $idCuenta));
    if ($cuotas_autorizadas <= 0) {
        return $resultado;
    }

    $abonos_query = new WP_Query(array(
        'post_type' => 'abono',
        'author' => get_current_user_id(),
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'id_cliente',
                'value' => $idPost_cuentas,
                'compare' => '=',
            ),
            array(
                'key' => 'cubrePagos',
                'value' => 0,
                'compare' => '=',
            ),
        ),
        'date_query' => array(
            array(
                'after' => $fecha_inicio_ymd,
                'before' => $fecha_fin_ymd,
                'inclusive' => true,
            ),
        ),
    ));

    if ($abonos_query->have_posts()) {
        while ($abonos_query->have_posts()) {
            $abonos_query->the_post();
            $monto_abono = floatval(get_field('abono'));
            $pago_cubierto = floatval(get_field('cubrePagos'));
            if ($monto_abono > 0) {
                $resultado['total_abonos'] += $monto_abono;
                $resultado['total_cubierto'] += $pago_cubierto;
                $resultado['id_cliente'] = intval(get_field('id_cliente'));
                $resultado['titulo_abono'] = trim(get_the_title());
                if (empty($resultado['detalles_abonos'])) {
                    $resultado['detalles_abonos'] = array(
                        'monto' => $monto_abono,
                        'fecha' => get_the_date('Y-m-d'),
                    );
                }
            }
        }
        wp_reset_postdata();
    }

    if (have_rows('pagos_abono', $idPost_cuentas)) {
        while (have_rows('pagos_abono', $idPost_cuentas)) {
            the_row();
            for ($i = 1; $i <= $cuotas_autorizadas; $i++) {
                $montoPago = get_sub_field('pago_#' . $i);
                if ($montoPago === null || $montoPago === false || $montoPago === '') {
                    $montoPago = get_sub_field('pago#' . $i);
                }

                $fechaPago = get_sub_field('fecha_del_pago#' . $i);
                if ($fechaPago === null || $fechaPago === false || $fechaPago === '') {
                    $fechaPago = get_sub_field('fecha_del_pago_#' . $i);
                }

                if (floatval($montoPago) <= 0 || empty($fechaPago)) {
                    continue;
                }

                $fechaPago_ymd = cocum_normalizar_fecha_ymd($fechaPago);
                if ($fechaPago_ymd >= $fecha_inicio_ymd && $fechaPago_ymd <= $fecha_fin_ymd) {
                    $resultado['total_pagos'] += floatval($montoPago);
                    $resultado['ultimo_pago_diario'] = floatval($montoPago);
                    $resultado['detalles_pagos'][] = array(
                        'monto' => floatval($montoPago),
                        'fecha' => $fechaPago_ymd,
                    );
                }
            }
        }
    }

    return $resultado;
}

function cocum_recalcular_reporte_diario_fecha($user_id, $fecha_ymd) {
    $user_id = intval($user_id);
    if ($user_id <= 0) {
        return false;
    }

    $fecha_ymd = trim((string) $fecha_ymd);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_ymd)) {
        return false;
    }

    
    $rd_ids = get_posts(array(
    'post_type'      => 'reporte_diario',
    'author'         => $user_id,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'fields'         => 'ids',
    'date_query'     => array(
        array(
            'year'  => intval(date('Y', strtotime($fecha_ymd))),
            'month' => intval(date('m', strtotime($fecha_ymd))),
            'day'   => intval(date('d', strtotime($fecha_ymd))),
        ),
    ),
));

$prev_ids = get_posts(array(
    'post_type'      => 'reporte_diario',
    'author'         => $user_id,
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'fields'         => 'ids',
    'date_query'     => array(
        array(
            'before'    => $fecha_ymd,
            'inclusive' => false,
        ),
    ),
));

$caja_anterior = 0.0;
if (!empty($prev_ids)) {
    $caja_anterior = floatval(get_field('caja_actual', intval($prev_ids[0])));
}

if (empty($rd_ids)) {
    $nuevo_id = cocum_insertar_reporte_diario_placeholder($user_id, $fecha_ymd, $caja_anterior);
    if (!$nuevo_id) {
        return false;
    }
    $rd_id = intval($nuevo_id);
} else {
    $rd_id = intval($rd_ids[0]);
}



  $clientes_ids = get_posts(array(
    'post_type'      => 'cliente',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
));

$miscuentas_ids = get_posts(array(
    'post_type'      => 'miscuentas',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
));

$mc_index = array();
foreach ($miscuentas_ids as $mc_id) {
    $id_cli = intval(get_field('id_cliente_cuenta', $mc_id));
    if ($id_cli > 0) {
        $mc_index[$id_cli] = intval($mc_id);
    }
}

$cobrar_dia_actual = 0.0;
$clientes_por_cobrar = 0;
$total_prestado = 0.0;

foreach ($clientes_ids as $cli_id) {
    $cli_id = intval($cli_id);
    $fecha_cli_ymd = get_the_date('Y-m-d', $cli_id);
    if (!$fecha_cli_ymd || $fecha_cli_ymd > $fecha_ymd) {
        continue;
    }

    if ($fecha_cli_ymd === $fecha_ymd) {
        $total_prestado += floatval(get_field('monto_cliente', $cli_id));
    }

    if (!isset($mc_index[$cli_id])) {
        continue;
    }

    $mc_id = $mc_index[$cli_id];
    $estatus_cuenta = (string) get_field('cuenta', $mc_id);
    $estatus_pago = (string) get_field('estatus_pago', $mc_id);

    if ($estatus_cuenta === 'activa' && $fecha_cli_ymd !== $fecha_ymd) {
        $cobrar_dia_actual += floatval(get_field('valor_cuota_cliente', $cli_id));
        if (trim($estatus_pago) === '') {
            $clientes_por_cobrar++;
        }
    }
}



$total_cobrado = 0.0;

foreach ($miscuentas_ids as $mc_id) {
    $mc_id = intval($mc_id);
    $resumen_pago = cocum_calcular_pagos_miscuentas_por_rango($mc_id, $fecha_ymd, $fecha_ymd);
    $total_cobrado += floatval($resumen_pago['total_pagos']);
}

$gasto = 0.0;
$gastos_ids = get_posts(array(
    'post_type'      => 'gasto',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
    'date_query'     => array(
        array(
            'year'  => intval(date('Y', strtotime($fecha_ymd))),
            'month' => intval(date('m', strtotime($fecha_ymd))),
            'day'   => intval(date('d', strtotime($fecha_ymd))),
        ),
    ),
));
foreach ($gastos_ids as $gasto_id) {
    if ((string) get_field('aceptar', $gasto_id) === 'si') {
        $gasto += floatval(get_field('cantidad', $gasto_id));
    }
}

$inyeccion = 0.0;
$inyecciones_ids = get_posts(array(
    'post_type'      => 'inyeccion',
    'author'         => $user_id,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'fields'         => 'ids',
    'date_query'     => array(
        array(
            'year'  => intval(date('Y', strtotime($fecha_ymd))),
            'month' => intval(date('m', strtotime($fecha_ymd))),
            'day'   => intval(date('d', strtotime($fecha_ymd))),
        ),
    ),
));
foreach ($inyecciones_ids as $iny_id) {
    $inyeccion += floatval(get_field('valor', $iny_id));
}

$porcentaje_ajuste = floatval(get_option('comision_cobrador_porcentaje', 3)) / 100;
$comision = $total_cobrado * $porcentaje_ajuste;
$caja_actual = (($caja_anterior + $total_cobrado) - $total_prestado - $gasto) + $inyeccion;

update_field('total_cobrado', $total_cobrado, $rd_id);
update_field('cobrar_dia_actual', $cobrar_dia_actual, $rd_id);
update_field('total_prestado', $total_prestado, $rd_id);
update_field('clientes_con_pagos', $clientes_por_cobrar, $rd_id);
update_field('gasto', $gasto, $rd_id);
update_field('comision', $comision, $rd_id);
update_field('caja_anterior', $caja_anterior, $rd_id);
update_field('caja_actual', $caja_actual, $rd_id);

return true;



}



/**
 * Determina si un post de reporte_diario luce incompleto (hueco).
 */
function cocum_es_hueco_reporte_diario_post($rd_id) {
    $rd_id = intval($rd_id);
    if ($rd_id <= 0) {
        return true;
    }

    $cobrar = floatval(get_field('cobrar_dia_actual', $rd_id));
    $clientes = intval(get_field('clientes_con_pagos', $rd_id));
    $total_cobrado = floatval(get_field('total_cobrado', $rd_id));
    $total_prestado = floatval(get_field('total_prestado', $rd_id));
    $gasto = floatval(get_field('gasto', $rd_id));

    $es_hueco = ($cobrar <= 0.0 && $clientes <= 0);
    if (!$es_hueco) {
        $es_hueco = ($total_cobrado <= 0.0 && $total_prestado <= 0.0 && $gasto <= 0.0 && $cobrar <= 0.0);
    }
    if (!$es_hueco) {
        $es_hueco = ($cobrar > 0.0 && $total_cobrado <= 0.0);
    }

    return $es_hueco;
}

/**
 * Cuenta huecos de reporte_diario entre dos fechas (incluyendo días sin fila).
 */
function cocum_contar_huecos_reporte_diario($user_id, $fecha_inicio_ymd, $fecha_fin_ymd = null) {
    $user_id = intval($user_id);
    if ($user_id <= 0) {
        return 0;
    }

    $fecha_inicio_ymd = cocum_normalizar_fecha_ymd($fecha_inicio_ymd);
    $fecha_fin_ymd = cocum_normalizar_fecha_ymd(!empty($fecha_fin_ymd) ? $fecha_fin_ymd : wp_date('Y-m-d'));
    if ($fecha_inicio_ymd === '' || $fecha_fin_ymd === '') {
        return 0;
    }

    if ($fecha_inicio_ymd > $fecha_fin_ymd) {
        $tmp = $fecha_inicio_ymd;
        $fecha_inicio_ymd = $fecha_fin_ymd;
        $fecha_fin_ymd = $tmp;
    }

    $reportes = get_posts(array(
        'post_type'      => 'reporte_diario',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'date_query'     => array(
            array(
                'after'     => $fecha_inicio_ymd,
                'before'    => $fecha_fin_ymd,
                'inclusive' => true,
            ),
        ),
    ));

    $dias_validos = array();
    foreach ($reportes as $rd_id) {
        $rd_id = intval($rd_id);
        $fecha_rd = get_the_date('Y-m-d', $rd_id);
        if (!$fecha_rd) {
            continue;
        }
        if (!isset($dias_validos[$fecha_rd])) {
            $dias_validos[$fecha_rd] = false;
        }
        if (!cocum_es_hueco_reporte_diario_post($rd_id)) {
            $dias_validos[$fecha_rd] = true;
        }
    }

    $huecos = 0;
    $cursor = new DateTime($fecha_inicio_ymd);
    $fin = new DateTime($fecha_fin_ymd);
    while ($cursor <= $fin) {
        $ymd = $cursor->format('Y-m-d');
        if (!isset($dias_validos[$ymd]) || !$dias_validos[$ymd]) {
            $huecos++;
        }
        $cursor->modify('+1 day');
    }

    return $huecos;
}

/**
 * Busca fechas pendientes (huecos) y las recalcula por lote.
 * Se usa al abrir Reporte Diario, Nueva Liquidada y antes del corte,
 * con limite por ejecucion para no afectar rendimiento.
 */
function cocum_recalcular_huecos_reporte_diario($user_id, $fecha_inicio_ymd = null, $fecha_fin_ymd = null, $limite = 10) {
    $user_id = intval($user_id);
    $limite = max(1, intval($limite));
    if ($user_id <= 0) {
        return 0;
    }

    $hoy_ymd = wp_date('Y-m-d');
    $fecha_fin_ymd = !empty($fecha_fin_ymd) ? $fecha_fin_ymd : $hoy_ymd;

    $date_query = array(
        array(
            'before'    => $fecha_fin_ymd,
            'inclusive' => true,
        ),
    );

    if (!empty($fecha_inicio_ymd)) {
        $date_query[] = array(
            'after'     => $fecha_inicio_ymd,
            'inclusive' => true,
        );
    }

    $reportes = get_posts(array(
        'post_type'      => 'reporte_diario',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'date_query'     => $date_query,
    ));

    if (empty($reportes)) {
        return 0;
    }

    $procesados = 0;
    foreach ($reportes as $rd_id) {
        if ($procesados >= $limite) {
            break;
        }

        $rd_id = intval($rd_id);
        $cobrar = floatval(get_field('cobrar_dia_actual', $rd_id));
        $clientes = intval(get_field('clientes_con_pagos', $rd_id));
        $total_cobrado = floatval(get_field('total_cobrado', $rd_id));
        $total_prestado = floatval(get_field('total_prestado', $rd_id));
        $gasto = floatval(get_field('gasto', $rd_id));

        $es_hueco = ($cobrar <= 0.0 && $clientes <= 0);
        if (!$es_hueco) {
            $es_hueco = ($total_cobrado <= 0.0 && $total_prestado <= 0.0 && $gasto <= 0.0 && $cobrar <= 0.0);
        }
        if (!$es_hueco) {
            $es_hueco = ($cobrar > 0.0 && $total_cobrado <= 0.0);
        }
        if (!$es_hueco) {
            continue;
        }

        $fecha_rd = get_the_date('Y-m-d', $rd_id);
        if (!$fecha_rd) {
            continue;
        }

        if (cocum_recalcular_reporte_diario_fecha($user_id, $fecha_rd)) {
            $procesados++;
        }
    }

    return $procesados;
}

/**
 * Paso 4: Recalcular todos los acumulados de Nueva Liquidada desde la fuente (cuando no hay huecos)
 * Se invoca DESPUÉS de que cocum_recalcular_huecos_reporte_diario() termina (huecos_restantes_nl === 0)
 */
function cocum_recalcular_nueva_liquidada_acumulados($id_nl, $user_id, $fecha_inicio_nl_ymd, $id_misc_cuentas, $caja_nl_anterior = 0) {
    if (intval($id_nl) <= 0 || intval($user_id) <= 0 || intval($id_misc_cuentas) <= 0) {
        return false;
    }

    $fecha_inicio_nl_ymd = cocum_normalizar_fecha_ymd($fecha_inicio_nl_ymd);
    $fecha_fin_nl_ymd = wp_date('Y-m-d');

    if ($fecha_inicio_nl_ymd === '' || $fecha_fin_nl_ymd === '') {
        return false;
    }

    // --- 1. TOTAL COBRADO: suma de pagos_abono desde fecha_inicio_nl hasta hoy ---
    $total_cobrado_nl_nuevo = cocum_calcular_pagos_miscuentas_por_rango($id_misc_cuentas, $fecha_inicio_nl_ymd, $fecha_fin_nl_ymd);

    // --- 2. TOTAL PRESTADO: suma del campo 'prestado' de reporte_diario en el rango ---
    $total_prestado_nl_nuevo = 0;
    $reportes_rango = get_posts(array(
        'post_type'      => 'reporte_diario',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'date_query'     => array(
            array(
                'after'     => $fecha_inicio_nl_ymd,
                'before'    => $fecha_fin_nl_ymd,
                'inclusive' => true,
            ),
        ),
    ));

    foreach ($reportes_rango as $rd_id) {
        $prestado_rd = floatval(get_field('total_prestado', $rd_id));
        $total_prestado_nl_nuevo += $prestado_rd;
    }

    // --- 3. TOTAL GASTO: suma de posts tipo 'gasto' en el rango ---
    $total_gasto_nl_nuevo = 0;
    $gastos_rango = get_posts(array(
        'post_type'      => 'gasto',
        'author'         => $user_id,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'date_query'     => array(
            array(
                'after'     => $fecha_inicio_nl_ymd,
                'before'    => $fecha_fin_nl_ymd,
                'inclusive' => true,
            ),
        ),
    ));

    foreach ($gastos_rango as $gasto_id) {
        $monto_gasto = floatval(get_field('monto_gasto', $gasto_id));
        $total_gasto_nl_nuevo += $monto_gasto;
    }

    // --- 4. COMISIÓN: % de total_cobrado_nl ---
    $porcentaje_comision = floatval(get_option('comision_cobrador_porcentaje', 3)) / 100;
    $comision_nl_nuevo = $total_cobrado_nl_nuevo * $porcentaje_comision;

    // --- 5. CAJA ACTUAL NL: fórmula acumulada ---
    // caja_actual_nl = caja_anterior + total_cobrado - total_prestado - total_gasto - comisión
    $caja_actual_nl_nuevo = $caja_nl_anterior + $total_cobrado_nl_nuevo - $total_prestado_nl_nuevo - $total_gasto_nl_nuevo - $comision_nl_nuevo;

    // --- Guardar todos los campos recalculados ---
    update_field('total_cobrado_nl', $total_cobrado_nl_nuevo, $id_nl);
    update_field('total_prestado_nl', $total_prestado_nl_nuevo, $id_nl);
    update_field('gasto_nl', $total_gasto_nl_nuevo, $id_nl);
    update_field('comision_nl', $comision_nl_nuevo, $id_nl);
    update_field('caja_actual_nl', $caja_actual_nl_nuevo, $id_nl);

    return true;
}

/**
 * Hook que procesa Paso 4 después de que la página se carga
 */
add_action('wp_footer', function() {
    if (!is_admin()) return;
    
    $user_id = get_current_user_id();
    $paso4_key = 'cocum_paso4_pendiente_' . $user_id;
    $paso4_data = get_option($paso4_key);
    
    if (!empty($paso4_data) && is_array($paso4_data)) {
        $id_nl = intval($paso4_data['id_nl']);
        $id_author = intval($paso4_data['id_author']);
        $fecha_inicio = sanitize_text_field($paso4_data['fecha_inicio']);
        $caja_anterior = floatval($paso4_data['caja_anterior']);
        
        $cuentas_query = get_posts(array(
            'post_type'      => 'miscuentas',
            'author'         => $id_author,
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'fields'         => 'ids',
        ));
        
        $id_misc_cuentas = !empty($cuentas_query) ? intval($cuentas_query[0]) : 0;
        
        if ($id_nl > 0 && $id_author > 0 && $id_misc_cuentas > 0) {
            cocum_recalcular_nueva_liquidada_acumulados(
                $id_nl,
                $id_author,
                $fecha_inicio,
                $id_misc_cuentas,
                $caja_anterior
            );
        }
        
        delete_option($paso4_key);
    }
}, 999);


add_action('load-edit.php', function() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'reporte_diario') {
        $user_id_actual = get_current_user_id();
        $fechas_forzadas = array();
        $patrones_fecha = array(
            '/\b\d{4}-\d{2}-\d{2}\b/',
            '/\b\d{2}\/\d{2}\/\d{4}\b/',
            '/\b\d{8}\b/',
            '/\b\d{1,2}\s+(?:de\s+)?[a-záéíóúñ]+\s+(?:de\s+)?\d{4}\b/ui',
        );

        $fuentes_request = array($_GET, $_POST);
        foreach ($fuentes_request as $fuente) {
            if (empty($fuente) || !is_array($fuente)) {
                continue;
            }

            $iter = new RecursiveIteratorIterator(new RecursiveArrayIterator($fuente));
            foreach ($iter as $valor_request) {
                if (!is_scalar($valor_request)) {
                    continue;
                }

                $valor_texto = sanitize_text_field(wp_unslash((string) $valor_request));
                if ($valor_texto === '') {
                    continue;
                }

                foreach ($patrones_fecha as $patron_fecha) {
                    if (!preg_match_all($patron_fecha, $valor_texto, $matches) || empty($matches[0])) {
                        continue;
                    }
                    foreach ($matches[0] as $fecha_cruda) {
                        $fecha_norm = cocum_normalizar_fecha_ymd($fecha_cruda);
                        if ($fecha_norm !== '') {
                            $fechas_forzadas[$fecha_norm] = true;
                        }
                    }
                }
            }
        }

        $fechas_objetivo = array_keys($fechas_forzadas);
        sort($fechas_objetivo);
        if (count($fechas_objetivo) === 1) {
            cocum_recalcular_reporte_diario_fecha($user_id_actual, $fechas_objetivo[0]);
        } elseif (count($fechas_objetivo) >= 2) {
            $inicio = $fechas_objetivo[0];
            $fin = end($fechas_objetivo);
            $dias_rango = intval((strtotime($fin) - strtotime($inicio)) / DAY_IN_SECONDS);
            if ($dias_rango >= 0 && $dias_rango <= 31) {
                for ($d = 0; $d <= $dias_rango; $d++) {
                    $fecha_loop = date('Y-m-d', strtotime($inicio . ' +' . $d . ' days'));
                    cocum_recalcular_reporte_diario_fecha($user_id_actual, $fecha_loop);
                }
            } else {
                cocum_recalcular_reporte_diario_fecha($user_id_actual, $inicio);
                cocum_recalcular_reporte_diario_fecha($user_id_actual, $fin);
            }
        }

        cocum_backfill_reporte_diario_usuario(get_current_user_id());

        // NUEVA LINEA:
        cocum_recalcular_huecos_reporte_diario($user_id_actual, null, null, 5);

        reporte_diario();
    }
});

// ========================================
// 🔹 Archivo modificado por: Emmanuel Chimal
// ========================================
