<?php

namespace App\Http\Middleware\Admin\CMS\Advisers;

use App\Extenders\BaseMiddleware as Middleware;

class AdviserArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advisers.archive'];
    }
}
