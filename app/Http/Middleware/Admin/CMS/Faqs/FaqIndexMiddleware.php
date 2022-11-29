<?php

namespace App\Http\Middleware\Admin\CMS\Faqs;

use App\Extenders\BaseMiddleware as Middleware;

class FaqIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.faqs.index', 'admin.faqs.create', 'admin.faqs.update', 'admin.faqs.archive'];
    }
}
