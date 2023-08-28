<?php

namespace App\Code\Framework\Controller;

use App\Code\Framework\Data\Context;
use App\Code\Framework\ObjectManager;

class Router
{
    const SEARCH_PATTERN = "route[@frontName='%s']";

    const TARGET_PATH_FILE = '/var/etc/route.xml';

    private Context $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    public function getAction()
    {
        $xml = simplexml_load_file($this->context->getRootDirectory() . self::TARGET_PATH_FILE);
        $routes = $xml->xpath(sprintf(
            self::SEARCH_PATTERN,
            $this->context->getFrontName()
        ));

        if (count($routes) > 0) {
            $moduleName = (string) $routes[0]->module;
            return ObjectManager::getInstance()->get(
                'App\Code\\' . $moduleName . '\\Controller\\' . $this->context->getControllerPath()
            );
        }
    }
}
