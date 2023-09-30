<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class vds_Elementor_Addon_Info_Box extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'vds-info-box';
	}

	public function get_title(): string {
		return esc_html__( 'Info box', 'vds' );
	}

	public function get_icon(): string {
		return 'eicon-info-box';
	}

	protected function register_controls() {

		// image section
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Image', 'vds' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'img_type',
			[
				'label' => esc_html__('Infobox Type', 'vds'),
				'type' => Controls_Manager::SELECT,
				'default' => 'img-on-top',
				'label_block' => false,
				'options' => [
					'img-on-top' => esc_html__('Image/Icon On Top', 'vds'),
					'img-on-left' => esc_html__('Image/Icon On Left', 'vds'),
					'img-on-right' => esc_html__('Image/Icon On Right', 'vds'),
				],
			]
		);

		$this->add_control(
			'img_or_icon',
			[
				'label' => esc_html__('Image or Icon', 'vds'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'vds'),
						'icon' => 'fa fa-ban',
					],
					
					'icon' => [
						'title' => esc_html__('Icon', 'vds'),
						'icon' => 'fa fa-info-circle',
					],
					
					'img' => [
						'title' => esc_html__('Image', 'vds'),
						'icon' => 'eicon-image-bold',
					],
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'icon_vertical_position',
			[
				'label' => esc_html__('Icon Position', 'vds'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'condition' => [
					'img_type!' => 'img-on-top',
				],
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'vds'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__('Middle', 'vds'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'vds'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .element-info-box' => 'align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
			]
		);

		/**
		 * Condition: 'img_or_icon' => 'img'
		 */
		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__('Infobox Image', 'vds'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'img_or_icon' => 'img',
				],
			]
		);

		/**
		 * Condition: 'img_or_icon' => 'icon'
		 */
		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'vds'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-building',
					'library' => 'fa-solid',
				],
				'condition' => [
					'img_or_icon' => 'icon',
				],
			]
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'vds'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'vds'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is an icon box', 'vds'),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__('Description', 'vds'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'rows' => 10,
				'default' => esc_html__('Write a short description, that will describe the title or something informational and useful.', 'vds'),
				'placeholder' => esc_html__( 'Type your description here', 'vds' ),
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => esc_html__('Show Description', 'vds'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Show', 'vds'),
				'label_off' => esc_html__('Hide', 'vds'),
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[
				'label' => esc_html__('Content Alignment', 'vds'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'vds'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'vds'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'vds'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'infobox-content-align-',
				'condition' => [
					'img_type' => 'img-on-top',
				],
			]
		);

		$this->end_controls_section();

		// style icon
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon', 'vds'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'img_or_icon' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'vds'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .element-info-box__icon .icon-box i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .element-info-box__icon .icon-box svg' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Spacing', 'vds'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .element-info-box' => 'grid-gap: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->start_controls_tabs('icon_style_controls');

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__('Normal', 'vds'),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'vds'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .element-info-box__icon .icon-box i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .element-info-box__icon .icon-box svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__('Hover', 'vds'),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Icon Color', 'vds'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .element-info-box:hover .icon-box i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .element-info-box:hover .icon-box svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// style content
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content', 'vds'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_options',
			[
				'label' => esc_html__( 'Title', 'vds' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__('Spacing', 'vds'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .element-info-box__content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'vds'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-info-box__content .title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .element-info-box__content .title',
			]
		);

		$this->add_control(
			'description_options',
			[
				'label' => esc_html__( 'Description', 'vds' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'vds'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-info-box__content .text' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .element-info-box__content .text',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$img_or_icon = $settings['img_or_icon'];

		$this->add_render_attribute('infobox_inner', 'class', 'element-info-box');

		// add class img type
        if ( $settings['img_type'] == 'img-on-left' ) :
	        $this->add_render_attribute('infobox_inner', 'class', 'icon-on-left');
        elseif ( $settings['img_type'] == 'img-on-right' ):
	        $this->add_render_attribute('infobox_inner', 'class', 'icon-on-right');
        else:
	        $this->add_render_attribute('infobox_inner', 'class', 'icon-on-top');
        endif;

		// get image
		$selected_image = $this->get_settings('selected_image');
		$selected_image_url = Group_Control_Image_Size::get_attachment_image_src( $selected_image['id'], 'thumbnail', $settings );

		if ( empty( $selected_image_url ) ) {
			$selected_image_url = $selected_image['url'];
		}

    ?>

        <div <?php echo $this->get_render_attribute_string('infobox_inner'); ?>>
            <?php if ( $img_or_icon != 'none' ) : ?>

                <div class="element-info-box__icon">
                    <?php if ( $img_or_icon == 'img' ) : ?>
                        <img src="<?php echo esc_url( $selected_image_url ); ?>" alt="<?php echo esc_attr(get_post_meta( $selected_image['id'], '_wp_attachment_image_alt', true) ); ?>">
                    <?php endif; ?>

	                <?php if ( $img_or_icon == 'icon' ) : ?>
                        <div class="icon-box elementor-icon">
                            <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

            <div class="element-info-box__content">
                <h4 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h4>

                <?php if ( $settings['show_description'] == 'yes' ) : ?>

                    <div class="text">
                        <?php echo wp_kses_post( $settings['text'] ); ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

    <?php
	}

}