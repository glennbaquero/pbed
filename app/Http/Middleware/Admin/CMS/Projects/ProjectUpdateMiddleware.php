<?php

namespace App\Http\Middleware\Admin\CMS\Projects;

use App\Extenders\BaseMiddleware as Middleware;

class ProjectUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.projects.update'];
    }
}
