<?php get_header(); ?>

<main class="content">
	 <div class="wrap clrfx">
        
        <div class="page-content clrfx">
            <?php if ( function_exists('yoast_breadcrumb') ) 
                    {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
       

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			
            the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

        </div>
		
<?php get_sidebar();?>

	</div><!-- #wrap -->
</main><!-- .content -->

<?php get_footer();?>
