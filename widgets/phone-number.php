<?php
namespace HarvesterWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class PhoneNumber extends Widget_Base {

	public function get_name() {
		return 'phone-number';
	}

	public function get_title() {
		return __( 'Phone Number', 'page-harvester' );
	}


	public function get_icon() {
		return 'eicon-sitemap';
	}


	public function get_categories() {
		return [ 'page_harvester' ];
	}

	public function get_style_depends() {
		return ['page_harvester'];
	}


	public function get_script_depends() {
		return [];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'page-harvester' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'phone',
				'options' => [
					'phone' => esc_html__( 'Phone Number', 'page-harvester' ),
					'custom' => esc_html__( 'Custom Text', 'page-harvester' ),
				],
			]
		);

		$this->add_control(
			'button_custom_text',
			[
				'label' => esc_html__( 'Button Custom Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Now', 'page-harvester' ),
			]
		);

        $this->add_control(
			'before_text',
			[
				'label' => esc_html__( 'Before Text', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Phone: ', 'page-harvester' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'page-harvester' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'phone_typography',
				'selector' => '{{WRAPPER}} .ph-phone',
			]
		);

		$this->add_control(
			'phone_text_align',
			[
				'label' => esc_html__( 'Alignment', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'page-harvester' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'page-harvester' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'page-harvester' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'phone_text_color',
			[
				'label' => esc_html__( 'Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'phone_background_color',
			[
				'label' => esc_html__( 'Background Color', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'phone_border',
				'selector' => '{{WRAPPER}} .ph-phone',
			]
		);

		$this->add_control(
			'phone_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'phone_button_padding',
			[
				'label' => esc_html__( 'Padding', 'page-harvester' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ph-phone' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
        $before_text = $settings['before_text'];
		$button_text = $settings['button_text'];
		$button_custom_text = $settings['button_custom_text'];

        $phone = get_post_meta(get_the_ID(), 'ph_phone', true);

        if ($phone == null) {
            $phone_number_group = get_post_meta(get_the_ID(), 'ph_location_data', true);
            $phone = $phone_number_group;
        }

        if (strpos($_SERVER['REQUEST_URI'], 'elementor') !== false ) {
            $phone = '123-123-1234';
        }

		$tel_number = str_replace(array('-','(',')',' '),'',$phone);

		?>
			<a href="<?php echo 'tel:'.$tel_number; ?>">
			<div class="ph-phone">
				<?php echo esc_html( $before_text ); ?>
				<?php echo 'phone' === $button_text ? esc_html( $phone ) : esc_html( $button_custom_text );?>
				</div>
			</a>
		<?php
        
	}
}