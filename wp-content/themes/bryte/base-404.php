<?php get_header( bryte_template_base() ); ?>

	<div <?php bryte_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php bryte_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include bryte_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- .container -->

<?php get_footer( bryte_template_base() ); ?>
