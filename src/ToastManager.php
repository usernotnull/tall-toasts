<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;

/**
 * @see \Usernotnull\Toast\Toast
 */
class ToastManager extends Facade
{
    public bool $componentRendered = false;

    public static function componentRendered(): bool
    {
        return app('toast.manager')->componentRendered;
    }

    protected static function filterNotifications(array $notifications): array
    {
        return collect($notifications)
            ->filter(
                fn (array $notification) => ! App::isProduction() || $notification['type'] !== NotificationType::$debug
            )
            ->values()
            ->toArray();
    }

    protected static function getFacadeAccessor(): string
    {
        return 'toast';
    }

    public static function hasPendingToasts(): bool
    {
        return session()->has(config('tall-toasts.session_keys.toasts'));
    }

    protected static function javaScriptAssets(array $options): string
    {
        $appUrl = config('toast.asset_url') ?: rtrim($options['asset_url'] ?? '', '/');

        $manifestContent = File::get(__DIR__ . '/../dist/js/manifest.json');

        $manifest = json_decode($manifestContent, true, 512, JSON_THROW_ON_ERROR);
        $versionedFileName = $manifest['/tall-toasts.js'];

        // Default to dynamic `tall-toasts.js` (served by a Laravel route).
        $fullAssetPath = "{$appUrl}/toast{$versionedFileName}";

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        // Adding semicolons for this JavaScript is important,
        // because it will be minified in production.
        return <<<HTML
<script src="{$fullAssetPath}" data-turbo-eval="false" data-turbolinks-eval="false" {$nonce}></script>
<script data-turbo-eval="false" data-turbolinks-eval="false" {$nonce}>
    document.addEventListener('alpine:init', () => {
        window.Alpine.directive('ToastComponent', window.ToastComponent);
    });
</script>
HTML;
    }

    protected static function minify(string $subject): ?string
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }

    public static function pull(): array
    {
        return self::filterNotifications(session()->pull(config('tall-toasts.session_keys.toasts'), []));
    }

    public static function pullNextPage(): array
    {
        return self::filterNotifications(session()->pull(config('tall-toasts.session_keys.toasts_next_page'), []));
    }

    public static function scripts(array $options = []): string
    {
        $debug = config('app.debug');

        $scripts = self::javaScriptAssets($options);

        $html = $debug ? ['<!-- Toast Scripts -->'] : [];

        $html[] = $debug ? $scripts : self::minify($scripts);

        return implode("\n", $html);
    }

    public static function setComponentRendered(bool $rendered): void
    {
        app('toast.manager')->componentRendered = $rendered;
    }
}
