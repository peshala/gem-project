<?php
/**
 * Plugins configuration example.
 *
 * @var array
 */
$plugins = array(
	'elementor' => array(
		'name'   => esc_html__( 'Elementor', 'bryte' ),
		'access' => 'skins',
	),
	'jet-elements' => array(
		'name'   => esc_html__( 'Jet Elements', 'bryte' ),
		'source' => 'local',
		'path'   => BRYTE_THEME_DIR . '/assets/includes/plugins/jet-elements.zip',
		'access' => 'skins',
	),
	'cherry-ld-mods-switcher' => array(
		'name'   => esc_html__( 'Cherry Live Demo Mods Switcher', 'bryte' ),
		'source' => 'local',
		'path'   => BRYTE_THEME_DIR . '/assets/includes/plugins/cherry-ld-mods-switcher.zip',
		'access' => 'base',
	),
	'cherry-team-members' =>array(
		'name'   => esc_html__( 'Cherry Team Members', 'bryte' ),
		'access' => 'skins',
	),
	'cherry-services-list' => array(
		'name'   => esc_html__( 'Cherry Services List', 'bryte' ),
		'access' => 'skins',
	),
	'cherry-testi' => array(
		'name'   => esc_html__( 'Cherry Testimonials', 'bryte' ),
		'access' => 'skins',
	),
	'cherry-projects' => array(
		'name'   => esc_html__( 'Cherry Projects', 'bryte' ),
		'access' => 'skins',
	),
	'cherry-sidebars' => array(
		'name'   => esc_html__( 'Cherry Sidebars', 'bryte' ),
		'access' => 'skins',
	),
	'contact-form-7' => array(
		'name'   => esc_html__( 'Contact Form 7', 'bryte' ),
		'access' => 'skins',
	),
	'revslider' => array(
		'name'   => esc_html__( 'Slider Revolution', 'bryte' ),
		'source' => 'local',
		'path'   => BRYTE_THEME_DIR . '/assets/includes/plugins/revslider.zip',
		'access' => 'skins',
	),
	'tm-mega-menu' => array(
		'name'   => esc_html__( 'TM Mega Menu', 'bryte' ),
		'source' => 'remote',
		'path'   => 'http://cloud.cherryframework.com/downloads/free-plugins/tm-mega-menu.zip',
		'access' => 'skins',
	),
	'tm-photo-gallery' => array(
		'name'   => esc_html__( 'TM Photo Gallery', 'bryte' ),
		'access' => 'skins',
	),
	'woocommerce' => array(
		'name'   => esc_html__( 'Woocommerce', 'bryte' ),
		'access' => 'skins',
	),
	'tm-woocommerce-ajax-filters' => array(
		'name'   => esc_html__( 'TM Woocommerce Ajax Filters', 'bryte' ),
		'source' => 'local',
		'path'   => BRYTE_THEME_DIR . '/assets/includes/plugins/tm-woocommerce-ajax-filters.zip',
		'access' => 'skins',
	),
	'tm-woocommerce-compare-wishlist' => array(
		'name'   => esc_html__( 'TM Woocommerce Compare Wishlist', 'bryte' ),
		'access' => 'skins',
	),
	'tm-woocommerce-package' => array(
		'name'   => esc_html__( 'TM Woocommerce Package', 'bryte' ),
		'access' => 'skins',
	),
	'woocommerce-social-media-share-buttons' => array(
		'name'   => esc_html__( 'Woocommerce Social Media Share Buttons', 'bryte' ),
		'access' => 'skins',
	),
	'cherry-data-importer' => array(
		'name'   => esc_html__( 'Cherry Data Importer', 'bryte' ),
		'source' => 'remote',
		'path'   => 'https://github.com/CherryFramework/cherry-data-importer/archive/master.zip',
		'access' => 'base',
	),
);

/**
 * Skins configuration example
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'cherry-data-importer',
		'cherry-ld-mods-switcher'
	),
	'advanced' => array(
		'default' => array(
			'full'  => array(
				'elementor',
				'jet-elements',
				'cherry-team-members',
				'cherry-services-list',
				'cherry-testi',
				'cherry-projects',
				'cherry-sidebars',
				'contact-form-7',
				'revslider',
				'tm-mega-menu',
				'tm-photo-gallery',
				'tm-woocommerce-ajax-filters',
				'tm-woocommerce-compare-wishlist',
				'tm-woocommerce-package',
				'woocommerce-social-media-share-buttons',
				'woocommerce'
			),
			'lite'  => false,
			'demo'  => 'http://ld-wp2.template-help.com/wptheme/bryte',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/default-thumb.png',
			'name'  => esc_html__( 'Bryte', 'bryte' ),
		),
	),
);

$texts = array(
	'theme-name' => 'Bryte'
);

