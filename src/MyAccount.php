<?php

namespace S4mpp\MyAccount;

use S4mpp\MyAccount\Panel;
use S4mpp\Laraguard\Facades\RoutesGuard;

abstract class MyAccount
{
	private static $panels = [];

	public static function create(string $title, string $guard, string $controller)
	{
		$panel = new Panel($title, $guard, $controller);

		self::$panels[] = $panel;

		return $panel;
	}

	public static function getPanels(): array
	{
		return self::$panels;
	}

	public static function getPanel(string $needle): ?Panel
	{
		foreach(self::$panels as $panel)
		{
			if($panel->getSlug() != $needle)
			{
				continue;
			}
			
			return $panel;
		}

		return null;
	}

	public static function view(string $title, string $view_path)
	{
		$panel = self::getCurrentPanel();

		$pages = $panel->getPages();

        $menu = $panel->getMenu($panel->getSlug());

        $auth_identifier = 'auth.'.$panel->getSlug();

        $logout_url = route(RoutesGuard::identifier($auth_identifier)->logout());

        $my_account_url = route('my-account.'.$panel->getSlug());
        
        return view($view_path, compact('menu', 'auth_identifier', 'pages', 'panel', 'title', 'logout_url', 'my_account_url'));
	}

	public static function getCurrentPanel(): Panel
    {
        $path = request()->route()->action['as'];

        $path_steps = explode('.', $path);

        $panel = MyAccount::getPanel($path_steps[1]);

        if(!$panel)
        {
            abort(404);
        }

        return $panel;
    }

	public static function getCurrentPage(): Page
    {
		$current_panel = self::getCurrentPanel();

        $path_steps = explode('.', request()->route()->action['as']);
		
		$pages = $current_panel->getPages();

        $page = $pages[$path_steps[3]] ?? null;

        if(!$page)
        {
            abort(404);
        }

        return $page;
    }
}