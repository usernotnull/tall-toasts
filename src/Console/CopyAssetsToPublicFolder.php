<?php

namespace Usernotnull\Toast\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyAssetsToPublicFolder extends Command
{
    /**
     * @var string
     */
    protected $signature = 'tall-toast:assets';

    /**
     * @var string
     */
    protected $description = 'Copy tall toasts assets to the public folder.';

    /**
     * Copies the files only if necessary.
     *
     * @return int
     */
    public function handle() : int
    {
        $vendorToastFile = __DIR__ . '/../../dist/js/tall-toasts.js';
        $vendorToastMap = __DIR__ . '/../../dist/js/tall-toasts.js.map';

        $publicToastFile = public_path('/toast/tall-toasts.js');
        $publicToastMap = public_path('/toast/tall-toasts.js.map');

        if($this->fileExists(public_path('toast/tall-toasts.js'))){
            if($this->fileIsSame($vendorToastFile, $publicToastFile)){
                $this->info('Tall Toasts Javascript does not need to be copied.');
                return Command::SUCCESS;
            }
        }

        $this->copyFile($vendorToastFile, $publicToastFile);
        $this->copyFile($vendorToastMap, $publicToastMap);

        $this->info('Copied Tall Toasts assets to public/toast/');

        return Command::SUCCESS;
    }

    /**
     * Checks if a file exists.
     * @param string $fileName
     * @return bool
     */
    private function fileExists(string $fileName) : bool
    {
        return File::exists($fileName);
    }

    /**
     * Checks if two file's contents are the same.
     * @param string $originalFile
     * @param string $publicFile
     * @return bool
     */
    private function fileIsSame(string $originalFile, string $publicFile) : bool
    {
        return file_get_contents($originalFile) === file_get_contents($publicFile);
    }

    /**
     * Copies a file to a new location.
     * @param string $fileFrom
     * @param string $fileTo
     * @return bool
     */
    private function copyFile(string $fileFrom, string $fileTo) : bool
    {
        return File::copy($fileFrom, $fileTo);
    }
}
