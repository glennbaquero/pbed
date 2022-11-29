<?php

namespace App\Http\Middleware\Admin\CMS\FrameFour;

use App\Extenders\BaseMiddleware as Middleware;

class FrameFourIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.frame-four.index', 'admin.frame-four.create', 'admin.frame-four.update', 'admin.frame-four.archive'];
    }
}
