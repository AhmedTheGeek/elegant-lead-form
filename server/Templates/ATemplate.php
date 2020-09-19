<?php

namespace LEADGEN\Templates;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

abstract class ATemplate {
	protected $name;
	protected $engine;

	public function __construct( IEngine $engine ) {
		$this->engine = $engine;
	}

	public function render( $data = [] ): string {
		return $this->engine->render( $this->name, $data );
	}
}
