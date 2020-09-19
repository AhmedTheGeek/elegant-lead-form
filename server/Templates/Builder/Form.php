<?php

namespace LEADGEN\Templates\Builder;

use LEADGEN\Repository\Customer;
use LEADGEN\Templates\IEngine;

class Form {
	/**
	 * @var AField[]
	 */
	private $fields;
	private $form_id;
	private $engine;
	private $nonce;

	public function __construct( $form_id, IEngine $engine, $fields = [] ) {
		$this->fields  = $fields;
		$this->form_id = $form_id;
		$this->engine  = $engine;

		$this->nonce = wp_create_nonce( 'elegant_form_' . $form_id );
	}

	public function get_form_date() {
		$date = wp_remote_get( 'http://worldtimeapi.org/api/timezone/Egypt' );

		if ( ! is_wp_error( $date ) ) {
			$date = json_decode( $date['body'], true );
			$date = $date['datetime'];
		} else {
			$date = '';
		}

		return $date;
	}

	public function enqueue_scripts(): void {
		wp_enqueue_script( sprintf( '%s_form_script', LEADGEN_ASSETS_HANDLE ) );
	}

	public function build(): string {
		$output = '';

		$this->fields[] = new Hidden( $this->engine, 'nonce', null, 'hidden', $this->nonce );
		$this->fields[] = new Hidden( $this->engine, Customer::DATE, null, 'hidden', $this->get_form_date() );
		$this->fields[] = new Button( $this->engine, 'submit', __( "Submit Form", LEADGEN_TEXT_DOMAIN ), null );

		foreach ( $this->fields as $field ) {
			$field->set_form_id( $this->form_id );
			$output .= $field->render();
		}

		$this->enqueue_scripts();

		return $this->engine->render( 'form', [
			'children' => $output,
			'nonce'    => $this->nonce,
			'form_id'  => $this->form_id
		] );
	}
}
