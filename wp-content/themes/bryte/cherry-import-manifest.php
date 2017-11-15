<?php
/**
 * Default manifest file
 *
 * @var array
 */
$settings = array(
	'xml' => false,
	'advanced_import' => array(
		'default' => array(
			'label'    => esc_html__( 'Bryte', 'bryte' ),
			'full'     => get_template_directory() . '/assets/demo-content/default-full.xml',
			'lite'     => false,
			'thumb'    => get_template_directory_uri() . '/assets/demo-content/default-thumb.png',
			'demo_url' => 'http://ld-wp2.template-help.com/wptheme/bryte',
		),
	),
	'import' => array(
		'chunk_size' => 3,
	),
	'export' => array(
		'options' => array(
			'woocommerce_default_country',
			'woocommerce_shop_page_id',
			'woocommerce_default_catalog_orderby',
			'shop_catalog_image_size',
			'shop_single_image_size',
			'shop_thumbnail_image_size',
			'woocommerce_cart_page_id',
			'woocommerce_checkout_page_id',
			'woocommerce_terms_page_id',
			'tm_woowishlist_page',
			'tm_woocompare_page',
			'tm_woocompare_enable',
			'tm_woocompare_show_in_catalog',
			'tm_woocompare_show_in_single',
			'tm_woocompare_compare_text',
			'tm_woocompare_remove_text',
			'tm_woocompare_page_btn_text',
			'tm_woocompare_show_in_catalog',
			'cherry_projects_options',
			'cherry_projects_options_default',
			'cherry-team',
			'cherry-team_default',
			'cherry-services',
			'cherry-services_default',
			'revslider-global-settings',
			'elementor_disable_color_schemes',
			'elementor_disable_typography_schemes',
			'site_icon',
		),
		'tables' => array(
			'revslider_css',
			'revslider_layer_animations',
			'revslider_navigations',
			'revslider_sliders',
			'revslider_slides',
			'revslider_static_slides',
			'woocommerce_attribute_taxonomies',
		),
	),
	'slider' => array(
		'path' => 'https://raw.githubusercontent.com/JetImpex/wizard-slides/master/slides.json',
	),
);
