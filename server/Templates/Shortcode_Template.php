<?php

namespace LEADGEN\Templates;

use LEADGEN\Repository\Customer;
use LEADGEN\Templates\Builder\Field;
use LEADGEN\Templates\Builder\Form;
use LEADGEN\Templates\Builder\Textarea;

class Shortcode_Template extends ATemplate {
	protected $name = "shortcode";

	public function render( $data = [] ): string {
		$form_id = $data['form_id'] ?? 'lead_form';

		$fields = [
			new Field( $this->engine, Customer::NAME, __( 'Name', LEADGEN_TEXT_DOMAIN ), 'text' ),
			new Field( $this->engine, Customer::PHONE, __( 'Phone Number', LEADGEN_TEXT_DOMAIN ), 'number' ),
			new Field( $this->engine, Customer::EMAIL, __( 'Email', LEADGEN_TEXT_DOMAIN ), 'email' ),
			new Field( $this->engine, Customer::BUDGET, __( 'Desired Budget', LEADGEN_TEXT_DOMAIN ), 'text' ),
			new Textarea( $this->engine, Customer::MESSAGE, __( 'Message', LEADGEN_TEXT_DOMAIN ), 'textarea' ),
		];

		return ( new Form( $form_id, $this->engine, $fields ) )->build();
	}
}
