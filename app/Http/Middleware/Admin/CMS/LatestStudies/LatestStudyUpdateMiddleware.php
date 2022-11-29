<?php

namespace App\Http\Middleware\Admin\CMS\LatestStudies;

use App\Extenders\BaseMiddleware as Middleware;

class LatestStudyUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advocacies.update'];
    }
}
