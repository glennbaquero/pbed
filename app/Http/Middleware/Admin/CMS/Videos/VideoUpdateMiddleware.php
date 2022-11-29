<?php

namespace App\Http\Middleware\Admin\CMS\Videos;

use App\Extenders\BaseMiddleware as Middleware;

class VideoUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-videos.update'];
    }
}
