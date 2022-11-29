<?php

namespace App\Http\Middleware\Admin\CMS\LatestStudies;

use App\Extenders\BaseMiddleware as Middleware;

class LatestStudyCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.home-latest-study.create'];
    }
}
