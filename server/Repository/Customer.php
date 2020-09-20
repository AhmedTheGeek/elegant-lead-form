<?php

namespace LEADGEN\Repository;

use LEADGEN\Models\Customer as Customer_Entity;
use LEADGEN\Factory\Customer as Customer_Factory;

class Customer implements IRepository {
	public const NAME = "elegant_customer_name";
	public const PHONE = "elegant_customer_phone";
	public const EMAIL = "elegant_customer_email";
	public const BUDGET = "elegant_customer_budget";
	public const MESSAGE = "elegant_customer_message";
	public const DATE = "elegant_customer_date";

	private $factory;

	public function __construct( Customer_Factory $factory ) {
		$this->factory = $factory;
	}

	/**
	 * @param Customer_Entity $entity
	 */
	public function add( $entity ): void {
		if ( $entity->get_id() === null ) {
			$post_args = [
				'post_title'  => $entity->get_name(),
				'post_status' => 'private',
				'post_type'   => LEADGEN_CPT_SLUG
			];

			$post_id = wp_insert_post( $post_args );
			$entity->set_id( $post_id );
		} else {
			wp_update_post( array(
				'ID'          => $entity->get_id(),
				'post_status' => 'private',
			) );
		}

		$post_meta_fields = [
			self::NAME    => $entity->get_name(),
			self::PHONE   => $entity->get_phone_number(),
			self::EMAIL   => $entity->get_email(),
			self::BUDGET  => $entity->get_budget(),
			self::MESSAGE => $entity->get_message(),
			self::DATE    => $entity->get_date(),
		];

		foreach ( $post_meta_fields as $meta_key => $meta_value ) {
			update_post_meta( $entity->get_id(), $meta_key, $meta_value );
		}
	}

	public function delete( $entity ): void {
		// TODO: Implement delete() method.
	}

	public function update( $entity ): void {
		// TODO: Implement edit() method.
	}

	public function get( $id = null ) {
		$customer = $this->factory->build();
		$post     = get_post( $id );

		if ( $post === null ) {
			return null;
		}

		$customer->set_id( $id );
		$customer->set_name( $post->post_title );
		$customer->set_phone_number( get_post_meta( $id, self::PHONE, true ) );
		$customer->set_date( get_post_meta( $id, self::DATE, true ) );
		$customer->set_budget( get_post_meta( $id, self::BUDGET, true ) );
		$customer->set_message( get_post_meta( $id, self::MESSAGE, true ) );
		$customer->set_email( get_post_meta( $id, self::EMAIL, true ) );

		return $customer;
	}
}
