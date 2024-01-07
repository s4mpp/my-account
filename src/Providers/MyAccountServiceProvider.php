<?php

namespace S4mpp\MyAccount\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use S4mpp\MyAccount\Components\CardSetting;
use S4mpp\MyAccount\Livewire\ChangePassword;
use S4mpp\MyAccount\Livewire\ChangePersonalData;

class MyAccountServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../../views', 'my-account');

        Livewire::component('change-password', ChangePassword::class);
        Livewire::component('change-personal-data', ChangePersonalData::class);

        Blade::component('card-setting', CardSetting::class, 'my-account');
    }
}