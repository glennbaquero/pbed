<?php

namespace App\Http\Middleware\Admin\CMS\News;

use App\Extenders\BaseMiddleware as Middleware;

class NewsCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.news.create'];
    }
}
