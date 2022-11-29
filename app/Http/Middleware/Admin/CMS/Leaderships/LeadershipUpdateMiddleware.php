<?php

namespace App\Http\Middleware\Admin\CMS\Leaderships;

use App\Extenders\BaseMiddleware as Middleware;

class LeadershipUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.our-leaderships.update'];
    }
}
