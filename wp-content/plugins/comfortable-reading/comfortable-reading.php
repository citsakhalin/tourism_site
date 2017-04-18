<?php
/**
 * Plugin Name: Comfortable Reading Premium
 * Plugin URI: http://wordpress-club.com/comfortable-reading-premium
 * Description: Создание версии сайта для слабовидящих пользователей (премиум версия плагина).
 * Version: 3.0
 * Author: Flaeron
 * Author URI: http://wordpress-club.com/comfortable-reading-premium
 */

/*  Copyright 2015-2016 Flaeron  (email : d.flaeron@gmail.com)
*/

$site_count = '1';
$licence = '1';
$get_licence_rule = 'wp-lessons.com';
$website = 'main-site';

$get_option = md5( get_home_url() );
$option     = get_option( 'comfortable_settings' );
if ( $option == $get_option ) {
	add_action( 'wp_enqueue_scripts', 'add_cr_custom_styles' );
	function add_cr_custom_styles() {
		wp_enqueue_style( 'css-style', plugins_url( 'css/custom.css', __FILE__ ) );
	}
	add_shortcode( 'cr', 'caption_shortcode' );
	function caption_shortcode( $atts, $content = null ) {
		return '<div id="cr_widget"><a href="#" itemprop="Copy" id="cr_version_link">' . $content . '</a></div>';
	}
}
$get_script = md5( get_home_url() );
$set_js     = get_option( 'comfortable_settings' );
if ( $set_js == $get_script ) {
	add_action( 'wp_enqueue_scripts', 'add_cr_script' );
	function add_cr_script() {
		wp_register_script( 'add_cr_script', plugin_dir_url( __FILE__ ) . 'js/jquery.comfortable.reading.js', array( 'jquery' ), '3.0', true );
		wp_enqueue_script( 'add_cr_script' );
	}
}
$get_cookie = md5( get_home_url() );
$value      = get_option( 'comfortable_settings' );
if ( $value == $get_cookie ) {
	add_action( 'wp_enqueue_scripts', 'cr_cookie' );
	function cr_cookie() {
		wp_register_script( 'cr_cookie', plugin_dir_url( __FILE__ ) . 'js/jquery.cookie.js', array( 'jquery' ), '3.0', true );
		wp_enqueue_script( 'cr_cookie' );
	}
}
class wp_cr_plugin extends WP_Widget {
	function wp_cr_plugin() {
		parent::__construct( false, $name = __( 'Comfortable Reading', 'comfortable-reading' ) );
	}
	function form( $instance ) {
		if ( $instance ) {
			$text = esc_attr( $instance['text'] );
		} else {
			$text = '';
		}
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Текст кнопки:', 'comfortable-reading' ); ?></label>
			<input class="wide" id="<?php echo $this->get_field_id( 'text' ); ?>"
			       name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo $text; ?>"/>
		</p>
		<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance         = $old_instance;
		$instance['text'] = strip_tags( $new_instance['text'] );
		return $instance;
	}
	function widget( $args, $instance ) {
		$set              = get_option( 'comfortable_settings' );
		$set_widget_value = md5( get_home_url() );
		if ( $set == '' || $set != $set_widget_value ) {
			echo '&nbsp;';
		} else {
			extract( $args );
			$text = $instance['text'];
			echo $before_widget;
			echo '<div id="cr_widget">';

			if ( $text ) {
				echo '<a href="#" itemprop="Copy" id="cr_version_link">' . $text . '</a>';
			} else {
				echo '<a href="#" itemprop="Copy" id="cr_version_link">Версия для слабовидящих</a>';
			};
			echo '</div>';
			echo $after_widget;
		}
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget("wp_cr_plugin");' ) );

class wp_cr_plugin2 extends WP_Widget {
	function wp_cr_plugin2() {
		parent::__construct( false, $name = __( 'Comfortable Reading Image', 'comfortable-reading' ) );
	}
	function form( $instance ) {
		if ( $instance ) {
			$link = esc_attr( $instance['link'] );
		} else {
			$link = '';
		}
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на изображение (не обязательно):', 'comfortable-reading' ); ?></label>
			<input class="wide" id="<?php echo $this->get_field_id( 'link' ); ?>"
			       name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>"/>
		</p>
		<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance         = $old_instance;
		$instance['link'] = strip_tags( $new_instance['link'] );

		return $instance;
	}
	function widget( $args, $instance ) {
		$set              = get_option( 'comfortable_settings' );
		$set_widget_value = md5( get_home_url() );
		if ( $set == '' || $set != $set_widget_value ) {
			echo '&nbsp;';
		} else {
			extract( $args );
			$link = $instance['link'];
			echo $before_widget;
			echo '<div id="cr_widget_img">';

			if ( $link ) {
				echo '<a href="#" itemprop="Copy" id="cr_version_link"><img src="' . $link . '"></a>';
			} else {
				echo '<a href="#" itemprop="Copy" id="cr_version_link"><img src="/wp-content/plugins/comfortable-reading/img/glsses.png"></a>';
			};
			echo '</div>';
			echo $after_widget;
		}
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget("wp_cr_plugin2");' ) );
function comfortable_reading_option_callback_function() {
	echo '<h3>Введите ключ:</h3>';
}
add_action( 'wp_head', 'cr_style_hook' );
function cr_style_hook() { ?>
	<script>
		jQuery( document ).ready( function() {
		jQuery('#cr_version_link').specialVersion({'base-style' : '/wp-content/plugins/comfortable-reading/css/styles.css'});
	});
	</script>
	<?php
}
add_action( 'wp_head', 'cr_style_hook2' );
	$empty = get_option( 'comfortable_settings' );
	if ($empty == '') {
		add_action( 'admin_notices', 'comfortable_reading_plugin_notice' );
}
function cr_style_hook2() { ?>
	<script>
		jQuery( document ).ready( function() {
		jQuery('.cr').specialVersion({'base-style' : '/wp-content/plugins/comfortable-reading/css/styles.css'});
	});
	</script>
	<?php
}
add_action( 'admin_menu', 'cr_plugin_setup_menu' );
function cr_plugin_setup_menu() {
	add_menu_page( 'Премиум версия плагина для слабовидящих', 'Версия для слабовидящих', 'manage_options', 'comfortable-reading-premium', 'cr_content_init', plugin_dir_url( __FILE__ ) . 'img/cr-admin-icon.png' );
}
add_action( 'admin_head', 'cr_custom_admin_styles' );
function cr_custom_admin_styles() { ?>
	<style>
	.cr-description {
		margin-top: 30px;
	}
	.cr-ul-style {
		list-style-type: square;
		margin-left: 40px;
	}
	.cr-ul-style span{
		text-decoration:underline;
	}
  </style>
    <?php
}
function comfortable_reading_key_callback_function() {
	echo '<input
		name="comfortable_settings"
		type="text"
		value="' . get_option( 'comfortable_settings' ) . '"
		style="width:70%" />';
}
function cr_content_init() {
	?>
	<h1>Comfortable Reading Premium</h1>
	<h2>Премиум версия плагина для слабовидящих</h2>
	<p>Вы используете плагин на сайте - <b><?php echo site_url(); ?></b></p>

	<form method="POST" action="options.php">
		<?php
		settings_fields( 'comfortable-reading-premium' );
		do_settings_sections( 'comfortable-reading-premium' );
		submit_button();
		?>
	</form>

	<p>По вопросам установки плагина и приобретения ключей - пишите на почту <b>d.flaeron@gmail.com</b> или <a
			href="http://vk.com/flaeron" target="_blank">vk.com/flaeron</a></p>
	<p>По поводу установки плагина <b>НА ЛЮБОЙ САЙТ</b> (Joomla, Bitrix, DLE, uCoz, и т.п.) обращайтесь по этим же координатам :)</p>
	<div class='cr-description'>
		<h3>Функционал премиум плагина:</h3>
		<ul class="cr-ul-style">
			<li>Выбор шрифта Брайля.</li>
			<li>Возможность настройки межстрочного и межбуквенного интервала.</li>
			<li>Выбор типа шрифта (с засечками и без засечек).</li>
			<li>Виджет, позволяющий установить кнопку-изображение.</li>
			<li>Возможность добавлять кнопку в меню (<a href="https://www.youtube.com/watch?v=bFtAoPzd8tQ"
			                                            target="_blank">видео по добавлению</a>)
			</li>
			<li>Функция «Отключение и включение изображений».</li>
			<li>Выбор цветовых схем.</li>
		</ul>

		<h3>Демонстрация работы и пример установки плагина:</h3>
		<iframe width="800" height="450" src="https://www.youtube.com/embed/NkCnXMwcpj4" frameborder="0"
		        allowfullscreen></iframe>
	</div>
	<?php
}
function comfortable_reading_settings_api_init() {
	add_settings_section(
		'comfortable_reading_option_section',
		'',
		'comfortable_reading_option_callback_function',
		'comfortable-reading-premium'
	);

	add_settings_field(
		'comfortable_settings',
		'Ваш ключ:',
		'comfortable_reading_key_callback_function',
		'comfortable-reading-premium',
		'comfortable_reading_option_section'
	);
	register_setting( 'comfortable-reading-premium', 'comfortable_settings' );
}
add_action( 'admin_init', 'comfortable_reading_settings_api_init' );

function comfortable_reading_plugin_notice() {
	?>
	<div class="notice notice-warning">
		<p>Для работы плагина Comfortable Reading Premium необходимо ввести ключ на <a href="/wp-admin/admin.php?page=comfortable-reading-premium">странице настроек плагина</a>!</p>
	</div>
	<?php
}
function cr_copyright_text_function() {
    echo '<a href="http://wp-lessons.com/spisok-urokov"></a>';
}
add_action( 'wp_footer', 'cr_copyright_text_function', 100 );