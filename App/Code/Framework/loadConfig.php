<?php

return [
    'App\Code\Framework\Config\Helper\Merger\MergeStrategyProvider' => function ($autoloader) {
        return new \App\Code\Framework\Config\Helper\Merger\MergeStrategyProvider([
            'xml' => $autoloader->get('App\Code\Framework\Config\Helper\Merger\XmlMergeStrategy'),
            'php' => $autoloader->get('App\Code\Framework\Config\Helper\Merger\PhpMergeStrategy')
        ]);
    }
];
