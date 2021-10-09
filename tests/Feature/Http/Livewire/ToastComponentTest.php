<?php

declare(strict_types=1);

use Livewire\Livewire;
use Usernotnull\Toast\Http\Livewire\ToastComponent;
use Usernotnull\Toast\Notification;
use Usernotnull\Toast\NotificationType;
use Usernotnull\Toast\ToastManager;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

it('renders correctly and updates global render state', function () {
    assertFalse(ToastManager::componentRendered());

    Livewire::test(ToastComponent::class)
        ->assertSee('x-data')
        ->assertSee('ToastComponent');

    assertTrue(ToastManager::componentRendered());
});

it('receives notifications on livewire component', function () {
    $message = 'testing info';
    $title = 'title info';

    $notificationArray = Notification::make($message, $title);

    toast()
        ->info($message, $title)
        ->push();

    $component = Livewire::test(ToastComponent::class);

    assertEquals($component->get('toasts'), [$notificationArray]);
});

it('renders and pulls data in a blade view', function () {
    expect(ToastManager::componentRendered())
        ->toBeFalse()
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse();

    $this->get('base-call-from-blade')
        ->assertOk();

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
