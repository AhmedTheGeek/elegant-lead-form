<?php

namespace LEADGEN\Templates;

class Metabox_Template extends ATemplate {
	protected $name = "customer_metabox";

	public function set_template_name( $name ) {
		$this->name = $name;
	}
}
