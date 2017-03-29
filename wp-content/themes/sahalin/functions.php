<?php
/**
 * sahalin functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sahalin
 */

if ( ! function_exists( 'sahalin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sahalin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sahalin, use a find and replace
	 * to change 'sahalin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sahalin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sahalin' ),
        'fmenu' => esc_html__( 'Fmenu', 'sahalin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sahalin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'sahalin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sahalin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sahalin_content_width', 640 );
}
add_action( 'after_setup_theme', 'sahalin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sahalin_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sahalin' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sahalin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sahalin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sahalin_scripts() {
	wp_enqueue_style( 'sahalin-style', get_stylesheet_uri() );
    wp_enqueue_style( 'sahalin-fonts', get_stylesheet_directory_uri() . '/fonts/fonts.css' );
    wp_enqueue_style( 'sahalin-nitfycss', get_stylesheet_directory_uri() . '/nifty.css' );
    //wp_enqueue_style( 'sahalin-aweso me', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' );
    wp_enqueue_style( 'sahalin-formstyle', get_stylesheet_directory_uri() . '/jquery.formstyler.css' );
    
    wp_enqueue_script( 'sahalin-nifty', get_template_directory_uri() . '/js/nifty.js', array(), '1.0.0', true );
    wp_enqueue_script( 'sahalin-form', get_template_directory_uri() . '/js/jquery.formstyler.js', array(), '1.0.0', true );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sahalin_scripts' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page('');
    acf_add_options_sub_page('Слайдер');
    acf_add_options_sub_page('Приветствие');
    acf_add_options_sub_page('Баннеры');
    acf_add_options_sub_page('Футер');
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function trim_characters($count, $after = '...'){
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = mb_substr($excerpt, 0, $count);
  $excerpt = $excerpt . $after;
  return $excerpt;
}

function add_help_menu() {
    add_menu_page(
        'Видео-помощь', // имя в меню
        'Видео-помощь', // title страницы
        'manage_options', // уровень доступа
        'admin_help', // slug страницы
        'render_help_page', // функция, отображающая собственно страницу
        'dashicons-video-alt3', // иконка
        '10' // позиция в меню
    );
}
add_action('admin_menu', 'add_help_menu');

function render_help_page() {
    echo '<h2>Видео-помощь</h2>'; 
    echo '<p><a href="https://youtu.be/q3cREnHAKw8" target="_blank">Добавление новостей</a></p>';
    echo '<p><a href="https://youtu.be/sRRTbaKdW1A" target="_blank">Редактирование страниц </a></p>';
    echo '<p><a href="https://youtu.be/6-jGb9e_qMw" target="_blank">Слайдер, баннеры, текст приветствия </a></p>';
    echo '<p><a href="https://youtu.be/VhtijPqDT-k" target="_blank">Как менять дату у новости </a></p>';
    echo '<p><a href="https://youtu.be/O1zgoxxsKZY" target="_blank">Как менять кнопки меню </a></p>';
    echo '<p><a href="https://youtu.be/PPkkcrkKs6g" target="_blank">Как менять разделы и подразделы </a></p>';
    echo '<p><a href="https://youtu.be/tQBhonO287E" target="_blank">Создание таблицы и размещение на странице</a></p>';
}

























