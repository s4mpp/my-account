<?php

namespace S4mpp\MyAccount;

use S4mpp\MyAccount\Page;
use S4mpp\MyAccount\Traits\TitleSluggable;

final class Panel
{
	use TitleSluggable;

	private $pages = [];

	private bool $allow_auto_register = false;

	public function __construct(private string $title, private string $guard, private string $controller)
	{}

	public function addPage(string | Page $title_or_page, string $view = null)
	{
		$page = is_a($title_or_page, Page::class) ? $title_or_page : new Page($title_or_page, $view);
		
		$this->pages[$page->getSlug()] = $page;

		return $this;
	}

	public function allowAutoRegister()
	{
		$this->allow_auto_register = true;

		return $this;
	}

	public function hasAutoRegister()
	{
		return $this->allow_auto_register;
	}

	public function getController(): string
	{
		return $this->controller;
	}

	public function getPages(): array
	{
		return $this->pages;
	}

	public function getGuard(): string
	{
		return $this->guard;
	}

	public function getMenu(string $slug_panel): array
	{
		foreach($this->pages as $page)
		{
			$route = $page->getRouteName($slug_panel);

			$menu[] = [
				'title' => $page->getTitle(),
				'slug' => $page->getSlug(),
				'route' => $route,
			];
		}

		foreach($menu ?? [] as $i => $menu_item)
		{
			$menu[$i]['active'] = self::menuIsActive($menu_item['route']);
		}

		return $menu ?? [];
	}

	private static function menuIsActive(string $route): bool
	{
		$current_route = request()->route()->action['as'];

		$route_path = explode('.', $current_route);

		$current_route_prefix = join('.', [$route_path[0] ?? null, $route_path[1] ?? null, $route_path[2] ?? null, $route_path[3] ?? null]);

		return (($route == $current_route) || strpos($route, $current_route_prefix.'.') !== false);
	}
}