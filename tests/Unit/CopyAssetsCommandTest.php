<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

it('can copy assets to public folder', function () {
    expect(File::exists(public_path('/toast/tall-toasts.js')))->toBeFalse();

    Artisan::call('tall-toasts:assets');

    expect(File::exists(public_path('/toast/tall-toasts.js')))->toBeTrue();
});
