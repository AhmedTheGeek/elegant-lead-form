<?php

namespace LEADGEN\Factory;

use LEADGEN\Models\Customer as Customer_Model;

class Customer {
	public function build() {
		return new Customer_Model();
	}
}
