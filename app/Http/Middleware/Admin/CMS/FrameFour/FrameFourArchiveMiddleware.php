<?php

namespace App\Http\Middleware\Admin\CMS\FrameFour;

use App\Extenders\BaseMiddleware as Middleware;

class FrameFourArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.frame-four.archive'];
    }
}
