<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

class Notification
{
    protected bool $sanitize;

    protected string $message;

    protected ?string $title;

    protected ?string $type;

    protected ?int $duration;

    public function __construct(
        string $message,
        ?string $title,
        ?string $type = null,
        ?int $duration = null
    ) {
        $this->duration = $duration;
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        $this->sanitize = $type !== NotificationType::$debug;
    }

    protected function asArray(): array
    {
        $message = $this->sanitize ? htmlspecialchars($this->message, ENT_QUOTES) : $this->message;
        $title = $this->sanitize && $this->title ? htmlspecialchars($this->title, ENT_QUOTES) : $this->title;
        $type = $this->type ?? NotificationType::$info;
        $duration = $this->duration ?? config('tall-toasts.duration');

        return compact('message', 'title', 'type', 'duration');
    }

    public function doNotSanitize(): Notification
    {
        $this->sanitize = false;

        return $this;
    }

    public static function make(
        string $message,
        ?string $title,
        ?string $type = null,
        ?int $duration = null
    ): array {
        return (new static($message, $title, $type, $duration))->asArray();
    }

    public function duration(int $duration): Notification
    {
        $this->duration = $duration;

        return $this;
    }

    public function keep(): Notification
    {
        $this->duration = 0;

        return $this;
    }

    public function push(): void
    {
        session()->push(config('tall-toasts.session_keys.toasts'), $this->asArray());
    }

    public function pushOnNextPage(): void
    {
        session()->push(config('tall-toasts.session_keys.toasts_next_page'), $this->asArray());
    }
}
