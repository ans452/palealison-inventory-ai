<?php

namespace App\Code\Framework\Controller\Result;

use App\Code\Framework\Controller\IResult;

class PageResult implements IResult
{
    public function return()
    {
        header('Content-Type: application/json');
        echo json_encode([1,23,43,5]);
    }
}
