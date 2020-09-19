<?php

namespace LEADGEN\Templates;

use Mustache_Engine as Engine;
use Mustache_Loader_FilesystemLoader;

class Mustache_Engine implements IEngine {
	private $engine;

	public function __construct() {
		$loader       = new Mustache_Loader_FilesystemLoader( LEADGEN_PATH . '/static/views' );
		$this->engine = new Engine( [
			'loader' => $loader
		] );
	}

	public function render( string $template, $data = [] ): string {
		return $this->engine->render( $template, $data );
	}
}
