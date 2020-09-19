<?php

namespace LEADGEN\Hooks;

use LEADGEN\Repository\Customer as Customer_Repository;
use LEADGEN\Factory\Customer as Customer_Factory;

class FormAjax implements IHook {
	private const ACTION_NAME = 'elegant_form_action';
	private $customer_repository;
	private $customer_factory;

	public function __construct( Customer_Repository $repository, Customer_Factory $factory ) {
		$this->customer_repository = $repository;
		$this->customer_factory    = $factory;
	}

	public function register(): void {
		add_action( sprintf( 'wp_ajax_%s', self::ACTION_NAME ), array( $this, 'define' ) );
	}

	private function get_request_field( $field, $form_id ) {
		$field_name = sprintf( '%s_%s', $form_id, $field );

		return sanitize_text_field( $_POST[ $field_name ] ) ?? '';
	}

	public function define(): void {
		$nonce_field = $_POST['form_id'] . '_nonce';
		if ( ! isset( $_POST['form_id'], $_POST[ $nonce_field ] ) || ! wp_verify_nonce( $_POST[ $_POST['form_id'] . '_nonce' ], sprintf( 'elegant_form_%s', $_POST['form_id'] ) ) ) {
			wp_send_json_error();

			return;
		}
		$form_id  = $_POST['form_id'];
		$customer = $this->customer_factory->build();

		$customer->set_email( $this->get_request_field( $this->customer_repository::EMAIL, $form_id ) );
		$customer->set_name( $this->get_request_field( $this->customer_repository::NAME, $form_id ) );
		$customer->set_message( $this->get_request_field( $this->customer_repository::MESSAGE, $form_id ) );
		$customer->set_budget( $this->get_request_field( $this->customer_repository::BUDGET, $form_id ) );
		$customer->set_date( $this->get_request_field( $this->customer_repository::DATE, $form_id ) );
		$customer->set_phone_number( $this->get_request_field( $this->customer_repository::PHONE, $form_id ) );

		$this->customer_repository->add( $customer );

		wp_send_json_success( [
			'hi' => "baby"
		] );
	}

}
