<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorks\YouthWorksTeams;

use App\Extenders\BaseMiddleware as Middleware;

class YouthWorksTeamArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-teams.archive'];
    }
}
