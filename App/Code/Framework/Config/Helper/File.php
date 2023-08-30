<?php

namespace App\Code\Framework\Config\Helper;

use App\Code\Framework\Data\Context;

class File
{
    /**
     * @var string
     */
    const ROOT_DIRECTORY_SPECIFICATION = 'Code';

    private Context $context;

    private Merger $merger;

    public function __construct(Context $context, Merger $merger)
    {
        $this->context = $context;
        $this->merger = $merger;
    }

    public function getDirectoryFiles($directory): \Generator
    {
        $targetDirectory =
            $this->context->getRootDirectory() . $directory;

        if (is_dir($targetDirectory)) {
            $handle = opendir($targetDirectory);

            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                    yield pathinfo($file, PATHINFO_FILENAME);
                }
            }

            closedir($handle);
        }
    }

    public function getAllFiles($pattern)
    {
        $files = [];
        $rootDirectory = $this->context->getRootDirectory() . DIRECTORY_SEPARATOR . self::ROOT_DIRECTORY_SPECIFICATION;
        $directories = glob($rootDirectory . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {
            $file = $directory . $pattern;
            if (file_exists($file)) {
                $files[] = $file;
            }
        }
        return $files;
    }

    public function getRootDirectory()
    {
        return $this->context->getRootDirectory();
    }

    public function merge($outputFile, ...$inputFile) {
        $this->merger->merge($outputFile, ...$inputFile);
    }
}
