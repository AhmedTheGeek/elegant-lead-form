<?php
use PHPUnit\Framework\TestCase;
use LEADGEN\Factory\Customer;

class FactoryTest extends TestCase {
	public function test_build() {
		$subject = new Customer();
		$customer = $subject->build();
		$this->assertInstanceOf(\LEADGEN\Models\Customer::class, $customer);
	}
}
