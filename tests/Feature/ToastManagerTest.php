<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Livewire\Livewire;
use Usernotnull\Toast\Http\Livewire\ToastComponent;
use Usernotnull\Toast\Notification;
use Usernotnull\Toast\NotificationType;
use Usernotnull\Toast\ToastBladeDirectives;
use Usernotnull\Toast\ToastManager;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertEquals;

it('receives toasts sent from controllers', function () {
    get('base-call-from-controller')->assertOk();

    assertEquals(ToastManager::pull(), [
        Notification::make('toast-from-controller', '', NotificationType::$success),
    ]);
});

it('received toasts sent from blade views', function () {
    get('base-call-from-blade')->assertOk();

    assertEquals(ToastManager::pull(), [
        Notification::make('toast-from-blade', '', NotificationType::$success),
    ]);
});

it('fetches script with blade directive', function () {
    $scriptDirective = Blade::compileString(ToastBladeDirectives::toastScripts(''));

    $scriptEval = eval(str_replace(['<?php echo', '?>'], ['return ', ';'], $scriptDirective));

    expect($scriptEval)->toContain(
        'src="/toast/tall-toasts.js?id=',
        "document.addEventListener('alpine:init'",
        "directive('ToastComponent'"
    );
});

it('displays toast script tag with blade directive', function () {
    expect(ToastManager::componentRendered())
        ->toBeFalse()
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse();

    get('base-call-from-blade')->assertOk();

    expect(ToastManager::hasPendingToasts())
        ->toBeTrue()
        ->and(Livewire::test(ToastComponent::class)
            ->get('toasts'))
        ->toEqual([
            Notification::make('toast-from-blade', '', NotificationType::$success),
        ])
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse()
        ->and(ToastManager::componentRendered())
        ->toBeTrue();
});

it('routes to the javascript', function () {
    $jsDate = File::lastModified(__DIR__ . '/../../dist/js/tall-toasts.js');
    $serverDate = sprintf('%s GMT', gmdate('D, d M Y H:i:s', $jsDate ?: null));

    get('/toast/tall-toasts.js', [
        'HTTP_IF_MODIFIED_SINCE' => $serverDate,
    ])->assertStatus(304);

    get('/toast/tall-toasts.js.map')->assertOk();

    expect(File::get(__DIR__ . '/../../dist/js/tall-toasts.js'))->toContain('this.toasts', 'wireToasts');
});
