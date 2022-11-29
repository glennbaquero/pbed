<?php

namespace App\Http\Middleware\Admin\CMS\Advocacies;

use App\Extenders\BaseMiddleware as Middleware;

class AdvocacyUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advocacies.update'];
    }
}
