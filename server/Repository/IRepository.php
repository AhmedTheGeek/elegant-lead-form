<?php

namespace LEADGEN\Repository;

interface IRepository {
	public function get($id = null);

	public function add( $entity ): void;

	public function update( $entity ): void;

	public function delete( $entity ): void;
}
