<?php

namespace S4mpp\MyAccount\Controllers;

use S4mpp\MyAccount\Page;
use S4mpp\MyAccount\Panel;
use S4mpp\MyAccount\MyAccount;
use App\Http\Controllers\Controller;
use S4mpp\Laraguard\Facades\RoutesGuard;

final class MyAccountController extends Controller
{
    public function myAccount()
    {
        return MyAccount::view('Minha conta', 'my-account::pages.my-account');
    }
}