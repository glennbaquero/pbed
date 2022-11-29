<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorks\YouthWorksTeams;

use App\Extenders\BaseMiddleware as Middleware;

class YouthWorksTeamUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-teams.update'];
    }
}
