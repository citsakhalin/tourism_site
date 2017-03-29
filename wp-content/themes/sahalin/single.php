<?php get_header(); ?>

<main class="content">
	 <div class="wrap clrfx">
        <div class="page-content clrfx">
           
            <?php if ( function_exists('yoast_breadcrumb') ) 
                    {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
                    
            <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'single' );


                endwhile; // End of the loop.
                ?>
        </div>
		
<?php get_sidebar();?>

	</div><!-- #wrap -->
</main><!-- .content -->

<?php get_footer();?>
