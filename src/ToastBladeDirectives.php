<?php

namespace Usernotnull\Toast;

class ToastBladeDirectives
{
    public static function toastScripts(string $expression): string
    {
        return '{!! \Usernotnull\Toast\ToastManager::scripts(' . $expression . ') !!}';
    }
}
