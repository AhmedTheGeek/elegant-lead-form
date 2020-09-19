<?php

namespace LEADGEN\Hooks;

interface IHook {
	public function register(): void;
	public function define(): void;
}
