<?php
/**
 * Register presets for TM Style Switcher
 *
 * @package Bryte
 */
if ( function_exists( 'tmss_register_preset' ) ) {

	tmss_register_preset(
		'default',
		esc_html__( 'Bryte', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/default.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/default.json'
	);

	tmss_register_preset(
		'skin1',
		esc_html__( 'Construction', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin1.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin1.json'
	);

	tmss_register_preset(
		'skin2',
		esc_html__( 'Fashion', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin2.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin2.json'
	);

	tmss_register_preset(
		'skin3',
		esc_html__( 'Furniture', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin3.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin3.json'
	);

	tmss_register_preset(
		'skin4',
		esc_html__( 'Ironmass', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin4.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin4.json'
	);

	tmss_register_preset(
		'skin5',
		esc_html__( 'Modern', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin5.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin5.json'
	);

	tmss_register_preset(
		'skin6',
		esc_html__( 'Resto', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin6.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin6.json'
	);

	tmss_register_preset(
		'skin7',
		esc_html__( 'LoanOffer', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin7.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin7.json'
	);

	tmss_register_preset(
		'skin8',
		esc_html__( 'Corporate', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin8.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin8.json'
	);

	tmss_register_preset(
		'skin9',
		esc_html__( 'Lawyer', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin9.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin9.json'
	);

	tmss_register_preset(
		'skin10',
		esc_html__( 'Weelko', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin10.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin10.json'
	);

	tmss_register_preset(
		'skin11',
		esc_html__( 'IntraBrand', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin11.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin11.json'
	);

	tmss_register_preset(
		'skin12',
		esc_html__( 'Lingua', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin12.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin12.json'
	);

	tmss_register_preset(
		'skin13',
		esc_html__( 'Marie Juliette', 'bryte' ),
		get_stylesheet_directory_uri() . '/tm-style-switcher-pressets/skin13.png',
		get_stylesheet_directory() . '/tm-style-switcher-pressets/skin13.json'
	);
}
