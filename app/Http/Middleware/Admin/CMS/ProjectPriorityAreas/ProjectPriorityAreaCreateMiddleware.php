<?php

namespace App\Http\Middleware\Admin\CMS\ProjectPriorityAreas;

use App\Extenders\BaseMiddleware as Middleware;

class ProjectPriorityAreaCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.project-priority-areas.create'];
    }
}
