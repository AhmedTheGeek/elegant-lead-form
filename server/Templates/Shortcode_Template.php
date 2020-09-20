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

		$name_display    = $data['name_title'] ?? __( 'Name', LEADGEN_TEXT_DOMAIN );
		$phone_display   = $data['phone_title'] ?? __( 'Phone Number', LEADGEN_TEXT_DOMAIN );
		$email_display   = $data['email_title'] ?? __( 'Email', LEADGEN_TEXT_DOMAIN );
		$budget_display  = $data['budget_title'] ?? __( 'Desired Budget', LEADGEN_TEXT_DOMAIN );
		$message_display = $data['message_title'] ?? __( 'Message', LEADGEN_TEXT_DOMAIN );

		$name_length    = $data['name_length'] ?? 255;
		$phone_length   = $data['phone_length'] ?? 255;
		$email_length   = $data['email_length'] ?? 255;
		$budget_length  = $data['budget_length'] ?? 255;
		$message_length = $data['message_length'] ?? 1020;

		$message_cols = $data['message_cols'] ?? 30;
		$message_rows = $data['message_rows'] ?? 10;

		$fields = [
			new Field( $this->engine, Customer::NAME, $name_display, 'text', null, $name_length ),
			new Field( $this->engine, Customer::PHONE, $phone_display, 'number', null, $phone_length ),
			new Field( $this->engine, Customer::EMAIL, $email_display, 'email', null, $email_length ),
			new Field( $this->engine, Customer::BUDGET, $budget_display, 'text', null, $budget_length ),
			new Textarea( $this->engine, Customer::MESSAGE, $message_display, 'textarea', null, $message_length, $message_cols, $message_rows ),
		];

		return ( new Form( $form_id, $this->engine, $fields ) )->build();
	}
}
