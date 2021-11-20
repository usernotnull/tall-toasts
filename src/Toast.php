<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

use function is_string;

class Toast
{
    public function danger(string $message, string $title = null): Notification
    {
        return new Notification($message, $title, NotificationType::$danger);
    }

    public function debug(mixed $message, string $title = null): Notification
    {
        if (! is_string($message)) {
            $message = json_encode($message, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        }

        return new Notification($message, $title, NotificationType::$debug);
    }

    public function info(string $message, string $title = null): Notification
    {
        return new Notification($message, $title, NotificationType::$info);
    }

    public function success(string $message, string $title = null): Notification
    {
        return new Notification($message, $title, NotificationType::$success);
    }

    public function warning(string $message, string $title = null): Notification
    {
        return new Notification($message, $title, NotificationType::$warning);
    }
}
