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
use function PHPUnit\Framework\assertStringContainsString;

it('pushes and pulls toasts via session', function () {
    expect(ToastManager::hasPendingToasts())->toBeFalse();

    ToastManager::info('testing info', 'title info')
        ->push();

    ToastManager::success('testing success', 'title success')
        ->push();

    ToastManager::warning('testing warning', 'title warning')
        ->push();

    ToastManager::danger('testing danger', 'title danger')
        ->push();

    expect(ToastManager::hasPendingToasts())->toBeTrue();

    $pulledToasts = ToastManager::pull();

    expect($pulledToasts)->toEqual([
        Notification::make('testing info', 'title info'),
        Notification::make('testing success', 'title success', NotificationType::$success),
        Notification::make('testing warning', 'title warning', NotificationType::$warning),
        Notification::make('testing danger', 'title danger', NotificationType::$danger),
    ]);

    expect(ToastManager::hasPendingToasts())->toBeFalse();
});

it('received toasts sent from controllers', function () {
    $this->get('base-call-from-controller')
        ->assertOk();

    assertEquals(ToastManager::pull(), [
        Notification::make('toast-from-controller', '', NotificationType::$success),
    ]);
});

it('received toasts sent from blade views', function () {
    $this->get('base-call-from-blade')
        ->assertOk();

    assertEquals(ToastManager::pull(), [
        Notification::make('toast-from-blade', '', NotificationType::$success),
    ]);
});

it('fetches script with blade directive', function () {
    $scriptDirective = Blade::compileString(ToastBladeDirectives::toastScripts(''));

    $scriptEval = eval(str_replace(['<?php echo', '?>'], ['return ', ';'], $scriptDirective));

    expect($scriptEval)->toContain(
        'src="/toast/tall-toast.js?id=',
        "document.addEventListener('alpine:init'",
        "directive('ToastComponent'",
    );
});

it('displays toast script tag with blade directive', function () {
    expect(ToastManager::componentRendered())
        ->toBeFalse()
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse();

    get('base-call-from-blade')->assertOk();

    expect(ToastManager::hasPendingToasts())->toBeTrue();

    $component = Livewire::test(ToastComponent::class);

    expect($component->get('toasts'))
        ->toEqual([
            Notification::make('toast-from-blade', '', NotificationType::$success),
        ])
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse()
        ->and(ToastManager::componentRendered())
        ->toBeTrue();
});

it('routes to the javascript', function () {
    $jsDate = File::lastModified(__DIR__ . '/../../dist/js/tall-toast.js');
    $serverDate = sprintf('%s GMT', gmdate('D, d M Y H:i:s', $jsDate ?: null));

    get('/toast/tall-toast.js', [
        'HTTP_IF_MODIFIED_SINCE' => $serverDate,
    ])->assertStatus(304);

    get('/toast/tall-toast.js.map')->assertOk();

    $jsContent = File::get(__DIR__ . '/../../dist/js/tall-toast.js');
    assertStringContainsString('this.toasts', $jsContent);
    assertStringContainsString('wireToasts', $jsContent);
});
