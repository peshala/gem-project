<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bryte
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<?php $utility       = bryte_utility()->utility;
	$blog_featured_image = get_theme_mod( 'blog_featured_image', bryte_theme()->customizer->get_default( 'blog_featured_image' ) );
	?>

	<div class="post-list__item-content">

		<header class="entry-header">

			<?php $cats_visible = bryte_is_meta_visible( 'blog_post_categories', 'loop' );

			$utility->meta_data->get_terms( array(
				'visible'   => $cats_visible,
				'type'      => 'category',
				'delimiter' => ', ',
				'before'    => '<span class="post__cats">',
				'after'     => '</span>',
				'echo'      => true,
			) );
			?>

			<?php bryte_sticky_label(); ?>

			<?php $title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>';

			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => $title_html,
				'echo'  => true,
			) );
			?>

		</header><!-- .entry-header -->

		<div class="post-featured-content">
			<?php do_action( 'cherry_post_format_audio' ); ?>
		</div><!-- .post-featured-content -->

		<div class="entry-content">
			<?php get_template_part( 'template-parts/content-entry-meta-loop' ); ?>

			<?php $blog_content = get_theme_mod( 'blog_posts_content', bryte_theme()->customizer->get_default( 'blog_posts_content' ) );
			$length             = ( 'full' === $blog_content ) ? -1 : 55;
			$content_visible    = ( 'none' !== $blog_content ) ? true : false;
			$content_type       = ( 'full' !== $blog_content ) ? 'post_excerpt' : 'post_content';

			$utility->attributes->get_content( array(
				'visible'      => $content_visible,
				'length'       => $length,
				'content_type' => $content_type,
				'echo'         => true,
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php $btn_text = get_theme_mod( 'blog_read_more_text', bryte_theme()->customizer->get_default( 'blog_read_more_text' ) );
			$btn_visible    = $btn_text ? true : false;

			$utility->attributes->get_button( array(
				'visible' => $btn_visible,
				'class'   => 'btn btn-primary',
				'text'    => esc_html( $btn_text ),
				'icon'    => '',
				'html'    => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
				'echo'    => true,
			) );
			?>
			
		</footer><!-- .entry-footer -->
	</div><!-- .post-list__item-content -->

</article><!-- #post-## -->
