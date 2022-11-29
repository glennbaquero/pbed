<?php

namespace App\Http\Middleware\Admin\CMS\Blogs;

use App\Extenders\BaseMiddleware as Middleware;

class BlogIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.blogs.index', 'admin.blogs.create', 'admin.blogs.update', 'admin.blogs.archive'];
    }
}
