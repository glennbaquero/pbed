<?php

namespace App\Http\Middleware\Admin\CMS\Advisers;

use App\Extenders\BaseMiddleware as Middleware;

class AdviserIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advisers.index', 'admin.advisers.create', 'admin.advisers.update', 'admin.advisers.archive'];
    }
}
