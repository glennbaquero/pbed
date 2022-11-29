<?php

namespace App\Http\Middleware\Admin\CMS\Courses;

use App\Extenders\BaseMiddleware as Middleware;

class CourseUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.youth-works-courses.update'];
    }
}
