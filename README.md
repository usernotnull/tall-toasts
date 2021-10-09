<div align="center">

# Beautiful Notification Toasts For Laravel

A Toast global that can be called from the backend (via Controllers, Blade Views, Components) or frontend (JS, Alpine
Components) to render customizable toasts.

Runs with the TALL stack: [Laravel](https://laravel.com/docs/8.x/installation),
[TailwindCSS](https://tailwindcss.com/docs/guides/laravel),
[Livewire](https://laravel-livewire.com/docs/2.x/installation),
[AlpineJS](https://alpinejs.dev/essentials/installation).

[![Latest Version on Packagist](https://img.shields.io/packagist/v/usernotnull/tall-toast.svg?style=plastic)](https://packagist.org/packages/usernotnull/tall-toast)
[![Build size Brotli](https://img.badgesize.io/usernotnull/tall-toast/main/dist/js/tall-toast.js.svg?compression=brotli&style=plastic&color=green&label=JS%20size)](https://github.com/usernotnull/tall-toast/blob/main/dist/js/tall-toast.js)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg?style=plastic&label=license)](https://opensource.org/licenses/MIT)
[![Total Downloads](https://img.shields.io/packagist/dt/usernotnull/tall-toast.svg?style=plastic)](https://packagist.org/packages/usernotnull/tall-toast)  
[![Scrutinizer Score](https://img.shields.io/scrutinizer/g/usernotnull/tall-toast.svg?style=plastic&label=scrutinizer%20score)](https://scrutinizer-ci.com/g/usernotnull/tall-toast)
[![Codacy branch grade](https://img.shields.io/codacy/grade/8cfed96c2dfc4409864afb6919cef1ed/main?style=plastic)](https://www.codacy.com/gh/usernotnull/tall-toast/dashboard?utm_source=github.com&utm_medium=referral&utm_content=usernotnull/tall-toast&utm_campaign=Badge_Grade)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/usernotnull/tall-toast/tests?label=tests&style=plastic)](https://github.com/usernotnull/tall-toast/actions/workflows/run-tests.yml)
[![Codacy branch coverage](https://img.shields.io/codacy/coverage/8cfed96c2dfc4409864afb6919cef1ed/main?style=plastic)](https://www.codacy.com/gh/usernotnull/tall-toast/dashboard?utm_source=github.com&utm_medium=referral&utm_content=usernotnull/tall-toast&utm_campaign=Badge_Coverage)
[![Checks](https://img.shields.io/github/workflow/status/usernotnull/tall-toast/run-checks?label=checks&style=plastic)](https://github.com/usernotnull/tall-toast/actions/workflows/checks.yml)
[![Styling](https://img.shields.io/github/workflow/status/usernotnull/tall-toast/fix-styling?label=styling&style=plastic)](https://github.com/usernotnull/tall-toast/actions/workflows/styling.yml)

Light | Dark
------------ | -------------
![toast-light](/.github/images/light.gif) | ![toast-dark](/.github/images/dark.gif)

</div>

## Why

If you are building a web app with the TALL stack, you must choose this library over the other outdated libraries
available:

### Size does matter

Since the frontend is a pure AlpineJS component with no reliance on external JS libs, and since the backend handles most
of the logic, the javascript footprint is
tiny [(less than ONE kilobyte!)](https://img.badgesize.io/usernotnull/tall-toast/master/dist/tall-toast.js.svg?compression=brotli&style=plastic&color=green)
.

The CSS footprint is also negligible as it uses the default TailwindCSS classes. Even if you override the default views,
you will rest assured that Tailwind's purging will only keep the styles/classes you have used.

In plain English, it will not bloat your generated JS/CSS files nor add extra files to download as when using other JS
libs!

### Takes advantage of all the niceties that come with TALL

Very easy to use!  
Memorize `Toast` for the frontend and `toast()` for the backend.

You can call it from anywhere [see the examples section](#usage).

### Customizable

You have control over the view.  
As you are overriding the blade view, you'll be able to shape it as you like using TailwindCSS classes.  
No more messing with custom CSS overrides!

## Usage

### From The Frontend

```js
Toast.info('Notification from the front-end...', 'The Title');

Toast.success('A toast without a title also works');

Toast.warning('Watch out!');

Toast.danger('I warned you!', 'Yikes');
```

### From The Backend

```php
toast()
    ->info('Notification from the backend...', 'The Title')
    ->push();

toast()
    ->success('A toast without a title also works')
    ->push();

toast()
    ->warning('Watch out!')
    ->push();

toast()
    ->danger('I warned you!', 'Yikes')
    ->push();
```

You can call the above toast helper from controllers, blade views, and components.

**To properly call it from inside livewire components, add the trait:**

```php
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class DemoComponent extends Component
{
    use WireToast; // <-- add this
```

*Video tutorial and walk-through coming soon!*

## Support Me

I plan on developing many open-source packages using the TALL stack.  
Consider supporting my work by tweeting about this library or by contributing to this package.

Check out the list of other packages I built for the TALL stack [Other Packages](#other-packages).  
To stay updated, [follow me on Twitter](https://twitter.com/usernotnull).

## Requirements

Dependency | Version | Comment
----|----|----
PHP | ^8.0
Laravel | ^8.0 | [Official Installation Docs](https://laravel.com/docs/8.x/installation)
TailwindCSS | ^2.0 |[Official Installation Docs](https://tailwindcss.com/docs/guides/laravel)
Livewire | ^2.0 | [Official Installation Docs](https://laravel-livewire.com/docs/2.x/installation)
AlpineJS | ^3.0 | [Official Installation Docs](https://alpinejs.dev/essentials/installation)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require usernotnull/tall-toast
```

## Setup

### TailwindCSS

Build your CSS as you usually do, ie

```bash
npm run dev
```

#### Usage With Tailwind [Just-in-Time Mode](https://tailwindcss.com/docs/just-in-time-mode)

Add these additional lines into your `tailwind.config.js` file:

```js
purge: [
    './vendor/usernotnull/tall-toast/config/**/*.php',
    './vendor/usernotnull/tall-toast/resources/views/**/*.blade.php',
    // etc...
]
```

This way, Tailwind JIT will include the classes used in this library in your CSS.

*As usual, if the content of `tailwind.config.js` changes, you should re-run the npm command.*

### AlpineJS

Add the ToastComponent to AlpineJS either as an npm module or with a script tag.

#### Option 1: NPM Module

Add the AlpineJS Toast component by changing your app.js file to match:

```js
import Alpine from "alpinejs"
import ToastComponent from '../../vendor/usernotnull/tall-toast/dist/js/tall-toast'

Alpine.data('ToastComponent', ToastComponent)

window.Alpine = Alpine
Alpine.start()
```

*If you have a custom directory structure, you may have to adjust the above import path until it correctly points
to `tall-toast.js` inside this vendor file.*

#### Option 2: Script Tag

Add the `@toastScripts` blade directive *BEFORE* importing AlpineJS:

-   If you imported AlpineJS from a script tag:

```html
@toastScripts
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
```

-   If you installed AlpineJS as an NPM Module:

```html
@toastScripts
<script src="{{ mix('js/app.js') }}" defer></script>
```

### The View

Add `<livewire:toasts />` **as high as possible** in the body tag, ie:

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metas, Styles, JS... -->
</head>

<body>
    <livewire:toasts />

    <!-- Below toasts, your contents... -->
</body>

</html>
```

That's it! 🎉

***

## Customization

The toasts should look pretty good out of the box. However, we've documented a couple of ways to customize the views and
functionality.

### Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Usernotnull\Toast\ToastServiceProvider" --tag="tall-toast-config"
```

### Customizing views

You can publish and change all views in this package:

```bash
php artisan vendor:publish --provider="Usernotnull\Toast\ToastServiceProvider" --tag=tall-toast-views
```

These published views can be found and changed in `resources/views/vendor/tall-toast/`.

## Troubleshooting

Make sure you thoroughly go through this readme first!

If the checklist below does not resolve your problem, feel free
to [submit an issue](https://github.com/usernotnull/tall-toast/issues/new/choose). Make sure to follow the bug report
template. It helps us quickly reproduce the bug and resolve it.

### The popups won't show

-   Is the <livewire:toasts /> located in a page that has both the livewire and alpine/app.js script tags
    inserted? [(see)](#the-view)

-   Did you skip adding the ToastComponent as an alpine data component? [(see)](#alpinejs)

-   Did you forget calling push() at the end of the chained method? [(see)](#usage)

-   Have you tried calling the toast() helper function from another part of the application and check if it worked (it
    will help us scope the problem)? [(see)](#usage)

-   Did you try calling `php artisan view:clear`?

-   Are you getting any console errors?

### The popups show but look weird

-   You may need to rebuild your CSS by running: `npm run dev` or re-running `npm run watch` [(see)](#tailwindcss)

## Roadmap

-   [ ] Release to public
-   [ ] Sticky toasts that are only removed on click
-   [ ] Action toasts

Can you think of anything else that toasts can do?

## Other Packages

-   TALL Floating Action Menu (unreleased)

To stay updated, [follow me on Twitter](https://twitter.com/usernotnull).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Versioning

This project follows the [Semantic Versioning](https://semver.org/) guidelines.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [the security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [John F](https://github.com/usernotnull) ( [@usernotnull](https://twitter.com/usernotnull) )
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [the license file](LICENSE.md) for more information.
