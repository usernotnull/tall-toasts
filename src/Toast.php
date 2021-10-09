<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

class Toast
{
    public function danger(string $message, string $title = null): Notification
    {
        return new Notification($message, $title, NotificationType::$danger);
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
