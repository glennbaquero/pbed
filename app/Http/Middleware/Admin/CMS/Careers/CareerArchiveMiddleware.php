<?php

namespace App\Http\Middleware\Admin\CMS\Careers;

use App\Extenders\BaseMiddleware as Middleware;

class CareerArchiveMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.careers.archive'];
    }
}
