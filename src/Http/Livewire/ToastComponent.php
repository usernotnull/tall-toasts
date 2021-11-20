<?php

declare(strict_types=1);

namespace Usernotnull\Toast\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Usernotnull\Toast\ToastManager;

class ToastComponent extends Component
{
    public int $duration;

    public int $loadDelay;

    public bool $prod;

    public array $toasts = [];

    public function dehydrate(): void
    {
        ToastManager::setComponentRendered(true);

        $this->toasts = array_merge($this->toasts, ToastManager::pull());
    }

    public function mount(): void
    {
        if (session()->has(config('tall-toasts.session_keys.toasts_next_page'))) {
            $this->toasts = ToastManager::pullNextPage();
        }

        $this->duration = config('tall-toasts.duration');

        $this->loadDelay = config('tall-toasts.load_delay');

        $this->prod = App::isProduction();
    }

    public function render(): View|Factory|Application
    {
        return app(ViewFactory::class)->make('tall-toasts::livewire.toasts');
    }

    public function updatedProd(): void
    {
        $this->prod = App::isProduction();
    }
}
