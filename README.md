<div align="center">

# Beautiful Notification Toasts For Laravel

A Toast global that can be called from the backend (via Controllers, Blade Views, Components) or frontend (JS, Alpine
Components) to render customizable toasts.

Runs with the TALL stack: [Laravel](https://laravel.com/docs/8.x/installation),
[TailwindCSS](https://tailwindcss.com/docs/guides/laravel),
[Livewire](https://laravel-livewire.com/docs/2.x/installation),
[AlpineJS](https://alpinejs.dev/essentials/installation).

[![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/usernotnull/tall-toasts?label=release&sort=semver&style=plastic)](https://github.com/usernotnull/tall-toasts/releases)
[![Build size Brotli](https://img.badgesize.io/usernotnull/tall-toasts/main/dist/js/tall-toasts.js.svg?compression=brotli&style=plastic&color=green&label=JS%20size)](https://github.com/usernotnull/tall-toasts/blob/main/dist/js/tall-toasts.js)  
[![Scrutinizer Score](https://img.shields.io/scrutinizer/g/usernotnull/tall-toasts.svg?style=plastic&label=scrutinizer%20score)](https://scrutinizer-ci.com/g/usernotnull/tall-toasts)
[![Codacy branch grade](https://img.shields.io/codacy/grade/0c6b4f96ac2a4a6cbf265f5e825a3fd2/main?style=plastic)](https://www.codacy.com/gh/usernotnull/tall-toasts/dashboard?utm_source=github.com&utm_medium=referral&utm_content=usernotnull/tall-toasts&utm_campaign=Badge_Grade)  
[![Styling](https://img.shields.io/github/workflow/status/usernotnull/tall-toasts/fix-styling?label=styling&style=plastic)](https://github.com/usernotnull/tall-toasts/actions/workflows/styling.yml)
[![Tests & Checks](https://img.shields.io/github/workflow/status/usernotnull/tall-toasts/run-checks?label=checks%20|%20tests&style=plastic)](https://github.com/usernotnull/tall-toasts/actions/workflows/checks.yml)
[![Codecov branch](https://img.shields.io/codecov/c/github/usernotnull/tall-toasts/main?style=plastic)](https://app.codecov.io/gh/usernotnull/tall-toasts)

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
tiny [(less than ONE kilobyte!)](https://img.badgesize.io/usernotnull/tall-toasts/main/dist/js/tall-toasts.js.svg?compression=brotli&style=plastic&color=green&label=JS%20size)
.

The CSS footprint is also negligible as it uses the default TailwindCSS classes. Even if you override the default views,
you will rest assured that Tailwind's purging will only keep the styles/classes you have used.

In plain English, it will not bloat your generated JS/CSS files nor add extra files to download as when using other JS
libs!

### Takes advantage of all the niceties that come with TALL

You can call it from anywhere! Memorize `Toast` for the frontend and `toast()` for the backend.

See the [usage section](#usage) for examples.

### Customizable

You have control over the view: As you are overriding the blade view, you'll be able to shape it as you like using
TailwindCSS classes.

No more messing with custom CSS overrides!

## Usage

### From The Frontend

```js
Toast.info('Notification from the front-end...', 'The Title');

Toast.success('A toast without a title also works');

Toast.warning('Watch out!');

Toast.danger('I warned you!', 'Yikes');

Toast.debug('I will NOT show in a production environment');
```

### From The Backend

```php
toast()
    ->info('I will appear only on the next page!')
    ->pushOnNextPage();

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

toast()
    ->danger('I will go…<br><i>to the next line 💪</i>', 'I am <span style="color:red;">HOT</span>')
    ->doNotSanitize()
    ->push();

toast()
    ->debug('I will NOT show in a production environment')
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

    public function sendCookie(): void
    {
        toast()
            ->success('You earned a cookie! 🍪')
            ->pushOnNextPage();

        redirect()->route('dashboard');
    }
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
PHP | ^8.0 | Make the switch, you won't regret it :)
Laravel | ^8.0 | [Official Installation Docs](https://laravel.com/docs/8.x/installation)
TailwindCSS | ^2.0 |[Official Installation Docs](https://tailwindcss.com/docs/guides/laravel)
Livewire | ^2.0 | [Official Installation Docs](https://laravel-livewire.com/docs/2.x/installation)
AlpineJS | ^3.0 | [Official Installation Docs](https://alpinejs.dev/essentials/installation)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require usernotnull/tall-toasts
```

## Setup

### TailwindCSS

Build your CSS as you usually do, ie

```bash
npm run dev
```

#### Usage With Tailwind JIT

If you are using [Just-in-Time Mode](https://tailwindcss.com/docs/just-in-time-mode), add these additional lines into
your `tailwind.config.js` file:

```js
purge: [
    './vendor/usernotnull/tall-toasts/config/**/*.php',
    './vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php',
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
import ToastComponent from '../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts'

Alpine.data('ToastComponent', ToastComponent)

window.Alpine = Alpine
Alpine.start()
```

*If you have a custom directory structure, you may have to adjust the above import path until it correctly points
to `tall-toasts.js` inside this vendor file.*

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
php artisan vendor:publish --provider="Usernotnull\Toast\ToastServiceProvider" --tag="tall-toasts-config"
```

These are the default contents of the published config file:

```php
<?php

return [
    /*
     * How long each toast will be displayed before fading out, in ms
     */
    'duration' => 5000,

    /*
     * How long to wait before displaying the toasts after page loads, in ms
     */
    'load_delay' => 400,
];

```

### Customizing views

You can publish and change all views in this package:

```bash
php artisan vendor:publish --provider="Usernotnull\Toast\ToastServiceProvider" --tag="tall-toasts-views"
```

The published views can be found and changed in `resources/views/vendor/tall-toast/`.

The published files are:

-   `includes/content.blade.php` - *the content view of each popup notification, fully configurable*
-   `includes/icon.blade.php` - *the icons of each notification type*
-   `livewire/toasts.blade.php` - *the parent of all toasts*

#### Text Sanitization

The content view displays the title and message with x-html. This is fine since the backend sanitizes the title and
message by default.

⚠️ If you wish to skip sanitization in order to display HTML content, such as bolding the text or adding `<br>` to go to
the next line, you will call doNotSanitize() as seen in the [usage section](#usage). In such case, make sure no user
input is provided!

## Troubleshooting

Make sure you thoroughly go through this readme first!

If the checklist below does not resolve your problem, feel free
to [submit an issue](https://github.com/usernotnull/tall-toasts/issues/new/choose). Make sure to follow the bug report
template. It helps us quickly reproduce the bug and resolve it.

### The toasts won't show

-   Is the <livewire:toasts /> located in a page that has both the livewire and alpine/app.js script tags
    inserted? [(see)](#the-view)

-   Did you skip adding the ToastComponent as an alpine data component? [(see)](#alpinejs)

-   Did you forget calling push() at the end of the chained method? [(see)](#usage)

-   Have you tried calling the toast() helper function from another part of the application and check if it worked (it
    will help us scope the problem)? [(see)](#usage)

-   Did you try calling `php artisan view:clear`?

-   Are you getting any console errors?

### The toasts show but look weird

-    Are you using TailwindCSS JIT? Don't forget to update your purge list! [(see)](#usage-with-tailwind-jit)
-    You may need to rebuild your CSS by running: `npm run dev` or re-running `npm run watch` [(see)](#tailwindcss)

## Other Packages

-   TALL Floating Action Menu (unreleased)
-   TALL Package Skeleton (unreleased)

To stay updated, [follow me on Twitter](https://twitter.com/usernotnull).

## Testing

This package uses [PestPHP](https://pestphp.com/) to run its tests.

-   To run tests without coverage, run:

```bash
composer test
```

-   To run tests with coverage, run:

```bash
composer test-coverage
```

## Contributing

This package has 3 GitHub Workflows which run sequentially when pushing PRs:

-   First, it checks for styling issues and automatically fixes them using:
    1. [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
    2. [PHP Code Beautifier](https://github.com/squizlabs/PHP_CodeSniffer)

-   Then, it uses static analysis followed by standard unit tests using:
    1. [Psalm](https://psalm.dev/)
    2. [PHP Stan](https://github.com/phpstan/phpstan)
    3. [PHP MessDetector](https://phpmd.org/)
    4. [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    5. [PestPHP](https://pestphp.com/)

-   Finally, it generates the minified JS dist which is injected by @toastScripts

When pushing PRs, it's a good idea to do a quick run and make sure the workflow checks out, which saves time during code
review before merging.

To facilitate the job, you can run the below command before pushing the PR:

```bash
composer workflow
```

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Versioning

This project follows the [Semantic Versioning](https://semver.org/) guidelines.

## Security Vulnerabilities

As per security best practices, do not call `doNotSanitize()` on a toast that has user input in its message or title!

Please review [the security policy](https://github.com/usernotnull/tall-toasts/security/policy) on how to report
security vulnerabilities.

## Credits

-   [John F](https://github.com/usernotnull) ( [@usernotnull](https://twitter.com/usernotnull) )
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [the license file](LICENSE.md) for more information.
