<?php

namespace App\Http\Middleware\Admin\CMS\ProjectPriorityAreas;

use App\Extenders\BaseMiddleware as Middleware;

class ProjectPriorityAreaIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.project-priority-areas.index', 'admin.project-priority-areas.create', 'admin.project-priority-areas.update', 'admin.project-priority-areas.archive'];
    }
}
