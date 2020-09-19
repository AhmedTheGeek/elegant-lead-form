<?php

namespace LEADGEN\Templates\Builder;

use LEADGEN\Templates\ATemplate;
use LEADGEN\Templates\IEngine;

abstract class AField extends ATemplate {

	protected $name = "field";
	private $display_name;
	private $field_name;
	private $form_id;
	private $type;
	private $value;

	public function __construct( IEngine $engine, $name, $display_name, $type, $value = null ) {
		parent::__construct( $engine );
		$this->field_name   = $name;
		$this->display_name = $display_name;
		$this->type         = $type;
		$this->value        = $value;
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
			'value'        => esc_attr( $this->value )
		];

		return $this->engine->render( $this->name, $context );
	}
}
