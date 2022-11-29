<?php

namespace App\Http\Middleware\Admin\CMS\Leaderships;

use App\Extenders\BaseMiddleware as Middleware;

class LeadershipIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.our-leaderships.index', 'admin.our-leaderships.create', 'admin.our-leaderships.update', 'admin.our-leaderships.archive'];
    }
}
