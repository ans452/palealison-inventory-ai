<?php

namespace App\Code\Framework\Config\Helper\Merger;

use App\Code\Framework\Config\Helper\IMergeStrategy;

class MergeStrategyProvider
{
    private array $mergeStrategyPool;

    public function __construct(array $mergeStrategyPool = [])
    {
        $this->mergeStrategyPool = $mergeStrategyPool;
    }

    public function getMergeStrategy($fileExtension): IMergeStrategy
    {
        return $this->mergeStrategyPool[$fileExtension];
    }
}

