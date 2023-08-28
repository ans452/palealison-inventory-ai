<?php

namespace App\Code\Framework\Build;

use App\Code\Framework\Build\Autoloader;

class AutoloaderFactory
{
    public function create(): Autoloader
    {
        return new Autoloader();
    }
}
