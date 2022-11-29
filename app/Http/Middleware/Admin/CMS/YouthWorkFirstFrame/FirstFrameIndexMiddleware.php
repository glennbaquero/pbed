<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorkFirstFrame;

use App\Extenders\BaseMiddleware as Middleware;

class FirstFrameIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youthwork-first-frame.index', 'admin.youthwork-first-frame.create', 'admin.youthwork-first-frame.update', 'admin.youthwork-first-frame.archive'];
    }
}
