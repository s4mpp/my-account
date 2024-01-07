<?php

use S4mpp\Laraguard\Routes;
use S4mpp\MyAccount\MyAccount;
use Illuminate\Support\Facades\Route;
use S4mpp\MyAccount\Controllers\MyAccountController;
use S4mpp\MyAccount\Controllers\PageController;
use S4mpp\MyAccount\Controllers\RegisterNewAccountController;

$route = Route::middleware('web');

$panels = MyAccount::getPanels();

foreach($panels as $panel)
{
	$route->prefix($panel->getSlug());
	
	$route->group(function() use ($panel)
	{
		Route::redirect('/', 'entrar');
		
		/**
		 * Authentication
		 */
		Route::controller($panel->getController())->group(function() use ($panel)
		{
			Routes::identifier('auth.'.$panel->getSlug())
			->authGroup()
			->forgotAndRecoveryPasswordGroup();
		});

		/**
		 * Register
		 */
		if($panel->hasAutoRegister())
		{
			Route::prefix('cadastro')->controller(RegisterNewAccountController::class)->group(function() use ($panel)
			{
				Route::get('/', 'index')->name('my-account.'.$panel->getSlug().'.register');
				Route::post('/salvar', 'save')->name('my-account.'.$panel->getSlug().'.register.save');
			});
		}

		/**
		 * Restricted area
		 */
		Route::middleware('web', 'auth:'.$panel->getGuard())->group(function() use ($panel)
		{
			/**
			 * Pages
			 */
			foreach($panel->getPages() as $page)
			{
				if($page->hasController())
				{
					Route::get($page->getSlug(), [$page->getController(), $page->getMethod()])->name($page->getRouteName($panel->getSlug()));
				
					continue;
				}

				Route::get($page->getSlug(), [PageController::class, 'index'])->name($page->getRouteName($panel->getSlug()));
			}

			/**
			 * My Account
			 */
			Route::get('minha-conta', [MyAccountController::class, 'myAccount'])->name('my-account.'.$panel->getSlug());
		});
	});
}

