<?php

namespace LEADGEN\Hooks;

use LEADGEN\Templates\Shortcode_Template;

class Shortcode implements IHook {
	private const SHORTCODE = 'elegant_lead';

	/**
	 * @var Shortcode_Template
	 */
	private $template;

	public function __construct( Shortcode_Template $template ) {
		$this->template = $template;
	}

	public function register(): void {
		add_action( 'init', array( $this, 'define' ) );
	}

	public function define(): void {
		add_shortcode( self::SHORTCODE, array( $this, 'render' ) );
	}

	public function render( $atts ): string {
		return $this->template->render( $atts );
	}
}
