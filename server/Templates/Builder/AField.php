<?php

namespace LEADGEN\Templates\Builder;

use LEADGEN\Templates\ATemplate;
use LEADGEN\Templates\IEngine;

abstract class AField extends ATemplate {

	protected $name = "field";
	protected $display_name;
	protected $field_name;
	protected $form_id;
	protected $type;
	protected $value;
	protected $max_length;

	public function __construct( IEngine $engine, $name, $display_name, $type, $value = null, $max_length = 255 ) {
		parent::__construct( $engine );
		$this->field_name   = $name;
		$this->display_name = sanitize_text_field( $display_name );
		$this->type         = $type;
		$this->value        = $value;
		$this->max_length   = $max_length;
	}

	public function set_display_name( $display_name ) {
		$this->display_name = $display_name;
	}

	public function set_name( $name ) {
		$this->field_name = $name;
	}

	public function set_form_id( $form_id ) {
		$this->form_id = $form_id;
	}

	public function set_type( $type ) {
		$this->type = $type;
	}

	public function render( $data = [] ): string {
		$context = [
			'form_id'      => esc_attr( $this->form_id ),
			'name'         => esc_attr( $this->field_name ),
			'display_name' => esc_attr( $this->display_name ),
			'type'         => esc_attr( $this->type ),
			'value'        => esc_attr( $this->value ),
			'max_length'   => esc_attr( $this->max_length )
		];

		return $this->engine->render( $this->name, $context );
	}
}
