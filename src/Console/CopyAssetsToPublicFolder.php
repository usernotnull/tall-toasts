<?php

namespace Usernotnull\Toast\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyAssetsToPublicFolder extends Command
{
    /**
     * @var string
     */
    protected $signature = 'tall-toasts:assets';

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
        $vendorFolder = __DIR__ . '/../../dist/js';

        $vendorToastFile = $vendorFolder . '/tall-toasts.js';


        $publicFolder = public_path('/toast');

        $publicToastFile = $publicFolder . '/tall-toasts.js';

        if($this->fileExists($publicToastFile)){
            if($this->fileIsSame($vendorToastFile, $publicToastFile)){
                $this->info('Tall Toasts Javascript does not need to be copied.');
                return Command::SUCCESS;
            };
        }
        else {
            File::makeDirectory($publicFolder);
        }

        $this->copyDir($vendorFolder, $publicFolder);

        $this->info('Copied Tall Toasts assets to ' . $publicFolder);

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
    private function copyDir(string $fromFolder, string $toFolder) : bool
    {
        return File::copyDirectory($fromFolder, $toFolder);
    }
}
