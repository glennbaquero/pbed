<?php

namespace App\Http\Middleware\Admin\CMS\LatestStudies;

use App\Extenders\BaseMiddleware as Middleware;

class LatestStudyIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.home-latest-study.index', 'admin.home-latest-study.create', 'admin.home-latest-study.update', 'admin.home-latest-study.archive'];
    }
}
