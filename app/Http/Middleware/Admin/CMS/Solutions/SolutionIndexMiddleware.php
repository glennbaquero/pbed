<?php

namespace App\Http\Middleware\Admin\CMS\Solutions;

use App\Extenders\BaseMiddleware as Middleware;

class SolutionIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.solutions.index', 'admin.solutions.create', 'admin.solutions.update', 'admin.solutions.archive'];
    }
}
