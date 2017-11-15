<?php
/**
 * Template for displaying standard post format item content
 *
 * @package Bryte
 */

$first_video = tm_get_first_video();
?>
<?php if ( $first_video ) : ?>
<div class="tm_main_video_container">
	<?php echo wp_kses_post( $first_video ); ?>
</div>
<?php endif; ?>
<div class="tm_pb_content_container">
	<?php if ( 'on' === $module->_var( 'show_categories' ) ) {
		?><div class="categories"><?php
			echo get_the_category_list( ', ' );
		?></div><?php
	}

	$title_html = '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>';

	tm_builder_core()->utility()->attributes->get_title( array(
		'html'  => $title_html,
		'class' => 'entry-title',
		'echo'  => true,
	) );
	?>

	<?php bryte_get_builder_module_template( 'blog/meta.php', $module ); ?>

	<?php echo wp_kses_post( $module->get_post_content() ); ?>
	<?php if ( 'on' === $module->_var( 'show_more' ) ) {
		bryte_get_builder_module_template( 'blog/more.php', $module ); 
	} ?>
</div>
