<?php

namespace ANCENC;

use Auryn\Injector;
use LEADGEN\Hooks\FormAjax;
use LEADGEN\Hooks\PublicDependencies;
use LEADGEN\Hooks\Shortcode;
use LEADGEN\Hooks\PostType;
use LEADGEN\Templates\ATemplate;
use LEADGEN\Templates\IEngine;
use LEADGEN\Templates\Mustache_Engine as Template_Engine;

$injector = new Injector();

//change the injection alias at any time to change the templates engine
$injector->alias(IEngine::class, Template_Engine::class);

//make all hooks and register them
$hooks = [
	$injector->make( FormAjax::class ),
	$injector->make( PublicDependencies::class ),
	$injector->make( PostType::class ),
	$injector->make( Shortcode::class ),
];

foreach ( $hooks as $hook ) {
	$hook->register();
}
