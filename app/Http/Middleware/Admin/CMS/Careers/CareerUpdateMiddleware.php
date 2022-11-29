<?php

namespace App\Http\Middleware\Admin\CMS\Careers;

use App\Extenders\BaseMiddleware as Middleware;

class CareerUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.careers.update'];
    }
}
