# Changelog

All notable changes will be documented in this file.

## 1.2.1 - 2021-11-19

-   **[FIX]** Avoid showing 'undefined' as toast title/message in rare situations.

## 1.2.0 - 2021-11-09

-   **[FEATURE]** Sanitization of the toast title and message is now optional, and enabled by default.

```php
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
