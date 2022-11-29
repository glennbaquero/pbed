<?php

namespace App\Http\Middleware\Admin\CMS\Courses;

use App\Extenders\BaseMiddleware as Middleware;

class CourseIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-courses.index', 'admin.youth-works-courses.create', 'admin.youth-works-courses.update', 'admin.youth-works-courses.archive'];
    }
}
