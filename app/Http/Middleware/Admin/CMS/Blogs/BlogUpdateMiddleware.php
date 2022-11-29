<?php

namespace App\Http\Middleware\Admin\CMS\Blogs;

use App\Extenders\BaseMiddleware as Middleware;

class BlogUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.blogs.update'];
    }
}
