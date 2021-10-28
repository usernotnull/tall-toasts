<?php

declare(strict_types=1);

namespace Usernotnull\Toast\Concerns;

use Livewire\Response;
use Usernotnull\Toast\ToastManager;

trait WireToast
{
    public function dehydrate(Response $response): void
    {
        if (! ToastManager::componentRendered()) {
            foreach (ToastManager::pull() ?? [] as $notification) {
                $this->dispatchBrowserEvent('toast', $notification);
            }
        }
    }
}
