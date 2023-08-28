<?php

namespace App;

use App\Code\Framework\Build\Autoloader;
use App\Code\Framework\Config\GeneratorsProvider;
use App\Code\Framework\Data\Context;
use App\Code\Framework\ObjectManager;
use App\Code\Framework\Config\AbstractGenerator;
use App\Code\Framework\Controller\Router;

class Application
{
    public function __construct()
    {
        $this->init();
    }

    public function run(): void
    {
        /** @var Router $router*/
        $router = ObjectManager::getInstance()->get(Router::class);
        $action = $router->getAction();
        $result = $action->execute();
        $result->return();
         
    }

    /**
     * Setup config
     * 
     * @return void
     */
    public function setup(): void
    {
        /** @var GeneratorsProvider $generatorsProvider */
        $generatorsProvider = ObjectManager::getInstance()->get(GeneratorsProvider::class);
        foreach ($generatorsProvider->get() as $generator) {
            if ($generator instanceof AbstractGenerator) {
                $generator->generate();
            }
        }
    }

    private function init(): void
    {
        ObjectManager::createInstance(new Autoloader(require_once __DIR__ . '/loadConfig.php'));
        $this->initContext();
    }

    private function initContext(): void
    {
        $context = new Context(
            array_merge(
                array_change_key_case($_SERVER, CASE_LOWER),
                ['root_directory' => __DIR__]
            )
        );
        
        ObjectManager::getInstance()->setDefinition(
            Context::class,
            $context
        );
    }
}
