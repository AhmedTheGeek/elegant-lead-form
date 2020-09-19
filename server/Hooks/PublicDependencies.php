<?php

namespace LEADGEN\Hooks;

class PublicDependencies implements IHook {

	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'define' ) );
	}

	public function define(): void {
		$handle           = sprintf( '%s_form_script', LEADGEN_ASSETS_HANDLE );
		$localized_script = [
			'ajax_url' => admin_url( 'admin-ajax.php' )
		];
		wp_register_script( $handle, LEADGEN_URL . '/public/js/form.js' );
		wp_localize_script( $handle, 'elegant_lead', $localized_script );
	}
}
