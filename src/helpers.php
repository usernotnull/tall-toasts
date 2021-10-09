<?php

declare(strict_types=1);

use Usernotnull\Toast\Toast;

if (! function_exists('toast')) {
    function toast(): Toast
    {
        return app('toast');
    }
}
