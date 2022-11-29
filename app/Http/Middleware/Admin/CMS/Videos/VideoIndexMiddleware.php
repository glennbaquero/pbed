<?php

namespace App\Http\Middleware\Admin\CMS\Videos;

use App\Extenders\BaseMiddleware as Middleware;

class VideoIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-videos.index', 'admin.youth-works-videos.create', 'admin.youth-works-videos.update', 'admin.youth-works-videos.archive'];
    }
}
