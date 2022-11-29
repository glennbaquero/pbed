<?php

namespace App\Http\Middleware\Admin\CMS\FirstFrame;

use App\Extenders\BaseMiddleware as Middleware;

class FirstFrameCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.home-first-frame.create'];
    }
}
