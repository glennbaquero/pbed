<?php

namespace App\Http\Middleware\Admin\CMS\News;

use App\Extenders\BaseMiddleware as Middleware;

class NewsIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.news.index', 'admin.news.create', 'admin.news.update', 'admin.news.archive'];
    }
}
