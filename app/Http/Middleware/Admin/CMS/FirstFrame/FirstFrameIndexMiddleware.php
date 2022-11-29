<?php

namespace App\Http\Middleware\Admin\CMS\FirstFrame;

use App\Extenders\BaseMiddleware as Middleware;

class FirstFrameIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.home-first-frame.index', 'admin.home-first-frame.create', 'admin.home-first-frame.update', 'admin.home-first-frame.archive'];
    }
}
