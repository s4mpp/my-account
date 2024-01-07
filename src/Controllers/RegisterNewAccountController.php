<?php

namespace S4mpp\MyAccount\Controllers;

use S4mpp\MyAccount\MyAccount;
use App\Http\Controllers\Controller;
use S4mpp\Laraguard\Facades\RoutesGuard;

final class RegisterNewAccountController extends Controller
{
	public function index()
	{
		$panel = MyAccount::getCurrentPanel();

		$title = 'Cadastro';

		$login_url = route(RoutesGuard::identifier('auth.'.$panel->getSlug())->logout());

		$register_post_url = route('my-account.'.$panel->getSlug().'.register.save');

		return view('my-account::auth.register', compact('panel', 'title', 'login_url', 'register_post_url'));
	}
}