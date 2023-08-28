<?php

namespace App\Code\Framework\Config;

use App\Code\Framework\Config\Helper\File as FileHelper;

abstract class AbstractGenerator
{
    protected FileHelper $fileHelper;

    protected $moduleScopeTargetPath;

    public function __construct(FileHelper $fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    public function generate(): void
    {
        if ($this->moduleScopeTargetPath) {
            $this->fileHelper->mergeXmlFiles(
                $this->fileHelper->getRootDirectory() . '/var' . $this->moduleScopeTargetPath,
                ...$this->fileHelper->getAllFiles($this->moduleScopeTargetPath)
            );
        } else {
            throw new \Exception("Module scope target path was not provided for " . get_class($this));
        }
    }
}
