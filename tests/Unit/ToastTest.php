<?php

declare(strict_types=1);

use Usernotnull\Toast\Notification;
use Usernotnull\Toast\NotificationType;
use Usernotnull\Toast\ToastManager;

it('pushes and pulls toasts via session', function () {
    expect(ToastManager::hasPendingToasts())->toBeFalse();

    toast()
        ->info('testing info', 'title info')
        ->push();

    toast()
        ->success('testing success', 'title success')
        ->push();

    toast()
        ->warning('testing warning', 'title warning')
        ->push();

    ToastManager::danger('testing danger', 'title danger')
        ->push();

    expect(ToastManager::hasPendingToasts())
        ->toBeTrue()
        ->and(ToastManager::pull())
        ->toEqual([
            Notification::make('testing info', 'title info'),
            Notification::make('testing success', 'title success', NotificationType::$success),
            Notification::make('testing warning', 'title warning', NotificationType::$warning),
            Notification::make('testing danger', 'title danger', NotificationType::$danger),
        ])
        ->and(ToastManager::hasPendingToasts())
        ->toBeFalse();

    toast()
        ->info('testing next page', 'title')
        ->pushOnNextPage();

    expect(ToastManager::hasPendingToasts())
        ->toBeFalse()
        ->and(ToastManager::pullNextPage())
        ->toEqual([Notification::make('testing next page', 'title')]);
});

it('sanitizes by default', function () {
    $message = 'a<br><b>b</b>c';
    $title = 'd<br><b>e</b>f';

    toast()
        ->info($message, $title)
        ->push();

    $toast = ToastManager::pull()[0];

    expect($toast['message'])
        ->toEqual(htmlspecialchars($message, ENT_QUOTES))
        ->and($toast['title'])
        ->toEqual(htmlspecialchars($title, ENT_QUOTES));
});

it('skips sanitization when required', function () {
    $message = 'a<br><b>b</b>c';
    $title = 'd<br><b>e</b>f';

    toast()
        ->info($message, $title)
        ->doNotSanitize()
        ->push();

    $toast = ToastManager::pull()[0];

    expect($toast['message'])
        ->toEqual($message)
        ->and($toast['title'])
        ->toEqual($title);
});
