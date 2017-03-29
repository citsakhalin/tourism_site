<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sahalin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-list'); ?>>
	<header class="entry-header">
	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
    <?php endif; ?>
        <div class="entry-meta">
			<span class="date"><?php the_time('j F, Y'); ?></span>
			<?php the_category(); ?>
		</div><!-- .entry-meta -->
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		
		<?php
		endif; ?>
		
        
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php echo trim_characters(340, '...'); ?></p>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<a href="<?php the_permalink(); ?>" class="more">Читать далее...</a>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
