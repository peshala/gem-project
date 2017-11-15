<?php
/*
Widget Name: Image Grid widget
Description: This widget is used to display a list of images from your posts
Settings:
 Title - Widget's text title
 Choose taxonomy type - Choose the posts source type
 Select cateogory / tag - Choose the posts source
 Post sorted - Choose the sort order
 Posts number - Limit the posts
 Offset post - Specify the offset
 Title words length - Specify post title length
 Columns number - Choose the number of columns
 Items padding - Choose the offset between items
*/

/**
 * @package Bryte
 */
if ( ! class_exists( 'Bryte_Image_Grid_Widget' ) ) {

	/**
	 * Image Grid Widget
	 */
	class Bryte_Image_Grid_Widget extends Cherry_Abstract_Widget {

		/**
		 * Contain utility module from Cherry framework
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $utility = null;

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->widget_name        = esc_html__( 'Image Grid', 'bryte' );
			$this->widget_description = esc_html__( 'This widget displays images from post.', 'bryte' );
			$this->widget_id          = 'widget-image-grid';
			$this->widget_cssclass    = 'widget-image-grid';
			$this->utility            = bryte_utility()->utility;
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'value' => 'Image Grid',
					'label' => esc_html__( 'Widget title', 'bryte' ),
				),
				'terms_type' => array(
					'type'    => 'radio',
					'value'   => 'category_name',
					'options' => array(
						'category_name' => array(
							'label' => esc_html__( 'Category', 'bryte' ),
							'slave' => 'terms_type_post_category',
						),
						'tag'           => array(
							'label' => esc_html__( 'Tag', 'bryte' ),
							'slave' => 'terms_type_post_tag',
						),
					),
					'label'   => esc_html__( 'Choose taxonomy type', 'bryte' ),
				),
				'category_name' => array(
					'type'             => 'select',
					'multiple'         => true,
					'value'            => '',
					'options'          => false,
					'options_callback' => array( $this->utility->satellite, 'get_terms_array', array( 'category', 'slug' ) ),
					'label'            => esc_html__( 'Select categories to show', 'bryte' ),
					'master'           => 'terms_type_post_category',
				),
				'tag' => array(
					'type'             => 'select',
					'multiple'         => true,
					'value'            => '',
					'options'          => false,
					'options_callback' => array( $this->utility->satellite, 'get_terms_array', array( 'post_tag', 'slug' ) ),
					'label'            => esc_html__( 'Select tags to show', 'bryte' ),
					'master'           => 'terms_type_post_tag',
				),
				'post_sort' => array(
					'type'    => 'select',
					'value'   => 'date',
					'options' => array(
						'date'          => esc_html__( 'Publish Date', 'bryte' ),
						'title'         => esc_html__( 'Post Title', 'bryte' ),
						'comment_count' => esc_html__( 'Comment Count', 'bryte' ),
					),
					'label'   => esc_html__( 'Post sorted', 'bryte' ),
				),
				'post_number' => array(
					'type'       => 'stepper',
					'value'      => '5',
					'max_value'  => '100',
					'min_value'  => '1',
					'step_value' => '1',
					'label'      => esc_html__( 'Posts number', 'bryte' ),
				),
				'post_offset' => array(
					'type'       => 'stepper',
					'value'      => '0',
					'max_value'  => '10000',
					'min_value'  => '0',
					'step_value' => '1',
					'label'      => esc_html__( 'Offset post', 'bryte' ),
				),
				'title_length' => array(
					'type'       => 'stepper',
					'value'      => '10',
					'max_value'  => '500',
					'min_value'  => '0',
					'step_value' => '1',
					'label'      => esc_html__( 'Title words length ( Set 0 to hide title. )', 'bryte' ),
				),
				'columns_number' => array(
					'type'       => 'stepper',
					'value'      => '3',
					'max_value'  => '4',
					'min_value'  => '1',
					'step_value' => '1',
					'label'      => esc_html__( 'Columns number', 'bryte' ),
				),
				'items_padding' => array(
					'type'       => 'stepper',
					'value'      => '5',
					'max_value'  => '50',
					'min_value'  => '0',
					'step_value' => '1',
					'label'      => esc_html__( 'Items padding ( size in pixels )', 'bryte' ),
				),
			);

			parent::__construct();
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 *
		 * @since  1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			global $post;

			$args = apply_filters( 'bryte_image_grid_widget_args', $args, $instance );

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$template = locate_template( '/inc/widgets/image-grid/views/image-grid-view.php', false, false );

			if ( empty( $template ) ) {
				return;
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			$terms_type     = $instance['terms_type'];
			$title_length   = $instance['title_length'];
			$columns_number = $instance['columns_number'];
			$items_padding  = $instance['items_padding'];


			if ( array_key_exists( $terms_type, $instance ) ) {
				$post_taxonomy = $instance[ $terms_type ];

				if ( $post_taxonomy ) {
					$post_args = array(
						'post_type'   => 'post',
						'offset'      => $instance['post_offset'],
						'orderby'     => $instance['post_sort'],
						'order'       => apply_filters( 'bryte_order_image_grid_widget', 'DESC', $instance ), // ASC
						'numberposts' => ( int ) $instance['post_number'],
					);
					$post_args[ $terms_type ] = implode( ',', $post_taxonomy );

					$posts = get_posts( $post_args );
				}
			}

			if ( isset( $posts ) && $posts ) {
				global $post;

				$grid_class_array = apply_filters( 'bryte_image_grid_widget_grid_class', array(
					'1' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12',
					'2' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6',
					'3' => 'col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4',
					'4' => 'col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3',
				) );

				$columns_class = $grid_class_array[ $columns_number ];

				if( '0' !== $items_padding ){

					bryte_theme()->dynamic_css->add_style(
						$this->add_selector( '.row' ),
						array( 'margin' => '0 0 -' . $items_padding . 'px -' . $items_padding . 'px' )
					);

					bryte_theme()->dynamic_css->add_style(
						$this->add_selector( '.widget-image-grid__inner' ),
						array( 'margin' => '0 0 ' . $items_padding . 'px ' . $items_padding . 'px' )
					);

				}

				echo apply_filters(
					'bryte_image_grid_widget_before',
					'<div class="row columns-number-' . $columns_number . '">',
					$instance
				);


				foreach ( $posts as $post ) {
					setup_postdata( $post );

					$taxonomy_type = ( 'category_name' === $terms_type ) ? 'category' : 'post_tag';
					$terms = $this->utility->meta_data->get_terms( array(
						'type'      => $taxonomy_type,
						'delimiter' => ', ',
						'before'    => '<div class="widget-image-grid__terms">',
						'after'     => '</div>',
					) );

					$image = $this->utility->media->get_image( array(
						'size'        => 'post-thumbnail',
						'mobile_size' => 'post-thumbnail',
						'class'       => 'widget-image-grid__img',
						'html'        => '<img %2$s src="%3$s" alt="%4$s" %5$s>',
					) );

					$permalink = $this->utility->attributes->get_post_permalink();

					$title_visible = ( '0' === $title_length ) ? false : true;

					$title = $this->utility->attributes->get_title( array(
						'visible' => $title_visible,
						'length'  => $title_length,
						'class'   => 'widget-image-grid__title',
						'html'    => '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>',
					) );

					$date = $this->utility->meta_data->get_date( array(
						'class' => 'widget-image-grid__date',
					) );

					$author = $this->utility->meta_data->get_author( array(
						'class'  => 'widget-image-grid__author-link',
						'prefix' => esc_html__( 'by ', 'bryte' ),
						'html'   => '<div class="widget-image-grid__author">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></div>',
					) );

					include $template;
				}

				echo apply_filters( 'bryte_image_grid_widget_after', '</div>', $instance );
			}

			$this->widget_end( $args );
			$this->reset_widget_data();

			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}
	}

	add_action( 'widgets_init', 'bryte_register_image_grid_widget' );
	/**
	 * Register image grid widget.
	 */
	function bryte_register_image_grid_widget() {
		register_widget( 'Bryte_Image_Grid_Widget' );
	}
}
