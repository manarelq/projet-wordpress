<?php
/**
 * Elegant Pink Theme Info
 *
 * @package elegant_pink
 */
if ( ! function_exists( 'elegant_pink_customizer_theme_info' ) ) :

function elegant_pink_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Information Links' , 'elegant-pink' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
	$theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'elegant-pink' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=elegant-pink' ) . '"  target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/elegant-pink/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/elegant-pink/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/elegant-pink/reviews/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More WordPress Themes', 'elegant-pink' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pink' ) . '</a></span><br />';


	$wp_customize->add_control( new elegant_pink_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'label' => __( 'About Elegant Pink' , 'elegant-pink' ),
		'section' => 'theme_info',
		'description' => $theme_info
		)));

	$wp_customize->add_setting('theme_info_more_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));

}
endif;
add_action( 'customize_register', 'elegant_pink_customizer_theme_info' );


if( class_exists( 'WP_Customize_control' ) ){

	class elegant_pink_Theme_Info extends WP_Customize_Control
	{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }//editor close
    
}//class close

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Elegant_Pink_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

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

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;


if ( ! function_exists( 'elegant_pink_sections_pro' ) ) :
/**
 * Section Pro 
*/
function elegant_pink_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Elegant_Pink_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Elegant_Pink_Customize_Section_Pro(
			$manager,
			'elegant_pink_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'elegant-pink' ),
                'priority' => 5, 
				'pro_text' => esc_html__( 'VIEW PRO THEME', 'elegant-pink' ),
				'pro_url'  => 'https://rarathemes.com/wordpress-themes/elegant-pink-pro/'
			)
		)
	);
}
endif;
add_action( 'customize_register', 'elegant_pink_sections_pro' );