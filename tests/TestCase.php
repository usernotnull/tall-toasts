<?php

declare(strict_types=1);

namespace Usernotnull\Toast\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Route;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Usernotnull\Toast\ToastServiceProvider;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            ToastServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        //$app->
        //Artisan::call('view:clear');
        app('config')->set('view.paths', [
            __DIR__ . '/views',
        ]);

        config()->set('database.default', 'testing');

        config()->set('app.key', 'base64:MEN6dYh4I+H9slhb8LDhjZMY7bvU2Hme1EeHg9U789o=');

        Route::get('base-call-from-controller', function () {
            toast()
                ->success('toast-from-controller')
                ->push();

            return view('base');
        });

        Route::view('base', 'base');

        Route::view('base-with-toast', 'base-with-toast');

        Route::view('base-with-toast-call-from-blade', 'base-with-toast-call-from-blade');

        Route::view('base-call-from-blade', 'base-call-from-blade');
    }
}
