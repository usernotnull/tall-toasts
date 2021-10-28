<?php

declare(strict_types=1);

namespace Usernotnull\Toast\Concerns;

use Usernotnull\Toast\ToastManager;

trait WireToast
{
    public function dehydrate(): void
    {
        if (! ToastManager::componentRendered()) {
            foreach (ToastManager::pull() ?? [] as $notification) {
                $this->dispatchBrowserEvent('toast', $notification);
            }
        }
    }
}
