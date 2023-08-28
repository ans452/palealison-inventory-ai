<?php

namespace App\Code\Framework\Data;

use App\Code\Framework\Data\Context;

class ContextProvider
{
    public function get($additionalData = []): Context
    {
        return new Context(array_merge($_SERVER, $additionalData));
    }
}
