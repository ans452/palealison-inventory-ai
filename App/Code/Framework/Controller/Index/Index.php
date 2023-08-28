<?php

namespace App\Code\Framework\Controller\Index;

use App\Code\Framework\Controller\IResult;
use App\Code\Framework\Controller\Result\PageResult;
use App\Code\Framework\Controller\IAction;

class Index implements IAction
{
    public function execute(): IResult
    {
        return new PageResult();
    }
}
