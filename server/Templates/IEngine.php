<?php
namespace LEADGEN\Templates;

interface IEngine {
	public function render(string $template, $data = []): string;
}
