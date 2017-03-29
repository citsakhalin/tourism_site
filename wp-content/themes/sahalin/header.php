<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
<meta name="viewport" content="width=1100">
<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<style>
    /* Слайдер в Новостях*/
    body.category-novosti header.header {
	background-image: url(<?php the_field('slider_novosti', 'option'); ?>); 
}    
    /* Слайдер Деятельность*/
    body.page-id-95 header.header {
	background-image: url(<?php the_field('slider_deyat', 'option'); ?>);  
}    
    /* Слайдер Документы*/
    body.page-id-10 header.header {
	background-image: url(<?php the_field('slider_docs', 'option'); ?>);
}    
    /* Слайдер Туристам*/
    body.page-id-12 header.header {
	background-image: url(<?php the_field('slider_turs', 'option'); ?>);
}    
    /* Слайдер Субьектам*/
    body.page-id-14 header.header {
	background-image: url(<?php the_field('slider_sub', 'option'); ?>);
}    
    /* Слайдер Статистика*/
    body.page-id-16 header.header {
	background-image: url(<?php the_field('slider_stat', 'option'); ?>);
}    
    /* Слайдер Коррупции*/
    body.page-id-18 header.header {
	background-image: url(<?php the_field('slider_kor', 'option'); ?>);
}    
    /* Слайдер Интернет-приемная*/
    body.page-id-385 header.header {
	background-image: url(<?php the_field('slider_inet', 'option'); ?>);
}    
</style>
</head>

    

<body <?php body_class(); ?>>

<div class="wrapper">
    <nav class="topmenu box" role="navigation">
        <div class="wrap box">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </div>
    </nav>
	<header class="header">
	    <div class="wrap box">
	        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo box">
	            <span class="lyellow">Агентство<br>по туризму</span>
	            <span class="lwhite">Сахалинской области</span>
	        </a>
	        <div class="dopmenu box clrfx">
	            <ul>
	                <li><a href="<?php echo home_url( '/o-sahaline-i-kurilah/' ) ?>">О Сахалине и Курилах</a></li>
	                <li><a href="https://uslugi.admsakhalin.ru/rpgu/orgs/detail.htm?id=8366%40egOrganization&agrp=10357456" target="_blanl">Государственные услуги</a></li>
	                <li><a href="<?php echo home_url( '/internet-priemnaya-grazhdan/' ) ?>">Интернет-приемная граждан</a></li>
	            </ul>
	        </div>
	    </div>
    </header><!-- .header-->