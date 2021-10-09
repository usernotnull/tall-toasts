<?php

declare(strict_types=1);

use Livewire\Livewire;
use Usernotnull\Toast\Http\Livewire\ToastComponent;
use Usernotnull\Toast\ToastManager;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

it('only pulls toasts when x-toasts is missing', function () {
    toast()
        ->info('test')
        ->push();

    assertTrue(ToastManager::hasPendingToasts());

    createFakeComponent();

    assertFalse(ToastManager::hasPendingToasts());

    Livewire::test(ToastComponent::class);

    toast()
        ->info('test')
        ->push();

    assertTrue(ToastManager::hasPendingToasts());

    createFakeComponent();

    assertTrue(ToastManager::hasPendingToasts());
});
