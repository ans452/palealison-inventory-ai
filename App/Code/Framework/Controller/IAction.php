<?php

namespace App\Code\Framework\Controller;

use App\Code\Framework\Controller\IResult;

interface IAction
{
    public function execute(): IResult;
}
