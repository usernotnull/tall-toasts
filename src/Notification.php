<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

class Notification
{
    public function __construct(
        protected string $message,
        protected ?string $title,
        protected ?string $type = null
    ) {
        $this->message = htmlspecialchars($message, ENT_QUOTES);
        $this->title = $title ? htmlspecialchars($title, ENT_QUOTES) : '';
        $this->type = $type ?? NotificationType::$info;
    }

    protected function asArray(): array
    {
        return [
            'message' => $this->message,
            'title' => $this->title ?? '',
            'type' => $this->type,
        ];
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
