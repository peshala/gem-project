<?php
/**
 * Elementor hooks.
 *
 * @package Bryte
 */


add_filter( 'jet-elements/controls/icon/data', 'bryte_set_theme_icons' );

function bryte_set_theme_icons( $data ) {
    return array(
        'format' => 'nc-icon-outline %s',
        'file'   => get_template_directory() . '/assets/css/nucleo-outline.css',
    );
}

add_action( 'elementor/editor/after_enqueue_styles', 'bryte_enqueue_font' );
add_action( 'elementor/frontend/after_register_styles', 'bryte_enqueue_font' );

function bryte_enqueue_font() {
	wp_enqueue_style( 'nucleo-outline', BRYTE_THEME_CSS . '/nucleo-outline.css', array(), '1.0.0' );
}

add_action( 'elementor/element/button/section_style/before_section_end', 'bryte_remove_button_controls' );
add_action( 'elementor/element/button/section_style/after_section_start', 'bryte_add_button_controls' );

function bryte_add_button_controls( $widget ) {

	$widget->add_control(
		'btn_bg_title',
		array(
			'label'     => esc_html__( 'Button Background', 'bryte' ),
			'type'      => Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$widget->start_controls_tabs( 'tabs_button_bg' );

	$widget->start_controls_tab(
		'tabs_button_bg_normal',
		array(
			'label' => esc_html__( 'Normal', 'bryte' ),
		)
	);

	$widget->add_group_control(
		Elementor\Group_Control_Background::get_type(),
		array(
			'name'     => 'btn_bg',
			'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
		)
	);

	$widget->end_controls_tab();

	$widget->start_controls_tab(
		'tabs_button_bg_hover',
		array(
			'label' => esc_html__( 'Normal', 'bryte' ),
		)
	);

	$widget->add_group_control(
		Elementor\Group_Control_Background::get_type(),
		array(
			'name'     => 'btn_bg_hover',
			'selector' => '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover',
		)
	);

	$widget->end_controls_tab();

	$widget->end_controls_tabs();

}

function bryte_remove_button_controls( $widget ) {

	$widget->remove_control( 'background_color' );
	$widget->remove_control( 'button_background_hover_color' );

}