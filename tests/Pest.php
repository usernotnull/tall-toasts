<?php

declare(strict_types=1);

use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use Usernotnull\Toast\Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');

function createFakeComponent(): void
{
    $component = new class () extends Component {
        use WireToast;
    };

    $component->renderedWireToast();
}

function setEnvironment(string $environment = 'testing'): void
{
    app()->detectEnvironment(fn () => $environment);
}
