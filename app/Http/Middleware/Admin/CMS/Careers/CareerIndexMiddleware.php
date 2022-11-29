<?php

namespace App\Http\Middleware\Admin\CMS\Careers;

use App\Extenders\BaseMiddleware as Middleware;

class CareerIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.careers.index', 'admin.careers.create', 'admin.careers.update', 'admin.careers.archive'];
    }
}
