<?php

namespace App\Http\Middleware\Admin\CMS\Advisers;

use App\Extenders\BaseMiddleware as Middleware;

class AdviserCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advisers.create'];
    }
}
