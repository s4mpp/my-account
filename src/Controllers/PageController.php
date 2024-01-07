<?php

namespace S4mpp\MyAccount\Controllers;

use S4mpp\MyAccount\Page;
use S4mpp\MyAccount\Panel;
use S4mpp\MyAccount\MyAccount;
use App\Http\Controllers\Controller;

final class PageController extends Controller
{
    public function index()
    {
        $page =  MyAccount::getCurrentPage();

        return MyAccount::view($page->getTitle(), 'my-account::pages.page');
    }
}