<?php

namespace App\Http\Middleware\Admin\CMS\Advocacies;

use App\Extenders\BaseMiddleware as Middleware;

class AdvocacyIndexMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.advocacies.index', 'admin.advocacies.create', 'admin.advocacies.update', 'admin.advocacies.archive'];
    }
}
