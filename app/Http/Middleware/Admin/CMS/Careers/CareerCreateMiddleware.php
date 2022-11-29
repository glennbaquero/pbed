<?php

namespace App\Http\Middleware\Admin\CMS\Careers;

use App\Extenders\BaseMiddleware as Middleware;

class CareerCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.careers.create'];
    }
}
