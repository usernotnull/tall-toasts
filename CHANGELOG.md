# Changelog

All notable changes will be documented in this file.

## 1.1.2 - 2021-11-07

### Fixes

-   Fixed container view which was not allowing click-through between and around toasts.

## 1.1.1 - 2021-10-30

### Fixes

-   Fixed a rare race condition between frontend and backend which caused infinite loop of livewire requests

## 1.1.0 - 2021-10-28

### New Features

-   Ability to delay toasts with pushOnNextPage()
-   Make session keys configurable

### Fixes

-   Issue with dispatchBrowserEvent if called in same livewire request with a toast notification

## 1.0.0 - 2021-10-01

-   initial public release
