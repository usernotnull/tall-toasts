<?php

namespace Usernotnull\Toast\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JavaScriptAssets
{
    use CanPretendToBeAFile;

    public function maps(): Response|BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/js/tall-toasts.js.map');
    }

    public function source(): Response|BinaryFileResponse
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../dist/js/tall-toasts.js');
    }
}
