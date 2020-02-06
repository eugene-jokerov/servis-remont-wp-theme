<?php

add_theme_support( 'post-thumbnails' );

/**
* Функция загружает часть шаблона, передавая в него переменные
* 
* @param string $_template_name имя файла шаблона
* @param array $_varibles ассоциативный массив, ключи которого станут переменными в подключаемом шаблоне
* @return void
*/
if( ! function_exists( 'jwp_get_template_part' ) ) {
	function jwp_get_template_part( $_template_name, array $_varibles = array() ) {
		if( ! $_template_name ) {
			return false;
		}
		$_template_file = TEMPLATEPATH . '/' . $_template_name . '.php';
		if( file_exists( $_template_file ) ) {
			if( $_varibles ){
				extract( $_varibles, EXTR_SKIP );
			}
			require( $_template_file );
		}
	}
}

function jwp_get_assets_url() {
	return get_template_directory_uri() . '/assets/';
}

add_action( 'wp_enqueue_scripts', function() {
	$assets_url = jwp_get_assets_url();
	wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900,900i&display=swap&subset=cyrillic' );
	wp_enqueue_style( 'fa5', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' );
	wp_enqueue_style( 'bootstrap', $assets_url . 'css/bootstrap.min.css' );
	wp_enqueue_style( 'slick', $assets_url . 'css/slick.css' );
	wp_enqueue_style( 'jquery.jscrollpane', $assets_url . 'css/jquery.jscrollpane.css' );
	wp_register_style( 'jquery-ui-styles','https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui-styles' );
	wp_enqueue_style( 'main-style', $assets_url . 'css/style.css' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'popper', $assets_url . 'js/popper.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'retina', $assets_url . 'js/retina.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'bootstrap', $assets_url . 'js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'slick', $assets_url . 'js/slick.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jquery.jscrollpane', $assets_url . 'js/jquery.jscrollpane.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'main-js', $assets_url . 'js/script.js', array( 'jquery' ), '', true );
} );

add_action( 'init', function() {
	$labels = array(
		'name'                  => _x( 'Организации', 'Post Type General Name', 'test_textdomain' ),
		'singular_name'         => _x( 'Организация', 'Post Type Singular Name', 'test_textdomain' ),
		'menu_name'             => __( 'Организации', 'test_textdomain' ),
		'name_admin_bar'        => __( 'Организации', 'test_textdomain' ),
		'all_items'             => __( 'Все организации', 'test_textdomain' ),
		'add_new_item'          => __( 'Добавить организацию', 'test_textdomain' ),
		'add_new'               => __( 'Добавить новую', 'test_textdomain' ),
		'new_item'              => __( 'Новая организация', 'test_textdomain' ),
		'edit_item'             => __( 'Редактировать', 'test_textdomain' ),
		'update_item'           => __( 'Обновить', 'test_textdomain' ),
		'view_item'             => __( 'Смотреть', 'test_textdomain' ),
		'view_items'            => __( 'Смотреть', 'test_textdomain' ),
		'search_items'          => __( 'Найти организацию', 'test_textdomain' ),
		'not_found'             => __( 'Организаций не найдено', 'test_textdomain' ),
		'not_found_in_trash'    => __( 'В корзине организаций не найдено', 'test_textdomain' ),
		'featured_image'        => __( 'Логотип', 'test_textdomain' ),
		'set_featured_image'    => __( 'Выбрать логотип', 'test_textdomain' ),
		'remove_featured_image' => __( 'Удадить логотип', 'test_textdomain' ),
		'use_featured_image'    => __( 'Использовать логотип', 'test_textdomain' ),
	);
	$args = array(
		'label'                 => __( 'Организаця', 'test_textdomain' ),
		'description'           => __( 'Организации', 'test_textdomain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'organization', $args );
} );

add_action( 'wp_ajax_jwp_street_autocomplete', 'jwp_street_autocomplete_handler' );
add_action( 'wp_ajax_nopriv_jwp_street_autocomplete', 'jwp_street_autocomplete_handler' );

// Автокомплит по полю улица или метро.
function jwp_street_autocomplete_handler() {
	global $wpdb;
	$term = isset( $_GET['term'] ) ? $wpdb->esc_like( $_GET['term'] ) : '';
	$type = isset( $_GET['type'] ) ? $_GET['type'] : '';
	
	$meta_key = 'улица';
	if ( 'street' != $type ) {
		$meta_key = 'метро';
	}
	$sql = "SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value LIKE %s";
	$prepared_sql = $wpdb->prepare( $sql, $meta_key, '%' . $term . '%' );
	$streets = $wpdb->get_col( $prepared_sql );
	$autocomplete = array();
	if ( $streets ) {
		$streets = array_unique( $streets );
		foreach ( $streets as $street ) {
			$autocomplete[] = array( 
				'label' => $street, 
				'value' => $street 
			);
		}
	}
	wp_send_json( $autocomplete );
}

add_action( 'wp_ajax_jwp_organizations_filter', 'jwp_organizations_filter_handler' );
add_action( 'wp_ajax_nopriv_jwp_organizations_filter', 'jwp_organizations_filter_handler' );

function jwp_organizations_filter_handler() {
	$street = isset( $_POST['street'] ) ? $_POST['street'] : '';
	$metro  = isset( $_POST['metro'] ) ? $_POST['metro'] : '';
	$remont = isset( $_POST['remont'] ) ? $_POST['remont'] : array();
	$viezd  = isset( $_POST['viezd'] ) ? $_POST['viezd'] : array();
	$oplata = isset( $_POST['oplata'] ) ? $_POST['oplata'] : array();
	
	$params = array(
		'post_type'      => 'organization',
		'posts_per_page' => 4,
	);
	$meta_query = array();
	
	if ( $street ) {
		$meta_query[] = array(
			'key'   => 'улица',
			'value' => esc_sql( $street )
		);
	}
	if ( $metro ) {
		$meta_query[] = array(
			'key'   => 'метро',
			'value' => esc_sql( $metro )
		);
	}
	
	if ( $remont ) {
		foreach ( $remont as $element ) {
			$meta_query[] = array(
				'key'     => 'вид_ремонта',
				'compare' => 'LIKE',
				'value'   => '"' . esc_sql( $element ) . '"'
			);
		}
	}
	if ( $viezd ) {
		foreach ( $viezd as $element ) {
			$meta_query[] = array(
				'key'     => 'вид_выезда',
				'compare' => 'LIKE',
				'value'   => '"' . esc_sql( $element ) . '"'
			);
		}
	}
	if ( $oplata ) {
		foreach ( $oplata as $element ) {
			$meta_query[] = array(
				'key'     => 'варианты_оплаты',
				'compare' => 'LIKE',
				'value'   => '"' . esc_sql( $element ) . '"'
			);
		}
	}
	if ( $meta_query ) {
		$params['meta_query'] = $meta_query;
	}
	$organizations = new WP_Query( $params );
	
	$content = '';
	if ( $organizations->posts ) {
		ob_start();
		foreach ( $organizations->posts as $organization ) {
			jwp_get_template_part( 'parts/organization', array( 'post' => $organization ) );
		}
		$content = ob_get_clean();
	}
	
	wp_send_json( array( 
		'content' => $content,
	) );
}
