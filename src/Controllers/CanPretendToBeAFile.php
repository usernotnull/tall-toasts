<?php

namespace Usernotnull\Toast\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use function is_string;

trait CanPretendToBeAFile
{
    protected function httpDate(int|false $timestamp): string
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp ?: null));
    }

    protected function matchesCache(int|false $lastModified): bool
    {
        $modifiedSince = Request::server('HTTP_IF_MODIFIED_SINCE', '');

        return is_string($modifiedSince) && strtotime($modifiedSince) === $lastModified;
    }

    public function pretendResponseIsFile(
        string $file,
        string $mimeType = 'application/javascript'
    ): Response|BinaryFileResponse {
        $expires = strtotime('+1 year');
        $lastModified = File::lastModified($file);
        $cacheControl = 'public, max-age=31536000';

        if ($this->matchesCache($lastModified)) {
            return response()->make('', 304, [
                'Expires' => $this->httpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        return response()->file($file, [
            'Content-Type' => "$mimeType; charset=utf-8",
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ]);
    }
}
