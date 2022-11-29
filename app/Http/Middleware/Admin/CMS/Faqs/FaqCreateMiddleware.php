<?php

namespace App\Http\Middleware\Admin\CMS\Faqs;

use App\Extenders\BaseMiddleware as Middleware;

class FaqCreateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.faqs.create'];
    }
}
