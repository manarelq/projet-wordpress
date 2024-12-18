<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class StorePress_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'Storepress';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';
	public $pro_demo_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';
	public $pro_demo_url = '';
	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = wp_kses_post($this->pro_text);
		$json['pro_url']  = esc_url( $this->pro_url );
		$json['pro_demo_text'] = wp_kses_post($this->pro_demo_text);
		$json['pro_demo_url']  = esc_url( $this->pro_demo_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>
        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand control-section-default storepress-upsale" aria-owns="sub-accordion-section-Storepress-pro">
            <h3 class="accordion-section-title">
				{{ data.title }}
				<div class="btn-group">	
					<a href="{{ data.pro_demo_url }}" class="button demo" target="_blank" rel="noopener">{{ data.pro_demo_text }}</a>
					<a href="{{ data.pro_url }}" class="button pro" target="_blank" rel="noopener">{{ data.pro_text }}</a>
				 </div>
            </h3>
        </li>
	<?php
	}
}