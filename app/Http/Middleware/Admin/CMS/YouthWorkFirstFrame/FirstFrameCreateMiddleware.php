<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorkFirstFrame;

use App\Extenders\BaseMiddleware as Middleware;

class FirstFrameCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youthwork-first-frame.create'];
    }
}
