<?php

/**
 * Class SiteOrigin_Widget_Field_Text
 */
abstract class SiteOrigin_Widget_Field_Text_Input_Base extends SiteOrigin_Widget_Field {

	/**
	 * A string to display before any text has been input.
	 *
	 * @access protected
	 * @var string
	 */
	protected $placeholder;
	/**
	 * If true, this field will not be editable.
	 *
	 * @access protected
	 * @var bool
	 */
	protected $readonly;

	public function __construct( $base_name, $element_id, $element_name, $options ){
		parent::__construct( $base_name, $element_id, $element_name, $options );

		if( isset( $options['placeholder'] ) ) $this->placeholder = $options['placeholder'];
		if( isset( $options['readonly'] ) ) $this->readonly = $options['readonly'];
	}

	protected $input_classes = array( 'widefat', 'siteorigin-widget-input' );

	protected function render_text_input( $value ) {
		?>
		<input type="text" name="<?php echo $this->element_name ?>" id="<?php echo $this->element_id ?>"
		         value="<?php echo esc_attr( $value ) ?>"
		         <?php if( !empty( $this->input_classes ) ) : ?>
				    class="<?php implode( ' ', array_map('sanitize_html_class', $this->input_classes ) )?>"
				 <?php endif; ?>
			<?php if ( ! empty( $this->placeholder ) ) echo 'placeholder="' . $this->placeholder . '"' ?>
			<?php if( ! empty( $this->readonly ) ) echo 'readonly' ?> />
		<?php
	}

	protected function sanitize_field_input( $value ) {
		$sanitized_value = wp_kses_post( $value );
		$sanitized_value = balanceTags( $sanitized_value , true );
		return $sanitized_value;
	}
}