<?php

require_once 'bootstrap.php';

$application = new \App\Application();
try {
    $application->run();
} catch (\Exception $e) {
    echo $e->getMessage();
}
