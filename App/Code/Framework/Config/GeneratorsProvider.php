<?php

namespace App\Code\Framework\Config;

use App\Code\Framework\ObjectManager;
use App\Code\Framework\Config\Helper\File as FileHelper;

class GeneratorsProvider
{
    /**
     * @var string
     */
    const TARGET_DIR = '/Code/Framework/Config/Generator';

    const GENERATOR_NAMESPACE = 'App\\Code\\Framework\\Config\\Generator\\';

    private FileHelper $fileHelper;

    public function __construct(FileHelper $fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    public function get()
    {
        foreach ($this->fileHelper->getDirectoryFiles(self::TARGET_DIR) as $file) {
            yield ObjectManager::getInstance()->get(self::GENERATOR_NAMESPACE . $file);
        }
    }
}
