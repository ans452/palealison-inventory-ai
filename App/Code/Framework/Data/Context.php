<?php

namespace App\Code\Framework\Data;

use App\Code\Framework\Data\DataObject;

class Context extends DataObject
{
    const DEFAULT_ACTION_PATH = 'index/index/index';

    const DEFUALT_PATH = 'index';

    const PATH_LIMIT = 3;

    public function getActionPath()
    {
        if (!parent::getActionPath()) {
            $paths = explode('/', substr($this->getPathInfo(), 1) ?: self::DEFAULT_ACTION_PATH);
            $actionPath = '';
            $controllerPath = '';
            for ($i = 0; $i < self::PATH_LIMIT; $i++) {
                $path  = $paths[$i] ?? self::DEFUALT_PATH;

                if ($i == 0) {
                    $this->setFrontName($path);
                } else {
                    $controllerPath .=
                        ucfirst($path) . ($i < self::PATH_LIMIT - 1 ? '\\' : '');
                }

                $actionPath .= $path;

                if ($i < self::PATH_LIMIT) {

                    $actionPath .= '/';
                }
            }
            $this->setControllerPath($controllerPath);
            $this->setActionPath($actionPath);
        }
        return parent::getActionPath();
    }

    public function getFrontName()
    {
        if (!parent::getFrontName()) {
            $this->getActionPath();
        }
        return parent::getFrontName();
    }

    public function getControllerPath()
    {
        if (!parent::getControllerPath()) {
            $this->getActionPath();
        }
        return parent::getControllerPath();
    }
}
