<?php

namespace App\Http\Middleware\Admin\CMS\Projects;

use App\Extenders\BaseMiddleware as Middleware;

class ProjectIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.projects.index', 'admin.projects.create', 'admin.projects.update', 'admin.projects.archive'];
    }
}
