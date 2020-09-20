<?php

namespace LEADGEN\Hooks;

use LEADGEN\Repository\IRepository;
use LEADGEN\Templates\Metabox_Template;

class Metabox implements IHook {
	private $post_type;
	/**
	 * @var Metabox_Template
	 */
	private $template;
	private $title;
	private $id;
	private $data;
	/**
	 * @var callable
	 */
	private $formatter;

	/**
	 * @var IRepository
	 */
	private $repository;

	public function __construct( Metabox_Template $template ) {
		$this->template = $template;
	}

	public function register(): void {
		add_action( 'add_meta_boxes', array( $this, 'define' ) );
	}

	public function define(): void {
		add_meta_box( $this->id, __( $this->title, LEADGEN_TEXT_DOMAIN ), [ $this, 'render' ], $this->post_type );
	}

	public function render( \WP_Post $post ): void {
		$this->template->set_template_name( $this->id );

		$post_data  = $this->repository->get( $post->ID );
		$this->data = $post_data;

		if ( $this->formatter !== null ) {
			$post_data = ( $this->formatter )( $post_data );
		}

		echo $this->template->render( $post_data );
	}

	public function set_post_type( $post_type ): void {
		$this->post_type = $post_type;
	}

	public function set_data( $data ): void {
		$this->data = $data;
	}

	public function set_title( $title ): void {
		$this->title = $title;
	}

	public function set_id( $id ): void {
		$this->id = $id;
	}

	public function set_repository( $repository ) {
		$this->repository = $repository;
	}

	public function set_formatter( callable $formatter ) {
		$this->formatter = $formatter;
	}
}
