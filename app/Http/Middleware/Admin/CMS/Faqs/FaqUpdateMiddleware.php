<?php

namespace App\Http\Middleware\Admin\CMS\Faqs;

use App\Extenders\BaseMiddleware as Middleware;

class FaqUpdateMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.faqs.update'];
    }
}
