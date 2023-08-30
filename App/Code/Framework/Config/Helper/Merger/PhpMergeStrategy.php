<?php

namespace App\Code\Framework\Config\Helper\Merger;

use App\Code\Framework\Config\Helper\IMergeStrategy;

class PhpMergeStrategy implements IMergeStrategy
{
    public function merge($outputFile, ...$files): void
    {
        $mergedArray = [];
        foreach ($files as $file) {
            $mergedArray = array_merge($mergedArray, require_once $file);
        }

        $serializedArray = [];
        foreach ($mergedArray as $key => $value) {
            $serializedArray[$key] = serialize($value);  
        }

        file_put_contents($outputFile, var_export($serializedArray, true));
    }
}

