<?php

declare(strict_types=1);

namespace Usernotnull\Toast\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Usernotnull\Toast\ToastManager;

class ToastComponent extends Component
{
    public int $duration;

    public int $loadDelay;

    public array $toasts = [];

    public function dehydrate(): void
    {
        ToastManager::setComponentRendered(true);
        $this->toasts = array_merge($this->toasts, ToastManager::pull());
    }

    public function mount(): void
    {
        $this->duration = config('tall-toasts.duration');
        $this->loadDelay = config('tall-toasts.load_delay');
    }

    public function render(): View|Factory|Application
    {
        return app(ViewFactory::class)->make('tall-toasts::livewire.toasts');
    }
}
