<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

class Notification
{
    protected bool $sanitize;

    protected string $message;

    protected ?string $title;

    protected ?string $type;

    public function __construct(
        string $message,
        ?string $title,
        ?string $type = null
    ) {
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

        return compact('message', 'title', 'type');
    }

    public function doNotSanitize(): Notification
    {
        $this->sanitize = false;

        return $this;
    }

    public static function make(
        string $message,
        ?string $title,
        ?string $type = null
    ): array {
        return (new static($message, $title, $type))->asArray();
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
