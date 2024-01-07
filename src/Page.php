<?php

namespace S4mpp\MyAccount;

use App\Http\Controllers\Controller;
use S4mpp\MyAccount\Traits\TitleSluggable;

final class Page
{
	use TitleSluggable;

	private string $controller;

	private string $method;

	public function __construct(private string $title, private ?string $view = null)
	{}

	public function controller(string $controller, string $method = 'index')
	{
		$this->controller = $controller;

		$this->method = $method;

		return $this;
	}

	public function getController(): string
	{
		return $this->controller;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function hasController(): bool
	{
		return isset($this->controller);
	}

	public function getRouteName(string $panel_slug): string
	{
		return 'my-account.'.$panel_slug.'.page.'.$this->getSlug();
	}
}