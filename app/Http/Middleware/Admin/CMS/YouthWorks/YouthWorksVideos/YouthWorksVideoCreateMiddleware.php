<?php

namespace App\Http\Middleware\Admin\CMS\YouthWorks\YouthWorksVideos;

use App\Extenders\BaseMiddleware as Middleware;

class YouthWorksVideoCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-videos.create'];
    }
}
