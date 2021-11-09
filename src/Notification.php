<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

class Notification
{
    public function __construct(
        protected string $message,
        protected ?string $title,
        protected ?string $type = null,
        protected bool $sanitize = true
    ) {
        $this->type = $type ?? NotificationType::$info;
    }

    protected function asArray(): array
    {
        $message = $this->sanitize ? htmlspecialchars($this->message, ENT_QUOTES) : $this->message;
        $title = $this->sanitize && $this->title ? htmlspecialchars($this->title, ENT_QUOTES) : $this->title;
        $type = $this->type;

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
