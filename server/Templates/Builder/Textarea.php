<?php

namespace LEADGEN\Templates\Builder;

use LEADGEN\Templates\IEngine;

class Textarea extends AField {
	protected $name = "textarea";
	private $columns;
	private $rows;

	public function __construct( IEngine $engine, $name, $display_name, $type, $value = null, $max_length = 255, $columns = 30, $rows = 10 ) {
		parent::__construct( $engine, $name, $display_name, $type, $value, $max_length );
		$this->columns = $columns;
		$this->rows    = $rows;
	}

	public function render( $data = [] ): string {
		$context = [
			'form_id'      => esc_attr( $this->form_id ),
			'name'         => esc_attr( $this->field_name ),
			'display_name' => esc_attr( $this->display_name ),
			'type'         => esc_attr( $this->type ),
			'value'        => esc_attr( $this->value ),
			'max_length'   => esc_attr( $this->max_length ),
			'columns'      => esc_attr( $this->columns ),
			'rows'         => esc_attr( $this->rows ),
		];

		return $this->engine->render( $this->name, $context );
	}
}
