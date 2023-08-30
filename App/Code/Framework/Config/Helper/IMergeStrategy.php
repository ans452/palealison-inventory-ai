<?php

namespace App\Code\Framework\Config\Helper;

interface IMergeStrategy
{
    public function merge($outputFile, ...$files): void;

}