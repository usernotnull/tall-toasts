# Changelog

All notable changes will be documented in this file.

## v1.7.0 - Mar 5, 2023

Added Feature: Per notification duration.
Please look at the readme for examples of adding duration and sticky behavior (toast won't disappear except if clicked).

## v1.6.0 - Feb 17, 2023

- Support for Laravel 10
- Minor fix for dark styled toast on mouse hover

## v1.5.1 - Aug 11, 2022

Minor UI tweak to force toasts above tailwind's z-50 (toasts should always be above any UI as they offer temporary yet usually crucial information to the user that should not be hidden by other elements)

## v1.5.0 - May 19, 2022

- Added support for RTL
- Minor UI tweak for dark mode.

## v1.4.0 - Feb 9, 2022

Added support for Laravel v9.x

## 1.3.0 - 2021-11-20

-   **[FEATURE]** debug method added which will also print the result in the console (silent in a production environment)

```js
// JS
Toast.debug('I will NOT show in production! Locally, I will also log in console...', 'A Debug Message');
```

```php
// PHP
toast()
    ->debug('I will NOT show in production! Locally, I will also log in console...', 'A Debug Message')
    ->push();

// debug also accepts objects as message
toast()
    ->debug(User::factory()->createOne()->only(['name', 'email']), 'A User Dump')
    ->push();
```

## 1.2.1 - 2021-11-19

-   **[FIX]** Avoid showing 'undefined' as toast title/message in rare situations.

## 1.2.0 - 2021-11-09

-   **[FEATURE]** Sanitization of the toast title and message is now optional, and enabled by default.

```php
// PHP
toast()
    ->danger('I will go…<br><i>to the next line 💪</i>', 'I am <span style="color:red;">HOT</span>')
    ->doNotSanitize()
    ->push();
```

IF you have previously published the vendor views, you should re-publish them, or just change `x-text` to `x-html`
inside `includes\content.blade.php`

See the documentation's [Text Sanitization](https://github.com/usernotnull/tall-toasts#text-sanitization), and review
the
[security best practices](https://github.com/usernotnull/tall-toasts#security-vulnerabilities).

## 1.1.2 - 2021-11-07

-   **[FIX]** Fixed container view which was not allowing click-through between and around toasts.

## 1.1.1 - 2021-10-30

-   **[FIX]** Fixed a rare race condition between frontend and backend which caused infinite loop of livewire requests

## 1.1.0 - 2021-10-28

-   **[FEATURE]** Ability to delay toasts with pushOnNextPage()
-   **[FEATURE]** Make session keys configurable
-   **[FIX]** Issue with dispatchBrowserEvent if called in same livewire request with a toast notification

## 1.0.0 - 2021-10-01

-   Initial public release
