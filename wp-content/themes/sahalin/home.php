<?php get_header(); ?>

<main class="content">


	
<div class="home-wrapper box clrfx">
    <aside class="homewr">
    
<div class="mytime">
<div class="hideyan"></div>
<iframe frameborder="no" scrolling="no" style="width:280px;height:150px;" src="https://yandex.ru/time/widget/?geoid=80&lang=ru&layout=horiz&type=analog&face=digits"></iframe>
</div>      
       
        <?php if( have_rows('banners', 'option') ): ?>

	<ul class="home-banners">

	<?php while( have_rows('banners', 'option') ): the_row(); 

		// vars
		$image = get_sub_field('img_banners');
		$link = get_sub_field('link_banners');

		?>

		<li class="slide">

			<?php if( $link ): ?>
				<a href="<?php echo $link; ?>" target="_blank">
			<?php endif; ?>

				<img src="<?php echo $image; ?>" />

			<?php if( $link ): ?>
				</a>
			<?php endif; ?>

		</li>

	<?php endwhile; ?>

	</ul>

<?php endif; ?>
   
    </aside>
    <div class="home-content">
      
         <div class="welcome box clrfx">
             <img src="<?php the_field('photo', 'option'); ?>" alt="" width="240">
             <div class="welcome-text">
                 <?php the_field('welcom_text', 'option'); ?>
             </div>
	     </div>
      
       <section class="mapanimation box">
            <div class="wrap">
              <span class="kostrova">Курильские острова</span>
               <h2>Расстояние от г. Москвы<br>до г. Южно-Сахалинска 10 400 км</h2>
               
               <?php
                    if (wpmd_is_iphone ()) { ?>
                        <img class="mapa" src="<?php echo get_template_directory_uri(); ?>/img/mapa.png" alt="">
                        <style>
                            span.kostrova {
                                display: none;
                            }
                        </style>
                   <?php } 
                    else { ?>
                        <iframe class="map-frame" SRC="<?php echo get_template_directory_uri(); ?>/mapsahalin.html" frameborder="0" height="574px" width="100%" scrolling="no">
                             </iframe>
                    <?php }
                ?> 
      
                <div class="clr"></div>
            </div>
        </section>  
    
        <section class="lastnews box">
            <div class="wrap">
                <h2>Последние новости</h2>
                <div class="lnlist">
                <?php
                    $args = array(
                    'category_name'  => 'novosti',    
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'posts_per_page' => 5
                  );
                   query_posts( $args );
                   if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                    <div class="lnlist-item">

                        
                        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                            <a class="post_thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="">
                                <?php the_post_thumbnail('news-anons'); ?>
                                <div class="pt_overlay"></div>
                            </a>
                        <?php endif; ?>
                        <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
                        <span class="home-date"><?php the_time('j F, Y'); ?></span>
                        <p><?php echo trim_characters(221, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="more">Читать далее...</a>
                    </div>
                      <?php
                    endwhile;
                  endif;

                 wp_reset_query();?>
                </div>

                <a href="<?php echo home_url( '/category/novosti/' ) ?>" class="allnews">Все новости</a>
            </div>
        </section>        
    
    </div>    
</div>
   
    
                 
              
                  
	    	    
</main><!-- .content -->

<?php get_footer();