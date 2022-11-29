<?php

namespace App\Http\Middleware\Admin\CMS\Solutions;

use App\Extenders\BaseMiddleware as Middleware;

class SolutionCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.solutions.create'];
    }
}
