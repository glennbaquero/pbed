<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorks\YouthWorksTeams;

use App\Extenders\BaseMiddleware as Middleware;

class YouthWorksTeamIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-teams.index', 'admin.youth-works-teams.create', 'admin.youth-works-teams.update', 'admin.youth-works-teams.archive'];
    }
}
