<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Bryte
 */
?>
<div class="comment-author vcard">
	<?php echo bryte_comment_author_avatar(); ?>
</div>
<div class="comment-content-wrap">
	<footer class="comment-meta">
		<div class="comment-metadata">
			<?php echo bryte_get_comment_author_link(); ?>
			<?php echo bryte_get_comment_date(); ?>
		</div>
	</footer>
	<div class="comment-content">
		<?php echo bryte_get_comment_text(); ?>
	</div>
	<div class="reply">
		<?php echo bryte_get_comment_reply_link( array( 'reply_text' => esc_html__( 'Reply', 'bryte' ) ) ); ?>
	</div>
</div>
