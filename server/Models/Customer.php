<?php

namespace LEADGEN\Models;

class Customer {
	private $id;
	private $name;
	private $phone_number;
	private $email;
	private $budget;
	private $message;
	private $date;

	public function set_id( $id ) {
		$this->id = $id;
	}

	public function set_date( $date ) {
		$this->date = $date;
	}

	public function set_name( $name ) {
		$this->name = $name;
	}

	public function set_phone_number( $phone_number ) {
		$this->phone_number = $phone_number;
	}

	public function set_email( $email ) {
		$this->email = $email;
	}

	public function set_budget( $budget ) {
		$this->budget = $budget;
	}

	public function set_message( $message ) {
		$this->message = $message;
	}

	public function get_name() {
		return $this->name;
	}

	public function get_phone_number() {
		return $this->phone_number;
	}

	public function get_email() {
		return $this->email;
	}

	public function get_budget() {
		return $this->budget;
	}

	public function get_message() {
		return $this->message;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_date() {
		return $this->date;
	}
}
