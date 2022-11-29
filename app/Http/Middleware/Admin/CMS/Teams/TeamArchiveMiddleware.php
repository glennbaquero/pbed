<?php

namespace App\Http\Middleware\Admin\CMS\Teams;

use App\Extenders\BaseMiddleware as Middleware;

class TeamArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-teams.archive'];
    }
}
