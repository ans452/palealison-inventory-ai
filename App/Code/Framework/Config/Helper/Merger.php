<?php

namespace App\Code\Framework\Config\Helper;

use App\Code\Framework\Config\Helper\IMergeStrategy;
use App\Code\Framework\Config\Helper\Merger\MergeStrategyProvider;

class Merger implements IMergeStrategy
{
    private MergeStrategyProvider $mergeStrategyProvider;

    public function __construct(MergeStrategyProvider $mergeStrategyProvider)
    {
        $this->mergeStrategyProvider = $mergeStrategyProvider;
    } 
    
    public function merge($outputFile, ...$files): void
    {
        $pathInfo = pathinfo($outputFile, PATHINFO_EXTENSION);
        $this->mergeStrategyProvider->getMergeStrategy($pathInfo)->merge($outputFile, ...$files);
    }
}
