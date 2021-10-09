<?php

declare(strict_types=1);

use Livewire\Component;
use Livewire\Livewire;
use Usernotnull\Toast\Concerns\WireToast;
use Usernotnull\Toast\Http\Livewire\ToastComponent;
use Usernotnull\Toast\ToastManager;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

it('only pulls toasts when x-toasts is missing', function () {
    toast()
        ->info('test')
        ->push();

    assertTrue(ToastManager::hasPendingToasts());

    new class () extends Component {
        use WireToast;

        public function __construct()
        {
            parent::__construct('123');
            $this->dehydrate(new \Livewire\Response(request()));
        }
    };

    assertFalse(ToastManager::hasPendingToasts());

    Livewire::test(ToastComponent::class);

    toast()
        ->info('test')
        ->push();

    assertTrue(ToastManager::hasPendingToasts());

    new class () extends Component {
        use WireToast;

        public function __construct()
        {
            parent::__construct('123');
            $this->dehydrate(new \Livewire\Response(request()));
        }
    };

    assertTrue(ToastManager::hasPendingToasts());
});
